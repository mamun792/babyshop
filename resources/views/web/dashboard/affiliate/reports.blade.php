@extends('web.dashboard.app', ['page' => 'affiliate-reports'])


@section('content')

<div class="card">
    <div class="card-header">
        <h5 class="card-title mb-0"> Reports</h5>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="container">
              
                <form method="GET" action="{{ route('dashboard.affiliate.reports') }}">
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <div class="input-group">
                                <span class="input-group-text" id="start_date_icon">
                                    <i class="fas fa-calendar-alt"></i>
                                </span>
                                <input type="date" name="start_date" id="start_date" class="form-control" aria-label="Start Date" aria-describedby="start_date_icon" value="{{ request('start_date') }}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="input-group">
                                <span class="input-group-text" id="end_date_icon">
                                    <i class="fas fa-calendar-alt"></i>
                                </span>
                                <input type="date" name="end_date" id="end_date" class="form-control" aria-label="End Date" aria-describedby="end_date_icon" value="{{ request('end_date') }}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <select name="date_filter" id="date_filter" class="form-select">
                                <option value="" disabled selected>Select Filter</option>
                                <option value="today" {{ request('date_filter') == 'today' ? 'selected' : '' }}>Today</option>
                                <option value="yesterday" {{ request('date_filter') == 'yesterday' ? 'selected' : '' }}>Yesterday</option>
                                <option value="this_week" {{ request('date_filter') == 'this_week' ? 'selected' : '' }}>This Week</option>
                                <option value="last_week" {{ request('date_filter') == 'last_week' ? 'selected' : '' }}>Last Week</option>
                                <option value="this_month" {{ request('date_filter') == 'this_month' ? 'selected' : '' }}>This Month</option>
                                <option value="last_month" {{ request('date_filter') == 'last_month' ? 'selected' : '' }}>Last Month</option>
                            </select>
                        </div>
                        <div class="col-md-3 d-flex align-items-end">
                            <button type="submit" class="btn btn-primary"><i class="fas fa-filter"></i> Filter</button>
                            <a href="{{ route('dashboard.affiliate.reports') }}" class="btn btn-secondary ms-2">Reset <i class="fas fa-undo"></i></a>
                        </div>
                    </div>
                </form>
                
                <table id="sales_report_table" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Product Name</th>
                            <th>Quantity Sold</th>
                            <th>Product Price</th>
                            <th>Date</th>
                            <th>Commission</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orderItems as $order)
                        <tr>
                            <td>{{ $order->order_id }}</td>
                            <td>{{ $order->product_name }}</td>
                            <td>{{ $order->quantity ?? 0 }}</td>  
                            <td>£{{ number_format($order->total_amount, 2) }}</td> 
                            <td>{{ \Carbon\Carbon::now()->format('Y-m-d') }}</td> 
                            <td>
                                £{{ number_format($order->commission_amount, 2) }}
                                @if(isset($order->commission_type))
                                (<span class="text-primary">{{ $order->commission_type === 'fixed' ? 'Fixed' : 'Percentage' }}</span>)
                            @endif
                        </td>  
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="3">Total</th>
                            <th>£
                                {{ number_format($orderItems ->sum('total_amount'), 2) }}
                            </th> <!-- Sum total_amount -->
                            <th></th>
                            <th>£
                                {{ number_format($orderItems ->sum('commission_amount'), 2) }}</th>
                        </tr>
                    </tfoot>
                </table>
                
            </div>

        </div>
    </div>
</div>

@endsection

@section('js')
<script>
    $(document).ready(function() {
        $('#sales_report_table').DataTable();
    });
</script>
@endsection