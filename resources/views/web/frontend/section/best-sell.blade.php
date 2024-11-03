<section class="section-padding" style="margin-top: -50px !important">
    <div class="container pb-20">
        <h3 class="section-title mb-20"><span>New</span> Arrivals</h3>

        <div class="carausel-4-columns-cover arrow-center position-relative">
            <div class="slider-arrow slider-arrow-2 carausel-4-columns-arrow" id="carausel-4-columns-2-arrows"></div>
            <div class="row carausel-4-columns carausel-arrow-center" id="carausel-4-columns-2">


                @foreach ($newArrivalProducts as $product)
                    <div class="col-lg-3 col-md-6 col-12">
                        <div class="product-cart-wrap">
                            <div class="product-img-action-wrap">
                                <div class="product-img product-img-zoom">
                                    <a href="{{ route('product-details', ['slug' => $product->slug]) }}">
                                        <img class="default-img" src="{{ asset($product->featured_image) }}"
                                            alt="{{ $product->name }}">
                                        <img class="hover-img" src="{{ asset($product->gallery_image_one) }}"
                                            alt="{{ $product->name }}">
                                    </a>
                                </div>
                                <div class="product-action-1">
                                    <a aria-label="Quick view" class="action-btn small hover-up" data-bs-toggle="modal"
                                        data-bs-target="#quickViewModal{{ $product->id }}">
                                        <i class="fi-rs-eye"></i></a>
                                    {{-- <a aria-label="Add To Wishlist" class="action-btn small hover-up" href="#">
                                        <i class="fi-rs-heart"></i></a> --}}
                                    <a aria-label="Add To Wishlist"
                                        class="action-btn small hover-up @if (in_array($product->id, $wishlistProducts)) added @endif"
                                        href="javascript:void(0);" onclick="addToWishlist({{ $product->id }}, this)">
                                        <i class="fi-rs-heart @if (in_array($product->id, $wishlistProducts)) filled @endif"></i>
                                    </a>

                                    <a aria-label="Compare" class="action-btn small hover-up" href="#">
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
                                    {{-- <span><span>{{ $product->rating }}%</span></span> --}}
                                    <span><span>{{ round(( ( ($product->price - ($product->price - $product->discount_price - $product->campaign_price) ) * 100 ) / ($product->price)   )) }}%</span></span>

                                 </div> 

                              
                                
                                <div class="product-price">
                                    <span>{{ number_format($product->price - $product->discount_price - $product->campaign_price, 2) }}</span>
                                    @if ($product->old_price)
                                        <span class="old-price">${{ number_format($product->old_price, 2) }}</span>
                                    @endif
                                </div>
                                <div class="">
                                    {{-- <button class="btn btn-primary btn-sm mt-3" style="width: 100% !important">
                                        ORDER NOW
                                    </button> --}}

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




                <!-- Repeat the product-cart-wrap for more products -->

            </div>
        </div>



    </div>
</section>
