@extends('web.dashboard.app', ['page' => 'api'])

@section('content')
    <div class="container mt-5">
        <div class="card shadow-sm">
            <div class="card-header">
                <h5 class="card-title mb-0">Courier Settings</h5>
            </div>
            <div class="card-body">
                <!-- Success Message -->

                <div class="alert alert-success" role="alert" style="display: none;">
                    Data updated successfully.
                </div>

                <!-- Courier Selection -->
                <div class="form-group mb-5">
                    <label for="courier_selection">Select which courier you want to use <span
                            class="text-danger">*</span></label>
                    <select name="courier" id="courier_selection" class="form-control">
                        <option value="pathao">Pathao Courier</option>
                        <option value="steadfast" selected>Steadfast Courier</option> <!-- Set Steadfast as default -->
                        <option value="redx">RedX Courier</option>
                    </select>
                </div>

                <!-- Pathao Courier Settings -->
                <div id="pathao_settings mt-3" class="courier-settings mt-4">
                    <p class="text-danger">Pathao Courier</p>
                    <div class="form-group">
                        <label for="pathao_client_id">Pathao Client ID <span class="text-danger">*</span></label>
                        <input type="text" id="pathao_client_id" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="pathao_secret">Pathao Client Secret <span class="text-danger">*</span></label>
                        <input type="text" id="pathao_secret" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="pathao_username">Pathao Username <span class="text-danger">*</span></label>
                        <input type="text" id="pathao_username" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="pathao_password">Pathao Password <span class="text-danger">*</span></label>
                        <input type="password" id="pathao_password" class="form-control">
                    </div>
                </div>

                <!-- Steadfast Courier Settings -->
                <div id="steadfast_settings " class="courier-settings mt-5">
                    <p class="text-danger">Steadfast Courier</p>


                    

                    <div class="form-group mt-2">
                        <label for="steadfast_api_key">Courier API Key <span class="text-danger">*</span></label>
                        <input type="text" id="steadfast_api_key" class="form-control"
                            value="{{ $steadfast ? $steadfast->api_key : '' }}"> 
                        <div class="invalid-feedback" id="api_key_error" style="display: none;"></div>
                    </div>

                    <div class="form-group mt-2">
                        <label for="steadfast_secret_key">Courier Secret Key <span class="text-danger">*</span></label>
                        <input type="text" id="steadfast_secret_key" class="form-control"
                            value="{{ $steadfast ? $steadfast->secret_key : '' }}"> 
                        <div class="invalid-feedback" id="secret_key_error" style="display: none;"></div>
                    </div>


                </div>

                <!-- RedX Courier Settings -->
                <div id="redx_settings" class="courier-settings mt-5">
                    <p class="text-danger">RedX Courier</p>
                    <div class="form-group mt-2">
                        <label for="redx_sandbox">RedX Sandbox Mode <span class="text-danger">*</span></label>
                        <select id="redx_sandbox" class="form-control">
                            <option value="true">True</option>

                        </select>
                    </div>
                    <div class="form-group mt-2 mb-3">
                        <label for="redx_access_token">RedX Access Token <span class="text-danger">*</span></label>
                        <input type="text" id="redx_access_token" class="form-control">
                    </div>
                </div>

                <!-- Save Button -->
                <button type="button" class="btn btn-primary btn-lg btn-block mt-4" onclick="submitCourierSettings()">Save
                    Settings</button>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        function submitCourierSettings() {
            // Get the selected courier
            const selectedCourier = document.getElementById("courier_selection").value;

            // Prepare data to be submitted
            let data = {
                courier: selectedCourier
            };

            // Collect data based on the selected courier
            switch (selectedCourier) {
                case 'pathao':
                    data.client_id = document.getElementById('pathao_client_id').value;
                    data.secret = document.getElementById('pathao_secret').value;
                    data.username = document.getElementById('pathao_username').value;
                    data.password = document.getElementById('pathao_password').value;
                    break;



                case 'steadfast':
                    data.api_key = document.getElementById('steadfast_api_key').value;
                    data.secret_key = document.getElementById('steadfast_secret_key').value;


                    axios.post('{{ route('dashboard.steadfast.courier.store') }}', data)
                        .then(response => {
                            console.log(response.data);
                            // Reset the form
                            document.getElementById('steadfast_api_key').value = '';
                            document.getElementById('steadfast_secret_key').value = '';


                            document.getElementById('api_key_error').style.display = 'none';
                            document.getElementById('secret_key_error').style.display = 'none';


                            document.querySelector('.alert-success').style.display = 'block';


                            setTimeout(() => {
                                window.location.reload();
                            }, 1000);
                        })
                        .catch(error => {
                            console.error(error);

                            if (error.response && error.response.status === 422) {
                                const errors = error.response.data.errors;


                                document.getElementById('api_key_error').style.display = 'none';
                                document.getElementById('secret_key_error').style.display = 'none';


                                if (errors.api_key) {
                                    document.getElementById('api_key_error').innerText = errors.api_key.join(
                                        ', ');
                                    document.getElementById('api_key_error').style.display =
                                        'block';
                                }

                                if (errors.secret_key) {
                                    document.getElementById('secret_key_error').innerText = errors.secret_key.join(
                                        ', ');
                                    document.getElementById('secret_key_error').style.display =
                                        'block';
                                }
                            }
                        });
                    break;






                case 'redx':
                    data.sandbox = document.getElementById('redx_sandbox').value;
                    data.access_token = document.getElementById('redx_access_token').value;
                    break;
            }


            console.log(data);

        }
    </script>
@endsection
