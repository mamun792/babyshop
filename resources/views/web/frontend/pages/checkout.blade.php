@extends('layouts.app')
@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/fontend/css/checkout.css') }}">
@endpush
@section('content')
  

    <section class="delivery-section">
        <div class="container">
            <!-- Checkout Form Section -->
            <!-- (Existing form structure remains as is) -->
            <div class="row justify-content-center">
                <div class="col-lg-8 col-md-11 col-sm-12">
                    <form action="" id="checkoutform">
                        <div class="delivery-section-inner">
                            <div class="delivery-title text-center">
                                <h4>Checkout Info</h4>
                            </div>
                            <div class="delivery-form">
                                <div class="contact-title mb-4">
                                    <h6>Contact Info</h6>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Full Name"
                                                name="full_name">

                                            <p class="text-danger" style="display: none;" id="full_name_error"></p>
                                        </div>
                                    </div>


                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Phone Number"
                                                name="phone">
                                            <p class="text-danger" style="display: none;" id="phone_error"></p>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Detailed Address"
                                                name="address">
                                            <p class="text-danger" style="display: none;" id="address_error"></p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <select class="scrollable-dropdown form-control" id="citySelect" name="city">
                                                <option selected disabled>Select City</option>
                                                <option value="Dhaka">Dhaka</option>
                                                <option value="Savar">Savar</option>
                                                <option value="Navinagar">Navinagar</option>
                                                <option value="Ashulia">Ashulia</option>
                                                <option value="Keranigonj">Keranigonj</option>
                                                <option value="Tongi">Tongi</option>
                                                <option value="Chandpur">Chandpur</option>
                                                <option value="Cumilla">Cumilla</option>
                                                <option value="Narsingdi">Narsingdi</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="at_phone"
                                                placeholder="Alt. Phone (01XXXXXXXXX)">
                                            <p class="text-danger" style="display: none;" id="phone_error"></p>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="payment-options-main mt-4">
                            <div class="row">
                                <div class="col-lg-9 col-md-9 col-sm-12">
                                    <div class="contact-title mb-4">
                                        <h6>Payment Options</h6>
                                    </div>
                                    <div class="payment-options-inner">
                                        <div class="row">

                                            <div class="col-md-4 col-sm-4 payment-button-column">
                                                <button class="dropbtn"
                                                    onclick="document.getElementById('radioInput3').checked = true;">
                                                    <input type="radio" id="radioInput3" name="payment">
                                                    <span style="cursor: pointer;">
                                                        {{-- <img class="img-responsive" src="{{ asset('assets/fontend/images/bkash.jpg') }}" alt=""> --}}
                                                        <span class="cashback-offer">10% Cashback</span>
                                                    </span>
                                                </button>
                                            </div>
                                            <div class="col-md-4 col-sm-4 payment-button-column">
                                                <button class="dropbtn"
                                                    onclick="document.getElementById('radioInput1').checked = true;">
                                                    <input type="radio" id="radioInput1" name="payment">
                                                    <span style="cursor: pointer;">
                                                        <img class="img-responsive"
                                                            src="{{ asset('assets/fontend/images/cod-pay.png') }}"
                                                            alt="">
                                                    </span>
                                                </button>
                                            </div>
                                            <div class="col-md-4 col-sm-4 payment-button-column">
                                                <button class="dropbtn"
                                                    onclick="document.getElementById('radioInput2').checked = true;">
                                                    <input type="radio" id="radioInput2" name="payment">
                                                    <span style="cursor: pointer;">
                                                        <img class="img-responsive"
                                                            src="{{ asset('assets/fontend/images/card-pay.png') }}"
                                                            alt="">
                                                    </span>
                                                </button>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Orders Table with Coupon Option -->
                        <div class="your-order-title p-3">
                            <span>Your Orders</span>
                            <span class="dropdown-toggle float-end"></span>
                        </div>
                        <div class="orders-table">
                            <table class="cart-table table table-responsive">
                                <thead>
                                    <tr class="text-center">
                                        <th>Item</th>
                                        <th>Name</th>
                                        <th>Size</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                    </tr>
                                </thead>
                                @if (!empty($cartItems) && count($cartItems) > 0)
                                    <tbody>

                                        @foreach ($cartData['items'] as $item)
                                            <tr>
                                                <td class="product-info">
                                                    <img src="{{ asset($item['featured_image']) }}"
                                                        alt="{{ $item['name'] }}">
                                                </td>
                                                <td>
                                                    <div class="product-details">
                                                        <p>{{ $item['name'] }}</p>
                                                        <span class="stock-status">In Stock</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <!-- Display options -->
                                                    @if (!empty($item['options']))
                                                        <ul class="list-unstyled mb-0">
                                                            @foreach ($item['options'] as $option)
                                                                <li>
                                                                    <span
                                                                        class="badge bg-secondary me-1">{{ ucfirst($option['option_name']) }}</span>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    @else
                                                        <span class="badge bg-secondary">N/A</span>
                                                    @endif
                                                </td>

                                                <td class="text-center">{{ $item['quantity'] }}</td>
                                                <td>£{{ number_format($item['price'], 2) }}</td>
                                            </tr>
                                        @endforeach

                                    </tbody>


                                    <tfoot>
                                        <tr>
                                            <td colspan="4" style="text-align: right; font-weight: bold;">Total
                                                (Excluding
                                                delivery)</td>
                                            <td id="orderTotal">£{{ number_format($cartData['total'], 2) }}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="4">
                                                <input type="text" id="couponCode"
                                                    style="width: 100%; padding: 10px; border: 1px solid #ced4da;"
                                                    placeholder="Enter Coupon Code">
                                                <p id="couponCodeError" style="color: red; display: none;">Please enter a
                                                    coupon
                                                    code.</p>
                                            </td>

                                            <td>
                                                <button id="applyCouponBtn"
                                                    style="padding: 10px; background-color: #007bff; color: white; border: none; border-radius: 3px; cursor: pointer;"
                                                    <?php if (Session::has('couponCode')) {
                                                        echo 'disabled';
                                                    } ?>>Apply Coupon</button>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td colspan="4" style="text-align: right; font-weight: bold;">Discount</td>
                                            <td id="discountAmount">- £{{ number_format($discountAmount, 2) }}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="4" style="text-align: right; font-weight: bold;">Total (After
                                                Discount)</td>
                                            <td id="finalTotal">£{{ number_format($finalTotal ?? $total, 2) }}</td>
                                        </tr>
                                    </tfoot>
                                @else
                                    <tr>
                                        <td colspan="5" class="text-center">No items in the cart</td>
                                    </tr>
                                @endif
                            </table>
                        </div>
                        @if (!empty($cartItems) && count($cartItems) > 0)
                            <div class="confirm-btn text-center">
                                <button type="submit" id="confirmOrderBtn">Confirm Order</button>
                            </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </section>


@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const applyCouponBtn = document.getElementById('applyCouponBtn');
            const checkoutForm = document.getElementById('checkoutform');
            const couponCodeInput = document.getElementById('couponCode');
            const couponCodeError = document.getElementById('couponCodeError');
            const discountAmountElem = document.getElementById('discountAmount');
            const finalTotalElem = document.getElementById('finalTotal');

            const errorMessages = {
                full_name: 'Please enter your full name',
                phone: 'Please enter your phone number',
                address: 'Please enter your address',
                //  at_phone: 'Please enter your alternative phone number',
                payment: 'Please select a payment method'
            };


            // Function to display error for a specific field
            const showError = (field) => {
                const errorElement = document.getElementById(`${field}_error`);
                if (errorElement) {
                    errorElement.style.display = 'block';
                    errorElement.innerText = errorMessages[field];
                }
            };

            // Function to hide all error messages
            const clearErrors = () => {
                Object.keys(errorMessages).forEach(id => {
                    const errorElement = document.getElementById(`${id}_error`);
                    if (errorElement) errorElement.style.display = 'none';
                });
            };


            const validateFields = (fields) => {
                for (const field of fields) {
                    // Skip validation for at_phone
                    if (field.name === 'at_phone') continue;

                    if (!field.value) {
                        showError(field.name);
                        return false;
                    }
                }
                return true;
            };

            // Handle coupon application
            applyCouponBtn.addEventListener('click', function(e) {
                e.preventDefault();
                const couponCode = couponCodeInput.value;

                if (!couponCode) {
                    couponCodeError.style.display = 'block';
                    return;
                } else {
                    couponCodeError.style.display = 'none';
                }

                axios.post('/apply-coupon', {
                        couponCode
                    }, {
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'

                        }
                    })
                    .then(response => {
                        const data = response.data;
                        if (data.success) {
                            discountAmountElem.innerText = `- £${data.discount}`;
                            finalTotalElem.innerText = `£${data.finalTotal}`;
                            couponCodeInput.value = '';
                            Swal.fire({
                                position: "top-end",
                                icon: "success",
                                title: "Coupon applied successfully!",
                                showConfirmButton: false,
                                timer: 1500
                            });
                        } else {
                            couponCodeInput.value = '';
                            Swal.fire({
                                icon: "error",
                                title: "Oops...",
                                text: data.message
                            });
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        Swal.fire({
                            icon: "error",
                            title: "Oops...",
                            text: "An unexpected error occurred. Please try again later."
                        });
                    });
            });

            // Handle form submission for checkout
            checkoutForm.addEventListener('submit', function(e) {
                e.preventDefault();
                clearErrors();

                const fullName = document.querySelector('input[name="full_name"]');
                const primaryPhone = document.querySelector('input[name="phone"]');
                const address = document.querySelector('input[name="address"]');
                const alternatePhone = document.querySelector('input[name="at_phone"]');
                const paymentMethod = document.querySelector('input[name="payment"]:checked');

                // Validate required fields
                if (!validateFields([fullName, primaryPhone, address, alternatePhone])) return;

                if (!paymentMethod) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: errorMessages.payment
                    });
                    return;
                }

                const formData = new FormData(this);

                formData.append('payment', paymentMethod.value);

                axios.post('/checkout', formData, {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    })
                    .then(response => {
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'Order placed successfully!',
                            showConfirmButton: true
                        }).then(() => {
                            location.reload();
                        });
                        // .then(() => {
                        //     window.location.href = '/order-summary';
                        // });
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'There was an issue placing your order. Please try again later.'
                        });
                    });
            });
        });
    </script>
@endpush
