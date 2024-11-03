<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Services\CategoryService;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use App\Models\Attribute;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;


class AllProductsController extends Controller
{
    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function index(Request $request)
    {
        

        $getCategoriesWithSubcategories = $this->categoryService->getCategoriesWithSubcategories();
       $products = $this->getAllProductQuery($request);
        $categories = ProductCategory::all();


        // clor and size attribute

        $acceptedNames = [
            'color' => ['color', 'colors', 'colour', 'colours', 'colur', 'colorz', 'clr', 'coulur', 'coulors'],
            'size' => ['size', 'sizes', 'sise', 'sized', 'sizee', 'sisees', 'sizesize'],
        ];


        $attributes = Attribute::with('options')->get();

        $colors = $this->getAttributeByNames($attributes, $acceptedNames['color']);
        $sizes = $this->getAttributeByNames($attributes, $acceptedNames['size']);


        return view('web.dashboard.testing.allproducts', compact(
            'products',
            'getCategoriesWithSubcategories',
            'categories',
            'colors',
            'sizes',
            'attributes'
        ));
    }



    public function getAllProductQuery(Request $request): ?LengthAwarePaginator
    {
        try {
            $productsQuery = Product::with([
                'category:id,name',
                'productOptions:id,product_id,product_option_id',
                'productOptions.option:id,name,attribute_id',
                'productOptions.option.attribute:id,name',
                // subcategory
                'subcategory:id,name',
            ])
                ->whereNotNull('slug');

            // Apply filters
            $this->applyFilters($request, $productsQuery);

            // Apply sorting
            $this->applySorting($request, $productsQuery);


            // Determine the limit for pagination
            $limit = $request->get('limit', 50);
            $products = $productsQuery->paginate($limit);

            // Format options for each product
            foreach ($products as $product) {
                $product->formatted_options = $this->formatProductOptions($product->productOptions);
            }

            return $products;
        } catch (ModelNotFoundException $e) {
            // Handle exception
            return null;
        }
    }


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





    private function getAttributeByNames($attributes, array $names)
    {
        $normalizedNames = array_map('strtolower', $names);

        return $attributes->first(function ($attribute) use ($normalizedNames) {
            return in_array(strtolower($attribute->name), $normalizedNames);
        }) ?? collect(); // Return an empty collection if no match is found
    }


    public function applyFilters(Request $request, $query)
    {
        // Filter by size
        if ($request->has('size') && !empty($request->input('size'))) {
            $query->whereHas('productOptions.option', function ($q) use ($request) {
                $q->whereIn('id', $request->input('size'));
            });
        }

        // Filter by color
        if ($request->has('color') && !empty($request->input('color'))) {
            $query->whereHas('productOptions.option', function ($q) use ($request) {
                $q->whereIn('id', $request->input('color'));
            });
        }

        // Filter by category

        if ($request->has('category') && !empty($request->input('category'))) {
            $query->where('category_id', $request->input('category'));
        }


        // Filter by new arrival
        if ($request->has('new-product')) {

            $query->where('is_new_arrival', 1);
        }

        // Filter by subcategory

        if ($request->has('sub-category') && !empty($request->input('sub-category'))) {
            $subCategoryIds = (array) $request->input('sub-category'); // Cast to array to ensure it's iterable
            $query->whereHas('subcategory', function ($q) use ($subCategoryIds) {
                $q->whereIn('id', $subCategoryIds);
            });
        }

        // Filter by "product-name": "hevrly"

        if ($request->filled('product-name')) {
            $firstChar = $request->input('product-name')[0];
            $query->where('name', 'LIKE', $firstChar . '%');
        }
        
        



        return $query;
    }

    public function applySorting(Request $request, $query)
    {
        if ($request->has('sort')) {
            $sort = $request->input('sort');

            switch ($sort) {
                case 'Most Relevant':
                    // Assuming 'created_at' is the relevant field for sorting
                    $query->orderBy('created_at', 'desc');
                    break;

                case 'Most Popular':
                    // Assuming there's a 'popularity' column for sorting
                    $query->orderBy('sold', 'desc');
                    break;

                case 'Alphabetical':
                    // Check for first letter filtering
                    $firstLetter = $request->input('first_letter', null);
                    if ($firstLetter) {
                        // Filter by first letter (case-insensitive)
                        $query->where('name', 'LIKE', $firstLetter . '%');
                    }
                    // Sort alphabetically
                    $query->orderBy('name', 'asc');
                    break;

                default:
                    // Default sorting can be added here if necessary
                    $query->orderBy('created_at', 'desc'); // Example default
                    break;
            }
        }

        return $query;
    }
}