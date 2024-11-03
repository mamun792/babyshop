<div>
    @extends('web.dashboard.app', ['page' => 'product-purchase'])
    @section('content')
        {{-- @include('web.dashboard.components.cards') --}}




        <div class="container mt-5">
           
            {{-- <h6 class="text-center mt-3">bAdd Purchase Product </h5> --}}
                <div class="card mt-3">
                    <div class="card-header py-16 px-24 bg-base border border-end-0 border-start-0 border-top-0">
                        Add Purchased Items 
                    </div>

                    <div class="card-body">

         
                        <form method="POST" action="{{ route('dashboard.product-purchase.store') }}"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="product" class="form-label">Purchase Product Name</label>
                                    <input type="text" class="form-control" id="product" name="purchase_name"
                                    value="{{ old('purchase_name') }}"
                                    >
                                    @if ($errors->has('purchase_name'))
                                        <span class="text-danger">{{ $errors->first('purchase_name') }}</span>
                                    @endif
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="purchase_date" class="form-label">Purchase Date</label>
                                    <input type="date" class="form-control" id="purchase_date" name="purchase_date"
                                    value="{{ old('purchase_date') }}"
                                    >
                                    @if ($errors->has('purchase_date'))
                                        <span class="text-danger">{{ $errors->first('purchase_date') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="invoice_number" class="form-label">Invoice Number</label>
                                    <input type="text" class="form-control" id="invoice_number" name="invoice_number"
                                    value="{{ old('invoice_number') }}"
                                    >
                                    @if ($errors->has('invoice_number'))
                                        <span class="text-danger">{{ $errors->first('invoice_number') }}</span>
                                    @endif
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="supplier_id" class="form-label">Supplier</label>
                                    <select class="form-select" id="supplier_id" name="supplier_id">
                                        <option></option>
                                        @foreach ($supplier as $d)
                                            <option value="{{ $d->id }}">{{ $d->supplier_name }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('supplier_id'))
                                        <span class="text-danger">{{ $errors->first('supplier_id') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="document" class="form-label">Document</label>
                                    <input type="file" class="form-control" id="document" name="document"
                                        accept="image/*">
                                    @if ($errors->has('document'))
                                        <span class="text-danger">{{ $errors->first('document') }}</span>
                                    @endif
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="comment" class="form-label">Comment</label>
                                    <textarea class="form-control" id="comment" name="comment" rows="3">
                                        {{ old('comment') }}
                                    </textarea>
                                    @if ($errors->has('comment'))
                                        <span class="text-danger">{{ $errors->first('comment') }}</span>
                                    @endif
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Add Purchase</button>
                        </form>

                      


                        @if (session('purchase'))
                            @php $purchase = session('purchase'); @endphp
                            <div class="alert alert-success mt-3">
                                <div id="product-forms-container">
                                    <!-- Initial form -->
                                    <form id="product-form">
                                        @csrf
                                        <div class="input-group mb-2">
                                            <input type="hidden" id="purchase_id" value="{{ $purchase->id }}"
                                                name="purchase_id">

                                            <input type="text" class="form-control" name="name"
                                                placeholder="Product Name" required>
                                            <input type="text" class="form-control" name="product_code"
                                                placeholder="Product Code">
                                            <input type="text" class="form-control" name="quantity"
                                                placeholder="Quantity" required>
                                            <input type="text" class="form-control" name="price" placeholder="Price"
                                                required>
                                            <input type="text" class="form-control" name="total_price"
                                                placeholder="Total Price" required>
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fas fa-plus"></i> <!-- Font Awesome Plus Icon -->
                                            </button>
                                        </div>
                                    </form>
                                </div>
                                <button id="add-more-product" class="btn btn-secondary mt-2">
                                    <i class="fas fa-plus"></i> Add Another Product
                                </button>
                            </div>
                        @endif




                    </div>

                </div>
        </div>
    @endsection

    @section('js')
        <script>
            document.getElementById('document').addEventListener('change', function(event) {
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const img = document.getElementById('imagePreview');
                        img.src = e.target.result;
                        img.style.display = 'block';
                    };
                    reader.readAsDataURL(file);
                } else {
                    const img = document.getElementById('imagePreview');
                    img.src = '';
                    img.style.display = 'none';
                }
            });
        </script>


        <script>
            document.addEventListener('DOMContentLoaded', function() {

                function attachFormSubmitListener(form) {
                    form.addEventListener('submit', function(e) {
                        e.preventDefault();

                        let formData = new FormData(form);


                        axios.post('{{ route('dashboard.product-purchase.addProductToPurchase') }}', formData)
                            .then(function(response) {

                                form.reset();

                                alert('Product added successfully!');
                            })
                            .catch(function(error) {
                                // Handle any errors
                                console.error(error);
                                alert('An error occurred: ' + (error.response.data.message || error
                                    .message));
                            });
                    });
                }


                let initialForm = document.getElementById('product-form');
                attachFormSubmitListener(initialForm);


                document.getElementById('add-more-product').addEventListener('click', function(e) {
                    e.preventDefault();

                    // Clone the form and assign a new ID
                    let newForm = initialForm.cloneNode(true);
                    newForm.reset();


                    newForm.removeAttribute('id');


                    document.getElementById('product-forms-container').appendChild(newForm);


                    attachFormSubmitListener(newForm);
                });
            });
        </script>
    @endsection
</div>
