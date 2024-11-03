@extends('web.dashboard.app', ['page' => 'attribute'])







@section('content')
  


        


                <div class="row mt-5">
                    <div class="col-lg-8 col-md-10 col-sm-12 bg-white p-4 rounded shadow-sm mx-auto my-4">
                        <div class="text-center mb-4">
                            <h6 class="font-weight-bold text-primary">Create New Option</h6>
                            <p class="text-muted">Fill out the details below to create a new option.</p>
                        </div>
                        <form class="admin-form" action="{{ route('dashboard.attribute.option.store', request()->get('attribute')) }}" method="POST">
                            @csrf
                
                            <!-- Option Name Field -->
                            <div class="row mb-4">
                                <label for="attr_name" class="col-sm-3 col-form-label text-start">Option Name <span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <input type="text" name="name" class="form-control" id="attr_name" placeholder="e.g., Color, Size" required>
                                    <div class="form-text text-muted">Enter the name of the option.</div>
                                </div>
                            </div>
                
                            {{-- Uncomment to include Stock Field
                            <div class="row mb-4">
                                <label for="stock" class="col-sm-3 col-form-label text-start">Stock <span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <input type="number" name="in_stock" class="form-control" id="stock" placeholder="Enter Stock" required>
                                    <div class="form-text text-muted">Specify the available stock quantity.</div>
                                </div>
                            </div>
                
                            <div class="row mb-4">
                                <label for="price" class="col-sm-3 col-form-label text-start">Price <small class="text-muted">(Set 0 for free)</small></label>
                                <div class="col-sm-9">
                                    <div class="input-group">
                                        <span class="input-group-text">৳</span>
                                        <input type="number" name="price" class="form-control" id="price" placeholder="Enter Price" step="0.01" required>
                                    </div>
                                    <div class="form-text text-muted">Enter the price for this option.</div>
                                </div>
                            </div>
                            --}}
                
                            <!-- Submit Button -->
                            <div class="row">
                                <div class="col-sm-9 offset-sm-3">
                                    <button type="submit" class="btn btn-primary btn-lg w-100 hover-shadow">
                                        <i class="bi bi-check2-circle"></i> Add Option
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                
                <!-- Add custom styles -->
                <style>
                    .hover-shadow:hover {
                        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
                    }
                </style>
                
        

    @endsection
