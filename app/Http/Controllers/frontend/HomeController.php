<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\Banner;
use App\Models\Campaign;
use App\Models\CartItem;
use App\Models\HeroSlider;
use App\Models\Product;
use App\Models\ProductCampaign;
use App\Models\ProductCategory;
use App\Models\ProductSubCategory;
use App\Models\Review;
use App\Models\User;
use App\Models\Wishlist;
use App\Services\CategoryService;
use App\Services\ProductService;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;

class HomeController extends  BaseController
{
    protected $productService;
    protected $categoryService;

    public function __construct(ProductService $productService, CategoryService $categoryService)
    {
        $this->productService = $productService;
        $this->categoryService = $categoryService;
        parent::__construct($categoryService);
    }
    
    public function index()
    {

      

      $getCategoriesWithSubcategories = $this->categoryService->getCategoriesWithSubcategories();

         $sliders = HeroSlider::latest()->get();
     


        $categories = Cache::remember('popular_categories', 60, function () {
            return ProductCategory::all();
        });

   
      

         $categoriesWithProducts = $this->productService->getProductsByCategories();

       $sub_categories = ProductSubCategory::select('id', 'name', 'slug', 'image')
            ->orderBy('name', 'asc')
            ->get();




       

    

        return view('web.frontend.index', [
            'sliders' => $sliders,

            'categories' => $categories,
           
            'categoriesWithProducts' => $categoriesWithProducts,
            // 'campaigns_product' => $campaigns_product,
            // 'campaign' => $campaign,
            'sub_categories' => $sub_categories,
            'getCategoriesWithSubcategories' => $getCategoriesWithSubcategories
           

        ]);
    }

    public function productDetails(Request $request,$slug)
    {

        // return $slug;
    $getCategoriesWithSubcategories= $this->categoryService->getCategoriesWithSubcategories();

      $product = $this->productService->getProductBySlug($slug);
      if($product->is_affiliate == 1) {
        if($request->refer_code) {
            $r = User::where('refer_code', $request->refer_code)->first();
            if($r) {

                $data = [
                    'referrer_id' => $r->id,
                    'product_id' => $product->id,
                    'referral_code' => $request->refer_code
                ];
                
                Session::put('affiliate_refer', $data);
                
            }
        }
    }
        $galleryImages = collect([
            $product->featured_image,
            $product->gallery_image_one,
            $product->gallery_image_two,
            $product->gallery_image_three
        ])->filter(function ($image) {
            return !is_null($image);
        })->values();


       
        $groupedAttributes = $product->productOptions->groupBy(function ($option) {
            return strtolower($option->option->attribute->name); 
        })->filter(function ($options) {
            return $options->isNotEmpty(); 
        });


        if (!$product) {
            return abort(404);
        }

        $related_products = $this->productService->getRelatedProducts($product->category_id, $product->id);


        $reviews = Review::with('user:id,name,avatar')
            ->where('product_id', $product->id)
            ->latest()
            ->paginate(3);



        $averageRating = $reviews->avg('rating');


     

        return view('web.frontend.pages.product-details', compact('product', 'related_products', 'reviews', 'averageRating', 'galleryImages', 'groupedAttributes', 'getCategoriesWithSubcategories'));

        // return view('web.frontend.pages.product-details');
    }


    public function about()
    {
        $about = About::first();
        return view('web.frontend.pages.about', compact('about'));
    }
}
