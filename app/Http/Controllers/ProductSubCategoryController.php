<?php

namespace App\Http\Controllers;

use App\Models\ProductSubCategory;
use App\Http\Requests\StoreProductSubCategoryRequest;
use App\Http\Requests\UpdateProductSubCategoryRequest;
use App\Models\ProductCategory;
use App\Services\SlugService;
use App\Traits\ImageManipulation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductSubCategoryController extends Controller
{
    protected $slugService;
    use ImageManipulation;

    public function __construct(SlugService $slugService)
    {
        $this->slugService = $slugService;
    }

    public function index()
    {
       $category = ProductCategory::all();
        $tree = ProductSubCategory::all();
        return view('web.dashboard.subcategories.index', compact('tree', 'category'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductSubCategoryRequest $request)
    {
        $request->validated();
        $slug = $this->slugService->createSlug($request->input('name'),  ProductSubCategory::class);

        // handle image upload imageManipulation trait
        $image = $this->storeImage($request, 'image', 'subcategories');


        ProductSubCategory::create([
            'category_id' =>  $request->category_id,
            'name' => $request->name,
            'slug' => $slug,
            'image' => $image
        ]);

        toastr()->success('Subcategory created successfully');
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(ProductSubCategory $subcategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProductSubCategory $subcategory)
    {
        $category = ProductCategory::all();
        return view('web.dashboard.subcategories.edit', compact('subcategory', 'category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductSubCategoryRequest $request, ProductSubCategory $subcategory)
    {
        $request->validated();

        // handle image upload imageManipulation trait
        $image = $this->updateImage($request, 'image', 'subcategories', $subcategory->image);


        $subcategory->update([
            'category_id' =>  $request->category_id,
            'name' => $request->name,
            // 'slug' => slug_generator($request->name),
            'image' => $image
        ]);
       
        toastr()->success('Subcategory updated successfully');

        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductSubCategory $subcategory)
    {
        $relatedProducts = DB::table('products')
        ->where('sub_category_id', $subcategory->id)
        ->exists();

    if ($relatedProducts) {
        toastr()->error('Subcategory cannot be deleted because it has related products');
        return back();
    }
    
        $subcategory->delete();
        toastr()->success('Subcategory deleted successfully');
        return back();
    }
}
