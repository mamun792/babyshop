@extends('web.frontend.master')

@section('main-content')
    <main class="main">

        {{-- <section class="mt-50 mb-50">
        <div class="container">
            <div class="row flex-row-reverse">
                <div class="col-lg-9">
                    <div class="shop-product-fillter">
                        <div class="totall-product">
                            <p> We found <strong class="text-brand">688</strong> items for you!</p>
                        </div>
                        <div class="sort-by-product-area">
                            <div class="sort-by-cover mr-10">
                                <div class="sort-by-product-wrap">
                                    <div class="sort-by">
                                        <span><i class="fi-rs-apps"></i>Show:</span>
                                    </div>
                                    <div class="sort-by-dropdown-wrap">
                                        <span> 50 <i class="fi-rs-angle-small-down"></i></span>
                                    </div>
                                </div>
                                <div class="sort-by-dropdown">
                                    <ul>
                                        <li><a class="active" href="#">50</a></li>
                                        <li><a href="#">100</a></li>
                                        <li><a href="#">150</a></li>
                                        <li><a href="#">200</a></li>
                                        <li><a href="#">All</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="sort-by-cover">
                                <div class="sort-by-product-wrap">
                                    <div class="sort-by">
                                        <span><i class="fi-rs-apps-sort"></i>Sort by:</span>
                                    </div>
                                    <div class="sort-by-dropdown-wrap">
                                        <span> Featured <i class="fi-rs-angle-small-down"></i></span>
                                    </div>
                                </div>
                                <div class="sort-by-dropdown">
                                    <ul>
                                        <li><a class="active" href="#">Featured</a></li>
                                        <li><a href="#">Price: Low to High</a></li>
                                        <li><a href="#">Price: High to Low</a></li>
                                        <li><a href="#">Release Date</a></li>
                                       
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row product-grid-3">

                      
                        <div class="col-lg-4 col-md-4 col-12 col-sm-6">
                            <div class="product-cart-wrap mb-30">
                                <div class="product-img-action-wrap">
                                    <div class="product-img product-img-zoom">
                                        <a href="shop-product-right.html">
                                            <img class="default-img" src="{{ asset('ecommerce/assets/imgs/shop/product-2-1.jpg') }}" alt="">
                                            <img class="hover-img" src="{{ asset('ecommerce/assets/imgs/shop/product-2-2.jpg') }}" alt="">
                                        </a>
                                    </div>
                                    <div class="product-action-1">
                                        <a aria-label="Quick view" class="action-btn hover-up" data-bs-toggle="modal" data-bs-target="#quickViewModal">
                                            <i class="fi-rs-search"></i></a>
                                        <a aria-label="Add To Wishlist" class="action-btn hover-up" href="shop-wishlist.html">
                                            <i class="fi-rs-heart"></i></a>
                                        <a aria-label="Compare" class="action-btn hover-up" href="shop-compare.html">
                                            <i class="fi-rs-shuffle"></i></a>
                                    </div>
                                    <div class="product-badges product-badges-position product-badges-mrg">
                                        <span class="hot">Hot</span>
                                    </div>
                                </div>
                                <div class="product-content-wrap">
                                    <div class="product-category">
                                        <a href="shop-grid-right.html">Music</a>
                                    </div>
                                    <h2><a href="shop-product-right.html">Colorful Pattern Shirts</a></h2>
                                    <div class="rating-result" title="90%">
                                        <span>
                                            <span>90%</span>
                                        </span>
                                    </div>
                                    <div class="product-price">
                                        <span>$238.85 </span>
                                        <span class="old-price">$245.8</span>
                                    </div>
                                    <div class="product-action-1 show">
                                        <a aria-label="Add To Cart" class="action-btn hover-up" href="shop-cart.html">
                                            <i class="fi-rs-shopping-bag-add"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                       

                        

                    </div>
                    <!--pagination-->
                    <div class="pagination-area mt-15 mb-sm-5 mb-lg-0">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination justify-content-start">
                                <li class="page-item active"><a class="page-link" href="#">01</a>
                                </li>
                                <li class="page-item"><a class="page-link" href="#">02</a></li>
                                <li class="page-item"><a class="page-link" href="#">03</a></li>
                                <li class="page-item"><a class="page-link dot" href="#">...</a></li>
                                <li class="page-item"><a class="page-link" href="#">16</a></li>
                                <li class="page-item"><a class="page-link" href="#"><i
                                            class="fi-rs-angle-double-small-right"></i></a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <div class="col-lg-3 primary-sidebar sticky-sidebar">
                    <div class="widget-category mb-30">
                        <h5 class="section-title style-1 mb-30 wow fadeIn animated">Category</h5>
                        <ul class="categories">
                            <li><a href="shop-grid-right.html">Shoes & Bags</a></li>
                            <li><a href="shop-grid-right.html">Blouses & Shirts</a></li>
                            <li><a href="shop-grid-right.html">Dresses</a></li>
                            <li><a href="shop-grid-right.html">Swimwear</a></li>
                            <li><a href="shop-grid-right.html">Beauty</a></li>
                            <li><a href="shop-grid-right.html">Jewelry & Watch</a></li>
                            <li><a href="shop-grid-right.html">Accessories</a></li>
                        </ul>
                    </div>
                    <!-- Fillter By Price -->
                    <div class="sidebar-widget price_range range mb-30">
                        <div class="widget-header position-relative mb-20 pb-10">
                            <h5 class="widget-title mb-10">Fill by price</h5>
                            <div class="bt-1 border-color-1"></div>
                        </div>
                        <div class="price-filter">
                            <div class="price-filter-inner">
                                <div id="slider-range"></div>
                                <div class="price_slider_amount">
                                    <div class="label-input">
                                        <span>Range:</span><input type="text" id="amount"
                                            name="price" placeholder="Add Your Price">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="list-group">
                            <div class="list-group-item mb-10 mt-10">
                                <label class="fw-900">Color</label>
                                <div class="custome-checkbox">
                                    <input class="form-check-input" type="checkbox" name="checkbox"
                                        id="exampleCheckbox1" value="">
                                    <label class="form-check-label" for="exampleCheckbox1"><span>Red
                                            (56)</span></label>
                                    <br>
                                    
                                </div>
                                <label class="fw-900 mt-15">Size</label>
                                <div class="custome-checkbox">
                                    <input class="form-check-input" type="checkbox" name="checkbox"
                                        id="exampleCheckbox11" value="">
                                    <label class="form-check-label" for="exampleCheckbox11"><span>XL</span></label>
                                    <br>
                                    
                                </div>
                            </div>
                        </div>
                        <a href="shop-grid-right.html" class="btn btn-sm btn-default"><i
                                class="fi-rs-filter mr-5"></i> Fillter</a>
                    </div>
                    <!-- Product sidebar Widget -->
                    
                    <div class="sidebar-widget product-sidebar mb-30 p-30 bg-grey border-radius-10">
                        <div class="widget-header position-relative mb-20 pb-10">
                            <h5 class="widget-title mb-10">New products</h5>
                            <div class="bt-1 border-color-1"></div>
                        </div>
                        <div class="single-post clearfix">
                            <div class="image">
                                <img src="{{ asset('ecommerce/assets/imgs/shop/thumbnail-3.jpg') }}" alt="#">
                            </div>
                            <div class="content pt-10">
                                <h5><a href="shop-product-detail.html">Chen Cardigan</a></h5>
                                <p class="price mb-0 mt-5">$99.50</p>
                                <div class="product-rate">
                                    <div class="product-rating" style="width:90%"></div>
                                </div>
                            </div>
                        </div>
                        
                    </div>

                    

                   
                </div>
            </div>
        </div>
    </section> --}}

        <style>
            /* Hide the checkbox but keep its functionality */
            .size-checkbox {
                display: none;
            }

            /* Customize the size buttons */
            .size-button {
                padding: 5px 10px;
                border-radius: 5px;
                transition: background-color 0.2s, color 0.2s, border 0.2s, transform 0.2s;
                /* Smooth transitions */
                display: inline-block;
                border: 2px solid transparent;
                position: relative;
                box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
                font-size: 0.8rem;
            }

            /* Highlight selected sizes */
            .size-checkbox:checked+.size-button {
                background: linear-gradient(135deg, #007bff, #0056b3);
                color: #fff;
                border: 2px solid #0056b3;
            }

            /* Show checkmark when checked */
            .size-checkbox:checked+.size-button .checkmark {
                display: inline;
                position: absolute;
                top: 50%;
                right: 5px;
                transform: translateY(-50%);
                color: #fff;
                font-size: 0.5rem;
            }

            /* Add a hover effect */
            .size-button:hover {
                background-color: #0056b3;
                color: #fff;
                border: 2px solid #007bff;
                transform: translateY(-2px);
            }

            /* Disabled state */
            .size-button:disabled {
                background-color: #e0e0e0;
                color: #9e9e9e;
                border: 2px solid #bdbdbd;
                box-shadow: none;
                cursor: not-allowed;
            }

            /* Ensure good spacing between size options */
            .size-wrapper {
                margin-right: 10px;
                margin-bottom: 10px;
            }

            /* Accessibility improvements */
            .size-button:focus {
                outline: none;
                box-shadow: 0 0 0 4px rgba(0, 123, 255, 0.5);
            }






            /* Customization for color circles and checkboxes */
            .color-wrapper {
                display: flex;
                align-items: center;
                margin-right: 10px;
                margin-bottom: 10px;
                position: relative;
            }

            .color-checkbox {
                display: none;
            }

            /* When a color is selected, show a checkmark or border */
            .color-checkbox:checked+.color-circle {

                box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
                position: relative;
            }

            .color-checkbox:checked+.color-circle::after {
                content: '✓';
                color: white;
                font-size: 16px;
                position: absolute;
                top: 5px;
                left: 10px;
            }

            /* Color circle customization */
            .color-circle {
                width: 40px;
                height: 40px;
                border-radius: 50%;
                border: 2px solid #ddd;
                cursor: pointer;
                display: flex;
                justify-content: center;
                align-items: center;
                transition: transform 0.2s, border-color 0.2s, box-shadow 0.2s;
            }

            .color-circle:hover {
                transform: scale(1.1);

            }

            /* Accessibility improvements for color names (hidden visually but readable by screen readers) */
            .visually-hidden {
                position: absolute;
                width: 1px;
                height: 1px;
                margin: -1px;
                padding: 0;
                overflow: hidden;
                clip: rect(0, 0, 0, 0);
                border: 0;
            }

            /* today */

        </style>



        <section class="mt-50 mb-50">
            <div class="container">
                <div class="row flex-row-reverse">
                    <div class="col-lg-9">



                        <div class="shop-product-fillter">
                            <div class="totall-product">
                                <p>We found <strong class="text-brand">{{ $products->count() }}</strong> items for you!</p>
                            </div>
                            <div class="sort-by-product-area">
                                <div class="sort-by-cover mr-10">
                                    <div class="sort-by-product-wrap">
                                        <div class="sort-by">
                                            <span><i class="fi-rs-apps"></i>Show:</span>
                                        </div>
                                        <div class="sort-by-dropdown-wrap">
                                            <span>{{ request()->get('limit', 50) }} <i
                                                    class="fi-rs-angle-small-down"></i></span>
                                        </div>
                                    </div>
                                    <div class="sort-by-dropdown">
                                        <ul>
                                            @foreach ([50, 100, 150, 200, 500] as $limitOption)
                                                <li>
                                                    <a class="{{ request()->get('limit') == $limitOption ? 'active' : '' }}"
                                                        href="?limit={{ $limitOption }}&{{ http_build_query(request()->except('limit')) }}">
                                                        {{ $limitOption }}
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                                <div class="sort-by-cover">
                                    <div class="sort-by-product-wrap">
                                        <div class="sort-by">
                                            <span><i class="fi-rs-apps-sort"></i>Sort by:</span>
                                        </div>
                                        <div class="sort-by-dropdown-wrap">
                                            <span id="sort-label">{{ request()->get('sort', 'Featured') }} <i
                                                    class="fi-rs-angle-small-down"></i></span>
                                        </div>
                                    </div>
                                    <div class="sort-by-dropdown">
                                        <ul>
                                            @foreach (['Featured' => 'Featured', 'price_asc' => 'Price: Low to High', 'price_desc' => 'Price: High to Low', 'release_date' => 'Release Date'] as $value => $label)
                                                <li>
                                                    <a class="{{ request()->get('sort') == $value ? 'active' : '' }}"
                                                        href="javascript:void(0);"
                                                        onclick="applySort('{{ $value }}')">
                                                        {{ $label }}
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>



                        {{-- <div id="loadingSpinner" style="display: none;" >
                            <img class="loader" src="{{ asset(loding()) }}" alt="Loading..." />
                        </div> --}}

                        <div class="row product-grid-3" id="product-listing">

                            @if ($products->isEmpty())
                                <div class="col-12 text-center">
                                    <h3>No products available at the moment.</h3>
                                    <p>Please check back later or explore other categories.</p>
                                </div>
                            @else
                                @foreach ($products as $product)
                                    <div class="col-lg-3 col-md-6 col-12">
                                        <div class="product-cart-wrap">
                                            <div class="product-img-action-wrap">
                                                <div class="product-img product-img-zoom">
                                                    <a href="{{ route('product-details', ['slug' => $product->slug]) }}">
                                                        <img class="default-img"
                                                            src="{{ asset($product->featured_image) }}"
                                                            alt="{{ $product->name }}">
                                                        <img class="hover-img"
                                                            src="{{ asset($product->gallery_image_one) }}"
                                                            alt="{{ $product->name }}">
                                                    </a>
                                                </div>
                                                <div class="product-action-1">
                                                    <a aria-label="Quick view" class="action-btn small hover-up"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#quickViewModal{{ $product->id }}">
                                                        <i class="fi-rs-eye"></i></a>


                                                    <a aria-label="Add To Wishlist"
                                                        class="action-btn small hover-up @if (in_array($product->id, $wishlistProducts)) added @endif"
                                                        href="javascript:void(0);"
                                                        onclick="addToWishlist({{ $product->id }}, this)">
                                                        <i
                                                            class="fi-rs-heart @if (in_array($product->id, $wishlistProducts)) filled @endif"></i>
                                                    </a>


                                                    <a aria-label="Compare" class="action-btn small hover-up"
                                                        href="#">
                                                        <i class="fi-rs-shuffle"></i></a>
                                                </div>
                                                <div class="product-badges product-badges-position product-badges-mrg">
                                                    <span class="hot">Hot</span>
                                                </div>
                                            </div>
                                            <div class="product-content-wrap">
                                                <h2><a
                                                        href="{{ route('product-details', ['slug' => $product->slug]) }}">{{ $product->name }}</a>
                                                </h2>
                                                <div class="rating-result" title="{{ $product->averageRating }}%">
                                                    <span><span>{{ round(( ( ($product->price - ($product->price - $product->discount_price - $product->campaign_price) ) * 100 ) / ($product->price)   )) }}%</span></span>
                                                </div>
                                                <div class="product-price">
                                                    <span>{{ number_format($product->price - $product->discount_price - $product->campaign_price, 2) }}</span>
                                                    @if ($product->old_price)
                                                        <span
                                                            class="old-price">${{ number_format($product->old_price, 2) }}</span>
                                                    @endif
                                                </div>
                                                <div class="">


                                                    <a href="{{ route('product-details', ['slug' => $product->slug]) }}"
                                                        class="btn btn-primary btn-sm mt-3"
                                                        style="width: 100% !important; display: block; text-align: center;">
                                                        ORDER NOW
                                                    </a>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>



                        <!--pagination-->
                        <div class="pagination-area mt-15 mb-sm-5 mb-lg-0">
                            <nav aria-label="Page navigation example">
                                <ul class="pagination justify-content-start">
                                    <!-- Previous Page Link -->
                                    @if ($products->onFirstPage())
                                        <li class="page-item disabled">
                                            <a class="page-link" href="#" aria-disabled="true">01</a>
                                        </li>
                                    @else
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $products->previousPageUrl() }}">Previous</a>
                                        </li>
                                    @endif

                                    <!-- Pagination Elements -->
                                    @foreach ($products->getUrlRange(1, $products->lastPage()) as $page => $url)
                                        @if ($page == $products->currentPage())
                                            <li class="page-item active"><a class="page-link"
                                                    href="#">{{ sprintf('%02d', $page) }}</a></li>
                                        @else
                                            <li class="page-item"><a class="page-link"
                                                    href="{{ $url }}">{{ sprintf('%02d', $page) }}</a></li>
                                        @endif
                                    @endforeach

                                    <!-- Dots (if there are many pages) -->
                                    @if ($products->lastPage() > 5)
                                        <li class="page-item"><a class="page-link dot" href="#">...</a></li>
                                        <li class="page-item"><a class="page-link"
                                                href="{{ $products->url($products->lastPage()) }}">{{ $products->lastPage() }}</a>
                                        </li>
                                    @endif

                                    <!-- Next Page Link -->
                                    @if ($products->hasMorePages())
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $products->nextPageUrl() }}"><i
                                                    class="fi-rs-angle-double-small-right"></i></a>
                                        </li>
                                    @else
                                        <li class="page-item disabled">
                                            <a class="page-link" href="#"><i
                                                    class="fi-rs-angle-double-small-right"></i></a>
                                        </li>
                                    @endif
                                </ul>
                            </nav>
                        </div>


                    </div>

                    <div class="col-lg-3 primary-sidebar sticky-sidebar">




                        <div class="widget-category mb-30">
                            <h5 class="section-title style-1 mb-30">Category</h5>
                            <ul class="list-unstyled" id="categoryList">
                                @foreach ($categories as $index => $category)
                                    <li class="mb-2 category-item"
                                        @if ($index >= 6) style="display:none;" @endif>
                                        <div class="form-check form-switch">
                                            <a href="javascript:void(0);" onclick="applyFilter({{ $category->id }})"
                                                class="category-link">
                                                {{ $category->name }}
                                            </a>
                                        </div>
                                    </li>
                                @endforeach

                                <!-- See More / See Less link (aligned like a category item) -->
                                @if (count($categories) > 6)
                                    <li class="mb-2">
                                        <div class="form-check more_categories form-switch">
                                            <a id="toggleButton" href="javascript:void(0);" onclick="toggleCategoriess()"
                                                class="category-link text-primary">See More</a>
                                        </div>
                                    </li>
                                @endif
                            </ul>
                        </div>



                        <!-- Filter by Price -->
                        <div class="sidebar-widget price_range range mb-30">
                            <div class="widget-header position-relative mb-20 pb-10">
                                <h5 class="widget-title mb-10">Filter by Price</h5>
                                <div class="bt-1 border-color-1"></div>
                            </div>
                            <div class="price-filter">
                                <div class="price-filter-inner">
                                    <div id="slider-range"></div>
                                    <div class="price_slider_amount">
                                        <div class="label-input">
                                            <span>Range:</span>
                                            <input type="text" id="amount" readonly>
                                            <input type="hidden" name="price_min" id="price_min">
                                            <input type="hidden" name="price_max" id="price_max">
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="list-group">
                                <div class="list-group-item mb-10 mt-10">
                                    <!-- Filter by Size -->
                                    <label class="fw-900">Size</label>
                                    <div class="btn-group d-flex flex-wrap" role="group" aria-label="Size options">
                                        @if ($sizes && $sizes->options->isNotEmpty())
                                            @foreach ($sizes->options as $size)
                                                <div class="size-wrapper">
                                                    <input type="checkbox" name="size[]" value="{{ $size->id }}"
                                                        id="size-{{ $size->id }}" class="size-checkbox">
                                                    <label for="size-{{ $size->id }}"
                                                        class="badge bg-secondary size-button me-2 mb-2">
                                                        {{ strtoupper($size->name) }}
                                                        <span class="checkmark" style="display: none;">✓</span>
                                                    </label>
                                                </div>
                                            @endforeach
                                        @else
                                            <p>No sizes available.</p>
                                        @endif
                                    </div>

                                    <!-- Filter by Color -->
                                    <label class="fw-900 mt-15 d-block">Color</label>
                                    <div class="d-flex flex-wrap">
                                        @if ($colors && $colors->options->isNotEmpty())
                                            @foreach ($colors->options as $color)
                                                <div class="color-wrapper">
                                                    <input type="checkbox" name="color[]" value="{{ $color->id }}"
                                                        id="color-{{ $color->id }}" class="color-checkbox">
                                                    <label for="color-{{ $color->id }}" class="color-circle"
                                                        style="background-color: {{ $color->name }};"
                                                        title="{{ ucfirst($color->name) }}">
                                                    </label>
                                                </div>
                                            @endforeach
                                        @else
                                            <p>No colors available.</p>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <!-- Submit Filter -->
                            <a href="javascript:void(0)" class="btn btn-sm btn-default" onclick="applyFilter()">
                                <i class="fi-rs-filter mr-5"></i> Filter
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </section>



    </main>
@endsection

@push('scripts')
    <script>
        $(function() {
            $("#slider-range").slider({
                range: true,
                min: 0,
                max: 1000, // Change this based on your price range
                values: [0, 500], // Default values
                slide: function(event, ui) {
                    $("#amount").val("$" + ui.values[0] + " - $" + ui.values[
                        1]); // This line is correct
                    $("#price_min").val(ui.values[0]);
                    $("#price_max").val(ui.values[1]);
                }
            });

            // Initialize the displayed price range
            $("#amount").val("$" + $("#slider-range").slider("values", 0) +
                " - $" + $("#slider-range").slider("values", 1));
            $("#price_min").val($("#slider-range").slider("values", 0));
            $("#price_max").val($("#slider-range").slider("values", 1));
        });





        // function applyFilter(categoryId = null) {

        //     var priceMin = $('#price_min').val();
        //     var priceMax = $('#price_max').val();

        //     // Get selected colors
        //     var selectedColors = [];
        //     $('input[name="color[]"]:checked').each(function() {
        //         selectedColors.push($(this).val());
        //     });

        //     // Get selected sizes
        //     var selectedSizes = [];
        //     $('input[name="size[]"]:checked').each(function() {
        //         selectedSizes.push($(this).val());
        //     });

        //     // Construct the URL with query parameters
        //     var url = new URL(window.location.href);

        //     // Set the price range if selected
        //     if (priceMin && priceMax) {
        //         url.searchParams.set('price_min', priceMin);
        //         url.searchParams.set('price_max', priceMax);
        //     }

        //     // Add selected colors to the URL if any are checked
        //     url.searchParams.delete('color[]');
        //     if (selectedColors.length > 0) {
        //         selectedColors.forEach(function(color) {
        //             url.searchParams.append('color[]', color);
        //         });
        //     }

        //     // Add selected sizes to the URL if any are checked
        //    url.searchParams.delete('size[]');
        //     if (selectedSizes.length > 0) {
        //         selectedSizes.forEach(function(size) {
        //             url.searchParams.append('size[]', size);
        //         });
        //     }

        //     // Add category to the URL if clicked
        //     if (categoryId) {
        //         url.searchParams.set('category', categoryId);
        //     }

        //     url.searchParams.delete('page');

        //     // Redirect with the updated URL
        //     window.location.href = url.toString();
        // }


        function toggleCategoriess() {
            var categoryItems = document.querySelectorAll('.category-item');
            var toggleButton = document.getElementById('toggleButton');


            if (toggleButton.textContent === 'See More') {
                categoryItems.forEach(function(item, index) {
                    if (index >= 6) {
                        item.style.display = 'block';
                    }
                });

                toggleButton.textContent = 'See Less';
            } else {
                categoryItems.forEach(function(item, index) {
                    if (index >= 6) {
                        item.style.display = 'none';
                    }
                });

                toggleButton.textContent = 'See More';
            }
        }


        function applyFilter(categoryId = null) {
            var priceMin = $('#price_min').val();
            var priceMax = $('#price_max').val();

            // Get selected colors
            var selectedColors = [];
            $('input[name="color[]"]:checked').each(function() {
                selectedColors.push($(this).val());
            });

            // Get selected sizes
            var selectedSizes = [];
            $('input[name="size[]"]:checked').each(function() {
                selectedSizes.push($(this).val());
            });

            // Construct the URL with query parameters
            var url = new URL(window.location.href);

            // Set the price range if selected
            if (priceMin && priceMax) {
                url.searchParams.set('price_min', priceMin);
            }

            // Add selected colors to the URL if any are checked
            url.searchParams.delete('color[]');
            if (selectedColors.length > 0) {
                selectedColors.forEach(function(color) {
                    url.searchParams.append('color[]', color);
                });
            }

            // Add selected sizes to the URL if any are checked
            url.searchParams.delete('size[]');
            if (selectedSizes.length > 0) {
                selectedSizes.forEach(function(size) {
                    url.searchParams.append('size[]', size);
                });
            }

            // Add category to the URL if clicked
            if (categoryId) {
                url.searchParams.set('category', categoryId);
            }

            url.searchParams.delete('page'); // Reset pagination on filter change

            // Show loading spinner
            $('#loadingSpinner').show();

            // Fetch data without page reload
            $.ajax({
                url: url.toString(),
                method: 'GET',
                dataType: 'html',
                success: function(response) {
                    // Update the product listing with the filtered data
                    $('#product-listing').html($(response).find('#product-listing').html());

                    // Hide loading spinner
                    $('#loadingSpinner').hide();
                },
                error: function() {
                    alert('An error occurred while applying the filter.');
                    $('#loadingSpinner').hide();
                }
            });
        }


        function applySort(sortValue) {
            var priceMin = $('#price_min').val();
            var priceMax = $('#price_max').val();

            // Get selected colors
            var selectedColors = [];
            $('input[name="color[]"]:checked').each(function() {
                selectedColors.push($(this).val());
            });

            // Get selected sizes
            var selectedSizes = [];
            $('input[name="size[]"]:checked').each(function() {
                selectedSizes.push($(this).val());
            });

            // Construct the URL with query parameters
            var url = new URL(window.location.href);

            // Set the sort value in the URL
            url.searchParams.set('sort', sortValue);

            // Set the price range if selected
            if (priceMin && priceMax) {
                url.searchParams.set('price_min', priceMin);
                url.searchParams.set('price_max', priceMax);
            }

            // Add selected colors to the URL if any are checked
            url.searchParams.delete('color[]');
            if (selectedColors.length > 0) {
                selectedColors.forEach(function(color) {
                    url.searchParams.append('color[]', color);
                });
            }

            // Add selected sizes to the URL if any are checked
            url.searchParams.delete('size[]');
            if (selectedSizes.length > 0) {
                selectedSizes.forEach(function(size) {
                    url.searchParams.append('size[]', size);
                });
            }

            // Show loading spinner
            $('#loadingSpinner').show();

            // Fetch data without page reload
            $.ajax({
                url: url.toString(),
                method: 'GET',
                dataType: 'html',
                success: function(response) {
                    // Update the product listing with the sorted data
                    $('#product-listing').html($(response).find('#product-listing').html());

                    // Update the total product count
                    $('.totall-product strong').text($(response).find('.totall-product strong').text());

                    // Hide loading spinner
                    $('#loadingSpinner').hide();
                },
                error: function() {
                    alert('An error occurred while applying the sorting.');
                    $('#loadingSpinner').hide();
                }
            });
        }
    </script>
@endpush
