@extends('web.dashboard.app', ['page' => 'campaigns'])


@section('content')
{{-- @include('web.dashboard.components.cards') --}}
<div class="card col-md-6 mx-auto">
    <div class="card-header">
        <h6 class="card-title mb-0">Create Campaign</h6>
    </div>
    <div class="card-body">

        <form action="{{ route('dashboard.campaign.store') }}" method="POST">
            @csrf
            <div class="row gy-3">
                <div class="col-12">
                    <label for="name">Campaign Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                        id="name" name="name" placeholder="Enter campaign name"
                        value="{{ old('name') }}">
                    <x-validation-errors field="name" />
                    @if ($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                    @endif
                </div>

                <div class="col-12">
                    <label for="start_date">Start Date</label>
                    <input type="date" class="form-control @error('start_date') is-invalid @enderror"
                        name="start_date" id="start_date" value="{{ old('start_date') }}">
                    <x-validation-errors field="start_date" />

                    @if ($errors->has('start_date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('start_date') }}
                    </div>
                    @endif
                </div>

                <div class="col-12">
                    <label for="expiry_date">Expiry Date</label>
                    <input type="date" class="form-control @error('expiry_date') is-invalid @enderror" id="expiry_date" name="expiry_date" value="{{ old('expiry_date') }}">
                    <x-validation-errors field="expiry_date" />
                    @if ($errors->has('expiry_date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('expiry_date') }}
                    </div>
                    @endif
                </div>

                <div class="col-12">
                    <label for="discount">Discount</label>
                    <input type="text" class="form-control @error('discount') is-invalid @enderror"
                        id="discount" name="discount" placeholder="Enter Discount .. Eg: 20% , 200" step="0.01"
                        value="{{ old('discount') }}">
                    <x-validation-errors field="discount" />
                    @if ($errors->has('discount'))
                    <div class="invalid-feedback">
                        {{ $errors->first('discount') }}
                    </div>
                    @endif
                </div>

                <div class="col-12">
                    <label for="code">Discount Code</label>
                    <input type="text" class="form-control @error('code') is-invalid @enderror"
                        id="code" name="code" placeholder="Enter Discount Code .. Eg: abc , xyz" step="0.01"
                        value="{{ old('code') }}">
                    <x-validation-errors field="code" />
                    @if ($errors->has('code'))
                    <div class="invalid-feedback">
                        {{ $errors->first('code') }}
                    </div>
                    @endif
                </div>

               
            </div>
            <br>
            <button type="submit" class="btn btn-primary w-100 ">Add Campaign</button>
        </form>

    </div>
</div>


@endsection
@section('js')

@endsection
