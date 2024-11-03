@extends('layouts.app')
@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/fontend/css/shoppingbag.css') }}">
@endpush
@section('content')
    {{-- <section class="shoppingbag-main-section">
        <div class="container">
            <div class="shoppingbag-title mt-4 mb-3">
                <h5>Shopping Bag (2)</h5>
                <span>Your bag contains 2 items and comes to a total of £95.00</span>
            </div>
            <div class="shopping-bag-wrapper mt-3">
                <div class="row">
                    <div class="col-md-9">
                        <div class="shopping-bag-inner-main">
                            <div class="shopping-bag-inner bg-light">
                                <div class="row">
                                    <div class="col-lg-2 col-md-2 col-sm-4">
                                        <div class="shopping-bag-inner-image">

                                            <img class="img-responsive"
                                                src="{{ asset('assets/fontend/images/bag/Q79260.webp') }}" alt="">
                                        </div>
                                    </div>
                                    <div class="col-lg-8 col-md-8 col-sm-8">
                                        <h5>Baker by Ted Baker Shower Resistant Padded Coat</h5>
                                        <span class="color-green mt-2 mb-2 d-block">In Stock</span>
                                        <div class="bag-size-main d-flex">
                                            <div class="bag-size-inner d-flex">
                                                <span>Size</span>
                                                <select class="scrollable-dropdown" id="sizeSelect">
                                                    <option selected disabled>Choose Size</option>
                                                    <option value="3-6 Mths">3-6 Mths</option>
                                                    <option value="6-9 Mths">6-9 Mths</option>
                                                    <option value="9-12 Mths">9-12 Mths</option>
                                                    <option value="12-18 Mths">12-18 Mths</option>
                                                    <option value="1.5-2 Yrs">1.5-2 Yrs</option>
                                                    <option value="2-3 Yrs">2-3 Yrs</option>
                                                    <option value="3-4 Yrs">3-4 Yrs</option>
                                                    <option value="4-5 Yrs">4-5 Yrs</option>
                                                    <option value="5-6 Yrs">5-6 Yrs</option>
                                                    <option value="6-7 Yrs">6-7 Yrs</option>
                                                    <option value="9-12 Mths">9-12 Mths</option>
                                                    <option value="12-18 Mths">12-18 Mths</option>
                                                    <option value="1.5-2 Yrs">1.5-2 Yrs</option>
                                                    <option value="2-3 Yrs">2-3 Yrs</option>
                                                    <option value="3-4 Yrs">3-4 Yrs</option>
                                                    <option value="4-5 Yrs">4-5 Yrs</option>
                                                </select>
                                            </div>

                                            <div class="increse-decrese d-flex">
                                                <span>Quantity</span>
                                                <div class="increse-decrese-btn d-flex align-items-center">
                                                    <button
                                                        class="btn btn-outline-secondary btn-sm decrease-quantity">-</button>
                                                    <input type="text" class=" quantity-input" value="1" readonly>
                                                    <button
                                                        class="btn btn-outline-secondary btn-sm increase-quantity">+</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-sm-4">
                                        <div class="product-price text-end">
                                            <p>£28 - £32</p>
                                            <p>Q53-238</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row justify-content-end">
                                    <div class="col-md-4 text-end">
                                        <span class="save-item">Save for later</span>
                                        <span class="remove-item">Remove</span>
                                    </div>
                                </div>
                            </div>
                            <hr class="m-0">
                            <div class="shopping-bag-inner bg-light">
                                <div class="row">
                                    <div class="col-lg-2 col-md-2 col-sm-4">
                                        <div class="shopping-bag-inner-image">

                                            <img class="img-responsive"
                                                src="{{ asset('assets/fontend/images/bag/Q53223.webp') }}" alt="">
                                        </div>
                                    </div>
                                    <div class="col-lg-8 col-md-8 col-sm-8">
                                        <h5>Rust Brown Borg Lined Hooded Padded Coat (3mths-7yrs)</h5>
                                        <span class="color-green mt-2 mb-2 d-block">In Stock</span>
                                        <div class="bag-size-main d-flex">
                                            <div class="bag-size-inner d-flex">
                                                <span>Size</span>
                                                <select class="scrollable-dropdown" id="sizeSelect">
                                                    <option selected disabled>Choose Size</option>
                                                    <option value="3-6 Mths">3-6 Mths</option>
                                                    <option value="6-9 Mths">6-9 Mths</option>
                                                    <option value="9-12 Mths">9-12 Mths</option>
                                                    <option value="12-18 Mths">12-18 Mths</option>
                                                    <option value="1.5-2 Yrs">1.5-2 Yrs</option>
                                                    <option value="2-3 Yrs">2-3 Yrs</option>
                                                    <option value="3-4 Yrs">3-4 Yrs</option>
                                                    <option value="4-5 Yrs">4-5 Yrs</option>
                                                    <option value="5-6 Yrs">5-6 Yrs</option>
                                                    <option value="6-7 Yrs">6-7 Yrs</option>
                                                    <option value="9-12 Mths">9-12 Mths</option>
                                                    <option value="12-18 Mths">12-18 Mths</option>
                                                    <option value="1.5-2 Yrs">1.5-2 Yrs</option>
                                                    <option value="2-3 Yrs">2-3 Yrs</option>
                                                    <option value="3-4 Yrs">3-4 Yrs</option>
                                                    <option value="4-5 Yrs">4-5 Yrs</option>
                                                </select>
                                            </div>

                                            <div class="increse-decrese d-flex">
                                                <span>Quantity</span>
                                                <div class="increse-decrese-btn d-flex align-items-center">
                                                    <button
                                                        class="btn btn-outline-secondary btn-sm decrease-quantity">-</button>
                                                    <input type="text" class=" quantity-input" value="1" readonly>
                                                    <button
                                                        class="btn btn-outline-secondary btn-sm increase-quantity">+</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-sm-4">
                                        <div class="product-price text-end">
                                            <p>£28 - £32</p>
                                            <p>Q53-238</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row justify-content-end">
                                    <div class="col-md-4 text-end">
                                        <span class="save-item">Save for later</span>
                                        <span class="remove-item">Remove</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="inner-total-price">
                            <div class="row justify-content-end">
                                <div class="col-md-4">
                                    <div class="total-peice">
                                        <div class="price-title">
                                            <h6>Total:</h6>
                                        </div>
                                        <div class="price">
                                            <h6>£130.00</h6>
                                        </div>
                                    </div>
                                    <div class="delevery-text">
                                        <p>Excluding UK Standard Delivery (Normally £4.95)</p>
                                        <p>FREE Delivery to Store (Subject to Availability)</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="total-peice">
                            <div class="price-title">
                                <h6>Total:</h6>
                            </div>
                            <div class="price">
                                <h6>£130.00</h6>
                            </div>
                        </div>
                        <div class="delevery-text">
                            <p>Excluding UK Standard Delivery (Normally £4.95)</p>
                            <p>FREE Delivery to Store (Subject to Availability)</p>
                        </div>
                        <div class="checkout-btn">
                            <a style="width: 100%;" href="checkout.html">Checkout</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}


    <section class="shoppingbag-main-section">
        <div class="container">
            <div class="shoppingbag-title mt-4 mb-3">
                <h5>Shopping Bag ({{ $count }})</h5>
                <span>Your bag contains {{ $count }} items and comes to a total of
                    £{{ number_format($total, 2) }}</span>
            </div>
            <div class="shopping-bag-wrapper mt-3">
                <div class="row">
                    <div class="col-md-9">
                        <div class="shopping-bag-inner-main">
                            {{-- @if (count($cartSummary['items']) > 0)
                            @foreach ($cartSummary['items'] as $item)
                                <div class="shopping-bag-inner bg-light">
                                    <div class="row">
                                        <div class="col-lg-2 col-md-2 col-sm-4">
                                            <div class="shopping-bag-inner-image">
                                                <img class="img-responsive" src="{{ asset($item['featured_image']) }}"
                                                    alt="">
                                            </div>
                                        </div>
                                        <div class="col-lg-8 col-md-8 col-sm-8">
                                            <h5>{{ $item['name'] }}</h5>
                                            <span class="color-green mt-2 mb-2 d-block">In Stock</span>
                                            <div class="bag-size-main d-flex">
                                                <div class="bag-size-inner d-flex">
                                                    @if (!empty($item['options']))
                                                        <span>Options:</span>
                                                        <div class="d-flex flex-wrap ms-2">
                                                            @foreach ($item['options'] as $option)
                                                                <span
                                                                    class="badge bg-secondary me-1">{{ ucfirst($option['option_name']) }}</span>

                                                               
                                                            @endforeach
                                                        </div>
                                                    @else
                                                        <span>Options: <span class="badge bg-secondary">N/A</span></span>
                                                    @endif
                                                </div>
                                                <div class="increse-decrese d-flex">
                                                    <span>Quantity</span>

                                                

                                                    <div class="increse-decrese-btn d-flex align-items-center">
                                                        <button class="btn btn-outline-secondary btn-sm decrease-quantity"
                                                            data-item-id="{{ $item['id'] }}"
                                                            data-option-id="{{ $option['option_id'] }}">-</button>
                                                        <input type="text" class="quantity-input"
                                                            value="{{ $item['quantity'] }}"
                                                            data-item-id="{{ $item['id'] }}"
                                                            data-option-id="{{ $option['option_id'] }}" readonly>
                                                        <button class="btn btn-outline-secondary btn-sm increase-quantity"
                                                            data-item-id="{{ $item['id'] }}"
                                                            data-option-id="{{ $option['option_id'] }}">+</button>
                                                    </div>


                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 col-md-2 col-sm-4">
                                            <div class="product-price text-end">
                                                <p>£{{ number_format($item['price'], 2) }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row justify-content-end">
                                        <div class="col-md-4 text-end">
                                            <span class="save-item" data-item-id="{{ $item['id'] }}"
                                                style="cursor: pointer;">Save for later</span>
                                            <span class="remove-item" data-item-id="{{ $item['id'] }}"
                                                style="cursor: pointer; margin-left: 10px;">Remove</span>
                                        </div>

                                    </div>

                                </div>
                                <hr class="m-0">
                            @endforeach --}}
                            @if (count($cartSummary['items']) > 0)
                                @foreach ($cartSummary['items'] as $item)
                                    <div class="shopping-bag-inner bg-light">
                                        <div class="row">
                                            <div class="col-lg-2 col-md-2 col-sm-4">
                                                <div class="shopping-bag-inner-image">
                                                    <img class="img-responsive" src="{{ asset($item['featured_image']) }}"
                                                        alt="">
                                                </div>
                                            </div>
                                            <div class="col-lg-8 col-md-8 col-sm-8">
                                                <h5>{{ $item['name'] }}</h5>
                                                <span class="color-green mt-2 mb-2 d-block">In Stock</span>
                                                <div class="bag-size-main d-flex">
                                                    <div class="bag-size-inner d-flex">
                                                        @if (!empty($item['options']))
                                                            <span>Options:</span>
                                                            <div class="d-flex flex-wrap ms-2">
                                                                @foreach ($item['options'] as $option)
                                                                    <span
                                                                        class="badge bg-secondary me-1">{{ ucfirst($option['option_name']) }}
                                                                        - {{ $option['option_id'] }}
                                                                    </span>
                                                                @endforeach
                                                            </div>
                                                        @else
                                                            <span>Options: <span
                                                                    class="badge bg-secondary">N/A</span></span>
                                                        @endif
                                                    </div>
                                                    <div class="increse-decrese d-flex">
                                                        <span>Quantity</span>
                                                        <div class="increse-decrese-btn d-flex align-items-center">
                                                            <button
                                                                class="btn btn-outline-secondary btn-sm decrease-quantity"
                                                                data-item-id="{{ $item['id'] }}"
                                                                data-cart-id="{{ $item['cart_id'] }}"
                                                                data-option-id="{{ $item['options'][0]['option_id'] ?? 'default' }}">-</button>
                                                            <input type="text" class="quantity-input"
                                                                value="{{ $item['quantity'] }}"
                                                                data-item-id="{{ $item['id'] }}"
                                                                data-option-id="{{ $item['options'][0]['option_id'] ?? 'default' }}"
                                                                readonly>
                                                            <button
                                                                class="btn btn-outline-secondary btn-sm increase-quantity"
                                                                data-item-id="{{ $item['id'] }}"
                                                                data-cart-id="{{ $item['cart_id'] }}"
                                                                data-option-id="{{ $item['options'][0]['option_id'] ?? 'default' }}">+</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-2 col-md-2 col-sm-4">
                                                <div class="product-price text-end">
                                                    <p>£{{ number_format($item['price'], 2) }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row justify-content-end">
                                            <div class="col-md-4 text-end">
                                                {{-- <span class="save-item" data-item-id="{{ $item['id'] }}"
                                               
                                                    style="cursor: pointer;">Save for later</span> --}}

                                                <span class="save-item" data-item-id="{{ $item['id'] }}"
                                                    data-cart-id="{{ $item['cart_id'] ?? 'default' }}"
                                                    style="cursor: pointer;">Save for later</span>

                                                <span class="remove-item" data-item-id="{{ $item['id'] }}"
                                                    style="cursor: pointer; margin-left: 10px;">Remove</span>
                                            </div>
                                        </div>
                                    </div>
                                    <hr class="m-0">
                                @endforeach
                            @else
                                <div class="shopping-bag-inner bg-light">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <h5>No items in your shopping bag</h5>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="inner-total-price">
                            <div class="row justify-content-end">
                                <div class="col-md-4">
                                    <div class="total-price">
                                        <div class="price-title">
                                            <h6>Total:</h6>
                                        </div>
                                        <div class="price">
                                            <h6>£{{ number_format($total, 2) }}</h6>
                                        </div>
                                    </div>
                                    <div class="delivery-text">
                                        <p>Excluding UK Standard Delivery (Normally £4.95)</p>
                                        <p>FREE Delivery to Store (Subject to Availability)</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if (count($cartSummary['items']) > 0)
                        <div class="col-md-3">
                            <div class="total-price">
                                <div class="price-title">
                                    <h6>Total:</h6>
                                </div>
                                <div class="price">
                                    <h6>£{{ number_format($total, 2) }}</h6>
                                </div>
                            </div>
                            <div class="delivery-text">
                                <p>Excluding UK Standard Delivery (Normally £4.95)</p>
                                <p>FREE Delivery to Store (Subject to Availability)</p>
                            </div>
                            <div class="checkout-btn">
                                <a style="width: 100%;" href="{{ route('productCheckout') }}">Checkout</a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {


            // Increase Quantity
            document.querySelectorAll('.increase-quantity').forEach(button => {
                button.addEventListener('click', function() {
                    const itemId = this.getAttribute('data-item-id');
                    const optionId = this.getAttribute('data-option-id');
                    const cartId = this.getAttribute('data-cart-id'); // Retrieve cart ID
                    const quantityInput = document.querySelector(
                        `.quantity-input[data-item-id="${itemId}"][data-option-id="${optionId}"]`
                    );

                    if (quantityInput) {
                        let quantity = parseInt(quantityInput.value) || 0;
                        quantity++;
                        quantityInput.value = quantity;

                        //  console.log(`Increased quantity for item ID: ${itemId}, option ID: ${optionId}, cart ID: ${cartId}`);
                        // Optionally make an API call here to update the quantity in the backend
                    } else {
                        console.error(
                            `Quantity input not found for item ID: ${itemId}, option ID: ${optionId}, cart ID: ${cartId}`
                            );
                    }
                });
            });

            // Decrease Quantity
            document.querySelectorAll('.decrease-quantity').forEach(button => {
                button.addEventListener('click', function() {
                    const itemId = this.getAttribute('data-item-id');
                    const optionId = this.getAttribute('data-option-id');
                    const cartId = this.getAttribute('data-cart-id'); // Retrieve cart ID
                    const quantityInput = document.querySelector(
                        `.quantity-input[data-item-id="${itemId}"][data-option-id="${optionId}"]`
                    );

                    if (quantityInput) {
                        let quantity = parseInt(quantityInput.value) || 0;
                        if (quantity > 1) {
                            quantity--;
                            quantityInput.value = quantity;

                            // console.log(`Decreased quantity for item ID: ${itemId}, option ID: ${optionId}, cart ID: ${cartId}`);
                            // Optionally make an API call here to update the quantity in the backend
                        }
                    } else {
                        console.error(
                            `Quantity input not found for item ID: ${itemId}, option ID: ${optionId}, cart ID: ${cartId}`
                            );
                    }
                });
            });


        });



        //  // Save For Later

        document.querySelectorAll('.save-item').forEach(button => {
            button.addEventListener('click', function() {
                const itemId = this.getAttribute('data-item-id');
                const cartId = this.getAttribute('data-cart-id') || 'N/A'; // Default if cart ID is missing

                // Attempt to find `option_id` from the closest '.shopping-bag-inner' context
                const optionId = this.closest('.shopping-bag-inner').querySelector('.increase-quantity')
                    ?.getAttribute('data-option-id') || 'default';

                // Retrieve quantity input based on item and option ID
                const quantityInput = document.querySelector(
                    `.quantity-input[data-item-id="${itemId}"][data-option-id="${optionId}"]`
                );

                // Retrieve the quantity from the input or default to 0 if not found
                const quantity = quantityInput ? parseInt(quantityInput.value) || 0 : 0;

                console.log('Item ID:', itemId);
                console.log('Option ID:', optionId);
                console.log('Quantity:', quantity);
                console.log('Cart ID:', cartId);

                if (quantityInput) {
                    // Call your saveForLater function or handle the logic to save the item
                     saveForLater(itemId, quantity, optionId, cartId);
                } else {
                    console.error(
                    `Quantity input not found for Item ID: ${itemId}, Option ID: ${optionId}`);
                }
            });
        });




        function saveForLater(itemId, quantity, optionId, cartId) {
            console.log('Saving item for later:', itemId);
            console.log('Quantity:', quantity);
            console.log('Option ID:', optionId);
            console.log('Cart ID:', cartId);


            axios.post('/save-for-later', {
                    item_id: itemId,
                    quantity: quantity,
                    option_id: optionId,
                    cart_id: cartId
                })
                .then(response => {
                    // Show success notification 



                    Swal.fire({
                        position: "top-end",
                        icon: "success",
                        title: "Your work has been saved",
                        showConfirmButton: false,
                        timer: 1500
                    });

                    // Update the UI or handle the response here  reload just bag section
                        location.reload();


                    console.log('Item saved for later:', response.data);
                })
                .catch(error => {
                    let errorMessage = 'An error occurred while saving the item.';

                    // Customize error messages based on response status
                    if (error.response) {
                        switch (error.response.status) {
                            case 404:
                                errorMessage = 'Item not found in cart.';
                                break;
                            case 422:
                                errorMessage = 'Insufficient stock for this item.';
                                break;
                            case 500:
                                errorMessage = 'Server error. Please try again later.';
                                break;
                            default:
                                errorMessage = error.response.data.message || errorMessage;
                        }
                    } else if (error.request) {
                        errorMessage = 'No response from server. Please check your network.';
                    } else {
                        errorMessage = error.message;
                    }

                    // Show error notification 

                    Swal.fire({
                        position: "top-end",
                        icon: "error",
                        title: errorMessage,
                        showConfirmButton: false,
                        timer: 1500
                    });

                    console.error('Error saving item for later:', error);
                });
        }





        // remove item from cart

        document.querySelectorAll('.remove-item').forEach(button => {
            button.addEventListener('click', function() {
                const itemId = this.getAttribute('data-item-id');
                removeItem(itemId);
            });
        });


        function removeItem(itemId) {
            console.log('Removing item:', itemId);


            axios.delete(`/${itemId}/remove-from-cart`)
                .then(response => {
                    console.log('Item removed');

                    // Show success notification
                    Swal.fire({
                        position: "top-end",
                        icon: "success",
                        title: "Item removed from cart",
                        showConfirmButton: false,
                        timer: 1500
                    });
                    // Update the UI or handle the response here
                    location.reload();
                })
                .catch(error => {
                    // Show error notification
                    Swal.fire({
                        position: "top-end",
                        icon: "error",
                        title: "An error occurred while removing the item.",
                        showConfirmButton: false,
                        timer: 1500
                    });
                    console.error('Error removing item:', error);
                });

        }
    </script>
@endpush
