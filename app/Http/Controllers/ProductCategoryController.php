<?php

namespace App\Http\Controllers;

use App\Models\ProductCategory;
use App\Http\Requests\StoreProductCategoryRequest;
use App\Http\Requests\UpdateProductCategoryRequest;
use App\Services\SlugService;
use App\Traits\ImageManipulation;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    protected $slugService;
    use ImageManipulation;
    public function __construct(SlugService $slugService)
    {
        $this->slugService = $slugService;
    }

    public function index()
    {
     

        $tree = ProductCategory::all();
        return view('web.dashboard.categories.index', compact('tree'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

  
    public function store(Request $request)
    {

        $slug = $this->slugService->createSlug($request->input('name'), ProductCategory::class);
        $imagePath = $this->storeImage($request, 'c_image', 'category');

        // Create a new ProductCategory entry
        ProductCategory::create([
            'name' => $request->name,
            'slug' => $slug,
            'image_path' => $imagePath,
        ]);



        toastr()->success('Category created successfully');
        return redirect()->route('dashboard.categories.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(ProductCategory $productCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProductCategory $category)
    {

        return view('web.dashboard.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreProductCategoryRequest $request, ProductCategory $category)
    {
     
        $request->validated();

         $category->update($request->except(['_token','image']));
       
        if ($request->hasFile('image')) {
            $path = $this->updateImage($request, 'image', 'images/category', null);
            $category->update([
                'image_path'=> $path
            ]);
        }

        toastr()->success('Category updated successfully');
        return redirect()->route('dashboard.categories.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductCategory $category)
    {
        $category->delete();
        return back();
    }
}
