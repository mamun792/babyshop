<div>
    @extends('web.dashboard.app', ['page' => 'product-purchase'])
    @section('content')
      


        <div class="container mt-5">

            <div class="card mt-3">
                @php
                    $stored = request()->query('stored');
                @endphp
               
                <div class="card-body">
                    @if ($stored!=1)
                   
        
                    <div class="card-header d-flex align-items-center justify-content-between mb-4 ">
                        <a href="{{ route('dashboard.product-purchase.index') }}" class="btn btn-dark btn-sm">
                            <i class="fas fa-arrow-left"></i>
                            Back
                        </a>
                       <p class="mb-0 flex-grow-1 text-center">Add Purchase</p>
                    </div>

                    <form method="POST" action="{{ route('dashboard.product-purchase.update', $data->id) }}"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="product" class="form-label">Purchase Name</label>
                                <input value="{{ $data->purchase_name }}" class="form-control" id="product"
                                    name="purchase_name">

                                    @if($errors->has('purchase_name'))
                                    <span class="text-danger">{{ $errors->first('purchase_name') }}</span>
                                @endif

                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="purchase_date" class="form-label">Purchase Date</label>
                                <input name="purchase_date" value="{{ $data->purchase_date }}" class="form-control">
                                  @if($errors->has('purchase_date'))
                                    <span class="text-danger">{{ $errors->first('purchase_date') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="invoice_number" class="form-label">Invoice Number</label>
                                <input name="invoice_number" value="{{ $data->invoice_number }}" class="form-control">
                                 @if($errors->has('invoice_number'))
                                    <span class="text-danger">{{ $errors->first('invoice_number') }}</span>
                                @endif
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="supplier_id" class="form-label">Supplier</label>
                                <select name="supplier_id" class="form-control">
                                    <option value=""></option>
                                    @foreach ($supplier as $d)
                                        <option value="{{ $d->id }}"
                                            @if ($data->supplier_id == $d->id) selected @endif>{{ $d->supplier_name }}
                                        </option>
                                    @endforeach

                                </select>

                            </div>
                        </div>
                        <div class="row">
                            @if ($data->document)
                                <div class="col-md-6 mb-3">
                                    <label for="document" class="form-label">Document</label> <br>
                                    <a href="{{ asset($data->document) }}">View Document</a>

                                </div>
                            @endif
                            <div class="col-md-6 mb-3">
                                <label for="document" class="form-label">Document</label>
                                <input type="file" name="document" class="form-control">

                            </div>
                        </div>
                        <div class="row">


                            @if ($data->document)
                                <div class="col-md-12 mb-3">
                                    <label for="comment" class="form-label">Comment</label>
                                    <textarea name="comment" class="form-control" rows="3">{{ $data->comment }}</textarea>

                                </div>
                            @endif

                        </div>
                        <button type="submit" class="btn btn-primary">Update Purchase</button>
                    </form>
                    @endif
                    <!-- Template for table row -->
                    <template id="row-template">
                        <tr>
                            <td><input class="form-control" /></td>
                            <td><input class="form-control" /></td>
                            <td><input class="form-control" /></td>
                            <td><input class="form-control" /></td>
                            <td><input type="number" class="form-control" /></td>
                            <td class="text-center">
                                <div class="d-flex align-items-center gap-10 justify-content-center">
                                    <button type="button"
                                        class="btn btn-warning-600 radius-8 px-14 py-6 text-sm remove-row-btn">Remove</button>
                                </div>
                            </td>
                        </tr>
                    </template>
                    <div class="card-body p-24">
                        <div class="table-responsive scroll-sm">
                            <table class="table bordered-table sm-table mb-0">
                                <thead>
                                    <tr>
                                        <th scope="col" class="text-center" style="width: 350px">Name</th>
                                        <th scope="col" class="text-center" style="width: 250px">Product Code</th>
                                        <th scope="col" class="text-center" style="width: 150px">Quantity</th>
                                        <th scope="col" class="text-center" style="width: 150px">Price</th>
                                        <th scope="col" class="text-center" style="width: 150px">Total</th>
                                        <th scope="col" class="text-center" style="width: 150px">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="table-body">
                                    @foreach ($products as $d)
                                        <tr>
                                            <form
                                                action="{{ route('dashboard.product-purchase.updateItemsPurchase', $d->id) }}"
                                                method="post">
                                                @csrf
                                                @method('PATCH')
                                                {{-- <input type="number" name="purchase_id" value="{{ $purchase->id }}" > --}}

                                                <td><input type="text" value="{{ $d->name }}" class="form-control"
                                                        name="product_name" /></td>
                                                <td><input type="text" value="{{ $d->product_code }}"
                                                        class="form-control" name="product_code" /></td>
                                                <td><input type="number" value="{{ $d->purchase_quantity }}"
                                                        class="form-control" name="quantity" min="0" /></td>
                                                <td><input type="number" value="{{ $d->purchase_price }}"
                                                        class="form-control" name="price" min="0" /></td>
                                                <td><input type="number" value="{{ $d->purchase_total_price }}"
                                                        class="form-control" name="total_price" min="0" /></td>
                                                <td class="text-center">
                                                    <div class="d-flex align-items-center gap-10 justify-content-center">

                                                        <button type="submit"
                                                            class="btn btn-success-600 radius-8 px-14 py-6 text-sm">Update</button>

                                                        <a href="{{ route('dashboard.product-purchase.deleteItemsPurchase', $d->id) }}"
                                                            class="btn btn-danger-600 radius-8 px-14 py-6 text-sm">Delete</a>
                                                    </div>
                                                </td>
                                            </form>

                                        </tr>
                                    @endforeach
                                    <tr>
                                        {{-- all error show --}}
                                       
                                        <form action="{{ route('dashboard.product-purchase.items_purchase_store') }}"
                                            method="post">
                                            @csrf
                                            <input type="number" name="purchase_id" value="{{ $data->id }}" hidden>
                                             <input type="number" name="purchase_id" value="{{ $purchase }}" hidden>

                                         
                                                    <td>
                                                        <input type="text" class="form-control" name="product_name" value="{{ old('product_name') }}" />
                                                        @error('product_name')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control" name="product_code" value="{{ old('product_code') }}" />
                                                        @error('product_code')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </td>
                                                    <td>
                                                        <input type="number" class="form-control" name="quantity" value="{{ old('quantity') }}" min="0" />
                                                        @error('quantity')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </td>
                                                    <td>
                                                        <input type="number" class="form-control" name="price" value="{{ old('price') }}" min="0" />
                                                        @error('price')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </td>
                                                    <td>
                                                        <input type="number" class="form-control" name="total_price" value="{{ old('total_price') }}" min="0" />
                                                        @error('total_price')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </td>
                                            <td class="text-center">
                                                <div class="d-flex align-items-center  justify-content-start">

                                                    <button type="submit"
                                                        class="btn btn-info-600 radius-8 px-14 py-6 text-sm ms-16">Insert</button>

                                                </div>
                                            </td>
                                        </form>

                                    </tr> 
                                  
                                </tbody>
                                <br>

                              


                            </table>
                            
                                    <a href="{{ route('dashboard.product-purchase.index') }}" id="submitBtn" class="btn btn-info-600 radius-8 px-14 py-6 mt-4 text-sm">Submit</a>
                        </div>


                    </div>






                </div>

            </div>
        </div>


        
    @endsection

    @section('js')
        <script>
           document.getElementById('submitBtn').addEventListener('click', function (e) {
        e.preventDefault(); 

        // Check if there are any non-empty inputs in the product rows
        let hasData = false;
        const rows = document.querySelectorAll('#table-body tr');
        
        rows.forEach(row => {
            const productName = row.querySelector('input[name="product_name"]').value;
            const productCode = row.querySelector('input[name="product_code"]').value;
            const quantity = row.querySelector('input[name="quantity"]').value;
            const price = row.querySelector('input[name="price"]').value;
            const totalPrice = row.querySelector('input[name="total_price"]').value;

            if (productName || productCode || quantity || price || totalPrice) {
                hasData = true;
            }
        });

        if (hasData) {
            // If there's valid data in any row, redirect to the next page
            window.location.href = this.getAttribute('href');
        } else {
            // If no data is inserted, show an alert
            alert("Please insert at least one product before submitting.");
        }
    });
        </script>
    @endsection
