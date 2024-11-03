<div>
    @extends('web.dashboard.app', ['page' => 'order'])
    @section('content')
        <div class="container mt-5">
            <div class="card shadow-sm">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Order Report</h5>
                    {{-- <a href="#" class="btn btn-primary">Download PDF</a> --}}
                    <a href="#" class="btn btn-primary submits" data-table-id="orderReportTable"
                        data-filename="order_report.pdf">Download PDF</a>
                </div>



                <div class="card-body">
                    <form action="{{ route('dashboard.reports.order') }}" method="GET" class="mb-3">
                        <div class="row">
                            <div class="col-md-3">
                                <label for="start_date" class="form-label">Start Date:</label>
                                <input type="date" class="form-control" id="start_date" name="start_date"
                                    value="{{ request('start_date') }}">
                            </div>
                            <div class="col-md-3">
                                <label for="end_date" class="form-label">End Date:</label>
                                <input type="date" class="form-control" id="end_date" name="end_date"
                                    value="{{ request('end_date') }}">
                            </div>
                            <div class="col-md-3">
                                <label for="date_filter" class="form-label">Filter by Date:</label>
                                <select class="form-select" id="date_filter" name="date_filter">
                                    <option value="">Select</option>
                                    <option value="today" {{ request('date_filter') === 'today' ? 'selected' : '' }}>Today
                                    </option>
                                    <option value="yesterday"
                                        {{ request('date_filter') === 'yesterday' ? 'selected' : '' }}>Yesterday</option>
                                    <option value="last_7_days"
                                        {{ request('date_filter') === 'last_7_days' ? 'selected' : '' }}>Last 7 Days
                                    </option>
                                    <option value="this_month"
                                        {{ request('date_filter') === 'this_month' ? 'selected' : '' }}>This Month</option>
                                    <option value="last_month"
                                        {{ request('date_filter') === 'last_month' ? 'selected' : '' }}>Last Month</option>
                                </select>
                            </div>
                            <div class="col-md-3 d-flex align-items-end">
                                {{-- <button class="btn btn-primary  w-100" type="submit">Filter</button> --}}
                                <button class="btn btn-primary w-100 me-2" type="submit">
                                    <i class="bi bi-filter me-2"></i> Filter
                                </button>
                                <a href="{{ route('dashboard.reports.order') }}" class="btn btn-secondary w-100">
                                    <i class="fas fa-sync-alt me-2"></i> Reset

                                </a>

                            </div>
                        </div>
                    </form>

                    {{-- <table id="orderReportTable" class="table table-striped table-bordered">
                        <thead class="table-light">
                            <tr>
                                <th>Invoice No</th>
                                <th>Date</th>
                                <th>Product</th>
                                <th>Quantity</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($orders as $order)
                                <tr>
                                    <td >{{ $order->invoice_number }}</td>
                                    <td >{{ \Carbon\Carbon::parse($order->created_at)->format('Y-m-d') }}</td>
                                    
                                    <!-- Loop through each item in the order -->
                                    <td class="ms-2">
                                   
                                        @foreach ($order->orderItems as $index => $item)
                                            @if ($item->product)
                                                {{ $item->product->name }}
                                                @endif
                                                @endforeach
                                               
                                            </td>
                                        <td>{{ $item->orderItems->quantity ?? 0 }}</td>
                                        <td>{{ $order->total_amount}}</td>
                        
                                      
                                       
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">No orders available at this time.</td>
                                </tr>
                            @endforelse
                        </tbody> --}}

                        <table id="orderReportTable" class="table table-striped table-bordered">
                            <thead class="table-light">
                                <tr>
                                    <th>Invoice No</th>
                                    <th>Date</th>
                                    <th>Product</th>
                                    <th>Quantity</th>
                                    <th>Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($orders as $order)
                                    <!-- First row for the order with invoice number, date, and first product details -->
                                    <tr>
                                        <td >{{ $order['invoice_number'] }}</td>
                                        <td >{{ \Carbon\Carbon::parse($order['created_at']) }}</td>
                                        
                                        <!-- Loop through each product in the order -->
                                      <td>
                                            @foreach ($order['products'] as $product)
                                            <div style="padding-top: 10px; padding-bottom: 5px; font-size: 14px; color: #333;">
                                                {{ $product['name'] }}
                                            </div>
                                        @endforeach
                                    </td>
                                    <td>{{ $order['total_quantity'] }}</td>



                                        <td>{{ number_format($order['total_amount'], 2) }}</td>
                                    </tr>
                               
                                  
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">No orders available at this time.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        
                        
                        
                        
                        <tfoot>
                            <tr>
                                <th colspan="4" class="text-end">Total:</th>
                                {{-- <th>{{ $totalQuantity }}</th> --}}
                                <th class="text-end">
                                    <span>৳</span> {{ number_format($totalPrice, 2) }}
                                </th>


                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    @endsection
    @section('js')
        <script src="{{ asset('assets/backend/report.js') }}"></script>


        <script>
            $(document).ready(function() {
                $('#orderReportTable').DataTable({
                    "paging": true,
                    "ordering": true,
                    "info": true,
                    "searching": true,
                    "lengthChange": true,
                    "pageLength": 10,
                    "language": {
                        "search": "Filter records:"
                    }
                });
            });
        </script>
    @endsection
</div>
