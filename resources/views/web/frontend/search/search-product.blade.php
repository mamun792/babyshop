@extends('web.frontend.master')

@section('main-content')
    <main class="main">
        <section class="mt-50 mb-50">
            <div class="container">
                <div class="row flex-row-reverse">
                    <div class="col-lg-9">
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
                                                        <img class="default-img" src="{{ asset($product->featured_image) }}"
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
                                                    <span><span>{{ $product->averageRating }}%</span></span>
                                                </div>
                                                <div class="product-price">
                                                    <span>{{ number_format($product->price, 2) }}</span>
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
                        <div class="d-flex justify-content-center">
                            {{ $products->links('vendor.pagination.bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>
@endsection
