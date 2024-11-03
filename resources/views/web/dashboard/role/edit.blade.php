<div>
    @extends('web.dashboard.app', ['page' => 'role'])
    @section('content')
       
        <div class="col-12">
            <div class="card p-0 overflow-hidden position-relative radius-12 h-100">
                <div class="card-header py-16 px-24 bg-base border border-end-0 border-start-0 border-top-0">
                    <h6 class="text-lg mb-0">Update Role with it's permissions </h6>
                </div>
                <div class="card-body p-24 pt-10">

                    <form action="{{ route('dashboard.roles.update', $id) }}" method="POST">
                        @method('PATCH')
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Role</label>
                            <input value="{{ $roleName }}" type="text" name="name" class="form-control"
                                id="name" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Permissions Availble</label>
                            <div class="row">
                                <!-- Permissions Checkboxes -->
                                {{-- {{ dd($roles->permissions) }} --}}
                                @foreach ($permissions as $d)
                                    <div class="col-md-3 mb-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="permissions[]"
                                                value="{{ $d->name }}" id="manageCategories"
                                                {{ in_array($d->id, $rolePermissions) ? 'checked' : '' }}>
                                            <label class="form-check-label ps-3" for="manageCategories"
                                                style="margin-top: -5px;">{{ $d->name }}</label>
                                        </div>
                                    </div>
                                @endforeach


                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Update Role</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
</div>
