@extends('web.dashboard.app', ['page' => 'attribute'])







@section('content')
  

    <div class="col-lg-12 col-md-10 col-sm-12 bg-white card shadow-sm">
        <div class="card-header ">
           Update Option Data
        </div>
        <div class="card-body">
            <form action="{{ route('dashboard.attribute.option.update', $option->id) }}" method="POST">
                @csrf
                @method('PATCH')

                <!-- Name Field -->
                <div class="mb-3">
                    <label for="attr_name" class="form-label">Name <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control" id="attr_name" placeholder="Enter Name"
                        value="{{ $option->name }}" required aria-label="Attribute Name">

                    @error('name')

                        <div class="text-danger mt-2">
                            {{ $message }}
                        </div>
                     
                    @enderror
                </div>

                {{-- <!-- Stock Field -->
                <div class="mb-3">
                    <label for="stock" class="form-label">Stock <span class="text-danger">*</span></label>
                    <input type="number" name="in_stock" class="form-control" id="stock" placeholder="Enter Stock"
                        value="{{ $option->in_stock }}" required aria-label="Stock Quantity">
                    <div class="form-check mt-3">
                        <input type="checkbox" value="1" class="form-check-input" id="unlimited" name="in_stock_unlimited"
                            {{ $option->in_stock_unlimited ? 'checked' : '' }}>
                        <label class="form-check-label" for="unlimited">Unlimited Stock</label>
                    </div>
                </div>

                <!-- Price Field -->
                <div class="mb-3">
                    <label for="price" class="form-label">Price <span class="text-muted">(Set 0 to make it
                            free)</span></label>
                    <div class="input-group">
                        <span class="input-group-text">৳</span>
                        <input type="number" name="price" class="form-control" id="price" placeholder="Enter Price"
                            value="{{ $option->price }}" step="0.01" required aria-label="Price">
                    </div>
                </div> --}}

                <!-- Submit Button -->
                <div class="d-flex justify-content-between mt-4">
                    <button type="submit" class="btn btn-primary" aria-label="Update Option">
                        <i class="bi bi-save"></i> Update
                    </button>
                    <a href="{{ route('dashboard.attribute.index') }}" class="btn btn-secondary"
                        aria-label="Back to Attribute List">
                        <i class="bi bi-arrow-left"></i> Back
                    </a>
                </div>
            </form>
        </div>

        <div class="card-footer text-center">
            <form action="{{ route('dashboard.attribute.option.destroy', $option->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm"
                    onclick="return confirm('Are you sure you want to delete this option?');" aria-label="Delete Option">
                    <i class="bi bi-trash"></i> Delete This Option
                </button>
            </form>
        </div>
    </div>
@endsection
