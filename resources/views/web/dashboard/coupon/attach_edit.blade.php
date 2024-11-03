<div>
    @extends('web.dashboard.app', ['page' => 'Add / Remove Product'])

    @section('content')
        {{-- @include('web.dashboard.components.cards') --}}

        <div class="card w-50 mx-auto">
            <div class="card-header d-flex justify-content-between align-items-center">
                <a href="{{ route('dashboard.product.coupon.index') }}" class="btn btn-dark">
                    <i class="fas fa-arrow-left"></i>
                    Back
                </a>
                <p class="mb-0 text-center flex-grow-1">Modify: {{ $coupon->code }}</p>
                 <!-- Delete Button -->
            <form action="{{ route('dashboard.product.coupon.destroy', $coupon->id) }}" method="POST" style="display: inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this coupon?');">
                    <i class="fas fa-trash"></i> Delete
                </button>
            </form>
            </div>
            
            <form method="POST" action="{{ route('dashboard.product.coupon.attach.update') }}" class="card-body">
                @csrf
                <input type="text" name="coupon_id" value="{{ $coupon->id }}" hidden>
                <table id="example" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Product Name</th>
                            <th>Product Code</th>

                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($products as $d)
                            <tr>
                                <td>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" value="{{ $d->id }}" name="product_ids[]"
                                            type="checkbox" role="switch" id="{{ $d->id }}"
                                            @checked(in_array($d->id, $productsWithThisCoupon))>
                                    </div>
                                </td>
                                <td>{{ $d->name }}</td>
                                <td>{{ $d->product_code }}</td>

                            </tr>
                        @endforeach



                    </tbody>

                </table>

                <div class="card-footer ">
                    <button type="submit" class="btn btn-success-600 radius-8 px-14 py-6 text-sm">Add</button>

                </div>
            </form>
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
