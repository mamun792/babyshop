@extends('web.dashboard.app', ['page' => 'Profile'])
@section('content')

    <div class="row gy-4">
        <div class="col-lg-4">
            <div class="user-grid-card position-relative border radius-16 overflow-hidden bg-base h-80">
                {{-- <img src="{{ asset($user->avatar) }}" alt="not found"  class="w-100 object-fit-cover"> --}}
                <img src="{{asset('user-grid-bg1.png')}}" alt="" class="w-100 object-fit-cover">
                <div class="pb-24 ms-16 mb-24 me-16  mt--100">
                    <div class="text-center border border-top-0 border-start-0 border-end-0">
                        {{-- <img src="{{ asset($user->avatar ?? 'images/default-image-url.png') }}" alt=""
                            class="border br-white border-width-2-px w-200-px h-200-px rounded-circle object-fit-cover"> --}}
                            @if (auth()->user()->avatar)
                         
                            <img src="{{ asset(auth()->user()->avatar)  }}" alt="Avatar" width="100"  class="border br-white border-width-2-px w-200-px h-200-px rounded-circle object-fit-cover">
                        @else
                            <!-- Generate avatar from user name if uploaded avatar is not available -->
                            <img src="{{ Avatar::create( auth()->user()->name )->toBase64() }}"
                                alt="Generated Avatar" width="100"  class="border br-white border-width-2-px w-200-px h-200-px rounded-circle object-fit-cover" >
                        @endif
                          
                        <h6 class="mb-0 mt-16">{{ $user->name }}</h6>
                        <span class="text-secondary-light mb-16">{{ $user->email }}</span>
                    </div>
                    <div class="mt-24">
                        <h6 class="text-xl mb-16">Personal Info</h6>
                        <ul>
                            <li class="d-flex align-items-center gap-1 mb-12">
                                <span class="w-30 text-md fw-semibold text-primary-light">Full Name</span>
                                <span class="w-70 text-secondary-light fw-medium">: {{ $user->name }}</span>
                            </li>
                            <li class="d-flex align-items-center gap-1 mb-12">
                                <span class="w-30 text-md fw-semibold text-primary-light"> Email</span>
                                <span class="w-70 text-secondary-light fw-medium">: {{ $user->email }}</span>
                            </li>
                            <li class="d-flex align-items-center gap-1 mb-12">
                                <span class="w-30 text-md fw-semibold text-primary-light"> Phone Number</span>
                                <span class="w-70 text-secondary-light fw-medium">: {{ $user->phone }}</span>
                            </li>
                            <li class="d-flex align-items-center gap-1 mb-12">
                                <span class="w-30 text-md fw-semibold text-primary-light"> Address</span>
                                <span class="w-70 text-secondary-light fw-medium">: {{ $user->street_address }} </span>
                            </li>

                            {{-- <li class="d-flex align-items-center gap-1 mb-12">
                                <span class="w-30 text-md fw-semibold text-primary-light"> Company </span>
                                <span class="w-70 text-secondary-light fw-medium">: {{ $user->company }}</span>
                            </li> --}}

                            <li class="d-flex align-items-center gap-1 mb-12">
                                <span class="w-30 text-md fw-semibold text-primary-light"> City</span>
                                <span class="w-70 text-secondary-light fw-medium">: {{ $user->city }}</span>
                            </li>


                        </ul>
                    </div>
                </div>
            </div>
        </div>
       
        <div class="col-lg-8">
            <div class="card h-100">
                <div class="card-body p-24">
                    <ul class="nav border-gradient-tab nav-pills mb-20 d-inline-flex" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link d-flex align-items-center px-24 active" id="pills-edit-profile-tab"
                                data-bs-toggle="pill" data-bs-target="#pills-edit-profile" type="button" role="tab"
                                aria-controls="pills-edit-profile" aria-selected="true">
                                Edit Profile
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link d-flex align-items-center px-24" id="pills-change-passwork-tab"
                                data-bs-toggle="pill" data-bs-target="#pills-change-passwork" type="button" role="tab"
                                aria-controls="pills-change-passwork" aria-selected="false" tabindex="-1">
                                Change Password
                            </button>
                        </li>

                    </ul>

                    <div class="tab-content" id="pills-tabContent">

                        <div class="tab-pane fade show active" id="pills-edit-profile" role="tabpanel"
                            aria-labelledby="pills-edit-profile-tab" tabindex="0">
                            <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                                @csrf
                                @method('patch')
                                <h6 class="text-md text-primary-light mb-16">Profile Image</h6>
                                <!-- Upload Image Start -->
                                <div class="mb-24 mt-16">
                                    <div class="avatar-upload">
                                        <div
                                            class="avatar-edit position-absolute bottom-0 end-0 me-24 mt-16 z-1 cursor-pointer">
                                            <input type='file' name="avatar" id="imageUpload" hidden>
                                            <label for="imageUpload"
                                                class="w-32-px h-32-px d-flex justify-content-center align-items-center bg-primary-50 text-primary-600 border border-primary-600 bg-hover-primary-100 text-lg rounded-circle">
                                                <iconify-icon icon="solar:camera-outline" class="icon"></iconify-icon>
                                            </label>
                                        </div>

                                        <div class="avatar-preview">
                                            <div id="imagePreview"
                                                style="background-image: url('{{ asset($user->avatar ?? 'images/default-image-url.png') }}'); 
                                             width: 150px; height: 150px; background-size: cover; background-position: center; border-radius: 50%;">
                                            </div>
                                        </div>
                                        {{--  error show --}}
                                        @if ($errors->has('avatar'))
                                        <span class="text-danger-600">{{ $errors->first('avatar') }}</span>
                                        @endif
                                        
                                    </div>
                                </div>

                                <!-- Upload Image End -->

                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="mb-20">
                                            <label for="name"
                                                class="form-label fw-semibold text-primary-light text-sm mb-8">Full Name
                                                <span class="text-danger-600">*</span></label>
                                            <input type="text" class="form-control radius-8" id="name"
                                                name="name" placeholder="Enter Full Name" value="{{ $user->name }}">
                                                @if ($errors->has('name'))
                                                <span class="text-danger-600">{{ $errors->first('name') }}</span>
                                                @endif
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="mb-20">
                                            <label for="email"
                                                class="form-label fw-semibold text-primary-light text-sm mb-8">Email <span
                                                    class="text-danger-600">*</span></label>
                                            <input type="email" class="form-control radius-8" id="email"
                                                name="email" placeholder="Enter email address"
                                                value="{{ $user->email }}">

                                                @if ($errors->has('email'))
                                                <span class="text-danger-600">{{ $errors->first('email') }}</span>
                                                @endif
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="mb-20">
                                            <label for="number"
                                                class="form-label fw-semibold text-primary-light text-sm mb-8">Phone</label>
                                            <input type="number" class="form-control radius-8" id="number"
                                                name="phone" placeholder="Enter phone number"
                                                value="{{ $user->phone }}">

                                                @if ($errors->has('phone'))
                                                <span class="text-danger-600">{{ $errors->first('phone') }}</span>
                                                @endif
                                        </div>
                                    </div>
                                    {{-- <div class="col-sm-6">
                                    <div class="mb-20">
                                        <label for="address" class="form-label fw-semibold text-primary-light text-sm mb-8"> <span class="text-danger-600">*</span>Company </label>
                                        <input type="text" class="form-control radius-8" id="address" name="address" placeholder="Enter address">
                                       
                                    </div> --}}
                                    <div class="col-sm-6">
                                        <div class="mb-20">
                                            <label for="city"
                                                class="form-label fw-semibold text-primary-light text-sm mb-8">City <span
                                                    class="text-danger-600"></span> </label>
                                            <input type="text" class="form-control radius-8" id="city"
                                                name="city" placeholder="Enter city" value="{{ $user->city }}">
                                              
                                                @if ($errors->has('city'))
                                                <span class="text-danger-600">{{ $errors->first('city') }}</span>
                                                @endif
                                        </div>
                                    </div>
                                </div>


                                <div class="col-sm-12">
                                    <div class="mb-20">
                                        <label for="address"
                                            class="form-label fw-semibold text-primary-light text-sm mb-8">Address</label>
                                        <textarea name="street_address" class="form-control radius-8" id="address" placeholder="Write address...">{{ $user->street_address }}</textarea>
                                    </div>
                                    @if ($errors->has('street_address'))
                                    <span class="text-danger-600">{{ $errors->first('street_address') }}</span>
                                    @endif
                                </div>

                                <div class="d-flex align-items-center  gap-3">
                                 
                                    <button type="submit"
                                        class="btn btn-primary border border-primary-600 text-md px-56 py-12 radius-8 float-end">
                                        Save
                                    </button>
                                </div>
                            </form>
                        </div>



                     
                        <div class="tab-pane fade" id="pills-change-passwork" role="tabpanel"
                            aria-labelledby="pills-change-passwork-tab" tabindex="0">
                            <form method="post" action="{{ route('password.update') }}">
                                @csrf
                                @method('put')

                                {{-- <div class="mb-20">
                                    <label for="current-password"
                                        class="form-label fw-semibold text-primary-light text-sm mb-8">
                                        Current Password <span class="text-danger-600">*</span>
                                        @if(session('error'))
                                        <span class="text-danger-600">{{ session('error') }}</span>
                                        @endif

                                    </label>
                                    <div class="position-relative">
                                        <input name="current_password" type="password" class="form-control radius-8"
                                            id="current-password" autocomplete="current-password"
                                            placeholder="Enter Current Password*">
                                        <span
                                            class="toggle-password ri-eye-line cursor-pointer position-absolute end-0 top-50 translate-middle-y me-16 text-secondary-light"
                                            data-toggle="#current-password"></span>
                                    </div>
                                </div>

                                <div class="mb-20">
                                    <label for="new-password"
                                        class="form-label fw-semibold text-primary-light text-sm mb-8">
                                        New Password <span class="text-danger-600">*</span>
                                    </label>
                                    <div class="position-relative">
                                        <input name="password" type="password" class="form-control radius-8"
                                            id="new-password" autocomplete="new-password"
                                            placeholder="Enter New Password*">
                                        <span
                                            class="toggle-password ri-eye-line cursor-pointer position-absolute end-0 top-50 translate-middle-y me-16 text-secondary-light"
                                            data-toggle="#new-password"></span>
                                    </div>
                                </div>

                                <div class="mb-20">
                                    <label for="confirm-password"
                                        class="form-label fw-semibold text-primary-light text-sm mb-8">
                                        Confirm Password <span class="text-danger-600">*</span>
                                    </label>
                                    <div class="position-relative">
                                        <input type="password" class="form-control radius-8" name="password_confirmation"
                                            id="confirm-password" autocomplete="new-password"
                                            placeholder="Confirm Password*">
                                        <span
                                            class="toggle-password ri-eye-line cursor-pointer position-absolute end-0 top-50 translate-middle-y me-16 text-secondary-light"
                                            data-toggle="#confirm-password"></span>
                                    </div>
                                </div> --}}

                                <div class="mb-20">
                                    <label for="current-password" class="form-label fw-semibold text-primary-light text-sm mb-8">
                                        Current Password <span class="text-danger-600">*</span>
                                    </label>
                                    <div class="position-relative">
                                        <input name="current_password" type="password" class="form-control radius-8" id="current-password" autocomplete="current-password" placeholder="Enter Current Password*">
                                        @error('current_password')
                                            <span class="text-danger-600">{{ $message }}</span>
                                        @enderror
                                        <span class="toggle-password ri-eye-line cursor-pointer position-absolute end-0 top-50 translate-middle-y me-16 text-secondary-light" data-toggle="#current-password"></span>
                                    </div>
                                </div>
                                
                                <div class="mb-20">
                                    <label for="new-password" class="form-label fw-semibold text-primary-light text-sm mb-8">
                                        New Password <span class="text-danger-600">*</span>
                                    </label>
                                    <div class="position-relative">
                                        <input name="password" type="password" class="form-control radius-8" id="new-password" autocomplete="new-password" placeholder="Enter New Password*">
                                        @error('password')
                                            <span class="text-danger-600">{{ $message }}</span>
                                        @enderror
                                        <span class="toggle-password ri-eye-line cursor-pointer position-absolute end-0 top-50 translate-middle-y me-16 text-secondary-light" data-toggle="#new-password"></span>
                                    </div>
                                </div>
                                
                                <div class="mb-20">
                                    <label for="confirm-password" class="form-label fw-semibold text-primary-light text-sm mb-8">
                                        Confirm Password <span class="text-danger-600">*</span>
                                    </label>
                                    <div class="position-relative">
                                        <input type="password" class="form-control radius-8" name="password_confirmation" id="confirm-password" autocomplete="new-password" placeholder="Confirm Password*">
                                        @error('password_confirmation')
                                            <span class="text-danger-600">{{ $message }}</span>
                                        @enderror
                                        <span class="toggle-password ri-eye-line cursor-pointer position-absolute end-0 top-50 translate-middle-y me-16 text-secondary-light" data-toggle="#confirm-password"></span>
                                    </div>
                                </div>
                                

                                <div class="d-flex align-items-center">
                                    <button type="submit"
                                        class="btn btn-primary border border-primary-600 text-md px-56 py-12 radius-8">
                                        Update Password
                                    </button>
                                </div>
                            </form>
                        </div>



                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('js')
    <script>
        document.getElementById('imageUpload').addEventListener('change', function() {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('imagePreview').style.backgroundImage = 'url(' + e.target.result + ')';
            }
            reader.readAsDataURL(this.files[0]);
        });

        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.toggle-password').forEach(function(toggle) {
                toggle.addEventListener('click', function() {
                    const input = document.querySelector(this.getAttribute('data-toggle'));
                    const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
                    input.setAttribute('type', type);
                    this.classList.toggle('ri-eye-line');
                    this.classList.toggle('ri-eye-off-line');
                });
            });
        });
    </script>

<script>
    $(document).ready(function() {
        @if (session('status'))
            toastr.success('{{ session('status') }}');
        @endif

        @if ($errors->any())
            @foreach ($errors->all() as $error)
                toastr.error('{{ $error }}');
            @endforeach
        @endif
    });
</script>
@endsection
