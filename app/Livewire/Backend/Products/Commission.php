<?php

namespace App\Livewire\Backend\Products;

use App\Models\Product;
use App\Models\ProductCategory;
use Livewire\Component;
use Livewire\WithPagination;

class Commission extends Component
{
    use WithPagination;

    public $subcategories = [], $category_id, $subcategory_id, $search;

    protected $updatesQueryString = ['search', 'category_id', 'subcategory_id'];

    public function commissionTypeUpdate($productId, $type)
    {
        $product = Product::find($productId);
        if ($product) {
            $product->commission_type = $type;
            if($product->commission_type == 'percent'){
                if ($product->commission_amount > 100) {
                    $product->commission_amount=30;
                }
            }
            $product->save();
        }
        flash()->success('Commission type updated successfully');
    }

    public function updatedCategoryId()
    {
        $this->subcategory_id = null;
        $this->subcategories = ProductCategory::find($this->category_id)
                             ?->subcategories()
                             ->get()
                             ->toArray() ?? [];
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function commissionValue($productId, $value)
    {
        $value = $value ?? 0;
        $product = Product::find($productId);
        if ($product) {
            if ($product->commission_type == 'fixed') {
                if ($product->discount_price < $value) {
                    flash()->info('Commission cannot be greater than the price.');
                    return;
                }
            }elseif($product->commission_type == 'percent'){
                if ($value>100) {
                    flash()->info('Commission percent cannot be greater than the 100.');
                    return;
                }
            }
            $product->commission_amount = $value;
            $product->save();
            flash()->success('Updated successfully');
        }
    }

    public function render()
    {
        $categories = ProductCategory::latest()->get();

        // Query products with filters for search, category, and subcategory
        $products = Product::affiliate()
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            })
            ->when($this->category_id, function ($query) {
                $query->where('category_id', $this->category_id);
            })
            ->when($this->subcategory_id, function ($query) {
                $query->where('sub_category_id', $this->subcategory_id);
            })
            ->paginate(10);

        return view('livewire.backend.products.commission', compact('products', 'categories'));
    }
}

