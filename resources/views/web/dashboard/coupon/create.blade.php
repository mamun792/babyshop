<div>
    @extends('web.dashboard.app', ['page' => 'Coupon'])

    @section('content')
        {{-- @include('web.dashboard.components.cards') --}}

        <div class="card">
            <div class="card-header">
                Coupon Form
            </div>
            <form action="{{ route('dashboard.product.coupon.store') }}" method="POST" class="p-4 bg-light card-body">
                @csrf
                <div class="row mb-3">
                    <!-- Coupon Code -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="code">Coupon Code</label>
                            <input type="text" class="form-control" id="code" name="code"
                                placeholder="Enter coupon code">
                            @if ($errors->has('code'))
                                <span class="text-danger">{{ $errors->first('code') }}</span>
                            @endif
                        </div>
                    </div>

                    <!-- Discount Amount -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="discount_amount">Discount Amount</label>
                            <div class="input-group">
                                <select name="discount_type" id="discount_type" class="form-select">
                                    <option value="fixed">Fixed Amount</option>
                                    <option value="percentage">Percentage</option>
                                </select>
                                <input type="text" class="form-control" id="discount_amount" name="discount_amount"
                                    placeholder="Enter discount amount" required>
                                @if ($errors->has('discount_amount'))
                                    <span class="text-danger">{{ $errors->first('discount_amount') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <!-- Valid From -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="valid_from">Valid From</label>
                            <input type="date" class="form-control" id="valid_from" name="valid_from" required>
                            @if ($errors->has('valid_from'))
                                <span class="text-danger">{{ $errors->first('valid_from') }}</span>
                            @endif
                        </div>
                    </div>

                    <!-- Expiry Date -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="expiry_date">Expire Date</label>
                            <input type="date" class="form-control" id="expiry_date" name="expiry_date" required>
                            @if ($errors->has('expiry_date'))
                                <span class="text-danger">{{ $errors->first('expiry_date') }}</span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <!-- Usage Limit -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="usage_limit">Coupon Usage Limit</label>
                            <input type="number" min="1" class="form-control" id="usage_limit" name="usage_limit"
                                placeholder="Enter usage limit" required>
                            @if ($errors->has('usage_limit'))
                                <span class="text-danger">{{ $errors->first('usage_limit') }}</span>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary">Add Coupon</button>
            </form>
        </div>
    @endsection

    @section('js')
        {{-- <script>
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
        </script> --}}

        <script>
            @if (session('success'))
                toastr.success("{{ session('success') }}");
            @endif
        </script>
    @endsection
</div>
