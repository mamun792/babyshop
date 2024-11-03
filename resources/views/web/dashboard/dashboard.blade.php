@extends('web.dashboard.app')



@section('content')
    @include('web.dashboard.components.info_card')


    <div class="col-xxl-3 col-lg-6">
        <div class="card h-100 radius-8 border-0">
            <div class="card-body">
                
                <div class="d-flex align-items-center flex-wrap gap-2 justify-content-between">
                    <h6 class="fw-bold text-lg">Order Statistics</h6>
                </div>
                {{-- <div id="statisticsDonutChart" class="chart-container"></div> --}}

                <div id="loadingIndicator" style="display: none;">Loading...</div>
                <div id="statisticsDonutChart"></div>


                <div class="position-relative">
                    <div id="statisticsDonutChart" class="flex-grow-1 apexcharts-tooltip-z-none title-style circle-none">
                    </div>
                </div>




            </div>



        </div>
    </div>

    <div class="col-xxl-8 col-lg-6">
        <div class="card h-100">
            <div class="card-body p-24">
                <div class="d-flex align-items-center flex-wrap gap-2 justify-content-between mb-20">
                    <h6 class=" fw-bold text-lg mb-0">Recent Orders</h6>

                </div>
                <div class="table-responsive scroll-sm">
                    <table class="table bordered-table mb-0">
                        <thead>
                            <tr>
                                <th scope="col">Users</th>
                                <th scope="col">Invoice</th>
                                <th scope="col">Items</th>
                                <th scope="col">Qty</th>
                                <th scope="col">Amount</th>
                                <th scope="col" class="text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($orders->isEmpty())
                                <tr>
                                    <td colspan="6" class="text-center">
                                        <p class="text-muted">No orders available at this time.</p>
                                    </td>
                                </tr>
                            @else
                                @foreach ($orders as $order)
                                    <tr>
                                        <td>{{ $order['user_name'] }}</td>
                                        <td>{{ $order['invoice_number'] }}</td>
                                        <td>
                                            @foreach ($order['products'] as $product)
                                                <div style="padding-top: 10px; padding-bottom: 5px; font-size: 14px; color: #333;">
                                                    {{ $product['name'] }}
                                                </div>
                                            @endforeach
                                        </td>
                                        <td>{{ $order['total_quantity'] }}</td>
                                        <td>৳ {{ number_format($order['total_amount'], 2) }}</td>
                                        <td class="text-center">
                                            <span class="bg-success-focus text-success-main px-24 py-4 rounded-pill fw-medium text-sm">
                                                {{ ucfirst($order['order_status']) }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                    
                </div>
            </div>
        </div>
    </div>
    <div class="col-xxl-4 col-lg-6">
        <div class="card h-100">

            <div class="card-body">
                <div class="d-flex align-items-center flex-wrap gap-2 justify-content-between mb-20">
                    <h6 class="mb-2 fw-bold text-lg mb-0">Top Customers</h6>

                </div>

                <div class="mt-32">



                    

                    @if ($topCustomers->isEmpty())
                        <div class="text-center text-muted">
                            <p>No top customers available at this time.</p>
                        </div>
                    @else
                        @foreach ($topCustomers as $customer)
                            <div class="d-flex align-items-center justify-content-between gap-3 mb-32">
                                <div class="d-flex align-items-center gap-2">
                                    @if (!empty($customer['user_avatar']))
                                   
                                    <img src="{{ asset($customer['user_avatar']) }}" alt="Avatar" width="100"
                                         class="w-40-px h-40-px radius-8 flex-shrink-0">
                                @else
                                   
                                    <img src="{{ Avatar::create($customer['user_name'])->toBase64() }}"
                                         alt="Generated Avatar" width="100"
                                         class="w-40-px h-40-px radius-8 flex-shrink-0">
                                @endif

                                    <div class="flex-grow-1">
                                        <h6 class="text-md mb-0 fw-normal">{{ $customer['user_name'] }}</h6>
                                        <span
                                            class="text-sm text-secondary-light fw-normal">{{ substr($customer['user_phone'], 0, 3) . '******' . substr($customer['user_phone'], -2) }}</span>
                                    </div>
                                </div>
                                <span class="text-primary-light text-md fw-medium">Orders:
                                    {{ $customer['order_count'] }}</span>
                            </div>
                        @endforeach
                    @endif




                </div>
            </div>
        </div>
    </div>

    <div class="col-xxl-6">
        <div class="card h-100">
            <div class="card-body p-24">
                <div class="d-flex align-items-center flex-wrap gap-2 justify-content-between mb-20">
                    <h6 class="mb-2 fw-bold text-lg mb-0">Top Selling Product</h6>

                </div>
                <div class="table-responsive scroll-sm">
                    <table class="table bordered-table mb-0">
                        <thead>
                            <tr>
                                <th scope="col">Items</th>
                                <th scope="col">Price</th>
                                <th scope="col">Discount </th>
                                <th scope="col">Sold</th>
                                {{-- <th scope="col" class="text-center">Total Orders</th> --}}
                            </tr>
                        </thead>
                        <tbody>

                           

                            @if ($topSellingProducts->isEmpty())
                                <tr>
                                    <td colspan="4" class="text-center text-muted">
                                        <p>No top-selling products available at this time.</p>
                                    </td>
                                </tr>
                            @else
                                @foreach ($topSellingProducts as $product)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img src="{{ asset('assets/images/product/product-img1.png') }}"
                                                    alt="" class="flex-shrink-0 me-12 radius-8">
                                                <div class="flex-grow-1">
                                                    <h6 class="text-md mb-0 fw-normal">{{ $product->product_name }}</h6>
                                                    <span class="text-sm text-secondary-light fw-normal">Category</span>
                                                </div>
                                            </div>
                                        </td>
                                        {{-- <td>৳ {{ number_format($product->product_price, 2) }}</td> --}}
                                        <td>
                                            {{-- Check if discount price is greater than 0, otherwise show product price --}}
                                            ৳ 
                                            @if ($product->discount_price && $product->discount_price > 0)
                                                {{ number_format($product->discount_price, 2) }}
                                            @else
                                                {{ $product->product_price ? number_format($product->product_price, 2) : 'N/A' }}
                                            @endif
                                        </td>
                                        <td>
                                            @if ($product->order_items_max_coupon_discount)
                                                {{ $product->order_items_max_coupon_discount }}{{ $product->order_items_max_coupon_discount_type === 'percentage' ? '%' : '' }}
                                            @else
                                                <span>No discount</span>
                                            @endif

                                        </td>
                                        <td>{{ $product->order_items_sum_quantity }}</td>
                                    </tr>
                                @endforeach
                            @endif

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xxl-6">
        <div class="card h-100">
            <div class="card-body p-24">
                <div class="d-flex align-items-center flex-wrap gap-2 justify-content-between mb-20">
                    <h6 class="mb-2 fw-bold text-lg mb-0">Stock Report</h6>

                </div>
                <div class="table-responsive scroll-sm">
                    <table class="table bordered-table mb-0">
                        <thead>
                            <tr>
                                <th scope="col">Items</th>
                                <th scope="col">Price</th>
                                <th scope="col">
                                    <div class="max-w-112 mx-auto">
                                        <span>Stock</span>
                                    </div>
                                </th>
                            </tr>
                        </thead>
                        <tbody>

                           

                            @if ($stockReport->isEmpty())
                                <tr>
                                    <td colspan="4" class="text-center text-muted">
                                        <p>No stock report available at this time.</p>
                                    </td>
                                </tr>
                            @else
                                @foreach ($stockReport as $item)
                                    <tr>
                                        <td>{{ $item->product_name }}</td>
                                        <td>৳ {{ number_format($item->price, 2) }}</td>
                                        <td>
                                            <div class="max-w-112 mx-auto">
                                                <div class="w-100">
                                                    <div class="progress progress-sm rounded-pill" role="progressbar"
                                                        aria-label="Stock progress" aria-valuenow="{{ $item->quantity }}"
                                                        aria-valuemin="0" aria-valuemax="{{ $item->total_handled_stock }}">

                                                        @php
                                                            $percentage =
                                                                $item->total_handled_stock > 0
                                                                    ? ($item->quantity / $item->total_handled_stock) *
                                                                        100
                                                                    : 0;

                                                            if ($item->quantity == 0) {
                                                                $barColor = 'bg-secondary';
                                                                $statusText = 'Out of Stock';
                                                            } elseif ($item->quantity <= 5) {
                                                                $barColor = 'bg-danger';
                                                                $statusText = 'Low Stock';
                                                            } else {
                                                                $barColor = 'bg-primary-600';
                                                                $statusText = 'In Stock';
                                                            }
                                                        @endphp

                                                        <!-- Progress Bar -->
                                                        <div class="progress-bar {{ $barColor }} rounded-pill"
                                                            style="width: {{ $percentage }}%;">
                                                        </div>
                                                    </div>
                                                </div>
                                                <span
                                                    class="mt-12 text-secondary-light text-sm fw-medium">{{ $statusText }}
                                                    ({{ $item->quantity }} in stock)
                                                </span>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>



@endsection


@section('js')
   

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const loadingIndicator = document.getElementById('loadingIndicator');
            loadingIndicator.style.display = 'block'; // Show loading indicator

            // Function to fetch order statistics
            async function fetchOrderStatistics() {
                try {
                    const response = await fetch('/get-order-statistics');
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return await response.json();
                } catch (error) {
                    console.error('Error fetching order statistics:', error);
                    throw error; // Rethrow the error for further handling
                }
            }

            // Function to render the chart
            function renderChart(data) {
                const options = {
                    series: [
                        data.pending,
                        data.processing,
                        data.pending_delivery,
                        data.sent_to_steadfast,
                        data.delivered,
                        data.cancelled,
                        data.returned
                    ],
                    colors: [
                        '#007BFF', '#28A745', '#FFC107', '#DC3545', '#17A2B8', '#4682B4', '#FF6F00'
                    ],
                    labels: [
                        "Pending", "Processing", "Pending Delivery", "Sent to Steadfast",
                        "Delivered", "Cancelled", "Returned"
                    ],
                    legend: {
                        show: false
                    },
                    chart: {
                        type: 'donut',
                        height: 230,
                        sparkline: {
                            enabled: true
                        },
                        margin: {
                            top: 0,
                            right: 0,
                            bottom: 0,
                            left: 0
                        },
                        padding: {
                            top: 0,
                            right: 0,
                            bottom: 0,
                            left: 0
                        }
                    },
                    stroke: {
                        width: 5
                    },
                    dataLabels: {
                        enabled: false
                    },
                    responsive: [{
                        breakpoint: 480,
                        options: {
                            chart: {
                                width: 200
                            },
                            legend: {
                                position: 'bottom'
                            }
                        }
                    }],
                };

                // Create a new chart
                const chart = new ApexCharts(document.querySelector("#statisticsDonutChart"), options);
                chart.render();
            }

            // Fetch data and render the chart
            fetchOrderStatistics()
                .then(data => {
                    renderChart(data);
                    loadingIndicator.style.display = 'none'; // Hide loading indicator after rendering
                })
                .catch(() => {
                    loadingIndicator.style.display = 'none'; // Hide loading indicator on error
                });
        });
    </script>


    <script src="{{ asset('assets/backend/chart.js') }}"></script>
    <script>
        const statistics = @json($statistics) || {};





        createChart('new-pending-chart', '#45b369', statistics.monthlyOrders['monthlyPendingOrders']);

        createChart('total-sal-chart', '#8252e9', statistics.monthlyOrders['totalSales'] || 0);
        createChart('total-return-sales-chart', '#f77e53', statistics.monthlyOrders['totalReturnedOrdersSales'] || 0);
        createChart('total-cancel-sales-chart', '#8252e9', statistics.monthlyOrders['totalCancelledOrdersSales'] || 0);
        createChart('monthly-deleviry-chart', '#8252e9', statistics.monthlyOrders['monthlyDeliveredOrders']);
        createChart('total-return-chart', '#f77e53', statistics.monthlyOrders['monthlyReturnedOrders']);
    </script>
@endsection