@extends('web.dashboard.app', ['page' => 'affiliate-products'])


@section('content')

<div class="container mt-5">
    <div class="row">
        <div class="col-12 mb-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Product Management</h5>
                </div>
                <div class="card-body">
                    <table class="table table-bordered" id="dataTable">
                        <thead>
                            <tr>
                                <th>S.L</th>
                                <th>Product Name</th>
                                <th>Product Code</th>
                                <th>Product Price</th>
                                <th>Commission </th>
                                <th>Copy Link</th>
                               
                            </tr>
                        </thead>
                        <tbody>
                            
                           
                            @foreach ($products as $i=>$item)
                            <tr>
                                <td>{{ $i+1 }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="{{ asset($item->featured_image) }}" alt="Product 1" class="img-fluid" style="width: 50px; height: 50px; object-fit: cover; margin-right: 10px;">
                                        <span>{{ $item->name }}</span>
                                    </div>
                                </td>
                                
                                <td>{{ $item->product_code }}</td>
                                <td>{{ $item->discount_price }}</td>
                                <td>
                                    <ul>
                                        <li>Commission type : {{ $item->commission_type }}</li>
                                        <li>Commission {{ $item->commission_type=='percent'?'rate':'amount' }} : {{ $item->commission_amount }} {{ $item->commission_type=='percent'?'%':'' }}</li>
                                    </ul>
                                </td>
                                <td>
                                    <button class="btn btn-primary" onclick="copyLink('{{ route('product-details',['slug'=>$item->slug,'refer_code'=>Auth::user()->refer_code]) }}', this)" title="Copy Product Link">
                                        <i class="fas fa-copy"></i>
                                    </button>
                                </td>
                                
                            </tr>
                            @endforeach
                            
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection



@section('js')
<script>
    // Data table initialization
    $(document).ready(function() {
        $('#dataTable').DataTable();
    });

    function copyLink(link, button) {
        navigator.clipboard.writeText(link).then(() => {
          
           button.innerHTML = '<i class="fas fa-check"></i> '; 
           button.disabled = true; 
          alert('Link copied successfully');
        }).catch(err => {
            console.error('Could not copy link: ', err);
        });
    }

 
</script>
@endsection

