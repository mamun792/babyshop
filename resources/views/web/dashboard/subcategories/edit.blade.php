@extends('web.dashboard.app', ['page' => 'Sub Category'])







@section('content')
    {{-- @include('web.dashboard.components.cards') --}}


    <div class="container mt-5">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Edit Subcategory</h4>
                <p class="card-description">Update the details of the subcategory.</p>

                <!-- Update Form -->
                <form action="{{ route('dashboard.subcategories.update', $subcategory->id) }}" method="post" class="mx-auto w-75" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                
                    <!-- Subcategory Name -->
                    <div class="form-group mb-4">
                        <label for="name">Subcategory Name</label>
                        <input type="text" id="name" name="name" class="form-control"
                            value="{{ $subcategory->name }}" placeholder="Enter subcategory name">
                        @if ($errors->has('name'))
                            <span class="text-danger">{{ $errors->first('name') }}</span>
                        @endif
                    </div>
                
                    <!-- Category Selection -->
                    <div class="form-group mb-4">
                        <label for="category_id">Category</label>
                        <select name="category_id" id="category_id" class="form-select" required>
                            @foreach ($category as $d)
                                <option value="{{ $d->id }}"
                                    {{ $d->id == $subcategory->category_id ? 'selected' : '' }}>
                                    {{ $d->name }}
                                </option>
                            @endforeach
                        </select>
                        @if ($errors->has('category_id'))
                            <span class="text-danger">{{ $errors->first('category_id') }}</span>
                        @endif
                    </div>
                
                    <!-- Image Upload -->
                    <div class="form-group mb-4">
                        <label for="image">Subcategory Image</label>
                        <input type="file" id="image" name="image" class="form-control" accept="image/*">
                        <small class="form-text text-muted">Leave blank to keep the current image.</small>
                        @if ($errors->has('image'))
                            <span class="text-danger">{{ $errors->first('image') }}</span>
                        @endif
                        @if ($subcategory->image)
                            <div class="mt-2">
                                <img src="{{ asset($subcategory->image) }}" alt="Current Image" class="img-thumbnail" style="max-width: 150px;">
                            </div>
                        @endif
                    </div>
                
                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
                
            </div>
        </div>
    </div>
@endsection
