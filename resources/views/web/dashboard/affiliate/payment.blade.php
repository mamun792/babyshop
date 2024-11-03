@extends('web.dashboard.app', ['page' => 'affiliate-payment'])



@section('content')
    <div class="row row-cols-xxxl-5 row-cols-lg-3 row-cols-sm-2 row-cols-1 gy-4">
        <div class="col">
            <div class="card shadow-none border bg-gradient-start-1 h-100">
                <div class="card-body p-20">
                    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                        <div>
                            <p class="fw-medium text-primary-light mb-1">Pending</p>
                            <h6 class="mb-0">{{ $withdraws->where('status','unpaid')->sum('amount') }}</h6>
                        </div>
                        <div class="w-50-px h-50-px bg-cyan rounded-circle d-flex justify-content-center align-items-center">
                            <iconify-icon icon="gridicons:multiple-users" class="text-white text-2xl mb-0"></iconify-icon>
                        </div>
                    </div>
                    {{-- <p class="fw-medium text-sm text-primary-light mt-12 mb-0 d-flex align-items-center gap-2">
            <span class="d-inline-flex align-items-center gap-1 text-success-main"><iconify-icon icon="bxs:up-arrow" class="text-xs"></iconify-icon> +5000</span> 
            Last 30 days users
          </p> --}}
                </div>
            </div><!-- card end -->
        </div>
        <div class="col">
            <div class="card shadow-none border bg-gradient-start-2 h-100">
                <div class="card-body p-20">
                    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                        <div>
                            <p class="fw-medium text-primary-light mb-1">Paid</p>
                            <h6 class="mb-0">{{ $withdraws->where('status','paid')->sum('amount') }}</h6>
                        </div>
                        <div
                            class="w-50-px h-50-px bg-purple rounded-circle d-flex justify-content-center align-items-center">
                            <iconify-icon icon="fa-solid:award" class="text-white text-2xl mb-0"></iconify-icon>
                        </div>
                    </div>

                </div>
            </div><!-- card end -->
        </div>
        <div class="col">
            <div class="card shadow-none border bg-gradient-start-3 h-100">
                <div class="card-body p-20">
                    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                        <div>
                            <p class="fw-medium text-primary-light mb-1">Rejected</p>
                            <h6 class="mb-0">{{ $withdraws->where('status','rejected')->sum('amount') }}</h6>
                        </div>
                        <div
                            class="w-50-px h-50-px bg-info rounded-circle d-flex justify-content-center align-items-center">
                            <iconify-icon icon="fluent:people-20-filled" class="text-white text-2xl mb-0"></iconify-icon>
                        </div>
                    </div>

                </div>
            </div><!-- card end -->
        </div>
        <div class="col">
            <div class="card shadow-none border bg-gradient-start-4 h-100">
                <div class="card-body p-20">
                    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                        <div>
                            <p class="fw-medium text-primary-light mb-1">Balance</p>
                            <h6 class="mb-0">{{ $user->balance }}</h6>
                        </div>
                        <div
                            class="w-50-px h-50-px bg-success-main rounded-circle d-flex justify-content-center align-items-center">
                            <iconify-icon icon="solar:wallet-bold" class="text-white text-2xl mb-0"></iconify-icon>
                        </div>
                    </div>

                </div>
            </div><!-- card end -->
        </div>

        <div class="col">
            <div class="card shadow-none border h-100">
                <div class="card-body p-10">
                    <span class="fw-medium text-primary-light ">Withdraw Money</span>
                    <form action="{{ route('dashboard.affiliate.payment.request') }}" method="POST">
                        @csrf
                            <div class="">
                                <div class="mb-2 d-flex gap-2">
                                    <input type="number" name="amount" width="50" class="form-control"  placeholder="Enter amount" value="{{ $user->balance }}">
                                    
                                    <div class="mb-3">
                                        <button type="submit" class="btn btn-sm btn-primary">Withdrawal</button>
                                    </div>
                                </div>
                                @error('amount')
                                    <div class="invalid-feedback show" style="display: flex!important">{{ $message }}</div>
                                @enderror

                            </div>
                         
                    </form>
                    <div id="withdrawalMessage" class="mt-3"></div>
                </div>
            </div>
        </div>
    
        
        
    </div>

    
    

    {{--   datatable  --}}
    <div class="container mt-5">
      
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Payment Transactions</h5>
            </div>
            <div class="card-body">
                <table id="transactionsTable" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Payment Method</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                             function formatPaymentMethodKey($key) {
                                return ucwords(str_replace('_', ' ', $key));
                            }
                        @endphp
                        @foreach ($withdraws as $item)
                        @php
                            // Determine the class for the status badge
                            if ($item->status == 'paid') {
                                $class = 'bg-success';
                            } elseif ($item->status == 'unpaid') {
                                $class = 'bg-warning';
                            } else {
                                $class = 'bg-danger';
                            }
                            
                            // Decode the payment method JSON
                            $paymentMethod = $item->payment_method;
                    
                           
                           
                        @endphp
                        <tr>
                            <td>{{ $item->created_at->format('d M Y h:i A') }}</td>
                            <td>${{ $item->amount }}</td>
                            <td><span class="badge {{ $class }}">{{ $item->status }}</span></td>
                            <td>
                                <ul>
                                    @foreach ($paymentMethod as $key => $value)
                                        <li><strong>{{ formatPaymentMethodKey($key) }} : </strong> <span class="text-success">{{ $value }}</span></li>
                                    @endforeach
                                </ul>
                            </td>
                        </tr>
                    @endforeach
                    
                        
                       
                    </tbody>
                    {{-- tfooter tital ammount --}}
                    <tfoot>
                        <tr>
                            <th colspan="1" style="text-align:right">Total:</th>
                            <th>{{ $withdraws->sum('amount') }}</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </tfoot>
                </table>
        </div>
       
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $('#transactionsTable').DataTable();
        });

    </script>   
@endsection
