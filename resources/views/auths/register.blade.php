@include('components.auth-header')

<style>
    /* General styles */
    .auth {
        min-height: 100vh;
        display: flex;
        background-color: #ffffff;
    }

    .auth-left {
        flex: 1;
        background-color: #f7f8fa;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .auth-right {
        flex: 1;
        padding: 2rem;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .max-w-464-px {
        max-width: 464px;
        width: 100%;
    }

    .form-control {
        width: 100%;
        padding: 0.75rem 1rem;
        height: 56px;
        border-radius: 12px;
        border: 1px solid #e3e3e3;
        background-color: #f8f9fa;
        margin-top: 10px;
        font-size: 1rem;
        transition: border-color 0.2s;
    }

    .form-control.error {
        border-color: #dc3545;
    }

    .form-control:focus {
        border-color: #007bff;
    }

    .icon-field {
        position: relative;
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
    }

    .icon-field .icon {
        margin-right: 10px;
    }

    .toggle-password {
        cursor: pointer;
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
    }

    .text-danger {
        font-size: 0.875rem;
        margin-top: 5px;
    }

    .btns {
        display: block;
        width: 100%;
        padding: 12px;
        border: none;
        border-radius: 12px;
        background-color: #007bff;
        color: #ffffff;
        font-size: 1rem;
        cursor: pointer;
        transition: background-color 0.2s;
    }

    .strength-indicator {
        height: 5px;
        width: 100%;
        margin-top: 5px;
        border-radius: 5px;
        background-color: transparent;
    }
</style>
<body>
<section class="auth">
    <div class="auth-left d-lg-block d-none">
        <div class="d-flex align-items-center flex-column h-100 justify-content-center">
            <img src="{{ asset('images/auth/auth-img.png') }}" alt="Image not found">
        </div>
    </div>
    <div class="auth-right">
        <div class="max-w-464-px mx-auto">
            <h4>Sign Up to Your Account</h4>
            <p class="text-secondary-light">Welcome back! Please enter your details.</p>
          
          

            <form method="POST" action="{{ route('register') }}" id="registration-form">
                @csrf
                <div class="icon-field">
                    <span class="icon"><iconify-icon icon="f7:person"></iconify-icon></span>
                    <input type="text" name="name" class="form-control {{ $errors->has('name') ? 'error' : '' }}"
                        placeholder="Username" value="{{ old('name') }}" required>
                </div>
                @error('name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                
                <div class="icon-field">
                    <span class="icon"><iconify-icon icon="mage:email"></iconify-icon></span>
                    <input type="email" name="email" class="form-control {{ $errors->has('email') ? 'error' : '' }}"
                        placeholder="Email" value="{{ old('email') }}" required>
                </div>
                @error('email')
                    <div class="text-danger">{{ $message }}</div>
                @enderror

                <div class="mb-20">
                    <div class="icon-field">
                        <span class="icon"><iconify-icon icon="solar:lock-password-outline"></iconify-icon></span>
                        <input type="password" name="password"
                            class="form-control {{ $errors->has('password') ? 'error' : '' }}" id="your-password"
                            placeholder="Password" required oninput="checkPasswordStrength()">
                        <span class="toggle-password ri-eye-line" onclick="togglePasswords()"></span>
                    </div>
                    <span class="mt-12 text-sm text-secondary-light">Your password must have at least 8 characters</span>
                    <div class="strength-indicator" id="strength-indicator"></div>
                </div>
                @error('password')
                    <div class="text-danger">{{ $message }}</div>
                @enderror

                <div class="mb-20">
                    <div class="icon-field">
                        <span class="icon"><iconify-icon icon="solar:lock-password-outline"></iconify-icon></span>
                        <input type="password" name="password_confirmation" class="form-control"
                            id="your-password-confirmation" placeholder="Confirm Password" required>
                        <span class="toggle-password ri-eye-line" onclick="toggleConPasswords()"></span>
                    </div>
                </div>

                <div class="form-check style-check d-flex align-items-start gap-2 mb-4">
                    <input class="form-check-input" type="checkbox" name="terms" id="condition" required>
                    <label class="form-check-label" for="condition">
                        By creating an account, you agree to the
                        <a href="{{ route('conditions') }}" class="text-primary-600 fw-semibold">Terms & Conditions</a>
                        and our
                        <a href="{{ route('polices') }}" class="text-primary-600 fw-semibold">Privacy Policy</a>.
                    </label>
                </div>
                
                <button type="submit" class="btns">Sign Up</button>
            </form>

            <div class="mt-32 text-center">
                <p>Already have an account? <a href="{{ route('login') }}" class="text-primary-600 fw-semibold">Sign In</a></p>
            </div>
        </div>
    </div>

    <script>
        function togglePasswords() {
            const passwordField = document.getElementById('your-password');
            const toggleIcon = event.currentTarget;
            const isPassword = passwordField.type === 'password';

            passwordField.type = isPassword ? 'text' : 'password';
            toggleIcon.className = isPassword ? 'toggle-password ri-eye-off-line' : 'toggle-password ri-eye-line';
        }

        function toggleConPasswords() {
            const passwordField = document.getElementById('your-password-confirmation');
            const toggleIcon = event.currentTarget;
            const isPassword = passwordField.type === 'password';

            passwordField.type = isPassword ? 'text' : 'password';
            toggleIcon.className = isPassword ? 'toggle-password ri-eye-off-line' : 'toggle-password ri-eye-line';
        }

        // function checkPasswordStrength() {
        //     const password = document.getElementById('your-password').value;
        //     const strengthIndicator = document.getElementById('strength-indicator');
        //     let strength = 0;

        //     if (password.length >= 8) strength += 1;
        //     if (/[A-Z]/.test(password)) strength += 1;
        //     if (/[a-z]/.test(password)) strength += 1;
        //     if (/[0-9]/.test(password)) strength += 1;
        //     if (/[^A-Za-z0-9]/.test(password)) strength += 1;

        //     switch (strength) {
        //         case 0:
        //         case 1:
        //             strengthIndicator.style.backgroundColor = 'red';
        //             break;
        //         case 2:
        //             strengthIndicator.style.backgroundColor = 'orange';
        //             break;
        //         case 3:
        //             strengthIndicator.style.backgroundColor = 'yellow';
        //             break;
        //         case 4:
        //         case 5:
        //             strengthIndicator.style.backgroundColor = 'green';
        //             break;
        //     }
        // }
    </script>

    @include('components.auth-footer')
</section>

</body>
