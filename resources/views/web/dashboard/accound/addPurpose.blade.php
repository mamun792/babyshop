<div>
    @extends('web.dashboard.app')
    @section('content')

    <div class="container mt-5">
        <a href="{{route('dashboard.accounts.accountPurpose')}}"  class="btn btn-dark">
            <i class="fas fa-arrow-left"></i>
        </a>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm border-light">
                    <div class="card-header d-flex justify-content-between align-items-center">
                      <span class="text-center flex-grow-1">Add Purpose</span>
                    </div>
                    <div class="card-body">
                        <form action="{{route('dashboard.accounts.storePurpose')}}" method="POST">
                            @csrf 
                            <div class="mb-3">
                                <label for="purposeName" class="form-label">Purpose Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="purposeName" name="name" placeholder="Enter purpose type"  value="{{ old('name') }}">
                                
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            

                        
    
                            <div class="d-flex justify-content-center mt-4">
                                <button type="submit" class="btn btn-primary">Add Purpose</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
       

    @endsection
</div>