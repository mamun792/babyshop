@extends('web.dashboard.app', ['page' => 'affiliate-orders'])



@section('content')
    <section class="order-table-section">

        <div class="row row-cols-xxxl-4 row-cols-lg-4 row-cols-sm-2 row-cols-1 gy-4">
            <div class="col">
                <div class="card shadow-none border bg-gradient-start-1 h-100">
                    <div class="card-body p-20">
                        <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                            <div>
                                <p class="fw-medium text-primary-light mb-1">Total Earning</p>
                                <h6 class="mb-0">{{ $user->earnings->sum('commission_amount') }}</h6>
                            </div>
                            <div class="w-50-px h-50-px bg-cyan rounded-circle d-flex justify-content-center align-items-center">
                                <iconify-icon icon="gridicons:multiple-users" class="text-white text-2xl mb-0"></iconify-icon>
                            </div>
                        </div>
                    </div>
                </div><!-- card end -->
            </div>
        
            <div class="col">
                <div class="card shadow-none border bg-gradient-start-2 h-100">
                    <div class="card-body p-20">
                        <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                            <div>
                                <p class="fw-medium text-primary-light mb-1">Pending Withdraw</p>
                                <h6 class="mb-0">{{ $user->withdraws->where('status','unpaid')->sum('amount') }}</h6>
                            </div>
                            <div class="w-50-px h-50-px bg-purple rounded-circle d-flex justify-content-center align-items-center">
                                <iconify-icon icon="fa-solid:award" class="text-white text-2xl mb-0"></iconify-icon>
                            </div>
                        </div>
                    </div>
                </div><!-- card end -->
            </div>
        
            <div class="col">
                <div class="card shadow-none border bg-gradient-start-3 h-100">
                    <div class="card-body p-20">
                        <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                            <div>
                                <p class="fw-medium text-primary-light mb-1">Successful</p>
                                <h6 class="mb-0"><h6 class="mb-0">{{ $user->withdraws->where('status','paid')->sum('amount') }}</h6></h6>
                            </div>
                            <div class="w-50-px h-50-px bg-info rounded-circle d-flex justify-content-center align-items-center">
                                <iconify-icon icon="fluent:people-20-filled" class="text-white text-2xl mb-0"></iconify-icon>
                            </div>
                        </div>
                    </div>
                </div><!-- card end -->
            </div>
        
            <div class="col">
                <div class="card shadow-none border bg-gradient-start-4 h-100">
                    <div class="card-body p-20">
                        <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                            <div>
                                <p class="fw-medium text-primary-light mb-1">Rejected</p>
                                <h6 class="mb-0"><h6 class="mb-0">{{ $user->withdraws->where('status','rejected')->sum('amount') }}</h6></h6>
                            </div>
                            <div class="w-50-px h-50-px bg-success-main rounded-circle d-flex justify-content-center align-items-center">
                                <iconify-icon icon="solar:wallet-bold" class="text-white text-2xl mb-0"></iconify-icon>
                            </div>
                        </div>
                    </div>
                </div><!-- card end -->
            </div>
        </div>
        
     
        


        <div class="card mt-5">
            <div class="card-header">
              
                <h5 class="card-title mb-0"> Orders Processed</h5>
            </div>
            <div class="card-body">

                <div class="table-responsive">
                    <div id="loadingSpinner" style="display: none;">
                        <p>Loading...</p>
                    </div>
                    <table id="ordersTable" class="table table-bordered table-striped table-hover text-center">
                        <thead class="table-light">
                            <tr>
                                <th>Invoice Number</th>
                                <th>Customer Name</th>
                                <th>Product Details</th>
                                <th>Amount</th>
                                <th>Status</th>
                               
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($orderItems as $item)
                                <tr>
                                    <!-- Invoice Number -->
                                    <td>{{ $item->invoice_number ?? 'N/A' }}</td>
                    
                                    <!-- Customer Name -->
                                    <td>{{ $item->customer_name ?? 'N/A' }}</td>
                    
                                    <!-- Product Details -->
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <!-- Product Image -->
                                            @if(!empty($item->featured_image))
                                                <img src="{{ asset($item->featured_image) }}" alt="Product Image" class="img-thumbnail" style="max-width: 50px; height: auto;">
                                            @endif
                                            <!-- Product Name -->
                                            <div class="ms-2">
                                                <strong>{{ $item->product_name }}</strong>
                                            </div>
                                        </div>
                                    </td>
                                    
                    
                                    <td>
                                        <div class="d-flex flex-column align-items-start">
                                            <!-- Total Amount -->
                                            <h6 class="mb-1">${{ number_format($item->total_amount, 2) }}</h6>
                                    
                                           
                                    
                                            <!-- Commission Amount with Type -->
                                            <small class="text-muted">
                                                Commission: ${{ number_format($item->commission_amount, 2) }} 
                                                @if(isset($item->commission_type))
                                                    (<span class="text-primary">{{ $item->commission_type === 'fixed' ? 'Fixed' : 'Percentage' }}</span>)
                                                @endif
                                            </small>
                                        </div>
                                    </td>
                                    

                                    
                                    
                    
                                    <!-- Status -->
                                    <td><span class="badge bg-warning text-dark">
                                        {{ $item->order_status ?? 'N/A' }}
                                        </span></td>
                    
                                    <!-- Action Button -->
                                    
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">No orders found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    
                </div>
                <div class="total-orders mt-3">
                    <h6>Total Orders Processed: <span id="totalOrders"></span></h6>
                </div>

            </div>
            </div>
    </section>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            // Initialize DataTable
            const table = $('#ordersTable').DataTable({
                "paging": true,
                "ordering": true,
                "searching": true,
                "info": false
            });

            // Display total orders processed
            $('#totalOrders').text(table.rows().count());
        });
    </script>
@endsection
