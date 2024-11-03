@extends('web.dashboard.app', ['page' => 'affiliate-settings'])


@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6">
                <div class="card mt-5 shadow-sm">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Update Personal Information</h5>
                    </div>
                    <div class="card-body">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="personal-tab" data-bs-toggle="tab"
                                    data-bs-target="#personal" type="button" role="tab" aria-controls="personal"
                                    aria-selected="true">Personal Details</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="security-tab" data-bs-toggle="tab" data-bs-target="#security"
                                    type="button" role="tab" aria-controls="security" aria-selected="false">Security
                                    Preferences</button>
                            </li>
                        </ul>

                        <div class="tab-content" id="myTabContent">
                            <form method="POST" action="{{ route('dashboard.affiliate.basic.update') }}"
                                enctype="multipart/form-data" class="tab-pane fade show active" id="personal"
                                role="tabpanel" aria-labelledby="personal-tab">
                                @csrf
                                <h5 class="mt-4">Basic Information</h5>

                                <!-- Avatar Upload -->
                                <div class="mb-3">
                                    <label for="avatar" class="form-label"><img width="150"
                                            src="{{ asset(Auth::user()->avatar) }}" alt=""></label>
                                    <input type="file" class="form-control @error('avatar') is-invalid @enderror"
                                        id="avatar" name="avatar">
                                    @error('avatar')
                                        <div class="invalid-feedback show">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Full Name -->
                                <div class="mb-3">
                                    <label for="name" class="form-label">Full Name</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        id="name" name="name" placeholder="Full Name"
                                        value="{{ old('name', Auth::user()->name) }}" required>
                                    @error('name')
                                        <div class="invalid-feedback show">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Email Address -->
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email Address</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                        id="email" name="email" placeholder="Email Address"
                                        value="{{ old('email', Auth::user()->email) }}" required>
                                    @error('email')
                                        <div class="invalid-feedback show">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Phone Number -->
                                <div class="mb-3">
                                    <label for="phone" class="form-label">Phone Number</label>
                                    <input type="tel" class="form-control @error('phone') is-invalid @enderror"
                                        id="phone" name="phone" placeholder="Phone Number"
                                        value="{{ old('phone', Auth::user()->phone) }}" required>
                                    @error('phone')
                                        <div class="invalid-feedback show">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Address -->
                                <div class="mb-3">
                                    <label for="street_address" class="form-label">Address</label>
                                    <input type="text" class="form-control @error('street_address') is-invalid @enderror"
                                        id="street_address" name="street_address" placeholder="Address"
                                        value="{{ old('street_address', Auth::user()->street_address) }}" required>
                                    @error('street_address')
                                        <div class="invalid-feedback show">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Submit Button -->
                                <button type="submit" class="btn btn-primary">Update Profile</button>
                            </form>


                            <form method="POST" action="{{ route('dashboard.affiliate.password.update') }}"
                                class="tab-pane fade" id="security" role="tabpanel" aria-labelledby="security-tab">
                                @csrf
                                <h5 class="mt-4">Security Settings</h5>

                                <!-- Old Password -->
                                <div class="mb-3 position-relative">
                                    <div>
                                        <input type="password"
                                            class="form-control @error('current_password') is-invalid @enderror"
                                            id="old_password" name="current_password" placeholder="Old Password"
                                            required>
                                        @error('current_password')
                                            <div class="invalid-feedback show">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <button id="toggleOldPassword" type="button"
                                        class="btn btn-outline-secondary position-absolute"
                                        style="right: 10px; top: 3px; padding: 0.375rem 0.75rem;">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>

                                <!-- New Password -->
                                <div class="mb-3 position-relative">
                                    <div>
                                        <input type="password"
                                            class="form-control @error('new_password') is-invalid @enderror"
                                            id="password" name="new_password" placeholder="New Password" required>
                                        @error('new_password')
                                            <div class="invalid-feedback show">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <button id="toggleNewPassword" type="button"
                                        class="btn btn-outline-secondary position-absolute"
                                        style="right: 10px; top: 3px; padding: 0.375rem 0.75rem;">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>

                                <!-- Confirm New Password -->
                                <div class="mb-3 position-relative">
                                    <div>
                                        <input type="password"
                                            class="form-control @error('new_password_confirmation') is-invalid @enderror"
                                            id="confirm_password" name="new_password_confirmation"
                                            placeholder="Confirm Password" required>
                                        @error('new_password_confirmation')
                                            <div class="invalid-feedback show">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <button id="toggleConfirmPassword" type="button"
                                        class="btn btn-outline-secondary position-absolute"
                                        style="right: 10px; top: 3px; padding: 0.375rem 0.75rem;">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>

                                <!-- Submit Button -->
                                <button type="submit" class="btn btn-primary">Update Password</button>
                            </form>


                        </div>


                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card mt-5 shadow-sm">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Manage Payment Methods</h5>
                    </div>
                    <div class="card-body">
                        <!-- Tab Navigation -->
                        <ul class="nav nav-tabs" id="settingsTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="payment-methods-tab" data-bs-toggle="tab"
                                    data-bs-target="#payment-methods" type="button" role="tab"
                                    aria-controls="payment-methods" aria-selected="true">
                                    Payment Methods
                                </button>
                            </li>


                        </ul>

                        <!-- Tab Content -->
                        <div class="tab-content mt-4" id="settingsTabContent">
                            <!-- Payment Methods Tab -->
                            <div class="tab-pane fade show active" id="payment-methods" role="tabpanel"
                                aria-labelledby="payment-methods-tab">
                                <h6>Your Payment Methods</h6>
                                <p>Manage your payment methods for commission withdrawals.</p>
                                <ul class="list-group mb-4" id="paymentMethodsList">
                                    <!-- Dynamic payment methods will be inserted here -->
                                </ul>
                                <button class="btn btn-success" data-bs-toggle="modal"
                                    data-bs-target="#addPaymentMethodModal">
                                    <i class="bi bi-plus-circle"></i> Add New Payment Method
                                </button>



                                <!-- Add Payment Method Modal -->
                                <div class="modal fade" id="addPaymentMethodModal" tabindex="-1"
                                    aria-labelledby="addPaymentMethodModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="addPaymentMethodModalLabel">Add New Payment
                                                    Method</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form method="POST"
                                                    action="{{ route('dashboard.affiliate.paymentMethod.update') }}">
                                                    @csrf

                                                    <!-- Payment Method Selection -->
                                                    <div class="mb-3">
                                                        <label for="paymentMethod" class="form-label">Payment
                                                            Method</label>
                                                        <select class="form-select" id="paymentMethod" name="name"
                                                            required>
                                                            <option value="">Select Payment Method</option>
                                                            <option value="bank"
                                                                {{ Auth::user()->paymentMethod && Auth::user()->paymentMethod->name == 'bank' ? 'selected' : '' }}>
                                                                Bank</option>
                                                            <option value="bkash"
                                                                {{ Auth::user()->paymentMethod && Auth::user()->paymentMethod->name == 'bkash' ? 'selected' : '' }}>
                                                                Bkash</option>
                                                            <option value="nagad"
                                                                {{ Auth::user()->paymentMethod && Auth::user()->paymentMethod->name == 'nagad' ? 'selected' : '' }}>
                                                                Nagad</option>
                                                        </select>
                                                        <div class="invalid-feedback show">Please select a payment method.
                                                        </div>
                                                    </div>

                                                    <!-- Bank Fields -->
                                                    <div class="bank-fields d-none">
                                                        <div class="mb-3">
                                                            <label for="bankName" class="form-label">Bank Name</label>
                                                            <input type="text" class="form-control" id="bankName"
                                                                name="info[bank_name]" placeholder="Enter bank name"
                                                                required
                                                                value="{{ Auth::user()->paymentMethod && Auth::user()->paymentMethod->name == 'bank' ? Auth::user()->paymentMethod->info['bank_name'] : '' }}">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="accountHolder" class="form-label">Account
                                                                Holder</label>
                                                            <input type="text" class="form-control" id="accountHolder"
                                                                name="info[account_holder]"
                                                                placeholder="Enter account holder name" required
                                                                value="{{ Auth::user()->paymentMethod && Auth::user()->paymentMethod->name == 'bank' ? Auth::user()->paymentMethod->info['account_holder'] : '' }}">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="accountNumber" class="form-label">Bank Account
                                                                Number</label>
                                                            <input type="text" class="form-control" id="accountNumber"
                                                                name="info[bank_account_number]"
                                                                placeholder="Enter bank account number" required
                                                                value="{{ Auth::user()->paymentMethod && Auth::user()->paymentMethod->name == 'bank' ? Auth::user()->paymentMethod->info['bank_account_number'] : '' }}">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="routingNumber" class="form-label">Routing
                                                                Number</label>
                                                            <input type="text" class="form-control" id="routingNumber"
                                                                name="info[routing_number]"
                                                                placeholder="Enter routing number" required
                                                                value="{{ Auth::user()->paymentMethod && Auth::user()->paymentMethod->name == 'bank' ? Auth::user()->paymentMethod->info['routing_number'] : '' }}">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="branchName" class="form-label">Branch Name</label>
                                                            <input type="text" class="form-control" id="branchName"
                                                                name="info[branch_name]" placeholder="Enter branch name"
                                                                value="{{ Auth::user()->paymentMethod && Auth::user()->paymentMethod->name == 'bank' ? Auth::user()->paymentMethod->info['branch_name'] : '' }}">
                                                        </div>
                                                    </div>

                                                    <!-- Bkash Fields -->
                                                    <div class="bkash-fields d-none">
                                                        <div class="mb-3">
                                                            <label for="bakshNumber" class="form-label">Bkash
                                                                Number</label>
                                                            <input type="text" class="form-control" id="bakshNumber"
                                                                name="info[account_number]"
                                                                placeholder="Enter Bkash number" required
                                                                value="{{ Auth::user()->paymentMethod && Auth::user()->paymentMethod->name == 'bkash' ? Auth::user()->paymentMethod->info['account_number'] : '' }}">
                                                        </div>
                                                    </div>

                                                    <!-- Nagad Fields -->
                                                    <div class="nagad-fields d-none">
                                                        <div class="mb-3">
                                                            <label for="nogudNumber" class="form-label">Nagad
                                                                Number</label>
                                                            <input type="text" class="form-control" id="nogudNumber"
                                                                name="info[account_number]"
                                                                placeholder="Enter Nagad number" required
                                                                value="{{ Auth::user()->paymentMethod && Auth::user()->paymentMethod->name == 'nagad' ? Auth::user()->paymentMethod->info['account_number'] : '' }}">
                                                        </div>
                                                    </div>

                                                    <button type="submit" class="btn btn-primary">Save Payment
                                                        Method</button>
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('js')
    <script>
        function togglePasswordVisibility(inputId, toggleIconId) {
            const input = document.getElementById(inputId);
            const toggleIcon = document.getElementById(toggleIconId).querySelector('i');


            if (input.type === "password") {
                input.type = "text";
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                input.type = "password";
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        }

        document.getElementById('toggleOldPassword').addEventListener('click', function() {
            togglePasswordVisibility('old_password', 'toggleOldPassword');
        });

        document.getElementById('toggleNewPassword').addEventListener('click', function() {
            togglePasswordVisibility('password', 'toggleNewPassword');
        });

        document.getElementById('toggleConfirmPassword').addEventListener('click', function() {
            togglePasswordVisibility('confirm_password', 'toggleConfirmPassword');
        });

        function paymethod() {
            const paymentMethodSelect = document.getElementById("paymentMethod");
            const bankFields = document.querySelector(".bank-fields");
            const bkashFields = document.querySelector(".bkash-fields");
            const nagadFields = document.querySelector(".nagad-fields");

            // Helper function to show/hide fields and set required attributes
            function toggleFields() {
                // Hide all sections initially and remove required attributes
                bankFields.classList.add("d-none");
                bkashFields.classList.add("d-none");
                nagadFields.classList.add("d-none");
                bankFields.querySelectorAll("input").forEach(input => input.required = false);
                bkashFields.querySelectorAll("input").forEach(input => input.required = false);
                nagadFields.querySelectorAll("input").forEach(input => input.required = false);

                // Show and set required attributes based on selected payment method
                if (paymentMethodSelect.value === "bank") {
                    bankFields.classList.remove("d-none");
                    bankFields.querySelectorAll("input").forEach(input => input.required = true);
                } else if (paymentMethodSelect.value === "bkash") {
                    bkashFields.classList.remove("d-none");
                    bkashFields.querySelectorAll("input").forEach(input => input.required = true);
                } else if (paymentMethodSelect.value === "nagad") {
                    nagadFields.classList.remove("d-none");
                    nagadFields.querySelectorAll("input").forEach(input => input.required = true);
                }
            }

            // Initialize fields based on current selection on page load
            toggleFields();

            // Add event listener to handle changes in the selection
            paymentMethodSelect.addEventListener("change", toggleFields);
        }

        document.addEventListener("DOMContentLoaded", function() {
            paymethod();
        });
    </script>
@endsection
