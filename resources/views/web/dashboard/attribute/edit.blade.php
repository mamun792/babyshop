@extends('web.dashboard.app', ['page' => 'attribute'])







@section('content')
   

    <div class="col-lg-10 col-md-12 mx-auto grid-margin stretch-card">
        <div class="card shadow-sm">
            <div class="card-header ">
               Update Attribute Data
            </div>
            <div class="card-body">
                
                <!-- Form to update attribute name -->
                <div class="mb-5">
                    <p class="form-text text-muted"><code>Change Attribute Name:</code></p>
                    <form action="{{ route('dashboard.attribute.update', $data->id) }}" method="post">
                        @method('PATCH')
                        @csrf
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" name="name" value="{{ $data->name }}" required placeholder="Enter attribute name">
                            <button class="btn btn-dark" type="submit">
                                <i class="bi bi-save"></i> Update
                            </button>
                        </div>
                    </form>
                </div>
    
                <!-- Divider -->
                <hr class="my-4">
    
                <!-- Options list -->
                <div class="mb-3">
                    <p class="form-text text-muted"><code><small>Edit Options:</small></code></p>
                    <div class="list-group">
                        @foreach ($data->options as $d)
                            <a href="{{ route('dashboard.attribute.option.edit', $d->id) }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                {{ $d->name }}
                                <span class="badge bg-secondary rounded-pill">
                                    <i class="bi bi-pencil text-white"></i>
                                </span>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    
@endsection
