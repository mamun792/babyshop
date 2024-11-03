<div>
    @extends('web.dashboard.app')

    @section('content')
        {{-- @include('web.dashboard.components.cards') --}}




        <div class="card">
            <div class="card-header">
                Cuppon <a href="{{ route('dashboard.product.coupon.create') }}" class="btn btn-sm btn-dark float-end"> Create
                    Cuppon </a>
            </div>
            <div class="p-5 bg-white mx-auto container card-body">


                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Code</th>
                            <th>Discount Amount</th>
                            <th>Valid From</th>
                            <th>Expiry Date</th>
                            <th>Usage Limit</th>
                            <th>Discount Type</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($coupons as $coupon)
                            <tr>
                                <td>{{ $coupon->code }}</td>
                                <td>
                                    @if ($coupon->discount_type === 'percentage')
                                        {{ $coupon->discount_amount }}%
                                    @else
                                        ${{ $coupon->discount_amount }}
                                    @endif
                                </td>
                                <td>{{ $coupon->valid_from }}</td>
                                <td>{{ $coupon->expiry_date }}</td>
                                <td>{{ $coupon->usage_limit }}</td>
                                <td>
                                    @if ($coupon->discount_type === 'percentage')
                                        <span class="badge bg-info">Percentage</span>
                                    @else
                                        <span class="badge bg-success">Fixed Amount</span>
                                    @endif
                                </td>
                                <td>{{ $coupon->created_at->format('Y-m-d H:i:s') }}</td>
                                <td>{{ $coupon->updated_at->format('Y-m-d H:i:s') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>



            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary">Add Coupon</button>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('.select2').select2({
                placeholder: "Select products",
                allowClear: true,
                width: '100%', // Ensure the select box takes up the full width of its container
                theme: 'bootstrap4', // Apply Bootstrap 4 theme for better integration
                tags: true, // Allow users to enter custom values if needed
                closeOnSelect: false // Keep the dropdown open after selecting items
            });
        });
    </script>
@endsection
</div>
