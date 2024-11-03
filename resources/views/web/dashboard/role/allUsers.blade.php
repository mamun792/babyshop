    @extends('web.dashboard.app', ['page' => 'User Management'])
    @section('content')
        {{-- {{-- @include('web.dashboard.components.cards') --}}
        {{-- <div class="col-lg-7 mx-auto">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Bordered Tables</h5>
                </div>
                <div class="card-body">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table striped-table mb-0">
                                <thead>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Address</th>
                                    <th>Company</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($usersWithRoles as $d)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <img src="assets/images/product/product-img1.png" alt=""
                                                        class="flex-shrink-0 me-12 radius-8 me-12">
                                                    <div class="flex-grow-1">
                                                        <h6 class="text-md mb-0 fw-normal">{{ $d->name }}</h6>
                                                        <span
                                                            class="text-sm text-secondary-light fw-normal">{{ $d->roles->pluck('name')->implode(',') }}</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{ $d->email }}</td>

                                            <td >
                                               {{ $d->street_address }}
                                            </td>
                                            <td class="text-center">
                                                {{ $d->company }}
                                            </td>
                                        </tr>
                                    @endforeach


                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div><!-- card end -->
        </div> --}}
        <div class="col-lg-10 mx-auto">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0"> All Users</h5>
                </div>
                <div class="card-body">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="users-table" class="table striped-table mb-0">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Address</th>
                                        <th>Company</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($usersWithRoles as $d)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <img src="assets/images/product/product-img1.png" alt=""
                                                        class="flex-shrink-0 me-12 radius-8 me-12">
                                                    <div class="flex-grow-1">
                                                        <h6 class="text-md mb-0 fw-normal">{{ $d->name }}</h6>
                                                        <span
                                                            class="text-sm text-secondary-light fw-normal">{{ $d->roles->pluck('name')->implode(',') }}</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{ $d->email }}</td>
                                            <td>{{ $d->street_address }}</td>
                                            <td class="text-center">{{ $d->company }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div><!-- card end -->
        </div>
    @endsection
    @section('js')
        <script>
            $(document).ready(function() {
                $('#users-table').DataTable();
            });
        </script>
    @endsection
