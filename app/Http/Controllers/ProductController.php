<?php

namespace App\Http\Controllers;

// use App\Http\Requests\ProductRequest;

use App\Http\Requests\CouponRequest;
use App\Http\Requests\CouponRequestUpdate;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Requests\UpdateTagRequest;
use App\Models\Attribute;
use App\Models\Brand;
use App\Models\Campaign;
use App\Models\Coupon;
use App\Models\ItemPurchase;
use App\Models\Option;
use App\Models\ProductCampaign;
use App\Models\ProductCategory;
use App\Models\ProductOption;
use App\Models\ProductPurchase;
use App\Models\ProductSubCategory;
use App\Models\ProductTag;
use App\Models\Purchase;
use App\Models\Review;
use App\Models\Tag;
use App\Services\SlugService;
use App\Traits\ImageManipulation;
use Carbon\Carbon;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    use ImageManipulation;
    protected $slugService;
    public function __construct(SlugService $slugService)
    {
        $this->slugService = $slugService;
    }

    function stockSwitch(Request $request)
    {

       
        $item = Product::where('product_code', $request->code)->first();

        return response($item, 200);
    }


    public function index()
    {
        $data = ItemPurchase::join('purchases', 'purchases.id', 'item_purchases.purchase_id')->get();
        return view('web.dashboard.products.show', compact('data'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function searchProduct(Request $request)
    {

        $productCode = $request->get('product_code');

        $products = ProductPurchase::where('product_code', 'like', '%' . $productCode . '%')
            ->get(['id', 'purchase_name as name', 'product_code']);

        if ($products->isEmpty()) {
            return response()->json(['message' => 'No products found'], 404);
        }

        return response()->json($products);
    }


    // function getOrCreateTagIds($request)
    // {

    //     return DB::transaction(function () use ($request) {
    //         $tagIds = [];

    //         $json = json_decode($request->product_tag);
    //         $tags = array_column($json, 'value');
    //         foreach ($tags as $tagName) {

    //             $tag = Tag::where('name', $tagName)->first();
    //             if ($tag) {

    //                 $tagIds[] = $tag->id;
    //             } else {

    //                 $newTag = Tag::create(['name' => $tagName]);
    //                 $tagIds[] = $newTag->id;
    //             }
    //         }
    //         return $tagIds;
    //     });
    // }

    function getOrCreateTagIds($request)
{
    return DB::transaction(function () use ($request) {
        $tagIds = [];

        // Check if product_tag is a string and contains JSON data
        if (is_string($request->product_tag)) {
            $json = json_decode($request->product_tag, true); // Convert JSON string to array
        } else {
            $json = $request->product_tag; // If it's already an array, use it as is
        }

        // Check if the JSON decoding was successful and is an array
        if (is_array($json)) {
            $tags = array_column($json, 'value');
            foreach ($tags as $tagName) {
                // Check if the tag exists
                $tag = Tag::where('name', $tagName)->first();
                if ($tag) {
                    $tagIds[] = $tag->id;
                } else {
                    // Create a new tag if it doesn't exist
                    $newTag = Tag::create(['name' => $tagName]);
                    $tagIds[] = $newTag->id;
                }
            }
        }

        return $tagIds;
    });
}





    public function store(StoreProductRequest $request)
    {
       //return $request->all();
        try {
            $featuredPath = $this->storeImage($request, 'featured_image', 'products');
            $gallery_onePath = $this->storeImage($request, 'gallery_image_one', 'products');
            $gallery_twoPath = $this->storeImage($request, 'gallery_image_two', 'products');
            $gallery_threePath = $this->storeImage($request, 'gallery_image_three', 'products');
    
            $slug = $this->slugService->createSlug($request->input('name'), Product::class);
    
            // Handle manual product creation or update
               $existingProduct = Product::where('product_code', $request->product_code)
                ->where('user_id', auth()->user()->id)
              
                ->first();
    
            if ($existingProduct) {
                if ($existingProduct->quantity <= 0) {
                    
                    return $this->handleProductUpdate($request, $existingProduct, $slug, $featuredPath, $gallery_onePath, $gallery_twoPath, $gallery_threePath);
                } else {
                    toastr()->error('Product already exists with quantity greater than 0. Please update manually.');
                    return back();
                }
            } else {
               
                return $this->createProduct($request, $slug, $featuredPath, $gallery_onePath, $gallery_twoPath, $gallery_threePath);
            }
        } catch (\Exception $e) {
            Log::error('An error occurred: ' . $e->getMessage());
            toastr()->error('An error occurred: ' . $e->getMessage());
            return back();
        }
    }
    

    private function handleProductUpdate($request, $existingProduct, $slug, $featuredPath, $gallery_onePath, $gallery_twoPath, $gallery_threePath)
    {
        $existingProduct->update([
            'name' => $request->input('name') ?? $existingProduct->name,
            'price' => $request->input('price') ?? $existingProduct->price,
            'quantity' => $request->input('quantity'),
            'category_id' => $request->input('category_id'),
            'sub_category_id' => $request->input('sub_category_id'),
            'brand_id' => $request->input('brand_id'),
            'discount_price' => $request->input('discount_price') ?? $existingProduct->discount_price,
            'featured_image' => $featuredPath ?? $existingProduct->featured_image,
            'gallery_image_one' => $gallery_onePath ?? $existingProduct->gallery_image_one,
            'gallery_image_two' => $gallery_twoPath ?? $existingProduct->gallery_image_two,
            'gallery_image_three' => $gallery_threePath ?? $existingProduct->gallery_image_three,
            'youtube_link' => $request->input('youtube_link') ?? $existingProduct->youtube_link,
            'description' => $request->input('description') ?? $existingProduct->description,
            'slug' => $slug,
            'meta_title' => $request->input('meta_title') ?? $existingProduct->meta_title,
            'meta_description' => $request->input('meta_description') ?? $existingProduct->meta_description,
            'user_id' => auth()->user()->id,

            'is_published' => 1,
        ]);

        $this->syncProductTagsAndOptions($request, $existingProduct);
        toastr()->success('Product updated successfully.');
        return back();
    }

    private function createProduct($request, $slug, $featuredPath, $gallery_onePath, $gallery_twoPath, $gallery_threePath)
    {
      
      $isAffiliateValue = $request->input('is_affiliate') ?? 0;
   
        $product = Product::create([
            'name' => $request->input('name'),
            'product_code' => $request->input('product_code'),
            'price' => $request->input('price'),
            'quantity' => $request->input('quantity'),
            'category_id' => $request->input('category_id'),
            'sub_category_id' => $request->input('sub_category_id'),
            'brand_id' => $request->input('brand_id'),
            'discount_price' => $request->input('discount_price'),
            'featured_image' => $featuredPath,
            'gallery_image_one' => $gallery_onePath,
            'gallery_image_two' => $gallery_twoPath,
            'gallery_image_three' => $gallery_threePath,
            'youtube_link' => $request->input('youtube_link'),
            'description' => $request->input('description'),
            'short_description' => $request->input('short_description'),
            'specifications' => $request->input('specifications'),
            'slug' => $slug,
            'meta_title' => $request->input('meta_title'),
            'meta_description' => $request->input('meta_description'),
            'user_id' => auth()->user()->id,
            'is_affiliate' => $isAffiliateValue,
            'is_published' => 1,
        ]);

        $this->syncProductTagsAndOptions($request, $product);
        toastr()->success('Product created successfully.');
        return back();
    }

    private function syncProductTagsAndOptions($request, $product)
    {
        if ($request->filled('option_id')) {
            foreach ($request->option_id as $d) {
                ProductOption::create([
                    'product_id' => $product->id,
                    'product_option_id' => $d,
                ]);
            }
        }

        $tagIds = $this->getOrCreateTagIds($request);
        $product->tags()->sync($tagIds);
    }









    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $product = Product::find($product->id);
        $attribute = Attribute::with('options')->get();
        $categories = ProductCategory::all();
        $subcategories = ProductSubCategory::all();
        $brands = Brand::all();
        return view('web.dashboard.products.editProduct', compact('product', 'categories', 'subcategories', 'brands', 'attribute'));
    }
   

    public function update(ProductRequest $request, Product $product)
    {
        // Validate quantity
        if ($request->quantity > $product->quantity) {
            toastr()->error('Unable to add the product. The maximum quantity allowed is ' . $product->quantity . 
                            '. But you are trying to purchase ' . $request->quantity . '. Please adjust your quantity.');
            return back();
        }
    
        // Update product fields
        $product->update([
            'name' => $request->input('name'),
            'product_code' => $request->input('product_code'),
            'price' => $request->input('price'),
            'quantity' => $request->input('quantity'),
            'category_id' => $request->input('category_id'),
            'sub_category_id' => $request->input('sub_category_id'),
            'brand_id' => $request->input('brand_id'),
            'discount_price' => $request->input('discount_price', 0),
            'featured_image' => $this->updateImage($request, 'featured_image', 'images/products', $product->featured_image),
            'gallery_image_one' => $this->updateImage($request, 'gallery_image_one', 'images/products', $product->gallery_image_one),
            'gallery_image_two' => $this->updateImage($request, 'gallery_image_two', 'images/products', $product->gallery_image_two),
            'gallery_image_three' => $this->updateImage($request, 'gallery_image_three', 'images/products', $product->gallery_image_three),
            'youtube_link' => $request->input('youtube_link'),
            'short_description' => $request->input('short_description'),
            'description' => $request->input('description'),
            'specifications' => $request->input('specifications'),
            'slug' => $this->generateSlug($request->input('name'), $request->input('price')),
            'meta_title' => $request->input('meta_title'),
            'meta_description' => $request->input('meta_description'),
            'user_id' => auth()->id(),
            'is_affiliate' => $request->input('is_affiliate', 0),
        ]);
    
     
        if ($request->filled('option_id')) {
         
            $product->productOptions()->delete();
    

            foreach ($request->option_id as $optionId) {
                $product->productOptions()->create([
                    'product_option_id' => $optionId
                ]);
            }
        }
    
       
        if ($request->filled('product_tag')) {
            $tagIds = collect($request->product_tag)->map(function ($tagName) {
                $tag = Tag::firstOrCreate(['slug' => Str::slug($tagName)], ['name' => $tagName]);
                return $tag->id;
            });
            $product->tags()->sync($tagIds);
        }
    
        toastr()->success('Product updated successfully');
        return back();
    }

private function generateSlug($name, $price)
{
    return    $this->slugService->createSlug($name , Product::class);
}




    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product = Product::find($product->id);
        // Delete associated product tags
        $product->tags()->delete();

        $imagePaths = [
            $product->featured_image,
            $product->gallery_image_one,
            $product->gallery_image_two,
            $product->gallery_image_three,
        ];

        // Loop through the image paths and delete if they exist
        foreach ($imagePaths as $imagePath) {
            if ($imagePath) {
                $this->deleteImage($imagePath);
            }
        }

        $product->delete();
        toastr()->error('Product deleted successfully');
        return back();
    }
    public function add()
    {
        $attribute = Attribute::with('options')->get();
        $categories = ProductCategory::all();
        $subcategories = ProductSubCategory::all();
        $brands = Brand::all();
        return view('web.dashboard.products.index', compact('categories', 'subcategories', 'brands', 'attribute'));
    }
    public function purchased()
    {
        return view('web.dashboard.products.purchased');
    }
    public function allProducts()
    {
        // $products = Product::paginate(10);
        $products = DB::table('products')
            ->leftJoin('product_sub_categories', 'products.sub_category_id', '=', 'product_sub_categories.id')
            ->leftJoin('product_categories', 'product_sub_categories.category_id', '=', 'product_categories.id')
            ->select(
                'products.*',
                'product_sub_categories.name as sub_category_name',
                'product_categories.name as category_name'
            )
            ->whereNotNull('products.price')
            ->whereNotNull('products.slug')
            ->whereNotNull('products.discount_price')
            ->get();


        $categories = ProductCategory::all();
        $subcategories = ProductSubCategory::all();
        return view('web.dashboard.products.allProducts', compact('products', 'categories', 'subcategories'));
    }

    // 


    public function productDetails($slug)
    {

        $product = Product::where('slug', $slug)->firstOrFail();


        $averageRating = Review::where('product_id', $product->id)
            ->avg('rating');


        $averageRating = $averageRating ?: 0;



        $averageRatings = getAverageRatingsByProduct();





        $currentDate = now();



        $product = DB::table('products')
            ->leftJoin('product_options', 'products.id', '=', 'product_options.product_id')
            ->leftJoin('product_categories', 'products.category_id', '=', 'product_categories.id')
            ->leftJoin('options', 'product_options.product_option_id', '=', 'options.id')
            ->leftJoin('attributes', 'options.attribute_id', '=', 'attributes.id')
            ->leftJoin('product_campaigns', 'products.id', '=', 'product_campaigns.product_id')
            ->leftJoin('campaigns', 'campaigns.id', '=', 'product_campaigns.campaign_id')
            ->where('products.slug', $slug)
            ->select(
                'products.*',
                'product_categories.name as category_name',
                'attributes.name as attribute_name',
                'options.name as option_name',
                'product_options.product_option_id',
                'campaigns.id as campaign_id',
                'campaigns.discount',
                'campaigns.start_date as campaign_start_date',
                'campaigns.expiry_date as campaign_expiry_date'
            )
            ->get()
            ->groupBy('id')
            ->map(function ($group) {
                // Extract the first product from the group
                $product = $group->first();

                // Group options by attribute_id and structure the array
                $product->options = $group->groupBy('attribute_id')->map(function ($items) {
                    return [
                        'attribute_name' => $items->first()->attribute_name,
                        'values' => $items->map(function ($item) {
                            return [
                                'name' => $item->option_name,
                                'product_option_id' => $item->product_option_id,
                            ];
                        })->unique('name')->values(),
                    ];
                })->values();

                // Set category name (using first entry in the group)
                $product->category_name = $group->pluck('category_name')->first();

                // Extract valid campaign details
                $product->campaigns = $group->map(function ($item) {
                    // Check if the campaign is valid
                    if (
                        !is_null($item->campaign_id) &&
                        now()->between($item->campaign_start_date, $item->campaign_expiry_date)
                    ) {
                        $campaignObject = new \stdClass(); // Create campaign object
                        $campaignObject->id = $item->campaign_id;
                        $campaignObject->discount = $item->discount;
                        $campaignObject->start_date = $item->campaign_start_date;
                        $campaignObject->expiry_date = $item->campaign_expiry_date;

                        return $campaignObject;
                    }
                })->filter()->unique('id')->values(); // Ensure unique campaigns based on ID

                // Clean up unnecessary fields
                unset($product->option_name, $product->is_color, $product->attribute_id, $product->attribute_name);

                return $product;
            })
            ->first();








        if (!$product) {
            abort(404, 'Product not found');
        }


        $related_products = $this->getRelatedProducts($product->category_id, $product->id);

        //   reviwes fetch 
        $reviews = DB::table('reviews')
            ->leftJoin('users', 'reviews.user_id', '=', 'users.id')
            ->where('reviews.product_id', $product->id)
            ->select('reviews.*', 'users.name', 'users.avatar') // Assuming users table has name and profile_image columns
            ->get();




        $total_reviews = DB::table('reviews')
            ->where('product_id', $product->id)
            ->count();



        return view('web.frontend.product-details', compact('product', 'related_products', 'reviews', 'total_reviews', 'averageRatings', 'averageRating'));
    }



    private function getProductWithCategory($slug)
    {
        return DB::table('products')
            ->leftJoin('product_categories', 'products.category_id', '=', 'product_categories.id')
            ->select('products.*', 'product_categories.name as category_name')
            ->where('products.slug', $slug) // Filter by slug
            ->first();
    }

    private function getRelatedProducts($categoryId, $productId)
    {
        return DB::table('products')
            ->where('category_id', $categoryId)
            ->where('is_published', true)
            ->where('id', '!=', $productId)
            ->take(4)
            ->get();
    }


    // 


    public function applyCoupon(Request $request, $id)
    {
        $validatedData = $request->validate([
            'coupon_code' => 'required|string|exists:coupons,code',
        ]);
        $coupon = Coupon::where('code', $validatedData['coupon_code'])->first();
        if (!$coupon) {
            return redirect()->back()->withErrors(['coupon_code' => 'Invalid coupon code.']);
        }
        $currentDate = Carbon::now(); // Current date and time
        $validFrom = $coupon->valid_from; // This should be a Carbon instance
        $validTo = $coupon->valid_to;
        $isDateValid = $currentDate->greaterThanOrEqualTo($validFrom) && $currentDate->lessThanOrEqualTo($validTo);
        Log::info("Is Date Valid: " . ($isDateValid ? 'Yes' : 'No'));
        if (!$isDateValid) {
            return redirect()->back()->withErrors(['coupon_code' => 'Coupon is not applicable to this product.']);
        }
        // status active or deactive 
        $isActive = $coupon->status === 'active';
        if (!$isActive) {
            return redirect()->back()->withErrors(['coupon_code' => 'Coupon is inactive.']);
        }
        Log::info("Date Validity: " . $isDateValid);
        $isApplicable = DB::table('coupon_product')
            ->where('coupon_id', $coupon->id)
            ->where('product_id', $id)
            ->exists();
        if (!$isApplicable) {
            return back()->withErrors(['coupon_code' => 'Coupon is not applicable to this product.']);
        }
        // Assuming $product is available and the price needs to be set
        $product = Product::find($id);
        $discountAmount = $coupon->discount_amount;
        $discountPrice = $product->discount_price - $discountAmount;
        // Set session data
        return redirect()->back()->withInput([
            'discountPrice' => $discountPrice,
            'discountAmount' => $discountAmount,
            'success' => "succfully added"
        ]);
    }
    public function coupon(): View
    {
        $coupons = Coupon::with('products')
            ->get();;
        return view('web.dashboard.coupon.index', compact('coupons'));
    }
    function couponCreate()
    {
        $data = Coupon::all();
        return view('web.dashboard.coupon.create', compact('data'));
    }
    function couponAttachToProduct()
    {
        $products = Product::all();
        $coupons = Coupon::all();
        return view('web.dashboard.coupon.cupon_product', compact('products', 'coupons'));
    }
    public function couponStore(CouponRequest $request)
    {
        // validate the request
        $request->validated();

        $coupon = Coupon::create($request->except('_token'));
        toastr()->success('Coupon Created.');
        return back();
    }
    public function couponUpdate(CouponRequestUpdate $request, Coupon $coupon)
    {

       
        $coupon->update($request->except('_token'));
        toastr()->success('Cupon Updated.');
        return back();
    }
    function couponAttach()
    {
        $products = Product::all();
        $coupons = Coupon::all();
        $couponsWithProducts = Coupon::whereHas('products')
            ->with('products')
            ->get();
        return view('web.dashboard.coupon.attach', compact('couponsWithProducts', 'products', 'coupons'));
    }
    function productCuponSync(Request $request)
    {

        $coupon = Coupon::find($request->coupon_id);
        // Sync products with additional data
        $coupon->products()->sync($request->product_ids);
        toastr()->success('Cupon Records Updated');
        return back();
    }
    function productCuponEdit(Coupon $coupon)
    {
       
        $productsWithThisCoupon =  $coupon->load('products')->products->pluck('id')->toArray();
        $products = $products = Product::whereNotNull('price')->get();

        return view('web.dashboard.coupon.attach_edit', compact('coupon', 'products', 'productsWithThisCoupon'));
    }
    function cuponEdit(Coupon $coupon)
    {
        return view('web.dashboard.coupon.edit', compact('coupon'));
    }
    public function bulkDelete(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'integer|exists:products,id'
        ]);
        // Log::info($request->ids);

        $ids = $request->input('ids');
        try {
            Product::whereIn('id', $ids)->delete();
            // Log::info('Product deleted successfully', ['ids' => $ids]);
            return response()->json(['success' => true], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while deleting products.'], 500);
        }
    }
    public function bulkUnpublish(Request $request)
    {
        // Validate input
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'integer|exists:products,id',
        ]);
        // Retrieve validated IDs
        $ids = $request->input('ids');
        try {
            Product::whereIn('id', $ids)->update(['is_published' => false]);
            return response()->json(['success' => true], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while unpublishing products.'], 500);
        }
    }
    public function bulkPublish(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'integer|exists:products,id',
        ]);
        $ids = $request->input('ids');
        try {
            Product::whereIn('id', $ids)->update(['is_published' => true]);
            // Log::info("publish:", ['ids' => $ids]);
            return response()->json(['success' => true], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while publishing products.'], 500);
        }
    }

    public function couponDestroy($id)
    {
        $coupon = Coupon::find($id);

        if (!$coupon) {
            toastr()->error('Coupon not found');
            return redirect()->route('dashboard.product.coupon.index');
        }

        // Optionally, you might want to detach products from the coupon if they exist
        $coupon->products()->detach();

        // Now delete the coupon
        $coupon->delete();

        toastr()->success('Coupon deleted successfully');
        return redirect()->route('dashboard.product.coupon.index');
    }




    public function filterAllProducts(Request $request)
    {
        // return $request->all();
        $query = Product::query()
            ->leftJoin('product_sub_categories', 'products.sub_category_id', '=', 'product_sub_categories.id')
            ->leftJoin('product_categories', 'product_sub_categories.category_id', '=', 'product_categories.id')
            ->select('products.*', 'product_sub_categories.name as sub_category_name', 'product_categories.name as category_name');

        // Apply filters based on the request parameters
        if ($request->filled('category_id')) {
            $query->where('product_categories.id', $request->input('category_id'));
        }

        if ($request->filled('sub_category_id')) {
            $query->where('product_sub_categories.id', $request->input('sub_category_id'));
        }

        if ($request->filled('is_published')) {
            $isPublished = $request->input('is_published');
            $query->where('products.is_published', $isPublished === 'published' ? 1 : 0);
        }



        if ($request->filled('pname')) {
            $productNames = $request->input('pname');
            $query->whereIn('products.name', $productNames);
        }


        // Handle the exact match for the product_code filter
        if ($request->filled('product_code')) {
            $productCode = $request->input('product_code');
            if (is_array($productCode)) {
                $query->whereIn('products.product_code', $productCode);
            } else {
                $query->where('products.product_code', $productCode);
            }
        }


        $products = $query->paginate(10);


        $categories = ProductCategory::all();
        $subcategories = ProductSubCategory::all();


        return view('web.dashboard.products.allProducts', compact('products', 'categories', 'subcategories'));
    }


    public function newArrival(Request $request)
    {



        $productId = $request->input('ids')[0];
        $product = Product::find($productId);

        if ($product) {
            // Toggle the is_hot status
            $product->is_new_arrival = !$product->is_new_arrival;
            $product->save();

            $status = $product->is_new_arrival ? 'added to' : 'removed from';
            return response()->json(['message' => "Product has been {$status} new arrivals.", 'status' => $product->is_new_arrival]);
        }




        return response()->json(['message' => 'Product not found.'], 404);
    }

    public function review(Request $request)
    {
        $query = DB::table('reviews')
            ->join('products', 'reviews.product_id', '=', 'products.id')
            ->join('brands', 'products.brand_id', '=', 'brands.id')
            ->select(
                'reviews.id as review_id',
                'reviews.review_text',
                'reviews.rating',
                'reviews.created_at as review_date',
                'products.name as product_name',
                'products.slug as product_slug',
                'products.price as product_price',
                'products.featured_image as product_image',
                'brands.company as brand_name',
                'products.id as product_id'
            );

        // Apply search filter
        if ($request->has('search') && $request->search) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('reviews.review_text', 'like', "%{$searchTerm}%")
                    ->orWhere('products.name', 'like', "%{$searchTerm}%");
            });
        }

        // Apply sorting
        switch ($request->get('sort', 'latest')) {
            case 'highest':
                $query->orderBy('reviews.rating', 'desc');
                break;
            case 'lowest':
                $query->orderBy('reviews.rating', 'asc');
                break;
            default:
                $query->orderBy('reviews.created_at', 'desc');
        }


        $reviews = $query->paginate(5);
        return view('web.dashboard.products.reviews', compact('reviews'));
    }
}
