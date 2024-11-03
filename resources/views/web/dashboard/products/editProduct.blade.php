@extends('web.dashboard.app', ['page' => 'product'])

@section('content')
    {{-- @include('web.dashboard.components.cards') --}}

    <div class="container mt-4">
        <div class="row gy-4">
            <!-- Basic Information Card -->
            <div class="col-md-12 d-flex">
                <div class="card flex-fill">
                    <div class="card-header d-flex justify-content-between align-items-center bg-light border-0">
                        <h5 class="card-title mb-0 text-primary">Basic Information</h5>

                    </div>
                    <div class="card-body">
                        <!-- Basic Information Content -->
                        <form action="{{ route('dashboard.product.update', $product->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Product Name</label>
                                    <input type="text" name="name" class="form-control"
                                        value="{{ old('name', $product->name) }}">
                                    @if ($errors->has('name'))
                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Product Code</label>
                                    <input type="text" name="product_code" class="form-control"
                                        value="{{ old('product_code', $product->product_code) }}">
                                    @if ($errors->has('product_code'))
                                        <span class="text-danger">{{ $errors->first('product_code') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Short Description</label>
                                <textarea name="short_description" class="form-control" rows="3">{{ old('short_description', $product->short_description) }}
                                    @if ($errors->has('short_description'))
<span class="text-danger">{{ $errors->first('short_description') }}</span>
@endif
                                </textarea>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Description</label>
                                <textarea name="description" id="summernote1" class="form-control" rows="10">{{ old('description', $product->description) }}
                                    @if ($errors->has('description'))
<span class="text-danger">{{ $errors->first('description') }}</span>
@endif
                                </textarea>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Specifications</label>
                                <textarea name="specifications" id="summernote2" class="form-control" rows="10">{{ old('specifications', $product->specifications) }}
                                    @if ($errors->has('specifications'))
<span class="text-danger">{{ $errors->first('specifications') }}</span>
@endif
                                </textarea>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Price</label>
                                    <input type="number" name="price" class="form-control"
                                        value="{{ old('price', $product->price) }}" step="0.01">
                                    @if ($errors->has('price'))
                                        <span class="text-danger">{{ $errors->first('price') }}</span>
                                    @endif
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Previous Price</label>
                                    <input type="number" name="discount_price" class="form-control"
                                        value="{{ old('discount_price', $product->discount_price) }}" step="0.01">
                                    @if ($errors->has('discount_price'))
                                        <span class="text-danger">{{ $errors->first('discount_price') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Quantity</label>
                                    <input type="number" name="quantity" class="form-control"
                                        value="{{ old('quantity', $product->quantity) }}" required>
                                    @if ($errors->has('quantity'))
                                        <span class="text-danger">{{ $errors->first('quantity') }}</span>
                                    @endif
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Category</label>
                                    <select name="category_id" class="form-select" required>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Subcategory</label>
                                    <select name="sub_category_id" class="form-select" required>
                                        @foreach ($subcategories as $subcategory)
                                            <option value="{{ $subcategory->id }}"
                                                {{ $product->sub_category_id == $subcategory->id ? 'selected' : '' }}>
                                                {{ $subcategory->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Brand</label>
                                    <select name="brand_id" class="form-select" required>
                                        @foreach ($brands as $brand)
                                            <option value="{{ $brand->id }}"
                                                {{ $product->brand_id == $brand->id ? 'selected' : '' }}>
                                                {{ $brand->company }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Image Uploads</label>
                                <div class="row gy-4">
                                    <!-- Image Upload Section -->
                                    <div class="col-md-12">
                                        <div class="card">

                                            <div class="d-flex">
                                                <!-- Featured Image -->
                                                <div class="form-group mb-4">
                                                    <div class="mb-2">
                                                        <img id="featured_image_preview"
                                                            src="{{ $product->featured_image ? asset($product->featured_image) : '' }}"
                                                            alt="Featured Image Preview" class="img-thumbnail"
                                                            style="max-width: 100px; {{ $product->featured_image ? 'display: block;' : 'display: none;' }}">
                                                        @if ($errors->has('featured_image'))
                                                            <span
                                                                class="text-danger">{{ $errors->first('featured_image') }}</span>
                                                        @endif
                                                    </div>
                                                    <label for="featured_image" class="form-label">Featured Image</label>
                                                    <input type="file" name="featured_image" id="featured_image"
                                                        class="form-control-file">

                                                </div>

                                                <!-- Gallery Image One -->
                                                <div class="form-group mb-4">
                                                    <div class="mb-2">
                                                        <img id="gallery_image_one_preview"
                                                            src="{{ $product->gallery_image_one ? asset($product->gallery_image_one) : '' }}"
                                                            alt="Gallery Image One Preview" class="img-thumbnail"
                                                            style="max-width: 100px; {{ $product->gallery_image_one ? 'display: block;' : 'display: none;' }}">
                                                        @if ($errors->has('gallery_image_one'))
                                                            <span
                                                                class="text-danger">{{ $errors->first('gallery_image_one') }}</span>
                                                        @endif
                                                    </div>
                                                    <label for="gallery_image_one" class="form-label">Gallery Image
                                                        One</label>
                                                    <input type="file" name="gallery_image_one" id="gallery_image_one"
                                                        class="form-control-file">


                                                </div>

                                                <!-- Gallery Image Two -->
                                                <div class="form-group mb-4">
                                                    <div class="mb-2">
                                                        <img id="gallery_image_two_preview"
                                                            src="{{ $product->gallery_image_two ? asset($product->gallery_image_two) : '' }}"
                                                            alt="Gallery Image Two Preview" class="img-thumbnail"
                                                            style="max-width: 100px; {{ $product->gallery_image_two ? 'display: block;' : 'display: none;' }}">
                                                        @if ($errors->has('gallery_image_two'))
                                                            <span
                                                                class="text-danger">{{ $errors->first('gallery_image_two') }}</span>
                                                        @endif
                                                    </div>
                                                    <label for="gallery_image_two" class="form-label">Gallery Image
                                                        Two</label>
                                                    <input type="file" name="gallery_image_two" id="gallery_image_two"
                                                        class="form-control-file">


                                                </div>

                                                <!-- Gallery Image Three -->
                                                <div class="form-group mb-4">
                                                    <div class="mb-2">
                                                        <img id="gallery_image_three_preview"
                                                            src="{{ $product->gallery_image_three ? asset($product->gallery_image_three) : '' }}"
                                                            alt="Gallery Image Three Preview" class="img-thumbnail"
                                                            style="max-width: 100px; {{ $product->gallery_image_three ? 'display: block;' : 'display: none;' }}">
                                                        @if ($errors->has('gallery_image_three'))
                                                            <span
                                                                class="text-danger">{{ $errors->first('gallery_image_three') }}</span>
                                                        @endif
                                                    </div>
                                                    <label for="gallery_image_three" class="form-label">Gallery Image
                                                        Three</label>
                                                    <input type="file" name="gallery_image_three"
                                                        id="gallery_image_three" class="form-control-file">


                                                </div>
                                            </div>



                                        </div>
                                    </div>
                                </div>
                            </div>

                    </div>
                    <div class="p-4">
                        <div class="mb-3">
                            <label class="form-label">YouTube Link</label>
                            <input type="text" name="youtube_link" class="form-control"
                                value="{{ old('youtube_link', $product->youtube_link) }}">
                            @if ($errors->has('youtube_link'))
                                <span class="text-danger">{{ $errors->first('youtube_link') }}</span>
                            @endif
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Meta Title</label>
                            <input type="text" name="meta_title" class="form-control"
                                value="{{ old('meta_title', $product->meta_title) }}">
                            @if ($errors->has('meta_title'))
                                <span class="text-danger">{{ $errors->first('meta_title') }}</span>
                            @endif
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Meta Description</label>
                            <textarea name="meta_description" class="form-control" rows="3">{{ old('meta_description', $product->meta_description) }}
                                @if ($errors->has('meta_description'))
<span class="text-danger">{{ $errors->first('meta_description') }}</span>
@endif
                                
                            </textarea>
                        </div>

                       {{-- affiliate product select  --}}
                        <div class="mb-3">
                            <label class="form-label">Affiliate Product  </label>
                            <select name="is_affiliate" class="form-select" required>
                                <option value="0" {{ $product->is_affiliate == 0 ? 'selected' : '' }}>No</option>
                                <option value="1" {{ $product->is_affiliate == 1 ? 'selected' : '' }}>Yes</option>
                            </select>
                        </div>


                        <div class="mb-3">
                            <label class="form-label">Product Attributes</label>
                            <ul class="nav nav-tabs" id="attributeTab" role="tablist">
                                @foreach ($attribute as $d)
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link {{ $loop->index == 0 ? 'active' : '' }}"
                                            id="{{ $d->name }}-tab" data-bs-toggle="tab"
                                            href="#{{ $d->name }}" role="tab"
                                            aria-controls="{{ $d->name }}"
                                            aria-selected="true">{{ $d->name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                            <div class="tab-content mt-3" id="attributeTabContent">
                                @foreach ($attribute as $i)
                                    <div class="tab-pane fade show {{ $loop->index == 0 ? 'active' : '' }}"
                                        id="{{ $i->name }}" role="tabpanel"
                                        aria-labelledby="{{ $i->name }}-tab">
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
                                                                <input class="form-check-input"
                                                                    value="{{ $obj->id }}" name="option_id[]"
                                                                    @if (in_array($obj->id, $product->options->pluck('product_option_id')->toArray())) checked @endif
                                                                    type="checkbox" role="switch"
                                                                    id="{{ $obj->id }}">
                                                            </div>
                                                        </th>
                                                        <td>
                                                            <span
                                                                @if ($obj->is_color) style="background: {{ extractHexCode($obj->name) }}" class="py-2 px-4 me-1" @endif></span>
                                                            {{ formatColorName($obj->name) }}
                                                        </td>
                                                        <td>{{ $obj->in_stock_unlimited ? 'Unlimited' : $obj->in_stock }}
                                                        </td>
                                                        <td>{{ $obj->price }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>


                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Update Product</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- SEO Settings Card -->
        {{-- <div class="col-md-12 d-flex">
                <div class="card flex-fill">
                    <div class="card-header">
                        <h5 class="card-title mb-0">SEO Settings</h5>
                    </div>
                    <div class="card-body">
                        <!-- SEO Settings Content -->
                        <!-- Add SEO Settings fields here if necessary -->
                    </div>
                </div>
            </div> --}}
    </div>
    </div>

    <!-- JavaScript for Image Preview -->
@endsection

@section('js')
    <script>
        function previewImage(input, previewId) {
            const file = input.files[0];
            const preview = document.getElementById(previewId);
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                };
                reader.readAsDataURL(file);
            } else {
                preview.src = '';
                preview.style.display = 'none';
            }
        }


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



        @if ($errors->any())
            @foreach ($errors->all() as $error)
                toastr.error('{{ $error }}', 'Error');
            @endforeach
        @endif

        @if (session('success'))
            toastr.success('{{ session('success') }}', 'Success');
        @endif

        @if (session('error'))
            toastr.error('{{ session('error') }}', 'Error');
        @endif
    </script>
@endsection
