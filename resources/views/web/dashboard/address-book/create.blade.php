<div>
    @extends('web.dashboard.app', ['page' => 'address-book'])
    @section('content')
        {{-- @include('web.dashboard.components.cards') --}}

        <div class="container my-4">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header bg-primary text-white text-center">
                            <h5 class="card-title mb-0">Address Form</h5>
                        </div>
                        <div class="card-body">
                            <form >
                                <div class="form-group mb-3">
                                    <label for="fullName">Full Name</label>
                                    <input type="text" id="fullName" class="form-control"
                                        placeholder="Enter your full name">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="phone">Phone Number</label>
                                    <input type="text" id="phone" class="form-control"
                                        placeholder="Enter your phone number">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="email">Email Address</label>
                                    <input type="email" id="email" class="form-control"
                                        placeholder="Enter your email address">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="addressLine1">Address Line 1</label>
                                    <input type="text" id="addressLine1" class="form-control"
                                        placeholder="Enter address line 1">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="addressLine2">Address Line 2 (optional)</label>
                                    <input type="text" id="addressLine2" class="form-control"
                                        placeholder="Enter address line 2">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="city">City</label>
                                    <select id="city" class="form-control">
                                        <option value="">Select City</option>
                                        <option value="new-york">New York</option>
                                        <option value="los-angeles">Los Angeles</option>
                                        <option value="chicago">Chicago</option>
                                        <!-- Add more city options here -->
                                    </select>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="state">State/Province</label>
                                    <select id="state" class="form-control">
                                        <option value="">Select State/Province</option>
                                        <option value="ny">New York</option>
                                        <option value="ca">California</option>
                                        <option value="il">Illinois</option>
                                        <!-- Add more state options here -->
                                    </select>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="postalCode">Postal Code</label>
                                    <input type="text" id="postalCode" class="form-control"
                                        placeholder="Enter postal code">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="country">Country</label>
                                    <input type="text" id="country" class="form-control" placeholder="Enter country">
                                </div>
                                <div class="form-check mb-3">
                                    <input type="checkbox" id="setDefault" class="form-check-input">
                                    <label for="setDefault" class="form-check-label">Set as Default Address</label>
                                </div>
                                <div class="form-group text-center">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
</div>
