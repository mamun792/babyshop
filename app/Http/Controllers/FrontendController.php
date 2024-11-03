<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Brand;
use App\Models\CartItem;
use App\Models\GeneralSetting;
use App\Models\HeroSlider;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductSubCategory;
use App\Models\Review;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class FrontendController extends Controller
{

    public  function home()
    {

        $productDetails = DB::table('products')
            ->leftJoin('product_options', 'products.id', '=', 'product_options.product_id')
            ->leftJoin('product_categories', 'products.category_id', '=', 'product_categories.id')
            ->leftJoin('options', 'product_options.product_option_id', '=', 'options.id')
            ->leftJoin('attributes', 'options.attribute_id', '=', 'attributes.id')
            ->select(
                'products.*',
                'product_categories.name as category_name',
                'attributes.name as attribute_name',
                'options.name as option_name',
                'options.id as option_id',

                'options.attribute_id'
            )
            ->get()
            ->groupBy('id')
            ->map(function ($group) {
                $product = $group->first();


                $product->options = $group->groupBy('attribute_id')->map(function ($items) {
                    return [
                        'attribute_name' => $items->first()->attribute_name,
                        'values' => $items->map(function ($item) {
                            return [
                                'name' => $item->option_name,
                                'price' => $item->price,
                                'option_id' => $item->option_id,
                            ];
                        })->unique('name')->values(),
                    ];
                })->values();


                $product->category_name = $group->pluck('category_name')->first();


                unset($product->option_name, $product->is_color, $product->option_price, $product->attribute_id, $product->attribute_name);
            });



        $averageRatings = getAverageRatingsByProduct();
        $categories = ProductCategory::all();


        $currentDate = now(); // Get current date
        $campaigns = Product::join('product_campaigns', 'products.id', '=', 'product_campaigns.product_id')
            ->join('campaigns', 'campaigns.id', '=', 'product_campaigns.campaign_id')
            ->where('campaigns.start_date', '<=', $currentDate)
            ->where('campaigns.expiry_date', '>=', $currentDate)
            ->orderBy('campaigns.start_date', 'desc')
            ->get([
                'products.name',
                'short_description',
                'featured_image',
                'sold',
                'quantity',
                'discount',
                'start_date',
                'expiry_date',
                'price',
                'discount_price',
                'products.slug'
            ]);


        $slider = HeroSlider::all();
        $banner = Banner::all();
        $brands = Brand::all();
        $products = Product::where('is_new_arrival', 1)->whereNotNull('name')->whereIsPublished(1)->get();
        $hotProducts = Product::where('is_flash', 1)->whereNotNull('name')->whereIsPublished(1)->get();
        $product = Product::with('category')->whereNotNull('name')->whereIsPublished(1)->get();


        $productsByCategorye = $product->groupBy('category_id')->map(function ($items) {
            return $items->take(8);
        });


        $productsByCategory = collect($productsByCategorye);

        return view('web.frontend.home', compact('campaigns', 'products', 'productDetails', 'brands', 'slider', 'banner', 'categories', 'productsByCategory', 'hotProducts', 'averageRatings'));
    }




    public function offerZone()
    {
        $hotProducts = Product::where('is_flash', 1)->get();


        return view('web.frontend.offerZone', compact('hotProducts'));
    }

    function lipa()
    {
        $orders = DB::table('orders')
            ->join('order_items', 'orders.id', '=', 'order_items.order_id')
            ->join('products', 'order_items.product_id', '=', 'products.id')
            ->where('order_id', 47)
            ->select('orders.*', 'products.name as product_name', 'order_items.*')
            ->get();

        // $order = Order::find(47);
        $general = GeneralSetting::first();
        return view('web.frontend.kama', compact('general', 'orders'));
    }


    public function showCategoryProducts($slug, Request $request)
    {

        $category = $this->getCategoryBySlug($slug);


        $query = $this->initializeProductQuery($category->id);


        $query = $this->applyFiltersAndSorting($query, $request);





        $products = $query->distinct()->paginate(8);


        [$colorOptions, $sizeOptions] = $this->getColorAndSizeOptions();

        $averageRatings = getAverageRatingsByProduct();

        $brands = $products->getCollection()->mapWithKeys(function ($product) {
            return [$product->brand_id => $product->brand_name];
        })->unique();


        $products = $this->getProductsWithWishlistStatus($query, auth()->id());



        return view('web.frontend.category-products', compact('category', 'products', 'colorOptions', 'sizeOptions', 'averageRatings', 'brands'));
    }

    public function showSubCategoryProducts($categorySlug, $subCategorySlug, Request $request)
    {

        $category = $this->getCategoryBySlug($categorySlug);
        $subCategory = $this->getSubCategoryBySlug($subCategorySlug);


        $query = $this->initializeProductQuery($category->id);


        $query->where('products.sub_category_id', $subCategory->id);


        $query = $this->applyFiltersAndSorting($query, $request);



        $products = $query->distinct()->paginate(8);


        [$colorOptions, $sizeOptions] = $this->getColorAndSizeOptions();


        $products = $this->getProductsWithWishlistStatus($query, auth()->id());

        $brands = $products->getCollection()->mapWithKeys(function ($product) {
            return [$product->brand_id => $product->brand_name];
        })->unique();

        $averageRatings = getAverageRatingsByProduct();


        return view('web.frontend.category-products', compact('category', 'subCategory', 'products', 'colorOptions', 'sizeOptions', 'averageRatings', 'brands'));
    }



    private function getProductsWithWishlistStatus($query, $userId)
    {

        $products = $query->distinct()->paginate(8);


        $wishlistProductIds = Wishlist::where('user_id', $userId)
            ->pluck('product_id')
            ->toArray();


        $products->getCollection()->transform(function ($product) use ($wishlistProductIds) {
            $product->in_wishlist = in_array($product->id, $wishlistProductIds);
            return $product;
        });

        return $products;
    }


    private function getCategoryBySlug($slug)
    {
        return ProductCategory::where('slug', $slug)->firstOrFail();
    }

    private function getSubCategoryBySlug($slug)
    {
        return ProductSubCategory::where('slug', $slug)->firstOrFail();
    }

    private function initializeProductQuery($categoryId)
    {
        return DB::table('products')
            ->leftJoin('brands', 'products.brand_id', '=', 'brands.id')
            ->where('products.category_id', $categoryId)
            ->where('products.is_published', 1)
            ->select(
                'products.id',
                'products.name',
                'products.slug',
                'products.price',
                'products.discount_price',
                'products.featured_image',
                'brands.company as brand_name',
                'products.brand_id'
            );
    }

    private function applyFiltersAndSorting($query, Request $request)
    {

        $query = $this->applyBrandFilter($query, $request->input('brands'));


        $query = $this->applySorting($query, $request->input('sort'));


        return $this->applyOptionFilters($query, $request->only(['color', 'size']));
    }

    private function applyBrandFilter($query, $brands)
    {


        if (is_array($brands) && !empty($brands)) {

            $brands = array_map('intval', $brands);


            $query->whereIn('products.brand_id', $brands);
        }

        return $query;
    }

    private function applySorting($query, $sort)
    {
        switch ($sort) {
            case 'low-to-high':
                $query->orderBy('products.discount_price', 'asc');
                break;
            case 'high-to-low':
                $query->orderBy('products.discount_price', 'desc');
                break;
            case 'best-match':

                break;
        }
        return $query;
    }

    private function applyOptionFilters($query, $filters)
    {
        foreach ($filters as $filterKey => $filterValue) {
            if ($filterValue) {
                $query->leftJoin('product_options as po', 'products.id', '=', 'po.product_id')
                    ->where('po.product_option_id', $filterValue);
            }
        }
        return $query;
    }

    private function getColorAndSizeOptions()
    {
        $options = DB::table('options')
            ->leftJoin('attributes', 'options.attribute_id', '=', 'attributes.id')
            ->select('options.*', 'attributes.name as attribute_name')
            ->get();

        $colorOptions = $options->filter(fn($option) => $option->attribute_name === 'Color');
        $sizeOptions = $options->filter(fn($option) => $option->attribute_name === 'Size');

        return [$colorOptions, $sizeOptions];
    }

    public function searchProduct(Request $request)
    {



        $searchTerm = $request->input('name');


        if (empty($searchTerm)) {

            $products = Product::where('is_published', 1)->paginate(8);
        } else {
            $products = Product::where('name', 'LIKE', "%{$searchTerm}%")
                ->where('is_published', 1)
                ->paginate(8);
        }

      

        return view('web.frontend.search.search-product', compact('products'));
    }




    public function searchProductSuggestions(Request $request)
    {
        $searchTerm = $request->input('query');
        // Log::info("Search term:" , [$searchTerm]);

        $products = Product::where('name', 'LIKE', "%{$searchTerm}%")
            ->whereNotNull('price')
            ->take(10)
            ->get(['id', 'name', 'slug', 'price', 'featured_image']);


        $products->each(function ($product) {
            $product->featured_image = asset($product->featured_image);
        });

        return response()->json($products);
    }

    public function checkCart($productId)
    {


        $isInCart = CartItem::where('product_id', $productId)
            ->exists();
        return response()->json(['isInCart' => $isInCart]);
    }

    public function ProductflashSale()
    {

        $today = now()->format('Y-m-d');

        $campaigns = Product::join('product_campaigns', 'products.id', '=', 'product_campaigns.product_id')
            ->join('campaigns', 'campaigns.id', '=', 'product_campaigns.campaign_id')
            ->whereDate('start_date', '<=', $today)
            ->whereDate('expiry_date', '>=', $today)
            ->get([
                'products.name',
                'short_description',
                'featured_image',
                'sold',
                'quantity',
                'discount',
                'start_date',
                'expiry_date',
                'price',
                'discount_price',
                'products.slug'
            ]);




        return view('web.frontend.flash-sale', compact('campaigns'));
    }
}
