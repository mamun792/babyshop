<div>
    @extends('web.dashboard.app', ['page' => 'All Products'])

    @section('content')
        {{-- @include('web.dashboard.components.cards') --}}


        <div class="container mt-5">
            <div class="row">
                <!-- Filters Section -->
                <div class="col-12 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Filter Products</h5>
                            <form id="product-filter-form" method="POST" action="{{ route('dashboard.product.filter') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <label for="category" class="form-label">Category</label>
                                        <select class="form-control" name="category_id"
                                            onchange="getCategoryWithSubcategories(this)">
                                            @foreach ($categories as $categorie)
                                                {{-- empty option --}}
                                                <option value="">Select Category</option>
                                                <option value="{{ $categorie->id }}">{{ $categorie->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="subCategory" class="form-label">Subcategory</label>
                                        <select class="form-control" name="sub_category_id" id="subcat_dropdown">
                                            @foreach ($subcategories as $subcategorie)
                                                {{-- empty option --}}
                                                <option value="">Select Subcategory</option>
                                                <option value="{{ $subcategorie->id }}">{{ $subcategorie->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="status" class="form-label">Status</label>
                                        <select class="form-control" id="status" name="is_published">
                                            <option value="">Select status</option>
                                            <option value="published">Published</option>
                                            <option value="unpublished">Unpublished</option>
                                            <option value="stockout">Stockout</option>
                                        </select>
                                    </div>
                                   
                                   
                                    
                                    <div class="col-md-4 mb-3">
                                        <label for="productName" class="form-label">Product Name</label>
                                        <select id="productName" name="pname[]" style="width: 500px;" class="form-control" multiple>
                                            <option value="" disabled selected>Select Product</option> 
                                            @foreach ($products as $product)
                                                <option value="{{ $product->id }}">{{ $product->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    


                                    <div class="col-md-4 mb-3">
                                        <label for="productCode" class="form-label">Product Code</label>
                                        <input type="text" class="form-control" id="productCode" name="product_code">
                                    </div>
                                    <div class="col-md-4 mb-3 d-flex align-items-end">
                                        <button type="submit" class="btn btn-primary">Filter</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Products Table -->

                <div class="col-12 mt-5">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">All Products</h5>
                            
                            <div class="d-flex justify-content-between mb-3">
                                <div class="d-flex align-items-center">
                                    <input type="checkbox" id="select-all" class="form-check-input me-2">
                                    <label for="select-all" class="form-check-label">Select All</label>
                                </div>
                                <div>

                                    <button type="button" class="btn btn-danger btn-sm" id="bulk-delete">Delete</button>
                                    <button type="button" class="btn btn-warning btn-sm bulk-unpublish">Unpublish</button>
                                    <button type="button" class="btn btn-success btn-sm bulk-publish">Publish</button>

                                </div>
                            </div>
                            <table class="table bordered-table mb-0 dataTable" id="dataTable" data-page-length="10"
                                style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th>
                                            <div class="form-check style-check d-flex align-items-center">
                                                <input class="form-check-input" type="checkbox">
                                                <label class="form-check-label">S.L</label>
                                            </div>
                                        </th>
                                        <th>Product Name</th>
                                        {{-- <th>Product Image</th> --}}
                                        <th>Product Code</th>
                                        <th>Product Category</th>
                                        <th>Sub-Category</th>
                                        <th>New Arrival</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $product)
                                        <tr>
                                            <td>
                                                <div class="form-check style-check d-flex align-items-center">
                                                    <input class="form-check-input product-checkbox" type="checkbox"
                                                        value="{{ $product->id }}">
                                                    <label class="form-check-label">{{ $loop->iteration }}</label>
                                                </div>
                                            </td>
                                            <td>
                                                {{-- {{ $product->name }} --}}
                                                <div class="d-flex align-items-center gap-2">
                                                    <img src="{{ $product->featured_image ? asset($product->featured_image) : '' }}"
                                                        alt="Product Image" class="product-image me-2"
                                                        style="width: 50px; height: 50px; object-fit: cover;">
                                                    <span>{{ $product->name }}</span>
                                                </div>

                                            </td>
                                            {{-- <td>
                                                <img  src="{{ $product->featured_image ? asset($product->featured_image) : '' }}" alt="Product Image"
                                                    style="width: 50px; height: 50px; object-fit: cover;">
                                            </td> --}}
                                            <td>{{ $product->product_code }}</td>
                                            <td>
                                                {{ $product->category_name ?? 'N/A' }}
                                            </td>
                                            <td>
                                                {{ $product->sub_category_name ?? 'N/A' }}
                                            </td>

                                            <td>
                                                @if ($product->is_new_arrival == '1')
                                                    <span class="badge bg-primary">New Arrival</span>
                                                @else
                                                    <span class="badge bg-secondary">Not New Arrival</span>
                                                @endif
                                            </td>

                                            <td>
                                                @if ($product->is_published == '1')
                                                    <span class="badge bg-success">Published</span>
                                                @else
                                                    <span class="badge bg-danger">Unpublished</span>
                                                @endif
                                            </td>


                                            <td>
                                                <div class="btn-group">
                                                    <button type="button"
                                                        class="btn btn-outline-secondary dropdown-toggle btn-sm"
                                                        data-bs-toggle="dropdown" aria-expanded="false">
                                                        Actions
                                                    </button>
                                                    <ul class="dropdown-menu">

                                                        <li><a class="dropdown-item text-warning"
                                                            href="{{ route('product-details', $product->slug) }}">View</a>
                                                        </li>

                                                        <li><a class="dropdown-item"
                                                                href="{{ route('dashboard.product.edit', $product->id) }}">Edit</a>
                                                        </li>
                                                        {{--  New Arrivals list  --}}
                                                        {{-- <li>


                                                            <a class="dropdown-item" href="#"
                                                                data-product-id="{{ $product->id }}"
                                                                onclick="toggleNewArrival('{{ route('dashboard.product.new-arrival') }}', {{ $product->id }})">
                                                                <i
                                                                    class="bi bi-star{{ $product->is_new_arrival ? '-fill' : '' }}"></i>
                                                                {{ $product->is_new_arrival ? 'Remove New Arrival' : 'Add New Arrival' }}
                                                            </a>

                                                        </li> --}}

                                                        <li>
                                                            <a class="dropdown-item" href="#"
                                                                data-product-id="{{ $product->id }}"
                                                                onclick="toggleNewArrival('{{ route('dashboard.product.new-arrival') }}', {{ $product->id }})">
                                                                <i class="bi bi-star{{ $product->is_new_arrival ? '-fill' : '' }}"></i>
                                                                {{ $product->is_new_arrival ? 'Remove New Arrival' : 'Add New Arrival' }}
                                                            </a>
                                                        </li>
                                                        

                                                        <li>
                                                            <a class="dropdown-item text-success" href="#"
                                                                onclick="handleAction('{{ route('dashboard.product.bulk-publish') }}', {{ $product->id }})">Publish</a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item text-warning" href="#"
                                                                onclick="handleAction('{{ route('dashboard.product.bulk-unpublish') }}', {{ $product->id }})">Unpublish</a>
                                                        </li>

                                                        <li>
                                                            <form
                                                                action="{{ route('dashboard.product.destroy', $product->id) }}"
                                                                method="POST" style="margin-left: 15px;">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="dropdown-item text-danger"
                                                                    style="border: none; background: none; padding: 0;">
                                                                    Delete
                                                                </button>
                                                            </form>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot></tfoot>
                            </table>

                        </div>
                    </div>
                </div>


            </div>
        </div>



        <!-- Include jQuery -->
    @endsection

    @section('js')
        {{-- 3 --}}


        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const table = $('#dataTable').DataTable();

                // Cached selectors for performance
                const bulkDeleteButton = $('#bulk-delete');
                const bulkUnpublishButton = $('.bulk-unpublish');
                const bulkPublishButton = $('.bulk-publish');
                const selectAllCheckbox = $('#select-all');
                const productCheckboxes = $('#dataTable').find('input.product-checkbox');

                let checkedIds = new Set();

                // Function to toggle the visibility of bulk action buttons
                // const updateButtons = () => {
                //     const anyChecked = checkedIds.size > 0;
                //     bulkDeleteButton.toggle(anyChecked);
                //     bulkUnpublishButton.toggle(anyChecked);
                //     bulkPublishButton.toggle(anyChecked);
                // };

                // Function to update the select all checkbox
                const updateSelectAll = () => {
                    const allCheckboxes = $('#dataTable').find('input.product-checkbox');
                    const allChecked = allCheckboxes.length === allCheckboxes.filter(':checked').length;
                    selectAllCheckbox.prop('checked', allChecked);
                };

                // Handle select/deselect all checkboxes on the current page
                selectAllCheckbox.on('change', function() {
                    const isChecked = $(this).is(':checked');
                    $('#dataTable').find('input.product-checkbox').each(function() {
                        const checkbox = $(this);
                        checkbox.prop('checked', isChecked);
                        if (isChecked) {
                            checkedIds.add(checkbox.val());
                        } else {
                            checkedIds.delete(checkbox.val());
                        }
                    });
                    updateButtons();
                });

                // Update checked IDs on individual checkbox change
                $('#dataTable').on('change', 'input.product-checkbox', function() {
                    const checkbox = $(this);
                    if (checkbox.is(':checked')) {
                        checkedIds.add(checkbox.val());
                    } else {
                        checkedIds.delete(checkbox.val());
                    }
                    updateButtons();
                    updateSelectAll();
                });

                // Handle page change to maintain checkbox states
                table.on('draw.dt', function() {
                    updateSelectAll();
                });

                // Generic function for handling bulk actions
                const handleBulkAction = async (actionUrl, successMessage) => {
                    const selectedIds = productCheckboxes.filter(':checked').map(function() {
                        return $(this).val();
                    }).get();

                    if (selectedIds.length === 0) {
                        Swal.fire({
                            icon: 'warning',
                            title: 'No products selected',
                            text: `Please select at least one product to ${successMessage.toLowerCase()}.`,
                        });
                        return;
                    }

                    const result = await Swal.fire({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: `Yes, ${successMessage.toLowerCase()} it!`,
                        cancelButtonText: 'Cancel'
                    });

                    if (result.isConfirmed) {
                        try {
                            const response = await $.post(actionUrl, {
                                _token: '{{ csrf_token() }}',
                                ids: selectedIds
                            });

                            Swal.fire(
                                `${successMessage}!`,
                                `Your products have been ${successMessage.toLowerCase()}.`,
                                'success'
                            ).then(() => {
                                location.reload();
                            });
                        } catch (error) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: `An error occurred while ${successMessage.toLowerCase()} the products.`,
                            });
                        }
                    }
                };

                // Bind bulk actions to their corresponding buttons
                bulkDeleteButton.on('click', () => handleBulkAction('{{ route('dashboard.product.bulk-delete') }}',
                    'Deleted'));
                bulkUnpublishButton.on('click', () => handleBulkAction(
                    '{{ route('dashboard.product.bulk-unpublish') }}', 'Unpublished'));
                bulkPublishButton.on('click', () => handleBulkAction('{{ route('dashboard.product.bulk-publish') }}',
                    'Published'));



                // Initialize Toastr notifications
                @if (session('success'))
                    toastr.success('{{ session('success') }}', 'Success');
                @endif

                @if (session('error'))
                    toastr.error('{{ session('error') }}', 'Error');
                @endif

              
                $('#productName').select2({
                    placeholder: 'Search for a product',
                    tags: true,
                  
                    data: @json(
                        $products->map(function ($product) {
                            return ['id' => $product->id, 'text' => $product->name];
                        })),
                    
                });

              

              



                // Initial update to set the correct state of the buttons
                updateButtons();
            });

            // Handle individual actions with auto-reload
            async function handleAction(url, productId) {
                const result = await Swal.fire({
                    title: 'Are you sure?',
                    text: "This action cannot be undone!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, do it!',
                    cancelButtonText: 'Cancel'
                });

                if (!result.isConfirmed) return;

                const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
                if (!csrfToken) {
                    Swal.fire({
                        icon: 'error',
                        title: 'CSRF Token Missing',
                        text: 'CSRF token not found or not available.',
                    });
                    return;
                }

                try {
                    const response = await fetch(url, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest',
                            'X-CSRF-TOKEN': csrfToken
                        },
                        body: JSON.stringify({
                            ids: [productId]
                        })
                    });

                    if (!response.ok) throw new Error('Failed to perform action.');

                    const data = await response.json();
                    Swal.fire({
                        icon: 'success',
                        title: 'Action Completed',
                        text: 'The action was completed successfully!',
                    }).then(() => {
                        location.reload(); // Auto-reload to reflect changes
                    });
                } catch (error) {
                    console.error('Error:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'An error occurred while processing your request.',
                    });
                }
            }
        </script>




        <script>
            function getCategoryWithSubcategories(ele) {

                $('#subcat_dropdown').empty();
                axios.get(`http://${window.location.hostname}:8000/api/${ele.value}/subcategory-all`).then((result) => {

                    result.data.forEach(element => {

                        $('#subcat_dropdown').append(`<option value="${element.id}">${element.name}</option>`);
                    })
                }).catch((err) => {

                });
            }
        </script>



        <script>
            async function toggleNewArrival(url, productId) {
                const result = await Swal.fire({
                    title: 'Are you sure?',
                    text: "This action will toggle the product's new arrival status.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, do it!',
                    cancelButtonText: 'Cancel'
                });

                if (!result.isConfirmed) return;

                const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
                if (!csrfToken) {
                    Swal.fire({
                        icon: 'error',
                        title: 'CSRF Token Missing',
                        text: 'CSRF token not found or not available.',
                    });
                    return;
                }

                try {
                    const response = await fetch(url, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest',
                            'X-CSRF-TOKEN': csrfToken
                        },
                        body: JSON.stringify({
                            ids: [productId]
                        })
                    });

                    if (!response.ok) throw new Error('Failed to perform action.');

                    const data = await response.json();

                    Swal.fire({
                        icon: 'success',
                        title: 'Action Completed',
                        text: data.message,
                    }).then(() => {
                        // Update the UI based on the new status
                        const starIcon = document.querySelector(`a[data-product-id="${productId}"] i`);
                        starIcon.classList.toggle('bi-star-fill');
                        starIcon.classList.toggle('bi-star');
                        if (data.is_new_arrival) {
                            starIcon.parentElement.innerText = 'Remove New Arrival';
                        } else {
                            starIcon.parentElement.innerText = 'Add New Arrival';
                        }
                        window.location.reload();
                    });
                } catch (error) {
                    console.error('Error:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'An error occurred while processing your request.',
                    });
                }
            }
        </script>
    @endsection


</div>
