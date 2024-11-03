@extends('web.dashboard.app', ['page' => 'Add Product'])


@section('content')
    {{-- {{-- @include('web.dashboard.components.cards') --}} -



    {{-- <form method="POST" action="{{ route('dashboard.product.store') }}" class="row gy-4" enctype="multipart/form-data"> --}}

    <form method="POST" action="{{ route('dashboard.product.update', $item->id) }}" class="row gy-4" enctype="multipart/form-data">
        @csrf
        <!-- Basic Information Card -->

        <div class="col-md-6 d-flex">
            <div class="card flex-fill">
                <div class="card-header">
                    <h5 class="card-title mb-0">Basic Information</h5>
                    {{-- all eror show list --}}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
                <div class="card-body">
                    <!-- Basic Information Content -->
                    <div class="mb-3 col-4 ms-auto">
                        <label class="form-label"> Select Stock Option</label>
                        <select name="" id="" class="form-control" onchange="stockOptionChange(this)">
                            <option value="manual" class="form-control" selected>Manual</option>
                            <option value="purchase" class="form-control">From Purchase</option>

                        </select>


                    </div>


                    <div class="mb-3">
                        <label class="form-label">Product Name</label>
                        <input type="text" id="product_name" name="name"  value="{{ $item->product_name }}" class="form-control" disabled>
              
                        @if ($errors->has('name'))
                            <span class="text-danger">{{ $errors->first('name') }}</span>
                        @endif
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Product Code</label>
                        <input type="text" id="product_code" disabled name="product_code" value="{{ $item->product_code }}" class="form-control"
                            placeholder="Product Code" autocomplete="off">
                        <ul id="product-suggestions" class="list-group"></ul>
                        @if ($errors->has('product_code'))
                            <span class="text-danger">{{ $errors->first('product_code') }}</span>
                        @endif
                    </div>




                    {{-- new close --}}
                    <div class="mb-3">
                        <label class="form-label">Short Description</label>
                        <textarea name="short_description" class="form-control" rows="3" placeholder="Enter a Short Description...">
                            @if ($errors->has('short_description'))
<span class="text-danger">{{ $errors->first('short_description') }}</span>
@endif
                        </textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="description" id="summernote1" class="form-control" rows="10">
                            @if ($errors->has('description'))
<span class="text-danger">{{ $errors->first('description') }}</span>
@endif
                        </textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Specifications</label>
                        <textarea name="specifications" id="summernote2" class="form-control" rows="10">
                            @if ($errors->has('specifications'))
<span class="text-danger">{{ $errors->first('specifications') }}</span>
@endif
                        </textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Product Tag</label>
                        <input type="text" class="form-control" name="product_tag">
                        @if ($errors->has('product_tag'))
                            <span class="text-danger">{{ $errors->first('product_tag') }}</span>
                        @endif
                    </div>

                    <!-- Dynamic Tabs for Attributes -->
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        @foreach ($attribute as $d)
                            <li class="nav-item" role="presentation">
                                <button class="nav-link {{ $loop->index == 0 ? 'active' : '' }}"
                                    id="{{ $d->name }}-tab" data-bs-toggle="tab" data-bs-target="#{{ $d->name }}"
                                    type="button" role="tab" aria-controls="{{ $d->name }}"
                                    aria-selected="true">{{ $d->name }}</button>
                            </li>
                        @endforeach
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        @foreach ($attribute as $i)
                            <div class="tab-pane fade {{ $loop->index == 0 ? 'show active' : '' }}"
                                id="{{ $i->name }}" role="tabpanel" aria-labelledby="{{ $i->name }}-tab">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Stock</th>
                                            <th scope="col">Price</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($i->options as $obj)
                                            <tr>
                                                <th scope="row">
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" value="{{ $obj->id }}"
                                                            name="option_id[]" type="checkbox" role="switch">
                                                    </div>
                                                </th>
                                                <td>
                                                    <span
                                                        @if ($obj->is_color) style="background: {{ extractHexCode($obj->name) }}" class="py-2 px-4 me-1" @endif></span>
                                                    {{ formatColorName($obj->name) }}
                                                </td>
                                                <td>{{ $obj->in_stock_unlimited ? 'Unlimited' : $obj->in_stock }}</td>
                                                <td>{{ $obj->price ? 'Free' : $obj->price }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- Price Data Card -->
        <div class="col-md-6 d-flex">
            <div class="card flex-fill">
                <div class="card-header">
                    <h5 class="card-title mb-0">Price Data</h5>

                </div>
                <div class="card-body">
                    <!-- Price Data Content -->
                    <div class="mb-3">
                        <label class="form-label">Price</label>
                        <input type="text" name="price" class="form-control">
                        @if ($errors->has('price'))
                            <span class="text-danger">{{ $errors->first('price') }}</span>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Previous Price</label>
                        <input type="text" name="discount_price" class="form-control">
                        @if ($errors->has('discount_price'))
                            <span class="text-danger">{{ $errors->first('discount_price') }}</span>
                        @endif
                    </div>
                    {{-- <div class="mb-3">
                        <label class="form-label">Quantity</label>
                        <input type="text" name="quantity" class="form-control">
                        @if ($errors->has('quantity'))
                            <span class="text-danger">{{ $errors->first('quantity') }}</span>
                        @endif
                    </div> --}}
                    {{-- new --}}
                    <div class="mb-3">
                        <label class="form-label">Available Quantity</label>
                        <input disabled type="text" id="quantity" value="{{ $item->quantity -  $item->sold}}" name="quantity" class="form-control">
                        <span id="quantity-message" class="text-danger"></span>
                        @if ($errors->has('quantity'))
                            <span class="text-danger">{{ $errors->first('quantity') }}</span>
                        @endif
                    </div>
                    {{-- nwe close --}}
                    <div class="mb-3">
                        <label class="form-label">Category</label>
                        <select class="form-control" name="category_id" onchange="getCategoryWithSubcategories(this)">
                            @foreach ($categories as $categorie)
                                <option value="{{ $categorie->id }}">{{ $categorie->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Subcategory</label>
                        <select class="form-control" name="sub_category_id" id="subcat_dropdown">
                            @foreach ($subcategories as $subcategorie)
                                <option value="{{ $subcategorie->id }}">{{ $subcategorie->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Brand</label>
                        <select class="form-control" name="brand_id">
                            @foreach ($brands as $d)
                                <option value="{{ $d->id }}">{{ $d->company }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Feature Image</label>
                        {{-- <input class="form-control" type="file" name="featured_image"> --}}
                        <input class="form-control" type="file" name="featured_image">
                        @if ($errors->has('featured_image'))
                            <span class="text-danger">{{ $errors->first('featured_image') }}</span>
                        @endif
                    </div>

                    <div class="mb-3">
                        <h6>Gallery</h6>
                        <div class="row">
                            <div class="col-4">
                                <input class="form-control" type="file" name="gallery_image_one">
                                @if ($errors->has('gallery_image_one'))
                                    <span class="text-danger">{{ $errors->first('gallery_image_one') }}</span>
                                @endif
                            </div>
                            <div class="col-4">
                                <input class="form-control" type="file" name="gallery_image_two">
                                @if ($errors->has('gallery_image_two'))
                                    <span class="text-danger">{{ $errors->first('gallery_image_two') }}</span>
                                @endif
                            </div>
                            <div class="col-4">
                                <input class="form-control" type="file" name="gallery_image_three">
                                @if ($errors->has('gallery_image_three'))
                                    <span class="text-danger">{{ $errors->first('gallery_image_three') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Product Video (YT Link)</label>
                        <input type="text" name="youtube_link" class="form-control" placeholder="YouTube Link">
                        @if ($errors->has('youtube_link'))
                            <span class="text-danger">{{ $errors->first('youtube_link') }}</span>
                        @endif
                    </div>

                    <h5>SEO Information</h5>
                    <div class="mb-3">
                        <label class="form-label">Meta Title</label>
                        <input type="text" name="meta_title" class="form-control">
                        @if ($errors->has('meta_title'))
                            <span class="text-danger">{{ $errors->first('meta_title') }}</span>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Meta Description</label>
                        <textarea class="form-control" rows="3" name="meta_description">
                            @if ($errors->has('meta_description'))
<span class="text-danger">{{ $errors->first('meta_description') }}</span>
@endif  
                        </textarea>
                    </div>

                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary w-100">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@section('js')
    {{-- <script src="{{ asset('assets/js/summernote/summernote.min.js') }}"></script> --}}
    <script>
        $(document).ready(function() {
            // Configuration for Summernote
            var config = {
                placeholder: 'Hello stand alone UI',
                tabsize: 2,
                height: 120,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ]
            };

            // Initialize Summernote on multiple editors
            $('#summernote1').summernote(config);
            $('#summernote2').summernote(config);
        });


        function getCategoryWithSubcategories(ele) {

            $('#subcat_dropdown').empty();
            axios.get(`http://${window.location.hostname}:8000/api/${ele.value}/subcategory-all`).then((result) => {

                result.data.forEach(element => {

                    $('#subcat_dropdown').append(`<option value="${element.id}">${element.name}</option>`);
                })
            }).catch((err) => {

            });
        }

        @if ($errors->any())
            @foreach ($errors->all() as $error)
                toastr.error('{{ $error }}');
            @endforeach
        @endif

        @if (session('error'))
            toastr.error('{{ session('error') }}');
        @endif


        var input = document.querySelector('input[name=product_tag]');
        new Tagify(input, {
            // options here
        });
    </script>



    <script>
        $(document).ready(function() {
            var debounceTimeout;

            $('#product_code').on('keyup', function() {
                clearTimeout(debounceTimeout);

                var query = $(this).val();

                if (query) {
                    debounceTimeout = setTimeout(function() {
                        $.ajax({
                            url: '{{ route('dashboard.product.search.product') }}',
                            type: 'GET',
                            data: {
                                product_code: query
                            },
                            success: function(data) {
                                $('#product-suggestions').empty();
                                if (data.length > 0) {
                                    $.each(data, function(index, product) {
                                        $('#product-suggestions').append(
                                            '<li class="list-group-item suggestion-item" style="cursor: pointer;" data-code="' +
                                            product.product_code +
                                            '" data-name="' + product.name +
                                            '">' +
                                            product.product_code + '</li>'
                                        );
                                    });
                                } else {
                                    $('#product-suggestions').append(
                                        '<li class="list-group-item">No products found</li>'
                                    );
                                }
                            },
                            error: function(xhr) {
                                $('#product-suggestions').empty();
                                if (xhr.status === 404) {
                                    $('#product-suggestions').append(
                                        '<li class="list-group-item">No products found</li>'
                                    );
                                }
                            }
                        });
                    }, 300); // Debounce delay
                } else {
                    $('#product-suggestions').empty();
                    $('#product_name').val('');
                    $('#quantity').val('');
                    $('#quantity-message').text('');
                }
            });

            $(document).on('click', '.suggestion-item', function() {
                var productCode = $(this).data('code');
                var productName = $(this).data('name');
                $('#product_code').val(productCode);
                $('#product_name').val(productName).prop('disabled', true);
                $('#hidden_product_name').val(productName); // Store value in hidden field
                $('#product-suggestions').empty();
            });

            $(document).on('mouseover', '.suggestion-item', function() {
                $('.suggestion-item').removeClass('active');
                $(this).addClass('active');
            });

            $(document).on('keydown', function(e) {
                if (e.key === "ArrowDown") {
                    var $active = $('.suggestion-item.active');
                    var $next = $active.next('.suggestion-item');
                    if ($next.length) {
                        $active.removeClass('active');
                        $next.addClass('active');
                    }
                    e.preventDefault();
                } else if (e.key === "ArrowUp") {
                    var $active = $('.suggestion-item.active');
                    var $prev = $active.prev('.suggestion-item');
                    if ($prev.length) {
                        $active.removeClass('active');
                        $prev.addClass('active');
                    }
                    e.preventDefault();
                } else if (e.key === "Enter") {
                    var $active = $('.suggestion-item.active');
                    if ($active.length) {
                        $active.trigger('click');
                    }
                    e.preventDefault();
                }
            });
        });
    </script>


    <script>
        $(document).ready(function() {
            $('#quantity').on('input', function() {
                var quantity = $(this).val();
                var productCode = $('#product_code').val();

                if (quantity && productCode) {
                    $.ajax({
                        url: '{{ route('dashboard.product.check.quantity') }}',
                        type: 'GET',
                        data: {
                            quantity: quantity,
                            product_code: productCode
                        },
                        success: function(response) {
                            if (response.exists) {
                                $('#quantity-message').text(
                                    'Quantity is valid for the selected product.'
                                ); // Success message
                                $('#quantity-error').text('');
                            } else {
                                $('#quantity-message').text(response.message ||
                                    'Quantity is invalid for the selected product.');
                                $('#quantity-error').text(response.message ||
                                    'Invalid quantity.');
                            }
                        },
                        error: function(xhr) {
                            $('#quantity-message').text('Error checking quantity.');
                            $('#quantity-error').text('Error checking quantity.');
                        }
                    });
                } else {
                    $('#quantity-message').text('Please enter a quantity and select a product code.');
                    $('#quantity-error').text('Quantity and product code are required.');
                }
            });
        });
    </script>

    <script>
        function stockOptionChange(d) {

            if (d.value == "purchase") {
                Swal.fire({
                    text: "Submit your Github username",
                    input: "text",
                    // inputAttributes: {
                    //     autocapitalize: "off"
                    // },
                    showCancelButton: true,
                    confirmButtonText: "Look up",
                    showLoaderOnConfirm: true,
                    preConfirm: async (login) => {
                        try {
                            const githubUrl = ` https://api.github.com/users/${login} `;
                            const response = await fetch(githubUrl);
                            if (!response.ok) {
                                return Swal.showValidationMessage(` ${JSON.stringify(await response.json())} `);
                            }
                            return response.json();
                        } catch (error) {
                            Swal.showValidationMessage(` Request failed: ${error} `);
                        }
                    },
                    allowOutsideClick: () => !Swal.isLoading()
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: `${result.value.login}'s avatar`,
                            imageUrl: result.value.avatar_url
                        });
                    }
                });
            } else {
                window.location.assign("{{ route('dashboard.product.add') }}");
            }


        }
    </script>
@endsection
