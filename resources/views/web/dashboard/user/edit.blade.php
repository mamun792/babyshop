<div>
    @extends('web.dashboard.app', ['page' => 'user'])
    @section('content')
        {{-- @include('web.dashboard.components.cards') --}}


        <div class="container my-4">
            <form action="{{route('dashboard.address-book.personal-info.update')}}" method="POST">
                @csrf
                @method('PATCH') <!-- Assuming you are using PATCH method for update -->
                
                <!-- Single Card for All Inputs -->
                <div class="card">
                    <div class="card-header">
                        <h5>Update Your Information</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <!-- Full Name Input -->
                            <div class="col-md-6 mb-4">
                                <div class="form-group">
                                    <label for="name">Full Name</label>
                                    <input type="text" name="name" id="name" class="form-control" value="{{ $user->name }}" placeholder="Enter your full name">
                                </div>
                                @if($errors->has('name'))
                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
        
                            <!-- Email Address Input -->
                            <div class="col-md-6 mb-4">
                                <div class="form-group">
                                    <label for="email">Email Address</label>
                                    <input type="email" name="email" id="email" class="form-control" value="{{ $user->email }}" placeholder="Enter your email address">
                                </div>
                                @if($errors->has('email'))
                                    <span class="text-danger">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
        
                            <!-- Mobile Number Input -->
                            <div class="col-md-6 mb-4">
                                <div class="form-group">
                                    <label for="phone">Mobile Number</label>
                                    <input type="tel" name="phone" id="phone" class="form-control" value="{{ $user->phone }}" placeholder="Enter your mobile number">
                                </div>
                                @if($errors->has('phone'))
                                    <span class="text-danger">{{ $errors->first('phone') }}</span>
                                @endif
                            </div>
        
                            <!-- Address Input -->
                            <div class="col-md-6 mb-4">
                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <input type="text"  id="address" name="street_address" class="form-control" value="{{ $user->street_address }}" placeholder="Enter your address">
                                </div>
                            </div>
        
                          
        
                            
        
                            
                        </div>
                    </div>
                    <!-- Card Footer with Submit Button -->
                    <div class="card-footer text-center">
                        <button type="submit" class="btn btn-primary btn-lg">Update Information</button>
                    </div>
                </div>
            </form>
        </div>
        
        
        
    @endsection
</div>
