@extends('layouts.app')
@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/fontend/css/product-details.css') }}">
@endpush
@section('content')
    <section class="product-details-main-section">
        <div class="container">




            <div class="row">
                <!-- Product Images Section -->
                <div class="col-lg-6 col-md-5 col-sm-12 position-relative">
                    <div class="product-image-section">
                        @foreach ($galleryImages as $key => $image)
                            <div class="mySlides">
                                <img class="img-responsive" src="{{ asset($image) }}">
                            </div>
                        @endforeach

                        <!-- Controls for next/previous -->
                        <a class="prev" onclick="plusSlides(-1)">❮</a>
                        <a class="next" onclick="plusSlides(1)">❯</a>
                    </div>

                    <!-- Thumbnails for the gallery -->
                    <div class="xzoom-thumbs slide-thumb-image">
                        @foreach ($galleryImages as $key => $image)
                            <div class="slider-thumb-image">
                                <img class="demo" src="{{ asset($image) }}" onclick="currentSlide({{ $key + 1 }})"
                                    alt="{{ $product->name }}">
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Product Details Section -->
                <div class="col-lg-6 col-md-7 col-sm-12">
                    <div class="product-details">
                        <!-- Product Title, Price, and Code -->
                        <div class="product-title-price mb-3">
                            <div class="row">
                                <div class="col-md-9 col-sm-9">
                                    <h5>{{ $product->name }}</h5>
                                    <ul class="d-flex">
                                        @for ($i = 0; $i < 5; $i++)
                                            <li><i class="fa-solid fa-star"></i></li>
                                        @endfor
                                    </ul>
                                </div>
                                <div class="col-md-3 col-sm-3">
                                    <div class="product-price">
                                        <p>৳{{ $product->price - optional($product->active_campaigns->first())->discount ?? 0 }}
                                        </p>
                                        <p>{{ $product->product_code }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <hr>
                        </div>

                        <!-- Attributes (Color, Size, etc.) -->
                        @foreach ($groupedAttributes as $attributeName => $options)
                            <div class="attribute-container">
                                @if (strtolower($attributeName) === 'color')
                                    <!-- Color options -->
                                    <div class="attribute-title">
                                        {{ ucfirst($attributeName) }}: <span id="selectedColor">Select Color</span>
                                    </div>
                                    <div class="colors">
                                        @foreach ($options as $option)
                                            <div class="color-ball {{ strtolower($option->option->name) }}"
                                                data-color="{{ $option->option->name }}"
                                                data-id="{{ $option->option->id }}">
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <!-- Size options -->
                                    <div class="details-page-size">
                                        <div class="attribute-title">{{ ucfirst($attributeName) }}</div>
                                        {{-- <select class="scrollable-dropdown" id="sizeSelect"> --}}
                                        <select class="scrollable-dropdown sizeSelects " id="sizeSelect">
                                            <!-- Ensure this matches your JS -->
                                            {{-- <option selected disabled>Choose {{ ucfirst($attributeName) }}</option> --}}
                                            @foreach ($options as $option)
                                                <option value="{{ $option->option->name }}"
                                                    data-id="{{ $option->option->id }}">
                                                    {{ $option->option->name }}
                                                </option>
                                            @endforeach
                                        </select>

                                    </div>
                                @endif
                            </div>
                        @endforeach

                        <!-- Notification Area -->
                        <div id="snackbar" class="snackbar">Your product has been successfully added!</div>
                        <div id="notification-area"></div>

                        <!-- Add to Bag Button -->
                        <div class="get-link add-to-bag">
                            <a href="javascript:void(0)" id="addToBag" onclick="addToBag({{ $product->id }})">Add to
                                Bag</a>
                        </div>

                        <div id="add-favourite" class="get-link add-favourite">
                            <a href="javascript:void(0)" onclick="toggleFavorite(this, {{ $product->id }})">
                                <span class="heart-svgs">
                                    {{-- <svg class="favorite heart default" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 1 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                                    </svg> --}}
                                    <span class="spinner-border spinner-border-sm" style="display: none;"></span>
                                </span>
                                Favourite
                            </a>
                        </div>

                        <!-- Product Description -->
                        <div class="product-details">
                            <div class="product-content" id="product-content">
                                <p>{!! $product->short_description !!}</p>
                                <div class="extra-content">
                                    <p>{!! $product->specifications !!}</p>
                                    <p>{!! $product->description !!}</p>
                                </div>
                            </div>
                            <span class="read-more-btn" id="readMoreBtn">Read More</span>
                        </div>
                    </div>
                </div>
            </div>






            <div class="product-details-slider-main">
                <div class="row">
                    <div class="offset-md-1 col-md-11">
                        <div class="product-details-slider-inner">
                            <div class="swiper productDetailsSwiper">
                                <div class="swiper-wrapper">
                                    @foreach ($related_products as $related_product)
                                        <div class="swiper-slide">
                                            <div class="product-details-slide">
                                                <a
                                                    href="{{ route('product-details', ['slug' => $related_product->slug]) }}">
                                                    <div class="product-details-slide-image">

                                                        <img src="{{ asset($related_product->featured_image) }}"
                                                            alt="">
                                                    </div>
                                                    <div class="product-details-slide-title">
                                                        <span>
                                                            {{ $related_product->name }}
                                                        </span>
                                                    </div>
                                                    <div class="product-view-price">
                                                        <span>
                                                            ৳{{ $related_product->price }}-৳{{ $related_product->discount_price }}
                                                        </span>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    @endforeach


                                </div>
                                <div class="swiper-button-next"></div>
                                <div class="swiper-button-prev"></div>
                            </div>
                        </div>
                        <!-- category-slider end -->

                    </div>
                </div>
            </div>



        </div>
    </section>
@endsection

@push('scripts')
    <script>
        // Handle color selection and update the displayed color name
        document.querySelectorAll('.color-ball').forEach(function(colorBall) {
            colorBall.addEventListener('click', function() {
                let color = this.getAttribute('data-color');


                document.getElementById('selectedColor').innerText = color;


                document.querySelectorAll('.color-ball').forEach(function(ball) {
                    ball.classList.remove('active');
                });


                this.classList.add('active');
            });
        });





        function showSnackbar() {
            const snackbar = document.getElementById("snackbar");
            snackbar.className = "snackbar show";
            setTimeout(() => {
                snackbar.className = snackbar.className.replace("show", "");
            }, 3000);
        }

        function showInlineNotification(message, color = 'red') {
            // Create notification element
            const notificationArea = document.getElementById("notification-area");
            notificationArea.textContent = message;
            notificationArea.style.color = color;
            notificationArea.classList.add('show');


            setTimeout(() => {
                notification.style.opacity = '0';
                setTimeout(() => {
                    notification.remove();
                }, 500);
            }, 3000);
        }


        function addToBag(productId) {
            // Get selected color
            const selectedColorElement = document.querySelector('.color-ball.active');
            const selectedColor = selectedColorElement ? {
                id: selectedColorElement.getAttribute('data-id')
            } : null;

            // Get selected size
            const sizeSelect = document.querySelector('#sizeSelect');
            const selectedSizeOption = sizeSelect && sizeSelect.options[sizeSelect.selectedIndex];
            const selectedSize = selectedSizeOption && selectedSizeOption.value !== 'Choose Size' ? {
                id: selectedSizeOption.getAttribute('data-id'),
            } : null;

            // Default values
            const quantity = 1;

            const campaignId =
                {{ optional($product->active_campaigns->first())->id ? json_encode(optional($product->active_campaigns->first())->id) : 'null' }};

            const isLoggedIn = {{ auth()->check() ? 'true' : 'false' }};

            // Check if user is logged in
            if (!isLoggedIn) {
                window.location.href = "{{ route('login') }}";
                return;
            }

            // Determine if attributes are available
            const hasColorAttribute = document.querySelector('.color-ball') !== null;
            const hasSizeAttribute = document.querySelector('.sizeSelects') !== null;
            console.log('Available attributes: Size -', hasSizeAttribute);
            console.log('Available attributes: Color -', hasColorAttribute);

            // Determine if attributes are available only if they exist
            if ((hasColorAttribute && (selectedColor === null || selectedColor === '')) &&
                (hasSizeAttribute && (selectedSize === null || selectedSize === ''))) {
                showInlineNotification('Please select at least one attribute: color or size.', 'red');
                return;
            }




            // Prepare the data object
            const data = {
                product_id: productId,
                quantity: quantity,
                campaign_id: campaignId,
                attributes: {
                    color: selectedColor,
                    size: selectedSize,
                },
            };

            console.log('Adding product to cart:', data);

            // Small loader adjustment
            const addToBagButton = document.getElementById('addToBag');

            // Change button state to loading
            addToBagButton.innerText = 'Adding...';
            addToBagButton.style.backgroundColor = '#ccc';
            addToBagButton.style.color = '#000';
            addToBagButton.style.cursor = 'not-allowed';
            addToBagButton.style.pointerEvents = 'none';

            // Axios POST request to add item to the bag
            axios.post('/cart/add', data)
                .then(response => {
                    // Handle success response
                    console.log('Product added to cart:', response.data);

                    if (document.getElementById('cartModal')) {
                        updateCartUI(response.data.cart);
                    }

                    showSnackbar();
                    showInlineNotification('Your product has been added to the bag.');

                    addToBagButton.innerText = 'Added to Bag';
                    addToBagButton.style.backgroundColor = '#000';
                    addToBagButton.style.color = '#fff';
                    addToBagButton.disabled = true;
                })
                .catch(error => {
                    // Handle error response
                    console.error('Error adding product to cart:', error);
                    alert('There was an error adding the product. Please try again.');

                    // Reset button state in case of error
                    addToBagButton.innerText = 'Add to Bag';
                    addToBagButton.style.backgroundColor = '#fff';
                    addToBagButton.style.color = '#000';
                    addToBagButton.style.cursor = 'pointer';
                    addToBagButton.style.pointerEvents = 'all';
                });
        }
    </script>
@endpush
