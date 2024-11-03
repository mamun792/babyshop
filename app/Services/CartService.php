<?php

namespace App\Services;

use App\Models\Campaign;
use App\Models\CartItem;
use App\Models\CartItemOption;
use App\Models\Product;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class CartService
{



    /**
     * Check if attributes match the existing cart item.
     */
    private function attributesMatch(CartItem $cartItem, ?array $attributes): bool
    {
        if (empty($attributes) || !is_array($attributes)) {
            Log::info('No valid attributes provided for product ID: ' . $cartItem->product_id);
            return false;
        }


        $existingOptions = $cartItem->options()->pluck('option_id')->map('strval')->toArray();


        $sizeId = $attributes['size']['id'] ?? null;
        if ($sizeId && !in_array($sizeId, $existingOptions)) {
            Log::info("No matching size attribute found for cart item ID: {$cartItem->id}");
            return false;
        }


        $colorId = $attributes['color']['id'] ?? null;
        if ($colorId !== null && !in_array($colorId, $existingOptions)) {
            Log::info("No matching color attribute found for cart item ID: {$cartItem->id}");
            return false;
        }

        Log::info("Attributes match for cart item ID: {$cartItem->id}");
        return true;
    }



    public function addCartItem(array $data, int $userId)
    {
        Log::info('Incoming data: ' . json_encode($data));


        $cartItem = CartItem::where('user_id', $userId)
            ->where('product_id', $data['product_id'])
            ->get()
            ->first(fn($item) => $this->attributesMatch($item, $data['attributes']));


        if ($cartItem) {
            $cartItem->increment('quantity', $data['quantity']);
            Log::info("Updated cart item ID {$cartItem->id} with new quantity: {$cartItem->quantity}");
            return $cartItem;
        }


        $cartItem = CartItem::create([
            'user_id' => $userId,
            'product_id' => $data['product_id'],
            'quantity' => $data['quantity'],
            'campaign_id' => $data['campaign_id'] ?? null,
        ]);


        $this->attachAttributesToCartItem($cartItem, $data['attributes']);

        //  Log::info("New cart item created with ID {$cartItem->id}");
        return $cartItem;
    }



    /**
     * Attach attributes to the cart item.
     */
    private function attachAttributesToCartItem(CartItem $cartItem, ?array $attributes): void
    {
        if (!empty($attributes) && is_array($attributes)) {
            foreach ($attributes as $key => $attribute) {
                if (!empty($attribute['id'])) {
                    Log::info("Inserting option ID: {$attribute['id']} for cart item ID: {$cartItem->id}");

                    // Create option for the cart item
                    $cartItem->options()->create([
                        'option_id' => strval($attribute['id']),
                        'cart_item_id' => $cartItem->id,
                    ]);
                } else {
                    Log::warning("Invalid attribute structure for '{$key}': " . json_encode($attribute));
                }
            }
        }
    }



    // public function fetchCartData($userId)
    // {
    //     $cartItems = CartItem::where('user_id', $userId)
    //         ->with(['product', 'campaign','options.option'])
    //         ->get()
    //         ->map(function ($item) {
    //             // Initialize discount variable
    //             $fixedDiscount = 0;

    //             if ($item->campaign_id) {
    //                 $campaign = Campaign::find($item->campaign_id);

    //                 // Check if the campaign is active
    //                 if ($campaign && now()->between($campaign->start_date, $campaign->expiry_date)) {
    //                     $fixedDiscount = $campaign->discount; // Get discount
    //                 }
    //             }

    //             return [
    //                 'featured_image' => $item->product->featured_image ?? 'default_image.jpg',
    //                 'name' => $item->product->name,
    //                 'size' => $item->size ?? 'N/A',
    //                 'quantity' => $item->quantity,
    //                 'price' => $item->product->price,
    //                 'campaign_id' => $item->campaign_id,
    //                 'discount' => $fixedDiscount, // Include discount in the mapped data
    //             ];
    //         });

    //     $count = $cartItems->count();
    //     $total = $cartItems->sum(function ($item) {
    //         $itemPrice = $item['price'];
    //         $fixedDiscount = $item['discount']; // Use the discount from mapped data

    //         $effectivePrice = max(0, $itemPrice - $fixedDiscount);

    //         // Calculate total for this item considering quantity
    //         return $effectivePrice * $item['quantity'];
    //     });

    //     return [
    //         'count' => $count,
    //         'items' => $cartItems,
    //         'total' => $total,
    //     ];
    // }




    public function fetchCartData($userId)
    {
        $cartItems = CartItem::where('user_id', $userId)
            ->with(['product', 'campaign', 'options.option']) // Ensure 'options.option' is included
            ->get()
            ->map(function ($item) {
                // Initialize discount variable
                $fixedDiscount = 0;

                if ($item->campaign_id) {
                    $campaign = Campaign::find($item->campaign_id);

                    // Check if the campaign is active
                    if ($campaign && now()->between($campaign->start_date, $campaign->expiry_date)) {
                        $fixedDiscount = $campaign->discount; // Get discount
                    }
                }

                return [
                    'id' => $item->product->id,
                    'cart_id' => $item->id,
                    'featured_image' => $item->product->featured_image ?? 'default_image.jpg',
                    'name' => $item->product->name,
                    'product_price' => $item->product->price,
                    'size' => $item->size ?? 'N/A',
                    'quantity' => $item->quantity,

                    'campaign_id' => $item->campaign_id,
                    'discount' => $fixedDiscount,
                    'price' => ($item->product->price * $item->quantity) - (($fixedDiscount ?? 0) * $item->quantity),

                    'options' => $item->options->map(function ($option) {
                        return [
                            'option_id' => $option->option->id,
                            'option_name' => $option->option->name,

                        ];
                    }),
                ];
            });

        $count = $cartItems->count();
        $total = $cartItems->sum(function ($item) {
            return $item['price'];
        });

        return [
            'count' => $count,
            'items' => $cartItems,
            'total' => $total,
        ];
    }

    // public function updateCartItem(array $data, $userId)
    // {
    //     Log::info('Incoming data: ' . json_encode($data));

    //     // Map `item_id` to `product_id` if it's set
    //     $data['product_id'] = $data['product_id'] ?? $data['item_id'];

    //     // Uncomment if validation is required
    //     // $this->validateUpdateRequest($data);

    //     // Check product availability
    //     $product = Product::findOrFail($data['product_id']);
    //     if ($product->quantity < $data['quantity']) {
    //         Log::error("Insufficient stock for product: {$product->name}");
    //         throw new \Exception("Insufficient stock for product: {$product->name}", 422);
    //     }

    //     // Check if the cart item exists for the user 
    //     $cartItem = $this->findCartItem($userId, $data['product_id']);
    //     if (!$cartItem) {
    //         Log::error('Cart item not found');
    //         throw new \Exception('Cart item not found', 404);
    //     }  

    //     // cart item options are match with the existing cart item this product quantity will be updated
    //     if ($this->attributesMatch($cartItem, $data['attributes'])) {
    //         $cartItem->increment('quantity', $data['quantity']);
    //         Log::info("Updated cart item ID {$cartItem->id} with new quantity: {$cartItem->quantity}");
    //         return $cartItem;
    //     }


    //     // Update quantity in cart item
    //    // $cartItem->update(['quantity' => $data['quantity']]);

    //     return $cartItem;
    // }

   
    public function updateCartItem(array $data, $userId)
    {
        Log::info('Incoming data: ' . json_encode($data));
    
        // Map `item_id` to `product_id` if it's set
        $data['product_id'] = $data['product_id'] ?? $data['item_id'];
    
        // Uncomment if validation is required
        // $this->validateUpdateRequest($data);
    
        // Check product availability
        $product = Product::findOrFail($data['product_id']);
        if ($product->quantity < $data['quantity']) {
            Log::error("Insufficient stock for product: {$product->name}");
            throw new \Exception("Insufficient stock for product: {$product->name}", 422);
        }
    
        // Check if the cart item exists for the user based on both product ID and attributes
        $cartItem = $this->findCartItem($userId, $data['product_id'], $data['attributes'] ?? null);
        if (!$cartItem) {
            Log::error('Cart item not found');
            throw new \Exception('Cart item not found', 404);
        }  
    
        // Check if attributes are set and match the existing cart item
        if (!empty($data['attributes'])) {
            if ($this->attributesMatch($cartItem->attributes, $data['attributes'])) {
                $cartItem->increment('quantity', $data['quantity']);
                Log::info("Updated cart item ID {$cartItem->id} with new quantity: {$cartItem->quantity}");
                return $cartItem;
            } else {
                Log::error('Attributes do not match for the cart item ID ' . $cartItem->id);
                throw new \Exception('Attributes do not match for the cart item', 422);
            }
        } else {
            // If no attributes are provided, update quantity without checking attributes
            $cartItem->update(['quantity' => $data['quantity']]);
            Log::info("Updated cart item ID {$cartItem->id} with new quantity: {$cartItem->quantity}");
            return $cartItem;
        }
    }
    

    protected function findCartItem($userId, $productId, $attributes = null)
    {
        $query = CartItem::where('user_id', $userId)->where('product_id', $productId);
    
        if ($attributes) {
            // Assuming attributes are stored as JSON or similar format
            $query->where('attributes', json_encode($attributes));
        }
    
        return $query->first();
    }
    



    // private function findCartItem($userId, $productId)
    // {
    //     return CartItem::where('user_id', $userId)
    //         ->where('product_id', $productId)
    //         ->first();
    // }
}
