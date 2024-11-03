<?php


namespace App\Services;

use App\Models\Campaign;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Wishlist;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log; // For logging
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;

class ProductService
{
    /**
     * Fetch product details by slug with relationships.
     *
     * @param string $slug
     * @return Product|null
     */
   

    public function getProductBySlug(string $slug): ?Product
{
    try {
        $product = Product::with([
            'category:id,name',
            'productOptions:id,product_id,product_option_id',
            'productOptions.option:id,name,attribute_id',
            'productOptions.option.attribute:id,name',
            'brand:id,company',
            'campaigns',          
            'productCampaigns'
        ])
            ->where('slug', $slug)
            ->firstOrFail();

       
        $product->active_campaigns = $product->campaigns->filter(function ($campaign) {
            return !$campaign->expiry_date || $campaign->expiry_date > Carbon::now();
        });

        $product->formatted_options = $this->formatProductOptions($product->productOptions);

        return $product;
    } catch (ModelNotFoundException $e) {
        Log::error("Product not found for slug: {$slug}");
        return null;
    }
}


    public function getAllProduct(): ?Collection
    {
        try {
            // Eager load relationships
            $products = Product::with([
                'category:id,name',
                'productOptions:id,product_id,product_option_id',
                'productOptions.option:id,name,attribute_id',
                'productOptions.option.attribute:id,name',
                'brand:id,company'
            ])
                ->whereNotNull('name')
                ->whereNotNull('price')
                ->get();


            // Format options for each product
            foreach ($products as $product) {
                $product->formatted_options = $this->formatProductOptions($product->productOptions);
            }


            return $products; // Return the collection of products
        } catch (ModelNotFoundException $e) {
            Log::error("Products not found: " . $e->getMessage());
            return null;
        }
    }



    /**
     * Format product options with attributes and values.
     *
     * @param \Illuminate\Database\Eloquent\Collection $productOptions
     * @return array
     */
    private function formatProductOptions($productOptions): array
    {
        return $productOptions->map(function ($productOption) {
            return [
                'option_id' => $productOption->product_option_id,
                'option_name' => $productOption->option->name,
                'attribute' => $productOption->option->attribute->name,
            ];
        })->toArray();
    }




    public function getRelatedProducts($categoryId, $productId)
    {
        return Product::query()
            ->where('category_id', $categoryId)
            ->where('id', '!=', $productId)
            ->whereNotNull('quantity')
            ->where('is_published', 1)
            ->latest()
            ->take(4)
            ->get();
    }
    public function new_product($slug)
    {
        return Product::where('is_published', 1)
            ->where('slug', '!=', $slug)
            ->latest()
            ->take(3)
            ->select('name', 'price', 'discount_price', 'featured_image', 'slug')
            ->get();
    }



    public function getActiveCampaigns()
    {
        return Product::where('campaign_price', '!=', null)->with('campaigns')
            ->get();
    }

    private function formatDate($date)
    {
        return Carbon::parse($date)->format('Y-m-d');
    }


    /**
     * Get products by categories.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */

    // public function getProductsByCategories()
    // {
    //     $userId = auth()->id();

    //     $categories = ProductCategory::with(['products' => function ($query) use ($userId) {
    //         $query->leftJoin('wishlists', function ($join) use ($userId) {
    //             $join->on('products.id', '=', 'wishlists.product_id')
    //                 ->where('wishlists.user_id', $userId);
    //         })
    //             ->select('products.*', 'wishlists.id as wishlist_id');
    //         $this->applyProductFilters($query);
    //     }])->get();


    //     return $categories->filter(fn($category) => $category->products->isNotEmpty());
    // }

    public function getProductsByCategories()
    {
        $userId = auth()->id();


        // $categories = ProductCategory::with(['products' => function ($query) use ($userId) {
        //     $query->leftJoin('wishlists', function ($join) use ($userId) {
        //         $join->on('products.id', '=', 'wishlists.product_id')
        //              ->where('wishlists.user_id', $userId);
        //     })

        //     ->leftJoin('product_campaigns', 'products.id', '=', 'product_campaigns.product_id')

        //     ->leftJoin('campaigns', 'product_campaigns.campaign_id', '=', 'campaigns.id')

        //     ->select('products.*', 
        //              'wishlists.id as wishlist_id', 
        //              'campaigns.discount as campaign_discount')

        //     ->where('products.is_published', 1);


        // }])->get();


        // $filteredCategories = $categories->filter(fn($category) => $category->products->isNotEmpty());


        // $filteredCategories->each(function ($category) {
        //     $category->products->each(function ($product) {

        //         if (isset($product->campaign_discount)) {

        //             $product->campaign_price = $this->calculateFixedDiscountPrice(
        //                 $product->price, $product->campaign_discount
        //             );
        //         } else {

        //             $product->campaign_price =  $product->price;        
        //         }
        //     });
        // });

        // return $filteredCategories;


        $categories = ProductCategory::with(['products' => function ($query) use ($userId) {
            $query->leftJoin('wishlists', function ($join) use ($userId) {
                $join->on('products.id', '=', 'wishlists.product_id')
                    ->where('wishlists.user_id', $userId);
            })
                ->leftJoin('product_campaigns', 'products.id', '=', 'product_campaigns.product_id')
                ->leftJoin('campaigns', 'product_campaigns.campaign_id', '=', 'campaigns.id')
                ->select(
                    'products.*',
                    'wishlists.id as wishlist_id',
                    'campaigns.discount as campaign_discount',
                    'campaigns.expiry_date as campaign_expiry_date'
                )
                ->where('products.is_published', 1);
        }])->get();

        $filteredCategories = $categories->filter(fn($category) => $category->products->isNotEmpty());

        $filteredCategories->each(function ($category) {
            $category->products->each(function ($product) {

                // Check if campaign discount is valid
                $isCampaignValid = isset($product->campaign_discount) &&
                    (is_null($product->campaign_expiry_date) ||
                        $product->campaign_expiry_date > Carbon::now());

                // Apply discount if campaign is valid, otherwise use regular price
                if ($isCampaignValid) {
                    $product->campaign_price = $this->calculateFixedDiscountPrice(
                        $product->price,
                        $product->campaign_discount
                    );
                } else {
                    $product->campaign_price = $product->price;
                }
            });
        });

        return $filteredCategories;
    }

    /**
     * Calculate the discounted price based on fixed discount.
     */
    private function calculateFixedDiscountPrice($price, $fixedDiscount)
    {
        return max(0, $price - $fixedDiscount);
    }










    /**
     * Apply filters to the product query.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return void
     */
    protected function applyProductFilters($query)
    {
        $query->where('is_published', 1)
            ->whereNotNull('quantity')
            ->where('is_new_arrival', 1)
            ->latest()
            ->take(8);
    }
}
