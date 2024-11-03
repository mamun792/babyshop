<style>
    .search-module{
        position: relative;
    }

    .search-module .list-group{
        position: absolute;
        z-index: 9999 !important;
       
    }

    .search-module .list-group .list-group-item{
        display: flex;
        align-items: center;
        justify-content: flex-start;
        gap: 15px;
    }


</style>

<header class="header-area header-style-3 header-height-2">


    <div class="header-middle header-middle-ptb-1 d-none d-lg-block">
        <div class="container">
            <div class="header-wrap">
                <div class="logo logo-width-1">
                    <a href="/"><img src="{{ asset('ecommerce/assets/imgs/theme/logo.svg') }}" alt="logo"></a>
                </div>
                <div class="header-right">
                    {{-- <div class="search-style-4">

                        <form role="search">
                            <div class="input-group">
                                <input type="text" class="form-control search-input" placeholder="Search here">
                                <button class="input-group-text search-button" type="submit">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="white"
                                        class="bi bi-search" viewBox="0 0 16 16">
                                        <path
                                            d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                                    </svg>
                                </button>
                            </div>
                        </form>

                    </div> --}}

                    <div class="search-style-4 w-100">

                        <div class="search-module">

                            <form role="search" id="search-form" action="{{ route('search.product') }}" method="GET">
                                <div class="input-group">
                                    <input type="text" class="form-control search-input" name="name"
                                        id="search" placeholder="Search here">
                                    <button class="input-group-text search-button" type="submit">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                            fill="white" class="bi bi-search" viewBox="0 0 16 16">
                                            <path
                                                d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                                        </svg>
                                    </button>
                                </div>
                            </form>

                            <div id="product-list" class="list-group"></div>
                            <!-- Ensure you have a container to show results -->

                        </div>


                    </div>



                    {{-- cv --}}

                    <div class="header-action-right">
                        <div class="header-action-2">

                            <div class="ms-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                    fill="currentColor" class="bi bi-person-plus" viewBox="0 0 16 16">
                                    <path
                                        d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z" />
                                    <path fill-rule="evenodd"
                                        d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5" />
                                </svg>
                                <a class="ms-1 fw-bold" href="{{ route('register') }}">Register</a>
                            </div>

                            <div class="ms-3">
                                <a href="{{ route('login') }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                        fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                                        <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
                                        <path fill-rule="evenodd"
                                            d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1" />
                                    </svg>
                                    <span class="ms-1 fw-bold">My Account</span>
                                </a>

                            </div>

                            <div class="header-action-icon-2 ms-3">
                                <a class="mini-cart-icon" href="shop-cart.html">
                                    <img alt="Evara"
                                        src="{{ asset('ecommerce/assets/imgs/theme/icons/icon-cart.svg') }}">
                                    <span class="pro-count blue">0</span>
                                </a>
                                <span class="ms-3 fw-bold mt-1">Cart</span>

                                <div class="cart-dropdown-wrap cart-dropdown-hm2">
                                    <ul id="cart-items-list">





                                    </ul>

                                    <div class="shopping-cart-footer">
                                        <div class="shopping-cart-total">
                                            <h4>Total <span>$0.00</span></h4>
                                        </div>
                                        <div class="shopping-cart-button">
                                            <a href="/cart" class="outline">View cart</a>
                                            <a href="{{ route('productCheckout') }}">Checkout</a>
                                        </div>
                                    </div>

                                </div>


                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="header-bottom header-bottom-bg-color sticky-bar">
        <div class="container">
            <div class="header-wrap header-space-between position-relative  main-nav"
                style="background: #d8f4e2!important; border-radius: 10px">
                <div class="logo logo-width-1 d-block d-lg-none">
                    <a href="index.html"><img src="{{ asset('ecommerce/assets/imgs/theme/logo.svg') }}"
                            alt="logo"></a>
                </div>
                <div class="header-nav d-none d-lg-flex ms-2">
                    <div class="main-categori-wrap d-none d-lg-block">
                        <a class="categori-button-active" href="#">
                            <span class="fi-rs-apps"></span> Browse Categories
                        </a>




                        <div class="categori-dropdown-wrap categori-dropdown-active-large">
                            <ul id="categoryList">


                                @foreach ($categories as $index => $category)
                                    <li class="has-children"
                                        @if ($index >= 6) style="display: none;" class="more-categories" @endif>
                                        {{-- <a href="#">
                                            <i class="evara-font-dress"></i>{{ $category->name }}
                                        </a> --}}
                                        <a href="{{ route('allproduct', ['category' => $category->id]) }}">
                                            <i class="evara-font-dress"></i>{{ $category->name }}
                                        </a>
                                        @if ($category->subcategories->isNotEmpty())
                                            <div class="dropdown-menu">
                                                <ul class="mega-menu d-lg-flex">
                                                    <li class="mega-menu-col col-lg-7">
                                                        <ul class="d-lg-flex">
                                                            @foreach ($category->subcategories->chunk(ceil($category->subcategories->count() / 2)) as $subCategoryChunk)
                                                                <li class="mega-menu-col col-lg-6">
                                                                    <ul>
                                                                        @foreach ($subCategoryChunk as $subCategory)
                                                                            {{-- <li><span
                                                                                    class="submenu-title">{{ $subCategory->name }}</span>
                                                                            </li> --}}
                                                                            <li>
                                                                                <a class="dropdown-item nav-link nav_item"
                                                                                    href="{{ route('allproduct', ['sub-category' => $subCategory->id]) }}">
                                                                                    {{ $subCategory->name }}
                                                                                </a>
                                                                            </li>
                                                                        @endforeach
                                                                    </ul>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    </li>
                                                    {{-- <li class="mega-menu-col col-lg-5">
                                                        <div class="header-banner2">
                                                            <img src="{{ $category->image_path }}" alt="menu_banner1">
                                                            <div class="banne_info">
                                                                <h6>10% Off</h6>
                                                                <h4>New Arrival</h4>
                                                                <a href="#">Shop now</a>
                                                            </div>
                                                        </div>
                                                    </li> --}}
                                                </ul>
                                            </div>
                                        @else
                                            <div class="dropdown-menu">
                                                <ul class="mega-menu">
                                                    <li class="text-center p-3">
                                                        <span class="text-muted">No subcategories available</span>
                                                    </li>
                                                </ul>
                                            </div>
                                        @endif
                                    </li>
                                @endforeach


                            </ul>

                            {{--

                             @if (count($categories) > 6)
                                <div class="more_categories mt-2">
                                    <a id="toggleButton" href="javascript:void(0);" onclick="toggleCategories()"
                                        class="text-primary">Show More</a>
                                </div>
                            @endif



                            --}}


                        </div>









                    </div>


                    <div class="main-menu main-menu-padding-1 main-menu-lh-2 d-none d-lg-block">
                        <nav>
                            <ul>
                                <li>
                                    <a class="active" href="/">Home </i></a>

                                </li>
                                <li>
                                    <a href="/home-about">About</a>
                                </li>






                                <li>
                                    <a href="/cart">Cart</a>
                                </li>

                                <li>
                                    <a href="/all-product">All Product</a>
                                </li>

                            </ul>
                        </nav>
                    </div>



                </div>

                <div class="hotline d-none d-lg-block me-3">
                    <button class="btn btn-success btn-sm d-flex align-items-center justify-content-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-gift" viewBox="0 0 16 16">
                            <path
                                d="M3 2.5a2.5 2.5 0 0 1 5 0 2.5 2.5 0 0 1 5 0v.006c0 .07 0 .27-.038.494H15a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1v7.5a1.5 1.5 0 0 1-1.5 1.5h-11A1.5 1.5 0 0 1 1 14.5V7a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1h2.038A3 3 0 0 1 3 2.506zm1.068.5H7v-.5a1.5 1.5 0 1 0-3 0c0 .085.002.274.045.43zM9 3h2.932l.023-.07c.043-.156.045-.345.045-.43a1.5 1.5 0 0 0-3 0zM1 4v2h6V4zm8 0v2h6V4zm5 3H9v8h4.5a.5.5 0 0 0 .5-.5zm-7 8V7H2v7.5a.5.5 0 0 0 .5.5z" />
                        </svg>
                        <span class="ms-2">Hot Deals</span>
                    </button>
                </div>

                <p class="mobile-promotion">Happy <span class="text-brand">Mother's Day</span>. Big Sale Up to
                    40%</p>




                <div class="header-action-right d-block d-lg-none">
                    <div class="header-action-2">


                        <div class="header-action-icon-2">
                            <a href="{{ asset('ecommerce/shop-wishlist.html') }}">
                                <img alt="Evara"
                                    src="{{ asset('ecommerce/assets/imgs/theme/icons/icon-heart.svg') }}">
                                <span class="pro-count white">4</span>
                            </a>
                        </div>
                        <div class="header-action-icon-2">
                            <a class="mini-cart-icon" href="{{ asset('ecommerce/shop-cart.html') }}">
                                <img alt="Evara"
                                    src="{{ asset('ecommerce/assets/imgs/theme/icons/icon-cart.svg') }}">
                                <span class="pro-count white">2</span>
                            </a>



                            <div class="cart-dropdown-wrap cart-dropdown-hm2">
                                <ul>



                                    <li>
                                        <div class="shopping-cart-img">
                                            <a href="{{ asset('ecommerce/shop-product-right.html') }}">
                                                <img alt="Evara"
                                                    src="{{ asset('ecommerce/assets/imgs/shop/thumbnail-3.jpg') }}">
                                            </a>
                                        </div>
                                        <div class="shopping-cart-title">
                                            <h4><a href="{{ asset('ecommerce/shop-product-right.html') }}">Plain
                                                    Striola Shirts</a></h4>
                                            <h3><span>1 × </span>$800.00</h3>
                                        </div>
                                        <div class="shopping-cart-delete">
                                            <a href="#"><i class="fi-rs-cross-small"></i></a>
                                        </div>
                                    </li>





                                </ul>
                                <div class="shopping-cart-footer">
                                    <div class="shopping-cart-total">
                                        <h4>Total <span>$383.00</span></h4>
                                    </div>
                                    <div class="shopping-cart-button">
                                        <a href="{{ asset('ecommerce/shop-cart.html') }}">View cart</a>
                                        <a href="{{ asset('ecommerce/shop-checkout.html') }}">Checkout</a>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="header-action-icon-2 d-block d-lg-none">
                            <div class="burger-icon burger-icon-white">
                                <span class="burger-icon-top"></span>
                                <span class="burger-icon-mid"></span>
                                <span class="burger-icon-bottom"></span>
                            </div>
                        </div>
                    </div>
                </div>



            </div>
        </div>
    </div>



</header>


@push('scripts')
    <script>
        function toggleCategories() {
            const categoryItems = document.querySelectorAll('#categoryList .has-children');
            const toggleButton = document.getElementById('toggleButton');


            categoryItems.forEach((item, index) => {
                if (index >= 6) {
                    item.style.display = (item.style.display === 'none' || item.style.display === '') ? 'block' :
                        'none';
                }
            });


            if (toggleButton.textContent === 'Show More') {
                toggleButton.textContent = 'Show Less';
            } else {
                toggleButton.textContent = 'Show More';
            }
        }
    </script>
@endpush
