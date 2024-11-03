<div>
    @extends('web.dashboard.app')

    @section('content')
        {{-- @include('web.dashboard.components.cards') --}}




        <div class="card">
            <div class="card-header">
                Cuppon
            </div>
            <form action="{{ route('dashboard.product.coupon.update', $coupon->id) }}" method="POST"
                class="p-5 bg-white mx-auto container card-body">
                @csrf
                @method('PATCH')
                <div class="row">
                    <!-- Coupon Code -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="code">Coupon Code</label>
                            <input type="text" class="form-control" id="code" name="code"
                                value="{{ $coupon->code }}">
                            @if ($errors->has('code'))
                                <span class="text-danger">{{ $errors->first('code') }}</span>
                            @endif
                        </div>
                    </div>

                    <!-- Discount Amount -->
                    <div class="col-md-6">
                        
                        <label for="code">Discount Amount</label>
                        <div class="input-group">

                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <select name="discount_type" id="discount_type" class="form-control">
                                        <option value="fixed" {{ $coupon->discount_type == 'fixed' ? 'selected' : '' }}>
                                            Fixed Amount</option>
                                        <option value="percentage"
                                            {{ $coupon->discount_type == 'percentage' ? 'selected' : '' }}>Percentage
                                        </option>
                                    </select>
                                    @if ($errors->has('discount_amount'))
                                        <span class="text-danger">{{ $errors->first('discount_amount') }}</span>
                                    @endif
                                </div>

                            </div>
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <input type="text" class="form-control" id="code"
                                        value="{{ $coupon->discount_amount }}" name="discount_amount" required>
                                </div>
                                @if ($errors->has('discount_amount'))
                                    <span class="text-danger">{{ $errors->first('discount_amount') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <!-- Valid From -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="valid_from">Valid From</label>
                            <input type="date" class="form-control" id="valid_from"
                                value="{{ date('Y-m-d', strtotime($coupon->valid_from)) }}" name="valid_from" required>
                            @if ($errors->has('valid_from'))
                                <span class="text-danger">{{ $errors->first('valid_from') }}</span>
                            @endif
                        </div>
                    </div>

                    <!-- Expiry Date -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="expiry_date">Expire Date</label>
                            <input type="date" class="form-control" id="expiry_date"
                                value="{{ date('Y-m-d', strtotime($coupon->expiry_date)) }}" name="expiry_date" required>
                            @if ($errors->has('expiry_date'))
                                <span class="text-danger">{{ $errors->first('expiry_date') }}</span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <!-- Usage Limit -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="usage_limit">Coupon Usages Limit</label>
                            <input type="number" min="1" class="form-control" id="usage_limit"
                                value="{{ $coupon->usage_limit }}" name="usage_limit" required>
                            @if ($errors->has('usage_limit'))
                                <span class="text-danger">{{ $errors->first('usage_limit') }}</span>
                            @endif
                        </div>
                    </div>


                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary mt-3">Update Coupon</button>
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
                    theme: 'bootstrap4', // Apply Bootstrap 4 theme for better integration
                    tags: true, // Allow users to enter custom values if needed
                    closeOnSelect: false // Keep the dropdown open after selecting items
                });
            });
        </script>
    @endsection
</div>
