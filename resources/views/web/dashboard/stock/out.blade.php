<div>
    @extends('web.dashboard.app', ['page' => 'Stockout'])

    @section('content')
        <div class="card basic-data-table">
            <div class="card-header">
                <h5 class="card-title mb-0">Stockout</h5>
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
                            <th>Invoice Number</th>
                            <th>Purchase Name</th>
                            {{-- <th>Document</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $d)
                        @if($d->quantity==0)
                            <tr>
                                <td>{{ $d->product_name }}</td>
                                <td>{{ $d->product_code }}</td>
                                <td>{{ $d->quantity }}</td>
                                <td>{{ $d->sold }}</td>
                                <td>{{ $d->quantity  }}</td>
                                <td>{{ $d->price }}</td>
                                <td>{{$d->price * $d->quantity }}</td>
                                <td>{{ $d->invoice_number ?? 'N/A' }}</td>
                                <td>{{ $d->purchase_name ?? 'N/A' }}</td>
                                {{-- <td> <a href="{{ asset($d->document) }}">Download</a> </td> --}}
                            </tr>
                            @endif
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
