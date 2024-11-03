@extends('web.dashboard.app', ['page' => 'supplier'])







@section('content')
    {{-- @include('web.dashboard.components.cards') --}}




    <div class="d-flex justify-content-center align-items-center min-vh-100 bg-light">
        <form action="{{ route('dashboard.supplier.store') }}" method="POST" class="w-75 bg-white p-5 rounded shadow-sm">
            @csrf

            <h6 class="mb-4 text-center ">Create New Supplier</h6>

            <div class="row mb-4">
                <div class="col-md-12">
                    <label for="supplier_name" class="form-label">Supplier Name</label>
                    <input type="text" class="form-control" id="supplier_name" name="supplier_name"
                        placeholder="Enter supplier name">
                    @if ($errors->has('supplier_name'))
                        <span class="text-danger">{{ $errors->first('supplier_name') }}</span>
                    @endif
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-md-12">
                    <label for="company_name" class="form-label">Company Name</label>
                    <input type="text" class="form-control" id="company_name" name="company_name"
                        placeholder="Enter company name" required>
                    @if ($errors->has('company_name'))
                        <span class="text-danger">{{ $errors->first('company_name') }}</span>
                    @endif
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-md-12">
                    <label for="company_phone" class="form-label">Company Phone</label>
                    <input type="tel" class="form-control" id="company_phone" name="company_phone"
                        placeholder="0178...." required>
                    @if ($errors->has('company_phone'))
                        <span class="text-danger">{{ $errors->first('company_phone') }}</span>
                    @endif
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-md-12">
                    <label for="company_address" class="form-label">Company Address</label>
                    <textarea class="form-control" id="company_address" name="company_address" rows="4"
                        placeholder="Enter company address" required>
                        @if ($errors->has('company_address'))
                      <span class="text-danger">{{ $errors->first('company_address') }}</span>
                       @endif
                    </textarea>
                </div>
            </div>
            </br>
            <div class="text-center mt-4">
                <button type="submit" class="btn btn-primary px-5 m">Create Supplier</button>
            </div>
        </form>
    </div>
@endsection
