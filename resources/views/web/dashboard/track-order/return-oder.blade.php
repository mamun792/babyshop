<div>
    @extends('web.dashboard.app', ['page' => 'My Returns'])
    @section('content')
        {{-- @include('web.dashboard.components.cards') --}}

      
            
        <div class="container mt-5">
            
            <div class="card shadow-sm">
                <div class="card-header">
                    <h6  class="card-title mb-0" >My Returned Orders</h6>
                </div>
                
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="returnsTable" class="table table-bordered table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>Order</th>
                                    <th>Placed on</th>
                                    <th>Product</th>
                                    <th>Qty</th>
                                    <th>Status</th>
                                   
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($returnedOrders as $order)
                                    <tr>
                                        <td>Order #{{ $order->order_id }}</td>
                                        {{-- <td>{{ \Carbon\Carbon::parse($order->placed_on)->format('d M Y ') }}</td> --}}
                                        <td>
                                            <span>{{ \Carbon\Carbon::parse($order->placed_on)->diffForHumans() }}</span><br>
                                            <small class="text-muted">{{ \Carbon\Carbon::parse($order->placed_on)->format('d M Y') }}</small>
                                        </td>
                                        

                                        <td>{{ mb_substr($order->product_name, 0, 50) . '...' }}</td>
                                        <td>{{ $order->quantity }}</td>
                                        <td><span class="badge bg-danger">{{ $order->order_status }}</span></td>
                                       
                                    </tr>
                                @endforeach
                                <!-- Add more rows as needed -->
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
                $('#returnsTable').DataTable({
                    responsive: true,
                    autoWidth: false,
                    order: [
                        [1, 'desc']
                    ], // Order by the "Placed on" column
                    pageLength: 10
                });
            });
        </script>
    @endsection
</div>
