@php
    $productService = app(App\Services\ProductService::class);
    $all_product = $productService->getAllProduct(); // Assuming $slug is available in the Blade view

    //dd(json_encode($all_product, JSON_PRETTY_PRINT));

@endphp




@foreach ($all_product as $item)
    <div class="modal fade custom-modal" id="quickViewModal{{ $item->id }}" tabindex="-1"
        aria-labelledby="quickViewModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="modal-body">
                    <div class="row">

                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <div class="detail-gallery">
                                <span class="zoom-icon"><i class="fi-rs-search"></i></span>
                                <!-- MAIN SLIDES -->
                                <div class="product-image-slider">
                                    <figure class="border-radius-10">
                                        <img src="{{ asset($item->featured_image) }}" alt="product image">
                                    </figure>

                                    @if ($item->gallery_image_one)
                                        <figure class="border-radius-10">
                                            <img src="{{ asset($item->gallery_image_one) }}" alt="product image">
                                        </figure>
                                    @endif

                                    @if ($item->gallery_image_two)
                                        <figure class="border-radius-10">
                                            <img src="{{ asset($item->gallery_image_two) }}" alt="product image">
                                        </figure>
                                    @endif

                                    @if ($item->gallery_image_three)
                                        <figure class="border-radius-10">
                                            <img src="{{ asset($item->gallery_image_three) }}" alt="product image">
                                        </figure>
                                    @endif






                                </div>
                                <!-- THUMBNAILS -->
                                <div class="slider-nav-thumbnails pl-15 pr-15">
                                    <div>
                                        @if ($item->featured_image)
                                            <img src="{{ asset($item->featured_image) }}" alt="product image">
                                        @endif

                                    </div>
                                    <div>
                                        @if ($item->gallery_image_one)
                                            <img src="{{ asset($item->gallery_image_one) }}" alt="product image">
                                        @endif

                                    </div>
                                    <div>

                                        @if ($item->gallery_image_two)
                                            <img src="{{ asset($item->gallery_image_two) }}" alt="product image">
                                        @endif

                                    </div>
                                    <div>

                                        @if ($item->gallery_image_three)
                                            <img src="{{ asset($item->gallery_image_three) }}" alt="product image">
                                        @endif


                                    </div>

                                </div>
                            </div>
                            <!-- End Gallery -->

                        </div>


                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <div class="detail-info">
                                <h3 class="title-detail mt-30">{{ $item->name }}</h3>
                                <input type="hidden" class="product-id" value="{{ $item->id }}" />
                                <div class="product-detail-rating">
                                    <p>
                                        {{ $item->short }}

                                    </p>
                                </div>
                                <div class="clearfix product-price-cover" style="margin-top: -20px !important">
                                    <div class="product-price primary-color float-left">

                                     

                                        <ins><span class="text-brand">TK
                                                {{ $item->price - $item->discount_price - $item->campaign_price }}</span></ins>
                                        <ins><span class="old-price font-md ml-15">TK {{ $item->price }}</span></ins>


                                        <span class="save-price font-md color3 ml-15">
                                            @if ($item->price > 0)
                                                {{ number_format((($item->price - $item->discount_price) / $item->price) * 100, 2) }}%
                                                Off
                                            @else
                                                0% Off
                                            @endif
                                        </span>


                                    </div>
                                </div>





                                @php

                                    $groupedOptions = collect($item->formatted_options)->groupBy('attribute');
                                @endphp



                                @foreach ($groupedOptions as $attribute => $options)
                                    <div class="attr-detail attr-color mb-15">
                                        <strong class="mr-10">{{ ucfirst($attribute) }}</strong>
                                        <ul class="list-filter {{ strtolower($attribute) }}-filter color-filter">
                                            @foreach ($options as $option)
                                                <li class="mr-2">
                                                    <a href="#"
                                                        data-{{ strtolower($attribute) }}-id="{{ $option['option_id'] }}"
                                                        data-{{ strtolower($attribute) }}-name="{{ strtolower($option['option_name']) }}"
                                                        class="attr-option">
                                                        @if (strtolower($attribute) == 'color')
                                                            <span class="product-color"
                                                                style="background-color: {{ strtolower($option['option_name']) }};"></span>
                                                        @else
                                                            {{ ucfirst($option['option_name']) }}
                                                        @endif
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endforeach





                                <div class="detail-extralink">
                                    <div class="detail-qty">

                                        <div
                                            style="display: flex; align-items:center; justify-content: flex-start; margin-left: -20px">
                                            <span class="fw-bold" style="margin-right: 20px">Quantity : </span>
                                            <a href="#" class="qty-down border"
                                                style="padding: 7px; border-radius: 3px">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="25"
                                                    fill="black" class="bi bi-dash" viewBox="0 0 16 16">
                                                    <path
                                                        d="M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8" />
                                                </svg>
                                            </a>
                                            <span class="qty-val border"
                                                style="display:flex; align-items:center; justify-content:center; width: 30px; height: 41px; border-radius: 3px;">1</span>



                                            <a href="#" class="qty-up border"
                                                style="padding: 7px; border-radius: 3px">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="25"
                                                    fill="black" class="bi bi-plus" viewBox="0 0 16 16">
                                                    <path
                                                        d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4" />
                                                </svg>
                                            </a>
                                        </div>

                                    </div>

                                </div>



                                <div class="row mt-4">
                                    <div class="col-md-6 col-sm-6 col-6">
                                        <button class="btn btn-sm w-100 btn-success add-to-cart">Add
                                            to Cart</button>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-6">
                                        <button class="btn btn-sm w-100 btn-success order-now">Order Now</button>
                                    </div>
                                </div>


                                <button class="btn btn-sm"
                                    style="background: #61a564; border: none; width: 20vw; margin-top: 20px">

                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-whatsapp" viewBox="0 0 16 16">
                                        <path
                                            d="M13.601 2.326A7.85 7.85 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.9 7.9 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.9 7.9 0 0 0 13.6 2.326zM7.994 14.521a6.6 6.6 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.56 6.56 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592m3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.73.73 0 0 0-.529.247c-.182.198-.691.677-.691 1.654s.71 1.916.81 2.049c.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232" />
                                    </svg>
                                    <span>Order From Whatsapp</span>

                                </button>

                                <div style="margin-top: 10px">
                                    <span><strong>Availablity</strong> : 8 item in stock</span>
                                    <br>
                                    <div style="display: flex; gap: 15px; align-items: center">

                                        <div style="display: flex; gap: 3px">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="#ffbb51" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                <path
                                                    d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                            </svg>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="#ffbb51" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                <path
                                                    d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                            </svg>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="#ffbb51" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                <path
                                                    d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                            </svg>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="#ffbb51" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                <path
                                                    d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                            </svg>
                                        </div>
                                        <span>2 reviews</span>

                                    </div>

                                </div>









                            </div>
                            <!-- Detail Info -->
                        </div>




                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach
