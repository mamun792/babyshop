@extends('web.dashboard.app', ['page' => 'supplier'])







@section('content')
    {{-- @include('web.dashboard.components.cards') --}}


    <div class="d-flex justify-content-center align-items-center min-vh-100 bg-light">



        <form action="{{ route('dashboard.supplier.update', $supplier->id) }}" method="POST"
            class="w-50 mx-auto bg-white p-3">
            @csrf
            @method('PATCH')
            <h4 class="mb-4 text-center text-primary">Edit Supplier</h4>
            <div class="row mb-4">
                <div class="col-md-12">
                    <label for="supplier_name" class="form-label">Supplier Name</label>
                    <input value="{{ $supplier->supplier_name }}" type="text" class="form-control" id="supplier_name"
                        name="supplier_name">
                    @if ($errors->has('supplier_name'))
                        <span class="text-danger">{{ $errors->first('supplier_name') }}</span>
                    @endif
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-md-12">
                    <label for="company_name" class="form-label">Company Name</label>
                    <input value="{{ $supplier->company_name }}" type="text" class="form-control" id="company_name"
                        name="company_name" required>
                    @if ($errors->has('company_name'))
                        <span class="text-danger">{{ $errors->first('company_name') }}</span>
                    @endif
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-md-12">
                    <label for="company_phone" class="form-label">Company Phone</label>
                    <input value="{{ $supplier->company_phone }}" type="tel" class="form-control" id="company_phone"
                        name="company_phone" required>
                    @if ($errors->has('company_phone'))
                        <span class="text-danger">{{ $errors->first('company_phone') }}</span>
                    @endif
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-md-12">
                    <label for="company_address" class="form-label">Company Address</label>
                    <textarea class="form-control" id="company_address" name="company_address" rows="4" required>{{ $supplier->company_address }}
                        @if ($errors->has('company_address'))
<span class="text-danger">{{ $errors->first('company_address') }}</span>
@endif
                    </textarea>
                </div>
            </div>
            </br>
            <div class="text-center mt-4">
                <button type="submit" class="btn btn-primary px-5 ">Update Supplier</button>
            </div>
        </form>

    </div>
@endsection
