<div>
    @extends('web.dashboard.app')

    @section('content')
        {{-- @include('web.dashboard.components.cards') --}}
        <div class="card container mx-auto">
            <div class="card-header">
                Coupons
            </div>
            <form method="POST" action="http://127.0.0.1:8000/dashboard/product/coupon/attach" class="card-body">

                <table class="table table-striped" id="example">
                    <thead>
                        <tr>
                            <th>Cupon</th>
                            <th>Discount</th>
                            <th>From</th>
                            <th>Expiry Date</th>
                            <th>Usage Limit</th>

                            <th>Products</th>
                            <th class="text-center">Action</th>

                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($coupons as $coupon)
                            <tr>
                                <td>{{ $coupon->code }}</td>
                                <td class="text-center">

                                    @if ($coupon->discount_type == 'fixed')
                                        &#2547;
                                        @endif {{ intval($coupon->discount_amount) }} @if ($coupon->discount_type == 'percentage')
                                            &#37;
                                        @endif


                                </td>
                                <td>{{ $coupon->valid_from->format('d-m-Y') }}</td>
                                <td>{{ $coupon->expiry_date }}</td>
                                <td class="text-center">{{ $coupon->usage_limit }}</td>
                                {{-- <td>{{ $coupon->discount_type }}</td> --}}
                                <td>
                                    <!-- List of product names for the current coupon -->
                                    <ul class="">
                                        @if (count($coupon->products) != 0)
                                            @foreach ($coupon->products as $product)
                                                <li>{{ $product->name }}</li>
                                            @endforeach
                                        @else
                                            -------
                                        @endif

                                    </ul>
                                </td>
                                <td>
                                    <!-- Example Action button or link, adjust as needed -->
                                    <a href="{{ route('dashboard.product.coupon.attach.edit', $coupon->id) }}"
                                        class="btn btn-info btn-sm">Edit</a>
                                </td>
                            </tr>
                        @endforeach



                    </tbody>
                </table>

                <div class="card-footer">
                    <button type="submit">Update</button>
                </div>
            </form>
        </div>
    @endsection

    @section('script')
    @endsection
</div>
