<div>
    <div class="container mt-5">
        <div class="row">
            <!-- Filters Section -->
            <div class="col-12 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Filter Products</h5>
                        <div >
                            @csrf
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="category" class="form-label">Search</label>
                                    <input type="search" class="form-control" wire:model.live='search'>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="category" class="form-label">Category</label>
                                    <select class="form-control" name="category_id" wire:model.live='category_id'>
                                        <option value="">Select category</option>
                                        @foreach ($categories as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="subCategory" class="form-label">Subcategory</label>
                                    <select class="form-control" wire:model.live='subcategory_id'>
                                        <option value="">Select sub category</option>
                                        @foreach ($subcategories as $item)
                                            <option value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                               
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Products Table -->

            <div class="col-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">All Products</h5>


                        <div class="table-responsive">
                            <table class="table bordered-table mb-0 " >
                                <thead>
                                    <tr>
                                        
                                        <th>Product Name</th>
                                        <th>Product Category</th>
                                        <th>Sub-Category</th>
                                        <th>Commission Setup</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $product)
                                        <tr>
                                           
                                            <td>
                                                {{-- {{ $product->name }} --}}
                                                <div class="d-flex align-items-center gap-2">
                                                    <img src="{{ $product->featured_image ? asset($product->featured_image) : '' }}"
                                                        alt="Product Image" class="product-image me-2"
                                                        style="width: 50px; height: 50px; object-fit: cover;">
                                                    <span>{{ $product->name }}</span>
                                                </div>
    
                                            </td>
                                           
                                            <td>
                                                {{ $product->category_name ?? 'N/A' }}
                                            </td>
                                            <td>
                                                {{ $product->sub_category_name ?? 'N/A' }}
                                            </td>
    
                                            <td>
                                                <div class="d-flex flex-column gap-2">
                                                    <!-- Select dropdown for commission type -->
                                                    <select wire:change="commissionTypeUpdate({{ $product->id }}, $event.target.value)" class="form-control" name="commission_type">
                                                        <option value="fixed" {{ $product->commission_type=='fixed'?'selected':'' }}>Fixed</option>
                                                        <option value="percent" {{ $product->commission_type=='percent'?'selected':'' }}>Percent</option>
                                                    </select>
                                                    
                                                    <!-- Input field for the commission value -->
                                                    <input type="number" class="form-control" name="commission_value" wire:keyup="commissionValue({{ $product->id }},$event.target.value)" placeholder="Enter commission value" value="{{ $product->commission_amount }}">
                                                </div>
                                            </td>
                                            
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot></tfoot>
                            </table>
                        </div>
                       

                    </div>
                </div>
            </div>


        </div>
    </div>
</div>
