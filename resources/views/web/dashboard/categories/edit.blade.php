@extends('web.dashboard.app', ['page' => 'Category'])







@section('content')
    {{-- @include('web.dashboard.components.cards') --}}



    <div class="container mt-5">
        <div class="card">
            <div class="card-body" >
                <h4 class="card-title">Edit Category</h4>
                <p class="card-description">Update the details of the category.</p>
                <img style="max-width: 500px;margin-bottom:50px" src="{{ asset($category->image_path) }}" alt="">
                <form action="{{ route('dashboard.categories.update', $category->id) }}" method="post" 
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group mb-3">
                        <label for="name">Category Name</label>
                        <input type="text" value="{{ $category->name }}" name="name" class="form-control"
                            placeholder="Enter category name">

                    </div>

                    <div class="form-group mb-3">
                        <label for="image">Category Image</label>
                        <input type="file" name="image" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>

                {{-- <form action="{{ route('dashboard.categories.update', $category->id) }}" method="post" class="mx-auto w-75">
                    @csrf
                    @method('PUT')

          
                    <div class="form-group mb-4">
                        <label for="name">Category Name</label>
                        <input type="text" id="name" name="name" class="form-control"
                            value="{{ $category->name }}" placeholder="Enter category name" required>
                    </div>

              
                    <button type="submit" class="btn btn-primary">Update</button>
                </form> --}}
            </div>
        </div>
    </div>



    </div>
@endsection
