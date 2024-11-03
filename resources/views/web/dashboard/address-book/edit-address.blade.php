<div>
    @extends('web.dashboard.app', ['page' => 'address-book'])
    @section('content')
        {{-- @include('web.dashboard.components.cards') --}}
        <div class="container my-4">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Edit Address</h5>
                        </div>
                        <div class="card-body">
                            <form id="editAddressForm">
                                <div class="form-group mb-3">
                                    <label for="fullName">Full Name</label>
                                    <input type="text" id="fullName" class="form-control" value="John Doe"
                                        placeholder="Enter your full name" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="phone">Phone Number</label>
                                    <input type="text" id="phone" class="form-control" value="(123) 456-7890"
                                        placeholder="Enter your phone number" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="email">Email Address</label>
                                    <input type="email" id="email" class="form-control" value="johndoe@example.com"
                                        placeholder="Enter your email address" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="addressLine1">Address Line 1</label>
                                    <input type="text" id="addressLine1" class="form-control" value="123 Main St"
                                        placeholder="Enter address line 1" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="addressLine2">Address Line 2 (optional)</label>
                                    <input type="text" id="addressLine2" class="form-control" value="Apt 4B"
                                        placeholder="Enter address line 2">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="city">City</label>
                                    <input type="text" id="city" class="form-control" value="Anytown"
                                        placeholder="Enter city" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="state">State/Province</label>
                                    <input type="text" id="state" class="form-control" value="NY"
                                        placeholder="Enter state/province" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="postalCode">Postal Code</label>
                                    <input type="text" id="postalCode" class="form-control" value="12345"
                                        placeholder="Enter postal code" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="country">Country</label>
                                    <input type="text" id="country" class="form-control" value="USA"
                                        placeholder="Enter country" required>
                                </div>
                                <div class="form-group text-center">
                                    <button type="submit" class="btn btn-primary">Update Address</button>
                                    <button type="button" class="btn btn-secondary ml-2"
                                        data-dismiss="modal">Cancel</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
</div>
