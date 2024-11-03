<div>
    @extends('web.dashboard.app', ['page' => 'Upcomming Stockout'])

    @section('content')
        <div class="card basic-data-table">
            <div class="card-header">
                <h5 class="card-title mb-0">Upcomming Stockout</h5>
            </div>
            <div class="card-body">



                <table class="table table-striped table-bordered dataTable w-100" id="dataTable">
                    <thead>
                        <tr>
        
                            {{-- <th>Product Name</th>
                            <th>Product Code</th>
                            <th>Quantity</th>
                            <th>Sold</th>
                            <th>In Stock</th>
                            <th>Price</th>
                            <th>Total</th>
                            <th>Invoice Number</th>
                            <th>Purchase Name</th> --}}
                            {{-- <th>Document</th> --}}

                            <th>Product Name</th>
                            <th>Product Code</th>
                            <th>Quantity</th>
                            <th>Remaining Quantity</th>
                            <th>Sold</th>
                            <th>Price</th>
                           <th>Total</th>
                            <th>Stockout</th>
                           
                        </tr>
                    </thead>
                    <tbody>
                       
                        @foreach ($data as $product)
                        <tr class="{{ $product->stockout ? 'table-danger' : '' }}">
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->product_code }}</td>
                            <td>{{ $product->quantity+$product->sold  }}</td>
                            <td>{{ $product->quantity   }}</td>
                            <td>{{ $product->sold ?? '0' }}</td>
                            <td>{{ number_format($product->price, 2) }}</td>
                            <td>{{  number_format($product->price *($product->quantity+$product->sold),2) }}</td>
                            <td>
                                @if ($product->stockout)
                                    <span class="text-danger">Stockout</span>
                                @else
                                    <span class="text-success">In Stock</span>
                                @endif
                            </td>
                           
                        </tr>
                    @endforeach
                       
                    </tbody>
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
</div>