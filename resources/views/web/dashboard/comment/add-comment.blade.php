@extends('web.dashboard.app', ['page' => 'Comment'])

@section('content')


<div class="container mt-5">
    {{-- back oprion --}}
    <div class="mb-4">
        <a href="{{ route('dashboard.comments.index') }}" class="btn btn-dark btn-sm d-inline-flex align-items-center">
            <i class="fa fa-arrow-left mr-2"></i> 
        </a>
    </div>
    
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Add New Comment</div>
                <div class="card-body">
                    <form action="{{route('dashboard.comments.store')}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" id="name">
                            
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- <div class="form-group mt-2">
                            <label for="status">Status</label>
                            <select name="status" class="form-control" required>
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div> --}}
                        <br>

                        <button type="submit" class="btn btn-primary mt-4">Add Comment</button>
                      
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection