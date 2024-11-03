@extends('web.dashboard.app', ['page' => 'api'])

@section('content')


<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title
            mb-0">Baksh API Settings</h5>

        </div>
        <div class="card">
            <div class="card-body">
                
                <form action="#" method="POST">
                    @csrf
                    <!-- bkash_username -->
                    <div class="form-group">
                        <label for="bkash_username">bKash Username</label>
                        <input type="text" name="bkash_username" id="bkash_username" class="form-control" placeholder="Enter bKash Username" value="{{ old('bkash_username') }}" required>
                    </div>

                    <!-- bkash_password -->
                    <div class="form-group mt-3">
                        <label for="bkash_password">bKash Password</label>
                        <input type="password" name="bkash_password" id="bkash_password" class="form-control" placeholder="Enter bKash Password" value="{{ old('bkash_password') }}" required>
                    </div>

                    <!-- API Key -->
                    <div class="form-group">
                        <label for="api_key">bKash API Key</label>
                        <input type="text" name="api_key" id="api_key" class="form-control" placeholder="Enter bKash API Key" value="{{ old('api_key') }}" required>
                    </div>
        
                    <!-- Secret Key -->
                    <div class="form-group mt-3">
                        <label for="secret_key">bKash Secret Key</label>
                        <input type="text" name="secret_key" id="secret_key" class="form-control" placeholder="Enter bKash Secret Key" value="{{ old('secret_key') }}" required>
                    </div>
        
                    <!-- Callback URL -->
                    <div class="form-group mt-3">
                        <label for="callback_url">bKash Callback URL</label>
                        <input type="url" name="callback_url" id="callback_url" class="form-control" placeholder="Enter Callback URL" value="{{ old('callback_url', 'http://127.0.0.1:8000/bkash/callback') }}" required>
                    </div>
        
                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary btn-lg btn-block mt-4">Save Settings</button>
                </form>
            </div>
        </div>
        
    </div>
</div>

@endsection