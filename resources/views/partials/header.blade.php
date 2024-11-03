<header class="home-page-navbar sticky-top">
    <!-- Headder top nav section start -->
    <div class="top-nav-content container-fluid">
        <div class="container">
            <div class="row">
                <div class="offset-md-8 offset-lg-9 offset-sm-6 col-md-4 col-lg-3 col-sm-6">
                    <div class="top-menu-social">
                        <a href="#">Store Locator</a>
                        <a href="{{ route('affiliate.register.form') }}" class="btn btn-primary">Affiliate Register</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Headder top nav section end -->

    <!-- Headder logo and search section start -->

    <div class="logo-search-section">
        <div class="container">
            <div class="logo-icon-section-main">
               
                <div class="logo-search">
                    <div class="main-logo">

                        <a class="navbar-brand" href="/">
                            <img src="{{ asset('assets/fontend/images/logo.svg') }}" alt="">
                        </a>
                    </div>
                   
                    <form action="{{ route('all.products') }}" method="GET">
                        <div class="search-box position-relative">
                           
                            <input type="text" class="form-control input-search"
                                placeholder="Search product or brand" name="product-name" id="search-input"
                                aria-label="Search">

                            <button class="btn btn-primary btn-search position-absolute top-50 end-0 translate-middle-y"
                                id="search-button" aria-label="Search button">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </button>
                            <div id="search-suggestions" class="list-group position-absolute w-100"
                                style="z-index: 1000; display: none;"></div>
                        </div>
                    </form>
                </div>


                <div class="nav-icons-section">
                    <div class="user-icon">
                        <a href="{{ route('login') }}">
                            <img class="img-responsive"
                                src="{{ asset('assets/fontend/images/icons/next_my-account_desktop.svg') }}"
                                alt="">
                        </a>
                    </div>

                    <div class="favorite-icon">
                        <a href="{{ route('wishlist.favorit') }}">
                            <img class="img-responsive"
                                src="{{ asset('assets/fontend/images/icons/favourites-inactive-large.svg') }}"
                                alt="Favorites">

                            <span class="wishlist-count" id="wishlist-count">{{ $wishlistCount ?? '' }}</span>


                        </a>
                    </div>

                    {{-- <div data-bs-toggle="modal" data-bs-target="#exampleModal"
                        class="shopingbag-icon position-relative">
                        <span>3</span>
                        <a href="#">
                            <img class="img-responsive"
                                src="{{ asset('assets/fontend/images/icons/shopping-bag-large.svg') }}" alt="">
                        </a>
                    </div> --}}
                    <div data-bs-toggle="modal" data-bs-target="#cartModal"
                    class="shopingbag-icon position-relative">
                    <span id="cart-count">{{ $cartCount ?? 0 }}</span>
                    <a href="#">
                        <img class="img-responsive"
                            src="{{ asset('assets/fontend/images/icons/shopping-bag-large.svg') }}" alt="">
                    </a>
                </div>
                   


               
                    <div class="checkout-btn">
                        <a href="{{ route('productCheckout') }}">Checkout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Headder logo and search section end -->



    <header>
        <nav class="navbar navbar-expand-lg">
            <div class="container">
                <button onclick="myFunction(this)" class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent">
                    <div class="bar1"></div>
                    <div class="bar2"></div>
                    <div class="bar3"></div>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav m-auto">
                        @foreach ($getCategoriesWithSubcategories as $category)
                            @if ($category->subcategories->isNotEmpty())
                                <li class="nav-item dropdown-btn">
                                    <a class="nav-link"
                                        href="{{ route('all.products') }}?category={{ $category->id }}"
                                        id="navbarDropdown{{ $category->id }}" role="button" data-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">
                                        {{ $category->name }}
                                    </a>
                                    <div class="dropdown-wrapper">
                                        <div class="dropdown-menu" aria-labelledby="navbarDropdown{{ $category->id }}">
                                            <div class="row">
                                                <div class="col-lg-8 col-md-9">
                                                    <div class="row">
                                                        @foreach ($category->subcategories as $subcategory)
                                                            <div class="col-lg-3 col-md-4">
                                                                <div class="shop-filtering">
                                                                    <div class="shop-filter-title">
                                                                        <h5>{{ $subcategory->name }}</h5>
                                                                    </div>
                                                                    <div class="shop-filter-options">
                                                                        <ul>
                                                                            <li><a
                                                                                href="{{ route('all.products') }}?sub-category={{ $subcategory->id }}">{{ $subcategory->name }}</a>
                                                                        </li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-3">
                                                    <div class="menu-image-grid">
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                <img class="img-responsive"
                                                                    src="{{ asset($category->image_path) }}"
                                                                    alt="{{ $category->name }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="manu-category-link">
                                                        <a href="#">Shop {{ $category->name }} <i
                                                                class="fa-solid fa-angle-right"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>
        </nav>
    </header>


    <!-- Headder menu section end -->
</header>


{{-- @include('components.top-nav')
@include('components.logo')
@include('components.navbar') --}}
