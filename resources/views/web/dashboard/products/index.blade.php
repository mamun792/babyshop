@extends('web.dashboard.app', ['page' => 'Add Product'])


@section('content')
   

    <form method="POST" action="{{ route('dashboard.product.store') }}" class="row gy-4" enctype="multipart/form-data">
        @csrf
        <!-- Basic Information Card -->

        <div class="col-md-6 d-flex">
            <div class="card flex-fill">
               
                <div class="card-body">

                    <div class="mb-3">
                        <label class="form-label">Product Name</label>
                        <input type="text" id="product_name" name="name" class="form-control"
                          >
                        @if ($errors->has('name'))
                            <span class="text-danger">{{ $errors->first('name') }}</span>
                        @endif
                    </div>

                 
                   
                   
                  



                
                    <div class="mb-3" id="manual_code">
                        <label class="form-label">Product Code</label>
                        <input type="text" id="manual_product_code" name="product_code" class="form-control"
                            placeholder="Product Code" value="{{ old('product_code') }}">
                        <ul id="manual-product-suggestions" class="list-group"></ul>
                        @if ($errors->has('product_code'))
                            <span class="text-danger">{{ $errors->first('product_code') }}</span>
                        @endif
                    </div>


          


                    {{-- new close --}}
                    <div class="mb-3">
                        <label class="form-label">Short Description</label>
                        <textarea name="short_description" class="form-control" rows="3" placeholder="Enter a Short Description...">
                           {{ old('short_description') }}
                        </textarea>
                        @if ($errors->has('short_description'))
                            <span class="text-danger">{{ $errors->first('short_description') }}</span>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="description" id="summernote1" class="form-control" rows="10">
                          {{ old('description') }}
                        </textarea>
                        @if ($errors->has('description'))
                            <span class="text-danger">{{ $errors->first('description') }}</span>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Specifications</label>
                        <textarea name="specifications" id="summernote2" class="form-control" rows="10">
                           {{ old('specifications') }}
                        </textarea>
                        @if ($errors->has('specifications'))
                            <span class="text-danger">{{ $errors->first('specifications') }}</span>
                        @endif
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Product Tag</label>
                        <input type="text" class="form-control" name="product_tag" value="{{ old('product_tag') }}">
                        @if ($errors->has('product_tag'))
                            <span class="text-danger">{{ $errors->first('product_tag') }}</span>
                        @endif
                    </div>

                    {{-- affiliate product --}}
                    <div class="mb-3">
                        <label class="form-label fw-bold">
                            Affiliate Product
                        </label>
                        <div class="form-check">
                            <input class="form-check-input me-2" type="checkbox" id="affiliateProduct" name="is_affiliate" value="1" style="cursor: pointer; width: 1.5em; height: 1.5em;">
                            <label class="form-check-label" for="affiliateProduct">
                                Yes, this is an Affiliate Product
                            </label>
                        </div>
                        <small class="form-text text-muted">
                            Check the box if this product is part of your affiliate program.
                        </small>
                    </div>
                    
                    
                    

                    <!-- Dynamic Tabs for Attributes -->
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        @foreach ($attribute as $d)
                            <li class="nav-item" role="presentation">
                                <button class="nav-link {{ $loop->index == 0 ? 'active' : '' }}"
                                    id="{{ $d->name }}-tab" data-bs-toggle="tab"
                                    data-bs-target="#{{ $d->name }}" type="button" role="tab"
                                    aria-controls="{{ $d->name }}" aria-selected="true">{{ $d->name }}</button>
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
                                          
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($i->options as $obj)
                                            <tr>
                                                <th scope="row">
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" value="{{ $obj->id }}"
                                                            name="option_id[]" type="checkbox" role="switch"
                                                            value="{{ $obj->id }}">

                                                    </div>
                                                </th>
                                                <td>
                                                   
                                                    <span
                                                        @if ($obj->is_color) style="background: {{ $obj->name }}" class="py-2 px-4 me-1" @endif></span>
                                                    {{ formatColorName($obj->name) }}
                                                </td>
                                               
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


                  
              


                    <div class="mb-3">
                        <label class="form-label">Price</label>
                        <input type="text" id="price" name="price" class="form-control"
                            >
                        @if ($errors->has('price'))
                            <span class="text-danger">{{ $errors->first('price') }}</span>
                        @endif
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Previous Price</label>
                        <input type="text" name="discount_price" value="0" class="form-control"
                            value="{{ old('discount_price') }}">
                        @if ($errors->has('discount_price'))
                            <span class="text-danger">{{ $errors->first('discount_price') }}</span>
                        @endif
                    </div>


                    <div class="mb-3">
                        <label class="form-label">Quantity</label>
                        <input type="text" id="quantity" name="quantity" class="form-control">
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
                        <input type="text" name="youtube_link" class="form-control" placeholder="YouTube Link"
                            value="{{ old('youtube_link') }}">
                        @if ($errors->has('youtube_link'))
                            <span class="text-danger">{{ $errors->first('youtube_link') }}</span>
                        @endif
                    </div>

                    <h5>SEO Information</h5>
                    <div class="mb-3">
                        <label class="form-label">Meta Title</label>
                        <input type="text" name="meta_title" class="form-control" value="{{ old('meta_title') }}">
                        @if ($errors->has('meta_title'))
                            <span class="text-danger">{{ $errors->first('meta_title') }}</span>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Meta Description</label>
                        <textarea class="form-control" rows="3" name="meta_description">
                           {{ old('meta_description') }}
                        </textarea>
                        @if ($errors->has('meta_description'))
                            <span class="text-danger">{{ $errors->first('meta_description') }}</span>
                        @endif
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
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
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



  
@endsection
