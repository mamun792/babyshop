@extends('web.dashboard.app', ['page' => 'My Cancellations'])

@section('content')
    {{-- @include('web.dashboard.components.cards') --}}

    <div class="container mt-5">
      
       
        <div class="card shadow-sm  basic-data-table">
            <div class="card-header">
                <h6  class="card-title mb-0" >My Cancellations</h6>
            </div>
            <div class="card-body">
                <!-- Loop through each cancellation order -->
                @foreach ($cancelledOrders as $order)
                    <div class="row mb-4">
                        <div class="col-12 col-md-6">
                            <p><strong>Requested on:</strong>
                                {{ \Carbon\Carbon::parse($order->placed_on)->format('d M Y') }}</p>
                            <p><strong>Order #:</strong> {{ $order->order_id }}</p>
                        </div>

                    </div>
                @endforeach
                <div class="table-responsive">
                    <table id="cancellationTable" class="table table-bordered table-hover">
                        <thead class="table-light">
                            <tr>
                                
                                <th>Order #</th>
                                <th>Product</th>
                                <th>Quantity</th>
                                <th>Status</th>
                                <th>Requested On</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cancelledOrders as $order)
                                <tr>
                                   
                                       

                                    
                                   
                                    <td>{{ $order->order_id }}</td>
                                    <td class="d-flex align-items-center">
                                        <img src="{{ asset($order->featured_image) }}" alt="{{ $order->product_name }}" class="img-thumbnail me-2"
                                             style="max-width: 50px;">
                                        <span>{{ $order->product_name }}</span>
                                    </td>
                                    <td>{{ $order->quantity }}</td>
                                    <td><span class="badge bg-danger">{{ $order->order_status }}</span></td>
                                    <td>
                                        <span>{{ \Carbon\Carbon::parse($order->placed_on)->diffForHumans() }}</span><br>
                                        <small class="text-muted">{{ \Carbon\Carbon::parse($order->placed_on)->format('d M Y') }}</small>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $('#cancellationTable').DataTable({
                responsive: true,
                autoWidth: false,
                order: [
                    [5, 'desc']
                ],
                pageLength: 10
            });
        });
    </script>
@endsection
