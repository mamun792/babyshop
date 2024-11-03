@extends('web.dashboard.app', ['page' => 'Order Management'])

@section('content')
    @include('web.dashboard.components.cards')

    <div class="card basic-data-table">
        <div class="card-header">
            <h5 class="card-title mb-0">Order Management</h5>
        </div>
        <div class="card-body">


            <div class="card-body px-0">


                <form action="{{ route('dashboard.orders.filter') }}" method="get" class="row">
                    <!-- First Column -->
                    @csrf
                    <div class="col-md-3">
                        <div class="row mb-24 gy-3 align-items-center">
                            <div class="input-group input-group-sm mb-3">
                                <span class="input-group-text" id="inputGroup-sizing-sm">Product Code</span>
                                <input type="text" class="form-control" name="product_code"
                                    value="{{ request()->has('product_code') ? request()->get('product_code') : '' }}">
                            </div>
                        </div>
                    </div>

                    <!-- Second Column -->
                    <div class="col-md-3">
                        <div class="row mb-24 gy-3 align-items-center">
                            <div class="input-group input-group-sm mb-3">
                                <span class="input-group-text" id="inputGroup-sizing-sm">Invoice No.</span>
                                <input type="text" class="form-control" name="invoice_no"
                                    value="{{ request()->has('invoice_no') ? request()->get('invoice_no') : '' }}">
                            </div>
                        </div>
                    </div>

                    <!-- Third Column -->
                    <div class="col-md-3">
                        <div class="row mb-24 gy-3 align-items-center">
                            <div class="input-group input-group-sm mb-3">
                                <span class="input-group-text" id="inputGroup-sizing-sm">Phone No.</span>
                                <input type="text" class="form-control" name="phone"
                                    value="{{ request()->has('phone') ? request()->get('phone') : '' }}">
                            </div>
                        </div>
                    </div>

                    <!-- Fourth Column -->
                    <div class="col-md-3">
                        <div class="row mb-24 gy-3 align-items-center">
                            <div class="input-group input-group-sm mb-3">
                                <span class="input-group-text">Status</span>

                                <select class="form-control" style="padding-top: 10px;" name="status" id="">
                                    <option></option>

                                    <option value="pending">Pending</option>
                                    <option value="processing">Processing</option>
                                    {{-- <option value="Shipped">Shipped</option> --}}
                                    <option value="delivered">Delivered</option>
                                    <option value="cancelled">Cancelled</option>
                                    <option value="pending_delivery">Pending Delivery</option>
                                    <option value="sent_to_steadfast">Sent To Steadfast</option>
                                    <option value="returned">Returned</option>


                                </select>

                            </div>
                        </div>
                    </div>

                    <!-- Fifth Column -->
                    <div class="col-md-3">
                        <div class="row mb-24 gy-3 align-items-center">
                            <div class="input-group input-group-sm mb-3">
                                <span class="input-group-text" id="inputGroup-sizing-sm">Days</span>
                                <input type="text" class="form-control" name="days"
                                    value="{{ request()->has('days') ? request()->get('days') : '' }}">
                            </div>
                        </div>
                    </div>

                    <!-- Sixth Column (Date Filter) -->
                    <div class="col-md-3">
                        <div class="row mb-24 gy-3 align-items-center">
                            <div class="input-group input-group-sm mb-3">
                                {{-- <span class="input-group-text" id="inputGroup-sizing-sm">Date Filter</span> --}}
                                <span class="input-group-text">From:</span>
                                <input type="date" class="form-control" name="date_from">
                                <span class="input-group-text">To:</span>
                                <input type="date" class="form-control" name="date_to">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="row mb-24 gy-3 align-items-center">
                            <div class="input-group input-group-sm mb-3">
                                <span class="input-group-text" id="inputGroup-sizing-sm">Customer Name</span>
                                <input type="text" class="form-control" name="customer_name"
                                    value="{{ request()->has('customer_name') ? request()->get('customer_name') : '' }}">
                            </div>
                        </div>
                    </div>
                    <div class="col-3 ">
                        <div class="input-group">
                            <div class="d-flex align-items-center gap-3">
                                <button type="submit" class="btn btn-primary-600 rounded px-24 py-8">Filter</button>

                                <a href="{{ route('dashboard.orders.index') }}"
                                    class="btn btn-danger-600 rounded px-24 py-8">Reset</a>

                            </div>
                        </div>



                </form>





            </div>

            <hr>
            <br>





            <form action="{{ route('dashboard.orders.bulk.update.status') }}" method="post" id="statusForm">
                @csrf

                <div class="d-flex justify-content-end gap-2"
                    style="background-color: #6c757d; border-radius: 5px; padding: 10px 24px; margin-bottom: 20px;">
                    <div class="dropdown">
                        <button class="btn bg-white dropdown-toggle" type="button" id="statusDropdown"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Update Status
                        </button>

                        <ul class="dropdown-menu" aria-labelledby="statusDropdown">
                            <li><a class="dropdown-item" href="#" data-value="sent_to_steadfast"><i
                                        class="fas fa-paper-plane" style="color: #28a745;"></i> Sent To Steadfast</a></li>
                            <li><a class="dropdown-item" href="#" data-value="pending"><i class="fas fa-clock"
                                        style="color: #ffc107;"></i> Pending</a></li>
                            <li><a class="dropdown-item" href="#" data-value="processing"><i
                                        class="fas fa-cog fa-spin" style="color: #17a2b8;"></i> Processing</a></li>
                            <li><a class="dropdown-item" href="#" data-value="delivered"><i
                                        class="fas fa-check-circle" style="color: #28a745;"></i> Delivered</a></li>
                            <li><a class="dropdown-item" href="#" data-value="cancelled"><i class="fas fa-ban"
                                        style="color: #dc3545;"></i> Cancelled</a></li>
                            <li><a class="dropdown-item" href="#" data-value="pending_delivery"><i
                                        class="fas fa-truck" style="color: #ffc107;"></i> Pending Delivery</a></li>
                            <li><a class="dropdown-item" href="#" data-value="returned"><i class="fas fa-undo"
                                        style="color: #007bff;"></i> Returned</a></li>
                            <li><a class="dropdown-item text-danger" href="#" data-value="delete"><i
                                        class="fas fa-trash" style="color: #dc3545;"></i> Delete</a></li>
                        </ul>

                    </div>
                </div>
                <input type="hidden" name="status" id="selectedStatus">

                @if (!$filterResults)
                    @csrf
                    <table class="table table-striped table-bordered orderdataTable w-100" id="orderdataTable">
                        <thead>
                            <tr>
                                <th>
                                    <input class="form-check-input selectAllCheckboxes" type="checkbox">
                                </th>
                                <th>Invoice</th>
                                <th>Customer</th>
                                <th>Products</th>
                                {{-- <th>Delivery</th> --}}
                                <th>Total</th>
                                <th>Status</th>
                                <th>Courier Status</th>
                                <th>Comment</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $d)
                                <tr>
                                    <td>
                                        <input class="form-check-input rowCheckboxes" type="checkbox" name="order_ids[]"
                                            value="{{ $d->id }}">
                                    </td>
                                    <td>{{ $d->invoice_number }}</td>
                                    <td>
                                        <ul>
                                            <li>{{ $d->customer_name }}</li>
                                            <li>{{ $d->address }}</li>
                                            <li>{{ $d->phone_number }}</li>
                                        </ul>
                                    </td>
                                    <td style="width: 20%">


                                        <div class="container">
                                            <div class="row">
                                                @foreach ($d->items as $i)
                                                    <div class="col-md-6 mb-2">
                                                        <!-- Each item takes half the width on medium screens and up -->
                                                        <li class="m-2 d-flex align-items-center list-unstyled">
                                                            <div class="image-container">
                                                                <img class="rounded zoom-image"
                                                                    src="{{ asset($i->product->featured_image) }}"
                                                                    alt="{{ $i->product->name }}"
                                                                    data-bs-toggle="tooltip"
                                                                    title="{{ $i->product->name }}"
                                                                    style="width: 40px; height: 40px; object-fit: cover; cursor: pointer;"
                                                                    data-image="{{ asset($i->product->featured_image) }}"
                                                                    onerror="this.onerror=null; this.src='path/to/default/image.jpg';" />
                                                            </div>
                                                            <div class="ms-3">
                                                                <span class="d-inline-block"
                                                                    title="{{ $i->product->name }}">
                                                                    {{ Str::limit($i->product->name, 10, '...') }}
                                                                </span>
                                                            </div>
                                                        </li>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>

                                    </td>

                                    <td>৳ {{ $d->total_amount }}</td>

                                    <td>{{ $d->order_status }}</td>
                                    <td>{{ $d->steadfast_status }}</td>

                                    <td>
                                        <div class="container mt-4">

                                            <div class="comment-display ">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div class="comment-text">
                                                        {{ truncate_comment($d->comment) }}
                                                    </div>
                                                    <a href="#"
                                                        class="edit-comment-link text-primary text-decoration-none"
                                                        data-id="{{ $d->id }}" title="Edit this comment">
                                                        <i class="fa-solid fa-pen-to-square fa-lg"></i>
                                                    </a>
                                                </div>
                                            </div>


                                        </div>
                                    </td>

                                    <td>



                                        <div class="dropdown">
                                            <button
                                                class="btn btn-primary btn-sm d-flex align-items-center justify-content-between dropdown-toggle"
                                                type="button" id="updateOrderStatusButton" data-bs-toggle="dropdown"
                                                aria-expanded="false">
                                                <span class="me-2">Update Order Status</span>
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="updateOrderStatusButton">
                                                @if (!$d->consignment_id)
                                                    <li>
                                                        <a class="dropdown-item status-update" href="#"
                                                            data-status="sent_to_steadfast"
                                                            data-id="{{ $d->id }}">
                                                            <i class="bi bi-box-arrow-up text-info me-2"></i>Sent To
                                                            Steadfast
                                                        </a>
                                                    </li>
                                                @endif



                                                <li><a class="dropdown-item status-update" href="#"
                                                        data-status="pending" data-id="{{ $d->id }}">
                                                        <i class="bi bi-hourglass-split text-warning me-2"></i>Pending</a>
                                                </li>

                                                <li><a class="dropdown-item status-update" href="#"
                                                        data-status="processing" data-id="{{ $d->id }}">
                                                        <i class="bi bi-gear-fill text-primary me-2"></i>Processing</a>
                                                </li>

                                                <li><a class="dropdown-item status-update" href="#"
                                                        data-status="delivered" data-id="{{ $d->id }}">
                                                        <i class="bi bi-check2-circle text-success me-2"></i>Delivered</a>
                                                </li>

                                                <li><a class="dropdown-item status-update" href="#"
                                                        data-status="cancelled" data-id="{{ $d->id }}">
                                                        <i class="bi bi-x-circle text-danger me-2"></i>Cancelled</a></li>

                                                <li><a class="dropdown-item status-update" href="#"
                                                        data-status="pending_delivery" data-id="{{ $d->id }}">
                                                        <i class="bi bi-calendar2 text-info me-2"></i>Pending Delivery</a>
                                                </li>

                                                <li><a class="dropdown-item status-update" href="#"
                                                        data-status="returned" data-id="{{ $d->id }}">
                                                        <i
                                                            class="bi bi-arrow-return-left text-danger me-2"></i>Returned</a>
                                                </li>

                                                <li>
                                                    <a class="dropdown"
                                                        href="{{ route('dashboard.orders.invoice', $d->id) }}">
                                                        <i class="bi bi-file text-primary me-2"></i>View Invoice
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>



                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <table class="table bordered-table mb-0 oderdataTable w-100" id="oderdataTable">
                        <thead>
                            <tr>
                                <th>
                                    {{-- <input class="form-check-input" type="checkbox" id="selectAllCheckboxes"> --}}
                                    <input class="form-check-input selectAllCheckboxes" type="checkbox">
                                </th>
                                <th>Invoice</th>
                                <th>Customer</th>
                                <th>Products</th>
                                <th>Delivery</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Courier Status</th>

                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($filterResults as $d)
                                <tr>
                                    <td>
                                        <input class="form-check-input rowCheckboxes" type="checkbox" name="order_ids[]"
                                            value="{{ $d->id }}">
                                        {{-- <input class="form-check-input rowCheckboxes" type="checkbox" name="order_ids[]"
                                            value="{{ $d->id }}"> --}}

                                    </td>
                                    <td>{{ $d->invoice_number }}</td>
                                    <td>
                                        <ul>
                                            <li>{{ $d->customer_name }}</li>
                                            <li>{{ $d->address }}</li>
                                            <li>{{ $d->phone_number }}</li>
                                        </ul>
                                    </td>
                                    <td>
                                        <ul>
                                            @foreach ($d->items as $i)
                                                <li>{{ Str::limit($i->product->name, 40, '...') }}</li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td>৳ {{ $d->delivery_charge ?? 0 }}</td>
                                    <td>৳ {{ $d->total_amount }}</td>
                                    <td>{{ $d->order_status }}</td>
                                    <td>---</td>
                                    {{-- <td>{{ $d->comment }}</td> --}}
                                    <td>
                                        <button type="button">View</button>
                                        <button type="button">Edit</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </form>


            <div class="modal fade" id="imageZoomModal" tabindex="-1" aria-labelledby="imageZoomModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="imageZoomModalLabel">Product Image</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body text-center">
                            <img id="zoomedImage" src="" alt="Zoomed Image" class="img-fluid rounded">
                        </div>
                    </div>
                </div>
            </div>

        </div>

    @endsection


    @section('js')
        <script>
            let table = new DataTable('#orderdataTable', {
                columnDefs: [{
                    orderable: false,
                    targets: '_all'
                }],
                pageLength: 10,
                drawCallback: function() {

                    attachEventListeners();
                }
            });

            document.addEventListener('DOMContentLoaded', function() {
                const selectAllCheckbox = document.querySelector('.selectAllCheckboxes');

                selectAllCheckbox.addEventListener('change', function() {
                    const checkboxes = document.querySelectorAll('.rowCheckboxes');
                    checkboxes.forEach(checkbox => {
                        checkbox.checked = selectAllCheckbox.checked;
                    });
                });


                attachEventListeners();
            });

            function attachEventListeners() {
                // Attach dropdown item click event
                document.querySelectorAll('.dropdown-item').forEach(item => {
                    item.addEventListener('click', function(event) {
                        event.preventDefault();
                        const statusValue = this.getAttribute('data-value');
                        document.getElementById('selectedStatus').value = statusValue;
                        document.getElementById('statusForm').submit();
                    });
                });

                const orderTable = document.getElementById('orderdataTable');

                // Ensure each button has the event listener attached correctly
                orderTable.querySelectorAll('.status-update').forEach(statusUpdateButton => {
                    statusUpdateButton.addEventListener('click', function(event) {
                        event.preventDefault();

                        // // Add a confirmation dialog
                        // const confirmation = confirm("Are you sure you want to update the status?");
                        // if (!confirmation) {
                        //     return;
                        // }

                        const status = this.getAttribute('data-status');
                        const orderId = this.getAttribute('data-id');

                        const orderIdInput = document.createElement('input');
                        orderIdInput.type = 'hidden';
                        orderIdInput.name = 'order_ids[]';
                        orderIdInput.value = orderId;

                        document.getElementById('selectedStatus').value = status;
                        document.getElementById('statusForm').appendChild(orderIdInput);
                        document.getElementById('statusForm').submit();
                    });
                });


                // Attach event listener for comment editing
                const editCommentLinks = document.querySelectorAll('.edit-comment-link');
                editCommentLinks.forEach(link => {
                    link.removeEventListener('click', handleEditComment); // Remove existing listeners
                    link.addEventListener('click', handleEditComment); // Add the new listener
                });
            }



            function handleEditComment(event) {
                event.preventDefault();

                const updateUrl = "{{ route('dashboard.orders.comment.update', ':id') }}".replace(':id', this.getAttribute(
                    'data-id'));

                axios.get("{{ route('dashboard.orders.comments') }}")
                    .then(response => {
                        const comments = response.data;
                        console.log('Comments:', comments);
                        const options = comments.map(comment =>
                            `<option value="${comment.id}">${comment.name.length > 30 ? comment.name.substring(0, 30) + '...' : comment.name}</option>`
                        ).join('');

                        Swal.fire({
                            html: ` 
                        <div style="max-height: 400px; overflow-y: auto;">
                            <label for="commentSelect" class="form-label text-dark">Select a comment:</label>
                            <select id="commentSelect" class="form-select" style="width: 100%;">
                                ${options}
                            </select>
                        </div>
                    `,
                            showCancelButton: true,
                            confirmButtonText: 'Save Changes',
                            cancelButtonText: 'Cancel',
                            width: 'auto',
                            customClass: {
                                popup: 'border border-primary rounded',
                            },
                            preConfirm: () => {
                                const selectedCommentId = document.getElementById('commentSelect').value;
                                const selectedComment = comments.find(comment => comment.id ==
                                    selectedCommentId);
                                const newCommentText = selectedComment ? selectedComment.name : '';

                                Swal.showLoading();
                                return new Promise((resolve, reject) => {
                                    axios.post(updateUrl, {
                                            comment: newCommentText,
                                            _token: '{{ csrf_token() }}'
                                        })
                                        .then(response => {
                                            if (response.data.success) {
                                                resolve(response.data);
                                            } else {
                                                reject(
                                                    'Unable to update the comment. Please try again.');
                                            }
                                        })
                                        .catch(() => {
                                            reject(
                                            'An error occurred while updating your comment.');
                                        });
                                });
                            }
                        }).then((result) => {
                            if (result.isConfirmed) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Comment Updated',
                                    text: 'Your comment was successfully updated.',
                                    timer: 1500,
                                    showConfirmButton: false
                                }).then(() => {
                                    location.reload();
                                });
                            }
                        });
                    })
                    .catch(error => {
                        console.error('Error fetching comments:', error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Could not load comments. Please try again later.',
                        });
                    });
            }



            document.addEventListener('DOMContentLoaded', function() {

                var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
                var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                    return new bootstrap.Tooltip(tooltipTriggerEl);
                });


                document.querySelectorAll('.zoom-image').forEach(img => {
                    img.addEventListener('click', function() {
                        const imageUrl = this.getAttribute('data-image');
                        const zoomedImage = document.getElementById('zoomedImage');
                        zoomedImage.src = imageUrl;
                        const imageZoomModal = new bootstrap.Modal(document.getElementById(
                            'imageZoomModal'));
                        imageZoomModal.show();
                    });
                });
            });
        </script>

        <script src="{{ asset('assets/backend/chart.js') }}"></script>
        <script>
            const statistics = @json($statistics) || {};

            // Create the charts with dynamic data
            createChart('actives-user-chart', '#487fff', statistics.monthlyOrders['monthlyOrders']);
            createChart('new-pending-chart', '#45b369', statistics.monthlyOrders['monthlyPendingOrders']);
            createChart('processin-sales-chart', '#f77e53', statistics.monthlyOrders['monthlyProcessingOrders']);
            createChart('pendin-delevery-chart', '#8252e9', statistics.monthlyOrders['monthlyPendingDeliveryOrders']);
            createChart('total-user-chart', '#f77e53', statistics.monthlyOrders['totalUsers']);
            createChart('monthly-deleviry-chart', '#8252e9', statistics.monthlyOrders['monthlyDeliveredOrders']);
            createChart('total-return-chart', '#f77e53', statistics.monthlyOrders['monthlyReturnedOrders']);
            createChart('total-cancel-chart', '#8252e9', statistics.monthlyOrders['monthlyCancelledOrders']);
        </script>
    @endsection
