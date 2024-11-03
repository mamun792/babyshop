<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Services\ProductService;
use App\Models\Attribute;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class AllProductController extends Controller
{
    public function allProduct(Request $request)
    {
        // Log::info($request->all());
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
        

         // Get products with average ratings
        $products->map(function ($product) {
            $product->averageRating = $product->reviews->avg('rating') ?? 0; 
            return $product;
        });

        return view('web.frontend.pages.all-product', compact('products', 'categories', 'colors', 'sizes'));
    }

    // Get all products query
    public function getAllProductQuery(Request $request): ?LengthAwarePaginator
    {
        try {
            
            $productsQuery = Product::with([
                'category:id,name',
                'productOptions:id,product_id,product_option_id',
                'productOptions.option:id,name,attribute_id',
                'productOptions.option.attribute:id,name',
                'brand:id,company'
            ])
                
                ->whereNotNull('slug');


            // Apply filters
            $this->applyFilters($request, $productsQuery);
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
            // Log::error("Products not found: " . $e->getMessage());
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
        });
    }


    // Helper method to apply sorting options
    private function applySorting(Request $request, $query)
    {
        if ($request->filled('sort')) {
            $sortOptions = [
                'price_asc' => 'price',
                'price_desc' => 'price',
                'release_date' => 'created_at',
            ];

            // Determine the sort direction based on the request
            $sortDirection = in_array($request->input('sort'), ['price_asc', 'price_desc']) ?
                ($request->input('sort') === 'price_asc' ? 'asc' : 'desc') : 'desc';


            if (array_key_exists($request->input('sort'), $sortOptions)) {
                $query->orderBy($sortOptions[$request->input('sort')], $sortDirection);
            }
        } else {

            $query->orderBy('created_at', 'desc');
        }
    }




    // Helper method to apply filters

    private function applyFilters(Request $request, $query)
    {
        // Filter by color
        if ($request->filled('color')) {
            $this->filterByColor($request->input('color'), $query);
        }

        // Filter by size
        if ($request->filled('size')) {
            $this->filterBySize($request->input('size'), $query);
        }

        // Filter by price range
        if ($request->filled('price_min') && $request->filled('price_max')) {
            $this->filterByPriceRange($request->input('price_min'), $request->input('price_max'), $query);
        }

        // filter by category
        if ($request->filled('category')) {
            $query->where('category_id', $request->input('category'));
        }

        // filter by subcategory
        if ($request->filled('sub-category')) {
            $query->where('sub_category_id', $request->input('sub-category'));
        }
    }




    private function filterByColor(array $colorIds, $query)
    {


        if (!empty($colorIds)) {
            $query->whereHas('productOptions', function ($q) use ($colorIds) {
                $q->whereHas('option', function ($q) use ($colorIds) {
                    $q->whereIn('id', $colorIds);
                });
            });
        }
    }

    private function filterBySize(array $sizeIds, $query)
    {
        // Ensure that $sizeIds is not empty
        if (!empty($sizeIds)) {
            $query->whereHas('productOptions', function ($q) use ($sizeIds) {
                $q->whereHas('option', function ($q) use ($sizeIds) {
                    $q->whereIn('id', $sizeIds);
                });
            });
        }
    }


    private function filterByPriceRange($priceMin, $priceMax, $query)
    {
        // Log::info("Price Range: Min - $priceMin, Max - $priceMax");


        if (!empty($priceMin) && !empty($priceMax) && is_numeric($priceMin) && is_numeric($priceMax)) {
            $query->whereBetween('price', [(float)$priceMin, (float)$priceMax]);
        }
    }


}
