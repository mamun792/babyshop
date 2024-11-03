<div>
    @extends('web.dashboard.app', ['page' => 'Manage Roles'])
    @section('content')
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Manage Roles</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <a href="{{ route('dashboard.roles.create') }}"
                            class="btn btn-primary-600 radius-8 px-14 py-6 mb-3 text-sm float-end">Add new role /
                            permission</a>

                        <table class="table table-bordered mb-0">
                            <thead>
                                <tr>
                                    <th scope="col">Role</th>
                                    <th scope="col">Permissions</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($roles as $role)
                                    <tr>
                                        <td> <small> {{ $role->name }} </small></td>
                                        <td>
                                            @if ($role->permissions->isEmpty())
                                                <p class="px-2"> <small>No permissions assigned to this role.</small> </p>
                                            @else
                                                <div class="d-flex flex-wrap">
                                                    @foreach ($role->permissions as $permission)
                                                        <span
                                                            class="badge text-sm fw-semibold border border bg-transparent radius-4 text-secondary-light mb-2 me-2">
                                                            {{ $permission->name }} <i class="ri-edit-2-line"
                                                                style="opacity: 0.5;"
                                                                onclick="permission('{{ route('dashboard.roles.permissionUpdate', $permission->id) }}')"></i>
                                                            <i style="opacity: 0.5;" onclick="deletePermission('{{ route('dashboard.roles.permissionDelete', $permission->id) }}')"
                                                                class="ri-delete-bin-line"></i>

                                                        </span>
                                                    @endforeach
                                                </div>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex flex-wrap align-items-center justify-content-between">
                                                <div class="dropdown">
                                                    <button class="btn text-primary-light" type="button"
                                                        data-bs-toggle="dropdown" aria-expanded="false">
                                                        <iconify-icon icon="entypo:dots-three-vertical"
                                                            class="menu-icon"></iconify-icon>
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li><a href="{{ route('dashboard.roles.edit', $role->id) }}"
                                                                class="dropdown-item rounded text-secondary-light bg-hover-neutral-200 text-hover-neutral-900">Edit
                                                                Role</a></li>
                                                        <li>
                                                            <a onclick="document.getElementById('deleteForm-{{ $role->id }}').submit(); return false;"
                                                                class="dropdown-item px-16 py-8 rounded text-secondary-light bg-hover-neutral-200 text-hover-neutral-900">Delete
                                                                Role</a>
                                                            <form id="deleteForm-{{ $role->id }}"
                                                                action="{{ route('dashboard.roles.destroy', $role->id) }}"
                                                                method="POST" hidden>
                                                                @csrf
                                                                @method('DELETE')
                                                            </form>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div><!-- card end -->
        </div>
    @endsection

    @section('js')
        <script>
            function permission(url) {

                Swal.fire({
                    text: "Update Permission Name",
                    input: "text",
                    inputAttributes: {
                        autocapitalize: "off"
                    },
                    showCancelButton: true,

                    confirmButtonText: "Update",

                    cancelButtonText: "Cancel",
                    showLoaderOnConfirm: true,
                    inputPlaceholder: "Write a new name for this permission",

                    allowOutsideClick: () => !Swal.isLoading()
                }).then((result) => {


                    if (result.isConfirmed) {
                        console.log('Is confirmed..')

                        axios.post(url, {
                            name: result.value
                        })
                        Swal.fire({
                            text: `New name is : ${result.value}`,
                            imageUrl: result.value.avatar_url
                        });
                        location.reload(true);
                    } else if (result.isDismissed) {
                        Swal.fire('Action was cancelled', '', 'warning');
                    }
                });
            }

            function deletePermission(url) {

                Swal.fire({
                    text: "Delete Permission ?",
                 
                    showCancelButton: true,

                    confirmButtonText: "Delete",

                    cancelButtonText: "Cancel",
                    showLoaderOnConfirm: true,
                 

                    allowOutsideClick: () => !Swal.isLoading()
                }).then((result) => {


                    if (result.isConfirmed) {
                        console.log('Is confirmed..')

                        axios.post(url)
                        Swal.fire({
                            text: `Permission Deleted`,
                            imageUrl: result.value.avatar_url
                        });
                        location.reload(true);
                    } else if (result.isDismissed) {
                        Swal.fire('Action was cancelled', '', 'warning');
                    }
                });
            }


            $(document).ready(function() {
                $('#rolesTable').DataTable();
            });
        </script>
    @endsection
</div>
