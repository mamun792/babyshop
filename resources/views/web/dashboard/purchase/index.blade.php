<div>
    @extends('web.dashboard.app', ['page' => 'product-purchase'])
    @section('content')
        {{-- @include('web.dashboard.components.cards') --}}

        <div class="container mt-5">
            <div class="card">
                
                <div class="card-header py-16 px-24 bg-base border border-end-0 border-start-0 border-top-0">
                    <h6 class="text-lg mb-0"> Product List </h6>
                </div>
                <div class="card-body">
                    <table id="productTable" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Product</th>
                                <th>Purchase Date</th>
                                <th>Invoice Number</th>
                                <th>Supplier</th>
                               
                                <th>Comment</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($purchases as $purchase)
                                <tr>
                                    <td>{{ $purchase->id }}</td>
                                    <td>{{ $purchase->purchase_name }}</td>
                                    <td>{{ $purchase->purchase_date }}</td>
                                    <td>{{ $purchase->invoice_number }}</td>
                                    <td>{{ $purchase->supplier_name }}</td>
                                  
                                    <td>{{ $purchase->comment }}</td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Action Buttons">
                                         
                                            <a href="{{ route('dashboard.product-purchase.addPurchaseItems',$purchase->id) }}" class="btn btn-sm btn-primary" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            
                                            <form action="{{ route('dashboard.product-purchase.destroy', $purchase->id) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger ms-2" title="Delete">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{--  --}}
            </div>
        </div>
    @endsection
    @section('js')
        <script>
            $(document).ready(function() {
                $('#productTable').DataTable({
                    responsive: true,
                    autoWidth: false,

                });
            });
        </script>
    @endsection
</div>
