<div>
    @extends('web.dashboard.app', ['page' => 'Role and Permission'])
    @section('content')
        <div class="col-12">
            <div class="card p-0 overflow-hidden position-relative radius-12 h-100">
                <div class="card-header py-16 px-24 bg-base border border-end-0 border-start-0 border-top-0">
                    <h6 class="text-lg mb-0">Role and Permission </h6>
                </div>
                <div class="card-body p-24 pt-10">
                    <ul class="nav bordered-tab border border-top-0 border-start-0 border-end-0 d-inline-flex nav-pills mb-16"
                        id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link px-16 py-10 active" id="pills-home-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home"
                                aria-selected="true">Create Role</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link px-16 py-10" id="pills-details-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-details" type="button" role="tab" aria-controls="pills-details"
                                aria-selected="false" tabindex="-1">Create Permission</button>
                        </li>

                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade active show" id="pills-home" role="tabpanel"
                            aria-labelledby="pills-home-tab" tabindex="0">
                            <div>
                                <form action="{{ route('dashboard.roles.store') }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Role</label>
                                        <input type="text" name="name" class="form-control" id="name" required>
                                    </div>
                                    {{--  error  --}}
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    <div class="mb-3">
                                        <label class="form-label">Permissions Availble</label>
                                        <div class="row">
                                            <!-- Permissions Checkboxes -->
                                            @foreach ($permissions as $d)
                                                <div class="col-md-3 mb-2">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="permissions[]"
                                                            value="{{ $d->name }}" id="manageCategories">
                                                        <label class="form-check-label ps-3" for="manageCategories"
                                                            style="margin-top: -5px;">{{ $d->name }}</label>
                                                    </div>
                                                </div>
                                            @endforeach


                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Create Role</button>
                                </form>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-details" role="tabpanel" aria-labelledby="pills-details-tab"
                            tabindex="0">
                            <div>
                                <form  action="{{ route('dashboard.roles.store') }}"   method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Permission Name</label>
                                        <input type="text" name="name" class="form-control" id="name" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Roles Available</label>
                                        <div class="row">
                                            <!-- Permissions Checkboxes -->
                                            @foreach ($roles as $d)
                                                <div class="col-md-3 mb-2">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="permissions[]"
                                                            value="{{ $d->name }}" id="manageCategories">
                                                        <label class="form-check-label ps-3" for="manageCategories"
                                                            style="margin-top: -5px;">{{ $d->name }}</label>
                                                    </div>
                                                </div>
                                            @endforeach


                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Create Role</button>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>


    @endsection
</div>
