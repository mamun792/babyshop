<div>
    @extends('web.dashboard.app', ['page' => 'Product Details'])

    @section('content')
        <div class="card basic-data-table">
            <div class="card-header">
                <h5 class="card-title mb-0">Stock Management</h5>
            </div>
            <div class="card-body">



                <table class="table table-striped table-bordered dataTable w-100" id="dataTable">
                    <thead>
                        <tr>

                            <th>Product Name</th>
                            <th>Product Code</th>
                            <th>Quantity</th>
                            <th>Sold</th>
                            <th>In Stock</th>
                            <th>Price</th>
                            <th>Total</th>

                        </tr>
                    </thead>
                    {{-- <tbody>
                        @foreach ($data as $d)
                            @php
                                $isStockOut = $d->quantity - $d->sold <= 0;
                                $upcomingStockout = $d->quantity < $limit;
                            @endphp
                            <tr>
                                <td>{{ $d->name }}</td>
                                <td>{{ $d->product_code }}</td>
                                <td>{{ $d->quantity + $d->sold }}</td>
                                <td>
                                    {{ $d->sold ?? 0 }}


                                </td>

                                <td @if ($upcomingStockout) style="background: rgb(255, 255, 188)" @endif
                                    @if ($isStockOut) style="background: rgb(255, 188, 188)" @endif>
                                    {{ $d->quantity }}</td>

                                <td>{{ $d->price }}</td>

                                <td>{{ number_format($sumValue, 2) }}</td>



                            </tr>
                        @endforeach
                    </tbody>


                    <tfoot>
                        <tr>
                            <th colspan="5" class="text-end">Total:</th>
                            <th class="text-end">
                                <span>৳</span> {{ number_format($total, 2) }}
                            </th>
                            <th>
                                @php
                                    $totalValue = 0; // Initialize total value before the loop
                                @endphp
                                @foreach ($data as $d)
                                    @php
                                        // Calculate the sum value for the current product
                                        $sumValue = $d->price * $d->quantity + $d->price * $d->sold;
                                        $totalValue += $sumValue; // Add to total value
                                    @endphp
                                @endforeach
                                <span>৳</span> {{ number_format($sumValue, 2) }}

                            </th>
                        </tr>



                    </tfoot> --}}

                    <tbody>
                        @foreach ($data as $d)
                            @php
                                $isStockOut = $d->quantity - $d->sold <= 0;
                                $upcomingStockout = $d->quantity < $limit;
                                $sumValue = $d->price * $d->quantity + $d->price * $d->sold; // Only needed for this row
                            @endphp
                            <tr>
                                <td>{{ $d->name }}</td>
                                <td>{{ $d->product_code }}</td>
                                <td>{{ $d->quantity + $d->sold }}</td>
                                <td>{{ $d->sold ?? 0 }}</td>
                                <td @if ($upcomingStockout) style="background: rgb(255, 255, 188);" @endif
                                    @if ($isStockOut) style="background: rgb(255, 188, 188);" @endif>
                                    {{ $d->quantity }}
                                </td>
                                <td>{{ number_format($d->price, 2) }}</td>
                                <td>{{ number_format($sumValue, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    
                    <tfoot>
                        <tr>
                            <th colspan="2" class="text-end">Total:</th>
                            <th class="text-end">
                                {{ number_format($quantity, 2) }}
                            </th>

                            <th class="text-end">
                                {{ number_format($sold, 2) }}
                            </th>

                            <th class="text-end">
                                {{ number_format($instock, 2) }}
                            </th>
                            <th class="text-end">
                                <span>৳</span> {{ number_format($total, 2) }}
                            </th>
                            <th class="text-end">
                                <span>৳</span> {{ number_format($totalValue, 2) }} <!-- Use pre-calculated total -->
                            </th>
                            
                        </tr>
                    </tfoot>
                    
                </table>

            </div>



        </div>
        {{-- @include('web.dashboard.components.cards') --}}
    @endsection
    @section('js')
        <script>
            let table = new DataTable('#dataTable', {
                columnDefs: [{
                        orderable: false,
                        targets: '_all'
                    } // Disable sorting on all columns
                ]
            });
        </script>
    @endsection
