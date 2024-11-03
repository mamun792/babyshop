<div>
    @extends('web.dashboard.app')

    @section('content')
        {{-- @include('web.dashboard.components.cards') --}}




        <div class="card">
            <div class="card-header">
                Cuppon <a href="{{ route('dashboard.product.coupon.create') }}" class="btn btn-sm btn-dark float-end mx-2">
                    Create Cuppon </a> <a href="{{ route('dashboard.product.coupon.create') }}"
                    class="btn btn-sm btn-dark float-end"> Create Cuppon </a>
            </div>
            <div class="p-5 bg-white mx-auto container ">

                <form method="POST" action="{{ route('dashboard.product.coupon.attach.update') }}" class="row card">
                    @csrf
                    <div class="card-header">Attach cupon with products</div>
                    <div class="col-12 row card-body p-3">
                        <div class="col-6">
                            <label for="">Cuppon List</label>
                            <select class="select2" name="coupon_id">
                                @foreach ($coupons as $d)
                                    <option value="{{ $d->id }}">{{ $d->code }} &nbsp; &nbsp; &nbsp; &nbsp;
                                        @if ($d->discount_type == 'fixed')
                                            &#2547;
                                            @endif {{ intval($d->discount_amount) }} @if ($d->discount_type == 'percentage')
                                                &#37;
                                            @endif
                                    </option>
                                @endforeach

                            </select>
                        </div>

                        <div class="col-6">
                            <label for="">Product List</label>
                            <select class="select2" name="product_ids[]" multiple>
                                @foreach ($products as $d)
                                    <option value="{{ $d->id }}">{{ $d->name }}</option>
                                @endforeach

                            </select>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="float-end btn btn-info btn-sm">
                            Update
                        </button>
                    </div>
                </form>


                <br>


                <div class="card">
                    <div class="card-header">
                        Used Cuppons Records
                    </div>
                    <div class="card-body">
                        <table class="table table-striped ">
                            <thead>
                                <tr>
                                    <th>Cupon</th>
                                    <th>Discount</th>
                                    <th>From</th>
                                    <th>Expiry Date</th>
                                    <th>Usage Limit</th>
                                    {{-- <th>Discount Type</th> --}}
                                    <th>Products</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($couponsWithProducts as $coupon)
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
                                                @foreach ($coupon->products as $product)
                                                    <li>{{ $product->name }}</li>
                                                @endforeach
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

                    </div>
                    <div class="card-footer"></div>
                </div>


            </div>




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
                tags: true, // Allow users to enter custom values if needed
                closeOnSelect: false // Keep the dropdown open after selecting items
            });
        });
    </script>
@endsection
</div>
