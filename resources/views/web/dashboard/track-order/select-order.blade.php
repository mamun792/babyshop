<div>
    @extends('web.dashboard.app', ['page' => 'My Oders'])
    @section('content')
        {{-- @include('web.dashboard.components.cards') --}}

        {{-- <div class="container my-4">
            <!-- Tabs Navigation -->
            <ul class="nav nav-tabs" id="orderTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" id="all-tab" data-bs-toggle="tab" href="#all" role="tab"
                        aria-controls="all" aria-selected="true">All</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="pay-to-tab" data-bs-toggle="tab" href="#pay-to" role="tab"
                        aria-controls="pay-to" aria-selected="false">To Pay</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="ship-to-tab" data-bs-toggle="tab" href="#ship-to" role="tab"
                        aria-controls="ship-to" aria-selected="false">To Ship</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="receive-tab" data-bs-toggle="tab" href="#receive" role="tab"
                        aria-controls="receive" aria-selected="false">Receive</a>
                </li>
            </ul>

            <!-- Tabs Content -->
            <div class="tab-content mt-3" id="orderTabsContent">
                <!-- All Tab -->
                <div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="all-tab">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <table id="orderTable" class="table table-striped table-bordered nowrap" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th>Order #</th>
                                        <th>Placed On</th>
                                        <th>Product</th>
                                        <th>Qty</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($recentOrders as $order)
                                        <tr>
                                            <td>#{{ $order->order_id }}</td>
                                            <td>{{ \Carbon\Carbon::parse($order->placed_on)->format('d M Y H:i:s') }}</td>
                                            <td>
                                                @if ($order->featured_image)
                                                    <img src="{{ asset('path/to/images/' . $order->featured_image) }}"
                                                        alt="{{ $order->product_name }}" class="img-thumbnail"
                                                        style="max-width: 50px;">
                                                @else
                                                    <img src="https://via.placeholder.com/50" alt="Product Image"
                                                        class="img-thumbnail" style="max-width: 50px;">
                                                @endif
                                                {{ $order->product_name }}
                                            </td>
                                            <td>{{ $order->quantity }}</td>
                                            <td>
                                                @if ($order->order_status === 'Cancelled')
                                                    <span class="badge bg-danger">Cancelled</span>
                                                @else
                                                    <span
                                                        class="badge bg-success">{{ ucfirst($order->order_status) }}</span>
                                                @endif
                                            </td>
                                            <td><a href="#" class="btn btn-primary btn-sm">Manage</a></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

               
                <!-- To Pay Tab -->
                <div class="tab-pane fade" id="pay-to" role="tabpanel" aria-labelledby="pay-to-tab">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            @if ($recentOrders->isEmpty())
                                <p class="text-muted">No orders to pay for.</p>
                            @else
                                <!-- Display orders here -->
                                <table id="orderTable" class="table table-striped table-bordered nowrap"
                                    style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>Order #</th>
                                            <th>Placed On</th>
                                            <th>Product</th>
                                            <th>Qty</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($recentOrders as $order)
                                            <tr>
                                                <td>#{{ $order->order_id }}</td>
                                                <td>{{ \Carbon\Carbon::parse($order->placed_on)->format('d M Y H:i:s') }}
                                                </td>
                                                <td>
                                                    @if ($order->featured_image)
                                                        <img src="{{ asset('path/to/images/' . $order->featured_image) }}"
                                                            alt="{{ $order->product_name }}" class="img-thumbnail"
                                                            style="max-width: 50px;">
                                                    @else
                                                        <img src="https://via.placeholder.com/50" alt="Product Image"
                                                            class="img-thumbnail" style="max-width: 50px;">
                                                    @endif
                                                    {{ $order->product_name }}
                                                </td>
                                                <td>{{ $order->quantity }}</td>
                                                <td>
                                                    @if ($order->order_status === 'Cancelled')
                                                        <span class="badge bg-danger">Cancelled</span>
                                                    @else
                                                        <span
                                                            class="badge bg-success">{{ ucfirst($order->order_status) }}</span>
                                                    @endif
                                                </td>
                                                <td><a href="#" class="btn btn-primary btn-sm">Manage</a></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @endif
                        </div>
                    </div>
                </div>


                <!-- To Ship Tab -->
                <div class="tab-pane fade" id="ship-to" role="tabpanel" aria-labelledby="ship-to-tab">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <p class="text-muted">No orders to ship.</p>
                        </div>
                    </div>
                </div>

                <!-- Receive Tab -->
                <div class="tab-pane fade" id="receive" role="tabpanel" aria-labelledby="receive-tab">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <p class="text-muted">No orders to receive.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}

        {{-- <div class="container my-4">
            <!-- Tabs Navigation -->
            <ul class="nav nav-tabs" id="orderTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" id="all-tab" data-bs-toggle="tab" href="#all" role="tab"
                        aria-controls="all" aria-selected="true">All</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="pay-to-tab" data-bs-toggle="tab" href="#pay-to" role="tab"
                        aria-controls="pay-to" aria-selected="false">To Pay</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="ship-to-tab" data-bs-toggle="tab" href="#ship-to" role="tab"
                        aria-controls="ship-to" aria-selected="false">To Ship</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="receive-tab" data-bs-toggle="tab" href="#receive" role="tab"
                        aria-controls="receive" aria-selected="false">Receive</a>
                </li>
            </ul>

            <!-- Tabs Content -->
            <div class="tab-content mt-3" id="orderTabsContent">
                <!-- All Tab -->
                <div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="all-tab">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <table id="orderTable" class="table table-striped table-bordered nowrap" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th>Order #</th>
                                        <th>Placed On</th>
                                        <th>Product</th>
                                        <th>Qty</th>
                                        <th>Status</th>
                                       
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($recentOrders->flatten() as $order)
                                        <tr>
                                            <td>#OD-{{ $order->order_id }}</td>
                                            <td>{{ \Carbon\Carbon::parse($order->placed_on)->format('d M Y H:i:s') }}</td>
                                            <td>
                                                <img src="{{ $order->featured_image ? asset('path/to/images/' . $order->featured_image) : 'https://via.placeholder.com/50' }}"
                                                    alt="{{ $order->product_name }}" class="img-thumbnail"
                                                    style="max-width: 50px;">
                                                {{ $order->product_name }}
                                            </td>
                                            <td>{{ $order->quantity }}</td>
                                            <td>
                                                <span
                                                    class="badge {{ $order->order_status === 'Cancelled' ? 'bg-danger' : 'bg-success' }}">
                                                    {{ ucfirst($order->order_status) }}
                                                </span>
                                            </td>
                                           
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- To Pay Tab -->
                <div class="tab-pane fade" id="pay-to" role="tabpanel" aria-labelledby="pay-to-tab">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            @if ($recentOrders->has('Pending'))
                                <table id="payTable" class="table table-striped table-bordered nowrap"
                                    style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>Order #</th>
                                            <th>Placed On</th>
                                            <th>Product</th>
                                            <th>Qty</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($recentOrders->get('Pending') as $order)
                                            <tr>
                                                <td>#{{ $order->order_id }}</td>
                                                <td>{{ \Carbon\Carbon::parse($order->placed_on)->format('d M Y H:i:s') }}
                                                </td>
                                                <td>
                                                    <img src="{{ $order->featured_image ? asset('path/to/images/' . $order->featured_image) : 'https://via.placeholder.com/50' }}"
                                                        alt="{{ $order->product_name }}" class="img-thumbnail"
                                                        style="max-width: 50px;">
                                                    {{ $order->product_name }}
                                                </td>
                                                <td>{{ $order->quantity }}</td>
                                                <td>
                                                    <span
                                                        class="badge bg-warning">{{ ucfirst($order->order_status) }}</span>
                                                </td>
                                                <td><a href="#" class="btn btn-primary btn-sm">Manage</a></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                                <p class="text-muted">No orders to pay for.</p>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- To Ship Tab -->
                <div class="tab-pane fade" id="ship-to" role="tabpanel" aria-labelledby="ship-to-tab">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            @if ($recentOrders->has('Processing'))
                                <table id="shipTable" class="table table-striped table-bordered nowrap"
                                    style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>Order #</th>
                                            <th>Placed On</th>
                                            <th>Product</th>
                                            <th>Qty</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($recentOrders->get('Processing') as $order)
                                            <tr>
                                                <td>#{{ $order->order_id }}</td>
                                                <td>{{ \Carbon\Carbon::parse($order->placed_on)->format('d M Y H:i:s') }}
                                                </td>
                                                <td>
                                                    <img src="{{ $order->featured_image ? asset('path/to/images/' . $order->featured_image) : 'https://via.placeholder.com/50' }}"
                                                        alt="{{ $order->product_name }}" class="img-thumbnail"
                                                        style="max-width: 50px;">
                                                    {{ $order->product_name }}
                                                </td>
                                                <td>{{ $order->quantity }}</td>
                                                <td>
                                                    <span class="badge bg-info">{{ ucfirst($order->order_status) }}</span>
                                                </td>
                                                <td><a href="#" class="btn btn-primary btn-sm">Manage</a></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                                <p class="text-muted">No orders to ship.</p>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Receive Tab -->
                <div class="tab-pane fade" id="receive" role="tabpanel" aria-labelledby="receive-tab">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            @if ($recentOrders->has('On Delivery'))
                                <table id="receiveTable" class="table table-striped table-bordered nowrap"
                                    style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>Order #</th>
                                            <th>Placed On</th>
                                            <th>Product</th>
                                            <th>Qty</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($recentOrders->get('On Delivery') as $order)
                                            <tr>
                                                <td>#{{ $order->order_id }}</td>
                                                <td>{{ \Carbon\Carbon::parse($order->placed_on)->format('d M Y H:i:s') }}
                                                </td>
                                                <td>
                                                    <img src="{{ $order->featured_image ? asset('path/to/images/' . $order->featured_image) : 'https://via.placeholder.com/50' }}"
                                                        alt="{{ $order->product_name }}" class="img-thumbnail"
                                                        style="max-width: 50px;">
                                                    {{ $order->product_name }}
                                                </td>
                                                <td>{{ $order->quantity }}</td>
                                                <td>
                                                    <span
                                                        class="badge bg-success">{{ ucfirst($order->order_status) }}</span>
                                                </td>
                                                <td><a href="#" class="btn btn-primary btn-sm">Manage</a></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                                <p class="text-muted">No orders to receive.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}

        <div class="container my-4">
            <!-- Tabs Navigation -->
            <ul class="nav nav-tabs" id="orderTabs" role="tablist" style="background-color: #ffffff;">
                <li class="nav-item" role="presentation" >
                    <a class="nav-link active" id="all-tab" data-bs-toggle="tab" href="#all" role="tab" aria-controls="all" aria-selected="true">All</a>
                </li>
               
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="ship-to-tab" data-bs-toggle="tab" href="#ship-to" role="tab" aria-controls="ship-to" aria-selected="false">To Cancel</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="receive-tab" data-bs-toggle="tab" href="#receive" role="tab" aria-controls="receive" aria-selected="false">Receive</a>
                </li>
            </ul>
        
            <!-- Tabs Content -->
            <div class="tab-content mt-3" id="orderTabsContent">
                <!-- All Tab -->
                <div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="all-tab">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <table id="orderTable" class="table table-striped table-bordered nowrap" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th>Order #</th>
                                        <th>Placed On</th>
                                        <th>Product</th>
                                        <th>Qty</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($recentOrders->flatten() as $order)
                                        <tr>
                                            <td>#OD-{{ $order->order_id }}</td>
                                            <td>
                                                <span>{{ \Carbon\Carbon::parse($order->placed_on)->diffForHumans() }}</span><br>
                                                <small class="text-muted">{{ \Carbon\Carbon::parse($order->placed_on)->format('d M Y') }}</small>
                                            </td>
                                            <td class="d-flex align-items-center">
                                                <img src="{{ asset($order->featured_image) }}" alt="{{ $order->product_name }}" class="img-thumbnail me-2"
                                                     style="max-width: 50px;">
                                                <span>{{ $order->product_name }}</span>
                                            </td>
                                            
                                            <td>{{ $order->quantity }}</td>
                                            <td>
                                                <span class="badge {{ $order->order_status === 'Cancelled' ? 'bg-danger' : 'bg-success' }}">
                                                    {{ ucfirst($order->order_status) }}
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
        
              
        
                <!-- To Ship Tab -->
                <div class="tab-pane fade" id="ship-to" role="tabpanel" aria-labelledby="ship-to-tab">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            @if ($recentOrders->has('cancelled'))
                                <table id="shipTable" class="table table-striped table-bordered nowrap" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>Order #</th>
                                            <th>Placed On</th>
                                            <th>Product</th>
                                            <th>Qty</th>
                                            <th>Status</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($recentOrders->get('cancelled') as $order)
                                            <tr>
                                                <td>#{{ $order->order_id }}</td>
                                                <td>{{ \Carbon\Carbon::parse($order->placed_on)->format('d M Y H:i:s') }}</td>
                                                <td>
                                                    <img src="{{ $order->featured_image ? asset('path/to/images/' . $order->featured_image) : 'https://via.placeholder.com/50' }}"
                                                        alt="{{ $order->product_name }}" class="img-thumbnail" style="max-width: 50px;">
                                                    {{ $order->product_name }}
                                                </td>
                                                <td>{{ $order->quantity }}</td>
                                                <td>
                                                    <span class="badge bg-info">{{ ucfirst($order->order_status) }}</span>
                                                </td>
                                               
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                                <p class="text-muted">No orders to ship.</p>
                            @endif
                        </div>
                    </div>
                </div>
        
                <!-- Receive Tab -->
                <div class="tab-pane fade" id="receive" role="tabpanel" aria-labelledby="receive-tab">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            @if ($recentOrders->has('delivered'))
                                <table id="receiveTable" class="table table-striped table-bordered nowrap" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>Order #</th>
                                            <th>Placed On</th>
                                            <th>Product</th>
                                            <th>Qty</th>
                                            <th>Status</th>
                                          
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($recentOrders->get('delivered') as $order)
                                            <tr>
                                                <td>#{{ $order->order_id }}</td>
                                                <td>{{ \Carbon\Carbon::parse($order->placed_on)->format('d M Y H:i:s') }}</td>
                                                <td>
                                                    <img src="{{ $order->featured_image ? asset('path/to/images/' . $order->featured_image) : 'https://via.placeholder.com/50' }}"
                                                        alt="{{ $order->product_name }}" class="img-thumbnail" style="max-width: 50px;">
                                                    {{ $order->product_name }}
                                                </td>
                                                <td>{{ $order->quantity }}</td>
                                                <td>
                                                    <span class="badge bg-success">{{ ucfirst($order->order_status) }}</span>
                                                </td>
                                               
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                                <p class="text-muted">No orders to receive.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        

    @endsection

    @section('js')
        <script>
            $(document).ready(function() {
                $('#orderTable').DataTable({
                    responsive: true,
                    autoWidth: false,
                    order: [
                        [1, 'desc']
                    ]
                });
            });
        </script>
    @endsection

    @section('js')
        <script>
            $(document).ready(function() {
                $('#orderTable').DataTable({
                    responsive: true,
                    autoWidth: false,
                    order: [
                        [1, 'desc']
                    ]
                });
            });
        </script>
    @endsection
</div>
