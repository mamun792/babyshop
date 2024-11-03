@extends('web.dashboard.app', ['page' => 'api'])

@section('content')

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header ">
                    AmerPay Settings
                </div>
                <div class="card-body">
                    <form action="#" method="POST">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="store_id">Store ID</label>
                                <input type="text" name="store_id" id="store_id" class="form-control" value="{{ $settings->store_id ?? '' }}" required>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="signature_key"> signature key</label>
                                <input type="text" name="signature_key" id="signature_key" class="form-control" value="{{ $settings->signature_key ?? '' }}" required>
                            </div>
                        </div>


                        <div class="text-right mt-4">
                            <button type="submit" class="btn btn-primary">Save Settings</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection