@extends('web.dashboard.app', ['page' => 'affiliate-earnings'])


@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-12 mb-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Affiliate Earnings</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered" id="dataTable">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Product</th>
                                    <th>Commission</th>
                                    <th>Commission Details</th>

                                </tr>
                            </thead>
                            <tbody>
                              
                                @foreach ($earnings as $i => $item)
                                    <tr>
                                        <td>{{ $item->created_at->format('d M Y , h:i A') }}</td>
                                        <td>
                                            <ul>
                                                @foreach ($item->product_details as $is=>$items)
                                                <li><strong>{{ $is }} : </strong> {{ $items }}</li>
                                                @endforeach
                                                
                                            </ul>
                                        </td>

                                        <td>{{ $item->commission_amount }}</td>
                                        <td>
                                            <ul>
                                                @foreach ($item->commission_details as $it=>$itemt)
                                                <li><strong>{{ $it }} : </strong> {{ $itemt }}</li>
                                                @endforeach
                                                
                                            </ul>
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
