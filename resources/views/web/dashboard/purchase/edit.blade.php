<div>
    @extends('web.dashboard.app', ['page' => 'product-purchase'])
    @section('content')
        {{-- @include('web.dashboard.components.cards') --}}
        {{-- edit purchse product --}}
        <div class="container mt-5">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h6 class="text-center">Edit Purchase Product</h3>
                    {{-- all error show --}}
                    {{-- @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif --}}
                </div>
                <div class="card-body">
                    <form action="{{ route('dashboard.product-purchase.update', $purchase->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH') 

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="product" class="form-label">Product</label>
                                <input type="text" class="form-control" id="product" name="purchase_name" value="{{ old('purchase_name', $purchase->purchase_name) }}">
                                @if($errors->has('purchase_name'))
                                    <span class="text-danger">{{ $errors->first('purchase_name') }}</span>
                                @endif
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="purchase_date" class="form-label">Purchase Date</label>
                                <input type="date" class="form-control" id="purchase_date" name="purchase_date" value="{{ old('purchase_date', $purchase->purchase_date) }}">

                                @if($errors->has('purchase_date'))
                                    <span class="text-danger">{{ $errors->first('purchase_date') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="invoice_number" class="form-label">Invoice Number</label>
                                <input type="text" class="form-control" id="invoice_number" name="invoice_number" value="{{ old('invoice_number', $purchase->invoice_number) }}">
                                @if($errors->has('invoice_number'))
                                    <span class="text-danger">{{ $errors->first('invoice_number') }}</span>
                                @endif
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="supplier_id" class="form-label">Supplier</label>
                                <select class="form-select" id="supplier_id" name="supplier_id">
                                    <option value="">Select Supplier</option>
                                    @foreach($suppliers as $supplier)
                                        <option value="{{ $supplier->id }}" {{ $supplier->id == $purchase->supplier_id ? 'selected' : '' }}>
                                            {{ $supplier->supplier_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="document" class="form-label">Document</label>
                                <input type="file" class="form-control" id="document" name="document" accept="image/*">
                                @if($purchase->document)
                                    <img id="imagePreview" src="{{ asset('storage/' . $purchase->document) }}" alt="Image Preview" class="img-thumbnail mt-2">
                                @endif

                                @if($errors->has('document'))
                                    <span class="text-danger">{{ $errors->first('document') }}</span>
                                @endif
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="product_code" class="form-label">Product Code</label>
                                <input type="text" class="form-control" id="product_code" name="product_code" value="{{ old('product_code', $purchase->product_code) }}">

                                @if($errors->has('product_code'))
                                    <span class="text-danger">{{ $errors->first('product_code') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="price" class="form-label">Price</label>
                                <input type="number" class="form-control" id="price" name="price" value="{{ old('price', $purchase->price) }}">

                                @if($errors->has('price'))
                                    <span class="text-danger">{{ $errors->first('price') }}</span>
                                @endif
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="quantity" class="form-label">Quantity</label>
                                <input type="number" class="form-control" id="quantity" name="quantity" value="{{ old('quantity', $purchase->quantity) }}">

                                @if($errors->has('quantity'))
                                    <span class="text-danger">{{ $errors->first('quantity') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="comment" class="form-label">Comment</label>
                                <textarea class="form-control" id="comment" name="comment" rows="3">{{ old('comment', $purchase->comment) }}

                                </textarea>
                            </div>
                        </div>
                
                        <button type="submit" class="btn btn-primary">Update Purchase</button>
                    </form>
                </div>
            </div>
        </div>
    @endsection

</div>
