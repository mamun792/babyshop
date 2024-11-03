@extends('web.dashboard.app', ['page' => 'Point Of Sale'])







@section('content')
    @include('web.dashboard.components.cards')


    <div class="col-lg-6">

        <!-- card end -->
        <div class="card p-0 overflow-hidden position-relative radius-12 h-100">
            <div class="card-header py-16 px-24 bg-base border border-end-0 border-start-0 border-top-0">
                <h6 class="text-lg mb-0"> Order </h6>
            </div>
            <div class="card-body p-24 pt-10">
                <ul class="nav bordered-tab border border-top-0 border-start-0 border-end-0 d-inline-flex nav-pills mb-16"
                    id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link px-16 py-10 active" id="pills-home-tab" data-bs-toggle="pill"
                            data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home"
                            aria-selected="true">Customer Search</button>
                    </li>


                </ul>
                {{--  --}}
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab"
                        tabindex="0">
                        <div>


                            <div class="col-12">

                                <label for="userSearch" class="form-label">Find by Phone / Email</label>
                                <input type="hidden" id="defaultUserId"
                                    value="{{ $defaultUserId ?? 'hsmith@example.org' }}">

                                <div class="input-group">
                                    <input type="text" id="userSearch" class="form-control"
                                        placeholder="Type Query Here...">
                                    <input type="hidden" id="userId" name="userId" value="">

                                    <span class="input-group-text bg-base clickable" style="cursor: pointer;"
                                        data-bs-toggle="modal" data-bs-target="#exampleModal">
                                        <iconify-icon icon="mdi:plus"></iconify-icon>
                                    </span>




                                </div>

                            </div>
                            <div id="suggestions" class="dropdown-menu"
                                style="display: none; position: absolute; width: 100%;"></div>

                            <div class="bg-light rounded p-3 text-uppercase font-weight-bold mt-3">Order summary</div>
                            <div class="table-responsive mt-12">
                                <table class="table striped-table mb-0">
                                    <thead>
                                        <tr>
                                            <th scope="col">Items</th>
                                            <th class="text-end" scope="col">Price</th>
                                            <th class="text-end" scope="col">Quantity</th>
                                            <th class="text-end" scope="col">Total</th>
                                            <th class="text-end" scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="orderSummary">
                                        <!-- JavaScript will populate this section -->
                                    </tbody>
                                    <tfoot>



                                        <tr class="text-start">
                                            <td colspan="1"><strong>Sub-Total</strong></td>
                                            <td colspan="2" class="text-end" id="subTotal"><strong>0.00</strong></td>
                                        </tr>

                                        <!-- Shipping Cost Selection Row -->
                                        <tr class="text-start align-middle">
                                            <td colspan="2">
                                                <label for="shippingLocation" class="form-label mb-0"><strong>Shipping
                                                        Location</strong></label>
                                                <select id="shippingLocation" class="form-select mt-1">
                                                    <option value="60">Inside Dhaka - 60.00</option>
                                                    <option value="120">Outside Dhaka - 120.00</option>
                                                    <option value="0" selected>Offline</option>
                                                </select>
                                            </td>
                                            <td colspan="1" class="text-end align-middle"><strong
                                                    id="shippingCost">60.00</strong></td>
                                        </tr>

                                        <!-- Discount Type and Amount Row -->
                                        <tr class="text-start align-middle">
                                            <td colspan="2">
                                                <label for="discountType"
                                                    class="form-label mb-0"><strong>Discount</strong></label>
                                                
                                                <label for="discountType" class="form-label mb-0"><strong>Fixed Discount</strong></label>
                                                <input id="discountType" type="hidden" id="discountType" value="fixed">

                                                
                                            </td>

                                        </tr>
                                        <tr class="text-start align-middle">
                                            <td colspan="2">
                                                <input type="number" id="discountAmount" class="form-control mt-1"
                                                    placeholder="Enter Discount" value="0">
                                            </td>
                                            <td colspan="1" class="text-end align-middle"><strong
                                                    id="disammount">60.00</strong></td>
                                        </tr>

                                        <!-- Total Row -->
                                        <tr class="text-start">
                                            <td colspan="1"><strong>Total</strong></td>
                                            <td colspan="2" class="text-end" id="total"><strong>0.00</strong></td>
                                        </tr>

                                        <tr class="text-start text-danger" id="errorRow" style="display: none;">
                                            <td colspan="3" class="text-center">
                                                <div class="alert alert-danger" role="alert">
                                                    <strong id="errorMessage"></strong>
                                                </div>
                                            </td>
                                        </tr>


                                        <tr class="text-center">
                                            <td colspan="5">
                                                <div class="d-flex justify-content-center gap-3">

                                                    <button type="button" id="cancelButton"
                                                        class="btn btn-outline-danger-600 radius-8 px-15 py-8 d-flex align-items-center gap-2">
                                                        Cancel <iconify-icon icon="mdi:cancel"
                                                            style="font-size: 24px;"></iconify-icon>
                                                    </button>
                                                    <button type="button" id="checkoutButton"
                                                        class="btn btn-success-600 radius-8 px-15 py-8 d-flex align-items-center gap-2">
                                                        Checkout <iconify-icon icon="mdi:cart-check"
                                                            style="font-size: 24px;"></iconify-icon>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>

                                        

                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>


                </div>
                {{--  --}}
            </div>
        </div>
    </div>

    

    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Products </h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table bordered-table mb-0 dataTable" id="dataTable" data-page-length="5"
                        aria-describedby="dataTable_info">
                        <thead>
                            <tr>
                                <th scope="col">Items</th>
                                <th scope="col">Price</th>
                                {{-- <th scope="col">Discount</th> --}}
                                <th scope="col">Available Qty.</th>
                                <th scope="col" class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{--  data-user-id="{{ $user->id }} --}}
                            @foreach ($products as $product)
                                <tr data-row-id="{{ $product->id }}">
                                    <!-- Add data-row-id to identify each row -->
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="{{ asset($product->featured_image) }}" alt="{{ $product->name }}"
                                                class="flex-shrink-0  radius-8 me-12"
                                                style="width: 60px; height: 60px; object-fit: cover;">
                                            <div class="flex-grow-1">
                                                <h6 class="text-md mb-0 fw-normal">{{ $product->name }}</h6>
                                                <span
                                                    class="text-sm text-secondary-light fw-normal">{{ $product->category_name }}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $product->price }}</td>
                                    {{-- <td>15%</td> --}}
                                    <td class="text-center">
                                        <span
                                            class="bg-success-focus text-success-main px-32 py-4 rounded-pill fw-medium text-sm">{{ $product->quantity }}</span>
                                    </td>
                                    <td>
                                        {{-- <input type="hidden" id="userId" value="{{ $userId }}"> --}}
                                        <button type="button"
                                            class="btn btn-success d-flex align-items-center gap-1 add-product-btn"
                                            data-product-id="{{ $product->id }}">
                                            Add to Cart
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>


                </div>
            </div>
        </div>
    </div>



    <!-- Modal -->


    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Create New User</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('custom.register') }}">
                        @csrf
                        <div class="row g-3">
                            <div class="col-sm-12">
                                <div class="mb-3">
                                    <label for="firstName" class="form-label">Full Name</label>
                                    <input type="text" name="name" class="form-control"
                                        placeholder="Enter Full Name" id="firstName">
                                    @if ($errors->has('name'))
                                        <span class="text-danger" id="nameError">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="mb-3">
                                    <label for="PhoneNumber" class="form-label">Phone Number</label>
                                    <input name="phone" type="tel" class="form-control"
                                        placeholder="e.g., 0178963258 " id="PhoneNumber">
                                    @if ($errors->has('phone'))
                                        <span class="text-danger" id="phoneError">{{ $errors->first('phone') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="mb-3">
                                    <label for="emailAddress" class="form-label">Email Address</label>
                                    <input name="email" type="email" class="form-control"
                                        placeholder="Enter Email Address" id="emailAddress">
                                    @if ($errors->has('email'))
                                        <span class="text-danger" id="emailError">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="mb-3">
                                    <label for="customerAddress" class="form-label">Customer Address</label>
                                    <textarea name="address" class="form-control" placeholder="Enter Customer Address" id="customerAddress"
                                        rows="3"></textarea>
                                    @if ($errors->has('address'))
                                        <span class="text-danger"
                                            id="addressError">{{ $errors->first('address') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        {{-- Submit Button --}}
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@if ($errors->any())
    @foreach ($errors->all() as $error)
        <script>
            toastr.error('{{ $error }}');
        </script>
    @endforeach
@endif
@section('js')
    <script>
        $(document).ready(function() {

            $('#dataTable').DataTable({
                "pageLength": 5,
                "lengthMenu": [5, 10, 25, 50],
                "ordering": true,
                "searching": true,
                "info": false
            });



            let selectedUserId = @json(session('registeredUser') ?? (Auth::user() ? Auth::user()->id : null));
            //console.log('Selected User ID:', selectedUserId);

            function showSuggestions(suggestions) {
                const $suggestions = $('#suggestions');
                if (suggestions.length === 0) {
                    $suggestions.hide();
                    return;
                }

                // Clear existing suggestions
                $suggestions.empty();

                // Add new suggestions
                suggestions.forEach(suggestion => {
                    $suggestions.append(`
        <a href="#" class="dropdown-item" data-id="${suggestion.id}">
            ${suggestion.name}
        </a>
    `);
                });
//  (${suggestion.email})
                // Show suggestions dropdown
                const inputPosition = $('#userSearch').offset();
                const inputHeight = $('#userSearch').outerHeight();
                $suggestions.css({

                    display: 'block'
                });
            }


            // Function to initialize the default user selection
            function initializeDefaultUser() {
                // const defaultUserId = @json(Auth::user() ? Auth::user()->email : null);
                const defaultUserId = @json(session('registeredUser') ?? (Auth::user() ? Auth::user()->id : null));
               // console.log('Default User ID:', defaultUserId);

              

                if (defaultUserId) {
                    $.ajax({
                        url: '{{ route('dashboard.search.users.defualt') }}',
                        dataType: 'json',
                        data: {
                            query: defaultUserId
                        },
                        success: function(data) {


                            const numericUserId = Number(defaultUserId);

                            // Find the user with matching ID
                            const user = data.find(user => user.id === numericUserId);

                            if (user) {
                                $('#userSearch').val(`${user.name}`);
                                $('#userId').val(numericUserId);
                            } else {
                                console.error('User with the given ID not found in response:',
                                    numericUserId);
                            }
                        },
                        error: function(err) {
                            console.error('Error fetching default user:', err);
                        }
                    });
                }



            }

            // Search for users
            $('#userSearch').on('input', function() {
                const query = $(this).val();
                if (query.length < 1) {
                    $('#suggestions').hide();
                    return;
                }


                $.ajax({
                    url: '{{ route('dashboard.search.users') }}',
                    dataType: 'json',
                    data: {
                        query: query
                    },
                    success: function(data) {
                        showSuggestions(data);
                    }
                });
            });


            initializeDefaultUser();


            $(document).on('click', '.dropdown-item', function() {
                selectedUserId = $(this).data('id'); // Store the selected user ID
                const userName = $(this).text();

                // Set input value and hide suggestions
                $('#userSearch').val(userName);
                $('#suggestions').hide();
                updateOrderSummary();
                console.log('Selected User ID:', selectedUserId);
            });

            $(document).on('click', function(e) {
                if (!$(e.target).closest('#userSearch, #suggestions').length) {
                    $('#suggestions').hide();
                }
            });



            //     // Add product to cart

            $(document).on('click', '.add-product-btn', async function() {
                if (!selectedUserId) {
                    alert('Please select a user before adding a product to the cart.');
                    return;
                }

                const $row = $(this).closest('tr');
                const productId = $(this).data('product-id');

                // Retrieve data from the row
                const productName = $row.find('h6').text();
                const productCategory = $row.find('span.text-secondary-light').text();
                const productPrice = $row.find('td').eq(1).text();
                const productQuantity = $row.find('td').eq(2).text();
                const quantity = 1;

        
                // Check if a valid quantity was entered
                if (quantity && !isNaN(quantity) && quantity > 0) {
                    try {
                        // Send request to add product to cart
                        const response = await axios.post('/dashboard/adds-to-cart', {
                            productId,
                            userId: selectedUserId,
                            quantity
                        });

                        if (response.status === 200) {
                            // Handle successful response
                            const audio = new Audio('{{ asset('audio/add-tocart.mp3') }}');
                            audio.play().catch(error => {
                                console.error('Playback failed:', error);
                            }).catch(error => {
                                alert('issue sound play  ' + error);
                                console.error('Playback failed:', error);

                            });
                            updateOrderSummary();



                        } else {
                            throw new Error('Failed to add item to cart');
                        }

                    } catch (error) {
                        // Handle errors
                        if (error.response && error.response.data.error) {
                            alert(`Error: ${error.response.data.error}`);
                        } else {
                            alert('Failed to add item to cart. Please try again.');
                        }
                    }
                } else {
                    alert('Invalid quantity. Please enter a number greater than 0.');
                }
            });



    
   

    async function updateOrderSummary() {
                if (!selectedUserId) {
                    console.error('User ID is not selected. Cannot update order summary.');
                    return;
                }

                try {
                    const response = await axios.get('/dashboard/cart-itemss', {
                        params: {
                            user_id: selectedUserId
                        }
                    });

                    const cartItems = response.data;
                    let html = '';
                    let subtotalAmount = 0;

                    cartItems.forEach(item => {
                        const itemTotal = item.quantity * item.product.price;
                        subtotalAmount += itemTotal;

                        html += `
        <tr>
            <td>
                <div class="d-flex align-items-center">
             
                    <img 
            src="${item.product.featured_image ? '{{ asset('') }}' + item.product.featured_image : 'path/to/default-image.jpg'}" 
            alt="${item.product.name}"  class="flex-shrink-0 me-12 radius-8 me-12" style="width: 60px; height: 60px; object-fit: cover;">

                    <div class="flex-grow-1">
                        <h6 class="text-md mb-0 fw-normal text-truncate" style="max-width: 200px;">
                            ${item.product.name}
                        </h6>
                        <span class="text-sm text-secondary-light fw-normal">${item.category_name}</span>
                    </div>
                </div>
            </td>
            <td class="text-end">${item.product.price}</td>
            <td class="text-end">
                <div class="d-flex justify-content-end align-items-center">
                    <button class="btn btn-outline-secondary btn-sm me-1 quantity-btn" data-action="decrease" data-id="${item.product.id}">
                        -
                    </button>
                    <span class="quantity-text">${item.quantity}</span>
                    <button class="btn btn-outline-secondary btn-sm ms-1 quantity-btn" data-action="increase" data-id="${item.product.id}">
                        +
                    </button>
                </div>
            </td>
            <td class="text-end">${itemTotal.toFixed(2)}</td>
            <td class="text-end">
                <iconify-icon icon="mdi:delete" class="float-end delete-icon" data-id="${item.product.id}" style="cursor: pointer;"></iconify-icon>
            </td>
        </tr>
    `;
                    });

                    $('#orderSummary').html(html);
                    $('#subTotal strong').text(`${subtotalAmount.toFixed(2)}`);
                    updateShippingAndTotal(subtotalAmount);
                } catch (error) {
                    console.error('Failed to fetch cart items', error);
                }
            }




            function updateShippingAndTotal(subtotalAmount) {
    const shippingCost = parseFloat($('#shippingLocation').val());
    $('#shippingCost').text(`${shippingCost.toFixed(2)}`);

    let discountAmount = parseFloat($('#discountAmount').val());
    const discountType = $('#discountType').val();
    let finalAmount = subtotalAmount + shippingCost;

    // Initialize total quantity
    let totalQuantity = 0;

    // Loop through each cart item to sum total quantity
    $('#orderSummary tr').each(function() {
        const quantity = parseInt($(this).find('.quantity-text').text());
        totalQuantity += quantity;
    });

    // Adjust discount calculations based on the quantity
    if (discountType === 'fixed') {
        // Calculate the total discount based on the total quantity
        const totalDiscount = discountAmount;
        
        if (totalDiscount > finalAmount) {
            $('#errorRow').show();
            $('#errorMessage').text('Discount amount cannot be greater than the total amount.');
            $('#disammount').text('0.00');
            $('#total strong').text(`${finalAmount.toFixed(2)}`);
        } else {
            $('#errorRow').hide();
            finalAmount -= totalDiscount; // Apply total discount
            $('#disammount').text(`${totalDiscount.toFixed(2)}`);
            $('#total strong').text(`${finalAmount.toFixed(2)}`);
        }
    } else if (discountType === 'percentage') {
        const percentageDiscount = discountAmount / 100;
        const discount = subtotalAmount * percentageDiscount; // Calculate percentage discount
        
        // Ensure discount does not exceed the total amount
        if (discount > finalAmount) {
            $('#errorRow').show();
            $('#errorMessage').text('Discount exceeds total amount.');
            $('#disammount').text('0.00');
            $('#total strong').text(`${finalAmount.toFixed(2)}`);
        } else {
            $('#errorRow').hide();
            $('#disammount').text(`${discount.toFixed(2)}`);
            $('#total strong').text(`${(finalAmount - discount).toFixed(2)}`);
        }
    } else {
        $('#disammount').text('0.00');
        $('#total strong').text(`${finalAmount.toFixed(2)}`);
    }
}


            $('#shippingLocation, #discountAmount, #discountType').change(function() {
                const subtotalAmount = parseFloat($('#subTotal strong').text().replace('$', ''));

                const shippingCost = parseFloat($('#shippingLocation').val());

                $('#shippingCost').text(`$${shippingCost.toFixed(2)}`);
                console.log('Shipping Cost:', shippingCost);

                // Determine if inside or outside
                let deliveryType = '';
                if (shippingCost === 60) {
                    deliveryType = 'inside';
                } else if (shippingCost === 120) {
                    deliveryType = 'outside';
                }



                updateShippingAndTotal(subtotalAmount);
            });
 



            $(document).on('click', '.quantity-btn', async function() {
                const $btn = $(this);
                const action = $btn.data('action');
                const productId = $btn.data('id');
                const $quantityText = $btn.siblings('.quantity-text');
                let quantity = parseInt($quantityText.text());

                // Increase or decrease the quantity
                if (action === 'increase') {
                    quantity += 1;
                } else if (action === 'decrease' && quantity > 1) {
                    quantity -= 1;
                } else {
                    return; // Prevent quantity from going below 1
                }

                try {
                    // Make an async request to update the cart quantity
                    const response = await axios.put(`/dashboard/${productId}/cart-itemss`, {
                        user_id: selectedUserId,
                        quantity: quantity
                    });

                    if (response.status === 200) {
                        $quantityText.text(quantity); // Update quantity text in the UI
                        updateOrderSummary(); // Refresh the order summary on success
                    } else {
                        throw new Error('Failed to update quantity');
                    }
                } catch (error) {
                    // Handle errors and display them in the UI
                    if (error.response && error.response.data.error) {
                        alert(error.response.data.error); // Show error message from the server response
                    } else {
                        alert('Failed to update quantity. Please try again.');
                    }
                }
            });



            $(document).on('click', '.delete-icon', async function() {
                const productId = $(this).data('id');

                if (!selectedUserId) {
                    console.error('User ID is not selected. Cannot delete item from cart.');
                    return;
                }

                // Show SweetAlert2 confirmation dialog
                const {
                    value: confirm
                } = await Swal.fire({
                    title: 'Are you sure?',
                    text: 'Do you want to delete this item from the cart?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'Cancel',
                    reverseButtons: true
                });

                if (confirm) {
                    try {
                        const response = await axios.delete(`/dashboard/${productId}/cart-itemss`, {
                            data: {
                                user_id: selectedUserId
                            } // Use the selected user ID
                        });

                        if (response.status === 200) {
                            Swal.fire(
                                'Deleted!',
                                'The item has been removed from the cart.',
                                'success'
                            );
                            updateOrderSummary(); // Refresh the order summary on success
                        } else {
                            Swal.fire(
                                'Error!',
                                'Failed to delete the item. Please try again.',
                                'error'
                            );
                        }
                    } catch (error) {
                        Swal.fire(
                            'Error!',
                            'Failed to delete the item. Please try again.',
                            'error'
                        );
                    }
                }
            });

            $('#checkoutButton').on('click', async function() {
                if (!selectedUserId) {
                    alert('Please select a user before proceeding to checkout.');
                    return;
                }

                const discountType = $('#discountType').val();
                const discountAmount = parseFloat($('#discountAmount').val()) || 0;
                // added shohing cost inside dhaka and outside dhaka
                const shippingCost = parseFloat($('#shippingLocation').val());
                //    console.log('shippingCost', shippingCost);


                try {
                    const response = await axios.post('/dashboard/checkout', {
                        userId: selectedUserId,
                        discountType: discountType,
                        discountAmount: discountAmount,
                        shippingCost: shippingCost,

                    });

                    if (response.status === 200) {
                        $('#successRow').show();

                        //     redirect to pdf.invoice page
                        window.location.href = '/dashboard/generate-invoice/';

                    } else {
                        throw new Error('Checkout failed');
                    }
                } catch (error) {
                    console.error('Checkout failed:', error);
                    alert('Failed to complete the checkout. Please try again.');
                }
            });

            $('#cancelButton').on('click', function() {
                // Reset the cart or perform any other cancel action
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'Do you want to cancel the checkout process?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, cancel it!',
                    cancelButtonText: 'No, keep it',
                    reverseButtons: true
                }).then(async (result) => {
                    if (result.isConfirmed) {
                        try {

                            await axios.post('/dashboard/reset-cart', {
                                userId: selectedUserId
                            });

                            // Clear selected user ID
                            selectedUserId = null;

                            // Reset form fields
                            $('#userSearch').val('');
                            $('#suggestions').hide();
                            $('#shippingLocation').val('');
                            $('#discountAmount').val('');
                            $('#discountType').val('none');

                            // Refresh order summary
                            $('#orderSummary').empty();
                            $('#subTotal strong').text('0.00');
                            $('#shippingCost').text('0.00');
                            $('#disammount').text('0.00');
                            $('#total strong').text('0.00');

                            Swal.fire(
                                'Cancelled!',
                                'The checkout process has been cancelled.',
                                'success'
                            );
                        } catch (error) {
                            console.error('Failed to cancel checkout:', error);
                            Swal.fire(
                                'Error!',
                                'Failed to cancel the checkout process. Please try again.',
                                'error'
                            );
                        }
                    }
                });
            });



            // Initial call to populate order summary
            updateOrderSummary();
        });
</script>

<script src="{{asset('assets/backend/chart.js')}}"></script>
<script>
    const statistics =  @json($statistics) || {};

   
  

   
    createChart('new-pending-chart', '#45b369', statistics.monthlyOrders['monthlyPendingOrders']);
  
    createChart('total-sal-chart', '#8252e9',  statistics.monthlyOrders['totalSales'] || 0);
    createChart('total-return-sales-chart', '#f77e53', statistics.monthlyOrders['totalReturnedOrdersSales'] || 0);
    createChart('total-cancel-sales-chart', '#8252e9', statistics.monthlyOrders['totalCancelledOrdersSales'] || 0);
    createChart('monthly-deleviry-chart', '#8252e9', statistics.monthlyOrders['monthlyDeliveredOrders']);
    createChart('total-return-chart', '#f77e53', statistics.monthlyOrders['monthlyReturnedOrders']);
    
</script>

@endsection
