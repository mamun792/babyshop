@extends('web.dashboard.app', ['page' => 'api'])

@section('content')

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header ">
                  SSLCommerz Settings
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
                                <label for="store_password">Store Password</label>
                                <input type="text" name="store_password" id="store_password" class="form-control" value="{{ $settings->store_password ?? '' }}" required>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="currency">Currency</label>
                                <input type="text" name="currency" id="currency" class="form-control" value="{{ $settings->currency ?? '' }}" required>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="route_success">Success URL Route</label>
                                <input type="text" name="route_success" id="route_success" class="form-control" value="{{ $settings->route_success ?? '' }}" required>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="route_failure">Failure URL Route</label>
                                <input type="text" name="route_failure" id="route_failure" class="form-control" value="{{ $settings->route_failure ?? '' }}" required>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="route_cancel">Cancel URL Route</label>
                                <input type="text" name="route_cancel" id="route_cancel" class="form-control" value="{{ $settings->route_cancel ?? '' }}" required>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="route_ipn">IPN URL Route</label>
                                <input type="text" name="route_ipn" id="route_ipn" class="form-control" value="{{ $settings->route_ipn ?? '' }}" required>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="allow_localhost">Allow Localhost</label>
                                <select name="allow_localhost" id="allow_localhost" class="form-control" required>
                                    <option value="1" {{ isset($settings) && $settings->allow_localhost ? 'selected' : '' }}>TRUE</option>
                                    <option value="0" {{ isset($settings) && !$settings->allow_localhost ? 'selected' : '' }}>FALSE</option>
                                </select>
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
