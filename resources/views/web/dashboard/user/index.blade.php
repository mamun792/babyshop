<div>
    @extends('web.dashboard.app', ['page' => 'user'])
    @section('content')
        {{-- @include('web.dashboard.components.cards') --}}
        {{-- header personal info --}}
        <div class="">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div class="flex-grow-1 text-center">
                        <h5 class="card-title mb-0">Edit Personal Profile</h5>
                    </div>
                </div>
                
            </div>
        </div>

        <div class="container my-4">
            <div class="row">
                <!-- Personal Profile Card -->
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-header d-flex justify-content-between align-items-center bg-light border-bottom">
                            <span class="font-weight-bold">Personal Profile</span>
                            <a href="{{ route('dashboard.address-book.profile.edit', $user->id) }}" class="btn btn-sm btn-primary">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title font-weight-bold">{{$user->name}}</h5>
                            <p class="card-text text-muted">{{$user->email}}</p>
                            {{-- <a href="#" class="btn btn-link">Subscribe to our Newsletter</a> --}}
                        </div>
                    </div>
                </div>

                <!-- Address Book Card -->
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-header d-flex justify-content-between align-items-center bg-light border-bottom">
                            <span class="font-weight-bold">Address Book</span>
                            <a href="{{ route('dashboard.address-book.address-book') }}" class="btn btn-sm btn-primary">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                        </div>
                       

                        <div class="card-body">
                            <h5 class="card-title font-weight-bold">DEFAULT DELIVERY ADDRESS</h5>
                            @if($defaultDelivery)
                                <p class="card-text text-muted">
                                    {{ $defaultDelivery->full_name }}<br>
                                    {{ $defaultDelivery->address }}<br>
                                    {{ $defaultDelivery->area }} - {{ $defaultDelivery->landmark }}<br>
                                    <a href="tel:+{{ $defaultDelivery->mobile_number }}">(+{{ $defaultDelivery->mobile_number }})</a>
                                </p>
                            @else
                                <p class="card-text text-muted">No default delivery address set.</p>
                            @endif
                        </div>
                        
                    </div>
                </div>
                

                <!-- Default Billing Address Card -->
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-header bg-light border-bottom">
                            <span class="font-weight-bold">DEFAULT BILLING ADDRESS</span>
                        </div>
                        <div class="card-body">
                           
                                @if( $defaultBilling)
                                <p class="card-text text-muted">
                                    {{ $defaultBilling->full_name }}<br>
                                    {{  $defaultBilling->address }}<br>
                                    {{  $defaultBilling->area }} - {{ $defaultBilling->landmark }}<br>
                                    <a href="tel:+{{  $defaultBilling->mobile_number }}">(+{{ $defaultDelivery->mobile_number }})</a>
                                </p>
                            @else
                                <p class="card-text text-muted">No default delivery address set.</p>
                            @endif
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container my-4">
            <div class="card shadow-sm">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div class="flex-grow-1 text-center">
                        <h6 class="mb-0">Recent Orders</h5>
                    </div>
                 
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="ordersTable" class="table table-striped table-bordered">
                            <thead class="thead-light">
                                <tr>
                                    <th>Order #</th>
                                    <th>Placed On</th>
                                    <th>Items</th>
                                    <th>Total</th>
                                   
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($transformedOrders as $order)
                                <tr>
                                    <td>{{ $order['invoice_number'] }}</td>
                                    <td>{{ \Carbon\Carbon::createFromFormat('d/m/Y', $order['created_at'])->format('d/m/Y') }}</td>

                                    <td>
                                        @foreach($order['items'] as $item)
                                            <img src="{{ asset($item['featured_image']) }}" 
                                                 alt="{{ $item['name'] }}" 
                                                 class="img-fluid" 
                                                 style="max-width: 50px;">
                                        @endforeach
                                    </td>
                                    <td>৳ {{ $order['delivery_charge'] + $order['final_total_price'] }}</td>
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
                $('#ordersTable').DataTable();
            });
        </script>
    @endsection
</div>
