@extends('web.dashboard.app', ['page' => 'Coupon'])

@section('content')
    {{-- @include('web.dashboard.components.cards') --}}




    <div class="card">
        <div class="card-header">
            Cuppon <a href="{{ route('dashboard.product.coupon.create') }}" class="btn btn-sm btn-dark float-end"> Create
                Cuppon </a>
        </div>
        <div class="p-5 bg-white card-body ">


            <table class="table table-striped" id="example">
                <thead>
                    <tr>
                        <th>Code</th>
                        <th>Discount Amount</th>
                        <th>Valid From</th>
                        <th>Expiry Date</th>
                        <th>Usage Limit</th>
                        <th>With Product</th>
                        {{-- <th>Discount Type</th> --}}
                        <th>Created At</th>
                        <th>Updated At</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($coupons as $coupon)
                        <tr>
                            <td>{{ $coupon->code }}</td>
                            <td>
                                {{-- @if ($coupon->discount_type === 'percentage')
                                        {{ $coupon->discount_amount }}%
                                    @else
                                        ${{ $coupon->discount_amount }}
                                    @endif --}}

                                @if ($coupon->discount_type === 'percentage')
                                    <span class="badge bg-dark py-2">Percentage ( {{ $coupon->discount_amount }}% ) </span>
                                @else
                                    <span class="badge bg-success py-2">Fixed Amount ( ${{ $coupon->discount_amount }}
                                        )</span>
                                @endif

                            </td>
                            <td>{{ $coupon->valid_from }}</td>
                            <td>{{ $coupon->expiry_date }}</td>
                            <td>{{ $coupon->usage_limit }}</td>
                            <td>
                                <!-- List of product names for the current coupon -->
                                <ul class="">
                                    @foreach ($coupon->products as $product)
                                        <li>{{ $product->name }}</li>
                                    @endforeach
                                </ul>
                            </td>

                            {{-- <td>
                                    @if ($coupon->discount_type === 'percentage')
                                        <span class="badge bg-info">Percentage</span>
                                    @else
                                        <span class="badge bg-success">Fixed Amount</span>
                                    @endif
                                </td> --}}
                            <td>{{ $coupon->created_at->format('Y-m-d H:i:s') }}</td>
                            <td>{{ $coupon->updated_at->format('Y-m-d H:i:s') }}</td>
                            <td>
                                <!-- Example Action button or link, adjust as needed -->
                                {{-- <a href="{{ route('dashboard.product.coupon.attach.edit' , $coupon->id) }}" class="btn btn-info btn-sm">Add / Remove Product</a>
                                    <a href="{{ route('dashboard.product.coupon.attach.edit' , $coupon->id) }}" class="btn btn-info btn-sm">Add / Remove Product</a> --}}
                                <div class="btn-group-vertical" role="group" aria-label="Vertical button group">
                                    <div class="btn-group-sm" role="group">
                                        <button type="button" class="btn btn-primary dropdown-toggle"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            X
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li>

                                                <a class="dropdown-item"
                                                    href="{{ route('dashboard.product.coupon.attach.edit', $coupon->id) }}">Add
                                                    / Remove Product</a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item"
                                                    href="{{ route('dashboard.product.coupon.edit', $coupon->id) }}">Edit
                                                    Coupon</a>
                                            </li>

                                            </li>
                                        </ul>
                                    </div>

                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>



    </div>
@endsection

@section('js')
    <script>
        new DataTable('#example');
    </script>
@endsection
