@extends('web.dashboard.app', ['page' => 'Category'])



{{-- <div class="card basic-data-table">
    <div class="card-header">
        <h5 class="card-title mb-0">Default Datatables</h5>
    </div>
    <div class="card-body">
        <table class="table bordered-table mb-0 dataTable" id="dataTable">
                       
            <thead>
                <tr role="row">
           <th>sdfsdf</th>
           <th></th>
           <th>sdfsdf</th>
           <th></th>
           <th></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="sorting_1">
                        <div class="form-check style-check d-flex align-items-center">
                            <input class="form-check-input" type="checkbox">
                            <label class="form-check-label">
                                01
                            </label>
                        </div>
                    </td>
                    <td><a href="javascript:void(0)" class="text-primary-600">#526534</a></td>
                    <td>
                        <div class="d-flex align-items-center">
                            <img src="assets/images/user-list/user-list1.png" alt=""
                                class="flex-shrink-0 me-12 radius-8">
                            <h6 class="text-md mb-0 fw-medium flex-grow-1">Kathryn Murphy</h6>
                        </div>
                    </td>
                    <td>25 Jan 2024</td>
                    <td class="dt-type-numeric">$200.00</td>
                    <td> <span
                            class="bg-success-focus text-success-main px-24 py-4 rounded-pill fw-medium text-sm">Paid</span>
                    </td>
                    <td>
                        <a href="javascript:void(0)"
                            class="w-32-px h-32-px bg-primary-light text-primary-600 rounded-circle d-inline-flex align-items-center justify-content-center">
                            <iconify-icon icon="iconamoon:eye-light"></iconify-icon>
                        </a>
                        <a href="javascript:void(0)"
                            class="w-32-px h-32-px bg-success-focus text-success-main rounded-circle d-inline-flex align-items-center justify-content-center">
                            <iconify-icon icon="lucide:edit"></iconify-icon>
                        </a>
                        <a href="javascript:void(0)"
                            class="w-32-px h-32-px bg-danger-focus text-danger-main rounded-circle d-inline-flex align-items-center justify-content-center">
                            <iconify-icon icon="mingcute:delete-2-line"></iconify-icon>
                        </a>
                    </td>
                </tr>
                <tr>
                    <td class="sorting_1">
                        <div class="form-check style-check d-flex align-items-center">
                            <input class="form-check-input" type="checkbox">
                            <label class="form-check-label">
                                01
                            </label>
                        </div>
                    </td>
                    <td><a href="javascript:void(0)" class="text-primary-600">#526534</a></td>
                    <td>
                        <div class="d-flex align-items-center">
                            <img src="assets/images/user-list/user-list1.png" alt=""
                                class="flex-shrink-0 me-12 radius-8">
                            <h6 class="text-md mb-0 fw-medium flex-grow-1">Kathryn Murphy</h6>
                        </div>
                    </td>
                    <td>25 Jan 2024</td>
                    <td class="dt-type-numeric">$200.00</td>
                    <td> <span
                            class="bg-success-focus text-success-main px-24 py-4 rounded-pill fw-medium text-sm">Paid</span>
                    </td>
                    <td>
                        <a href="javascript:void(0)"
                            class="w-32-px h-32-px bg-primary-light text-primary-600 rounded-circle d-inline-flex align-items-center justify-content-center">
                            <iconify-icon icon="iconamoon:eye-light"></iconify-icon>
                        </a>
                        <a href="javascript:void(0)"
                            class="w-32-px h-32-px bg-success-focus text-success-main rounded-circle d-inline-flex align-items-center justify-content-center">
                            <iconify-icon icon="lucide:edit"></iconify-icon>
                        </a>
                        <a href="javascript:void(0)"
                            class="w-32-px h-32-px bg-danger-focus text-danger-main rounded-circle d-inline-flex align-items-center justify-content-center">
                            <iconify-icon icon="mingcute:delete-2-line"></iconify-icon>
                        </a>
                    </td>
                </tr>
                <tr>
                    <td class="sorting_1">
                        <div class="form-check style-check d-flex align-items-center">
                            <input class="form-check-input" type="checkbox">
                            <label class="form-check-label">
                                02
                            </label>
                        </div>
                    </td>
                    <td><a href="javascript:void(0)" class="text-primary-600">#696589</a></td>
                    <td>
                        <div class="d-flex align-items-center">
                            <img src="assets/images/user-list/user-list2.png" alt=""
                                class="flex-shrink-0 me-12 radius-8">
                            <h6 class="text-md mb-0 fw-medium flex-grow-1">Annette Black</h6>
                        </div>
                    </td>
                    <td>25 Jan 2024</td>
                    <td class="dt-type-numeric">$200.00</td>
                    <td> <span
                            class="bg-success-focus text-success-main px-24 py-4 rounded-pill fw-medium text-sm">Paid</span>
                    </td>
                    <td>
                        <a href="javascript:void(0)"
                            class="w-32-px h-32-px bg-primary-light text-primary-600 rounded-circle d-inline-flex align-items-center justify-content-center">
                            <iconify-icon icon="iconamoon:eye-light"></iconify-icon>
                        </a>
                        <a href="javascript:void(0)"
                            class="w-32-px h-32-px bg-success-focus text-success-main rounded-circle d-inline-flex align-items-center justify-content-center">
                            <iconify-icon icon="lucide:edit"></iconify-icon>
                        </a>
                        <a href="javascript:void(0)"
                            class="w-32-px h-32-px bg-danger-focus text-danger-main rounded-circle d-inline-flex align-items-center justify-content-center">
                            <iconify-icon icon="mingcute:delete-2-line"></iconify-icon>
                        </a>
                    </td>
                </tr>
                <tr>
                    <td class="sorting_1">
                        <div class="form-check style-check d-flex align-items-center">
                            <input class="form-check-input" type="checkbox">
                            <label class="form-check-label">
                                02
                            </label>
                        </div>
                    </td>
                    <td><a href="javascript:void(0)" class="text-primary-600">#696589</a></td>
                    <td>
                        <div class="d-flex align-items-center">
                            <img src="assets/images/user-list/user-list2.png" alt=""
                                class="flex-shrink-0 me-12 radius-8">
                            <h6 class="text-md mb-0 fw-medium flex-grow-1">Annette Black</h6>
                        </div>
                    </td>
                    <td>25 Jan 2024</td>
                    <td class="dt-type-numeric">$200.00</td>
                    <td> <span
                            class="bg-success-focus text-success-main px-24 py-4 rounded-pill fw-medium text-sm">Paid</span>
                    </td>
                    <td>
                        <a href="javascript:void(0)"
                            class="w-32-px h-32-px bg-primary-light text-primary-600 rounded-circle d-inline-flex align-items-center justify-content-center">
                            <iconify-icon icon="iconamoon:eye-light"></iconify-icon>
                        </a>
                        <a href="javascript:void(0)"
                            class="w-32-px h-32-px bg-success-focus text-success-main rounded-circle d-inline-flex align-items-center justify-content-center">
                            <iconify-icon icon="lucide:edit"></iconify-icon>
                        </a>
                        <a href="javascript:void(0)"
                            class="w-32-px h-32-px bg-danger-focus text-danger-main rounded-circle d-inline-flex align-items-center justify-content-center">
                            <iconify-icon icon="mingcute:delete-2-line"></iconify-icon>
                        </a>
                    </td>
                </tr>
                <tr>
                    <td class="sorting_1">
                        <div class="form-check style-check d-flex align-items-center">
                            <input class="form-check-input" type="checkbox">
                            <label class="form-check-label">
                                03
                            </label>
                        </div>
                    </td>
                    <td><a href="javascript:void(0)" class="text-primary-600">#256584</a></td>
                    <td>
                        <div class="d-flex align-items-center">
                            <img src="assets/images/user-list/user-list3.png" alt=""
                                class="flex-shrink-0 me-12 radius-8">
                            <h6 class="text-md mb-0 fw-medium flex-grow-1">Ronald Richards</h6>
                        </div>
                    </td>
                    <td>10 Feb 2024</td>
                    <td class="dt-type-numeric">$200.00</td>
                    <td> <span
                            class="bg-success-focus text-success-main px-24 py-4 rounded-pill fw-medium text-sm">Paid</span>
                    </td>
                    <td>
                        <a href="javascript:void(0)"
                            class="w-32-px h-32-px bg-primary-light text-primary-600 rounded-circle d-inline-flex align-items-center justify-content-center">
                            <iconify-icon icon="iconamoon:eye-light"></iconify-icon>
                        </a>
                        <a href="javascript:void(0)"
                            class="w-32-px h-32-px bg-success-focus text-success-main rounded-circle d-inline-flex align-items-center justify-content-center">
                            <iconify-icon icon="lucide:edit"></iconify-icon>
                        </a>
                        <a href="javascript:void(0)"
                            class="w-32-px h-32-px bg-danger-focus text-danger-main rounded-circle d-inline-flex align-items-center justify-content-center">
                            <iconify-icon icon="mingcute:delete-2-line"></iconify-icon>
                        </a>
                    </td>
                </tr>
                <tr>
                    <td class="sorting_1">
                        <div class="form-check style-check d-flex align-items-center">
                            <input class="form-check-input" type="checkbox">
                            <label class="form-check-label">
                                03
                            </label>
                        </div>
                    </td>
                    <td><a href="javascript:void(0)" class="text-primary-600">#256584</a></td>
                    <td>
                        <div class="d-flex align-items-center">
                            <img src="assets/images/user-list/user-list3.png" alt=""
                                class="flex-shrink-0 me-12 radius-8">
                            <h6 class="text-md mb-0 fw-medium flex-grow-1">Ronald Richards</h6>
                        </div>
                    </td>
                    <td>10 Feb 2024</td>
                    <td class="dt-type-numeric">$200.00</td>
                    <td> <span
                            class="bg-success-focus text-success-main px-24 py-4 rounded-pill fw-medium text-sm">Paid</span>
                    </td>
                    <td>
                        <a href="javascript:void(0)"
                            class="w-32-px h-32-px bg-primary-light text-primary-600 rounded-circle d-inline-flex align-items-center justify-content-center">
                            <iconify-icon icon="iconamoon:eye-light"></iconify-icon>
                        </a>
                        <a href="javascript:void(0)"
                            class="w-32-px h-32-px bg-success-focus text-success-main rounded-circle d-inline-flex align-items-center justify-content-center">
                            <iconify-icon icon="lucide:edit"></iconify-icon>
                        </a>
                        <a href="javascript:void(0)"
                            class="w-32-px h-32-px bg-danger-focus text-danger-main rounded-circle d-inline-flex align-items-center justify-content-center">
                            <iconify-icon icon="mingcute:delete-2-line"></iconify-icon>
                        </a>
                    </td>
                </tr>
                <tr>
                    <td class="sorting_1">
                        <div class="form-check style-check d-flex align-items-center">
                            <input class="form-check-input" type="checkbox">
                            <label class="form-check-label">
                                04
                            </label>
                        </div>
                    </td>
                    <td><a href="javascript:void(0)" class="text-primary-600">#526587</a></td>
                    <td>
                        <div class="d-flex align-items-center">
                            <img src="assets/images/user-list/user-list4.png" alt=""
                                class="flex-shrink-0 me-12 radius-8">
                            <h6 class="text-md mb-0 fw-medium flex-grow-1">Eleanor Pena</h6>
                        </div>
                    </td>
                    <td>10 Feb 2024</td>
                    <td class="dt-type-numeric">$150.00</td>
                    <td> <span
                            class="bg-success-focus text-success-main px-24 py-4 rounded-pill fw-medium text-sm">Paid</span>
                    </td>
                    <td>
                        <a href="javascript:void(0)"
                            class="w-32-px h-32-px bg-primary-light text-primary-600 rounded-circle d-inline-flex align-items-center justify-content-center">
                            <iconify-icon icon="iconamoon:eye-light"></iconify-icon>
                        </a>
                        <a href="javascript:void(0)"
                            class="w-32-px h-32-px bg-success-focus text-success-main rounded-circle d-inline-flex align-items-center justify-content-center">
                            <iconify-icon icon="lucide:edit"></iconify-icon>
                        </a>
                        <a href="javascript:void(0)"
                            class="w-32-px h-32-px bg-danger-focus text-danger-main rounded-circle d-inline-flex align-items-center justify-content-center">
                            <iconify-icon icon="mingcute:delete-2-line"></iconify-icon>
                        </a>
                    </td>
                </tr>
                <tr>
                    <td class="sorting_1">
                        <div class="form-check style-check d-flex align-items-center">
                            <input class="form-check-input" type="checkbox">
                            <label class="form-check-label">
                                04
                            </label>
                        </div>
                    </td>
                    <td><a href="javascript:void(0)" class="text-primary-600">#526587</a></td>
                    <td>
                        <div class="d-flex align-items-center">
                            <img src="assets/images/user-list/user-list4.png" alt=""
                                class="flex-shrink-0 me-12 radius-8">
                            <h6 class="text-md mb-0 fw-medium flex-grow-1">Eleanor Pena</h6>
                        </div>
                    </td>
                    <td>10 Feb 2024</td>
                    <td class="dt-type-numeric">$150.00</td>
                    <td> <span
                            class="bg-success-focus text-success-main px-24 py-4 rounded-pill fw-medium text-sm">Paid</span>
                    </td>
                    <td>
                        <a href="javascript:void(0)"
                            class="w-32-px h-32-px bg-primary-light text-primary-600 rounded-circle d-inline-flex align-items-center justify-content-center">
                            <iconify-icon icon="iconamoon:eye-light"></iconify-icon>
                        </a>
                        <a href="javascript:void(0)"
                            class="w-32-px h-32-px bg-success-focus text-success-main rounded-circle d-inline-flex align-items-center justify-content-center">
                            <iconify-icon icon="lucide:edit"></iconify-icon>
                        </a>
                        <a href="javascript:void(0)"
                            class="w-32-px h-32-px bg-danger-focus text-danger-main rounded-circle d-inline-flex align-items-center justify-content-center">
                            <iconify-icon icon="mingcute:delete-2-line"></iconify-icon>
                        </a>
                    </td>
                </tr>
                <tr>
                    <td class="sorting_1">
                        <div class="form-check style-check d-flex align-items-center">
                            <input class="form-check-input" type="checkbox">
                            <label class="form-check-label">
                                05
                            </label>
                        </div>
                    </td>
                    <td><a href="javascript:void(0)" class="text-primary-600">#105986</a></td>
                    <td>
                        <div class="d-flex align-items-center">
                            <img src="assets/images/user-list/user-list5.png" alt=""
                                class="flex-shrink-0 me-12 radius-8">
                            <h6 class="text-md mb-0 fw-medium flex-grow-1">Leslie Alexander</h6>
                        </div>
                    </td>
                    <td>15 March 2024</td>
                    <td class="dt-type-numeric">$150.00</td>
                    <td> <span
                            class="bg-warning-focus text-warning-main px-24 py-4 rounded-pill fw-medium text-sm">Pending</span>
                    </td>
                    <td>
                        <a href="javascript:void(0)"
                            class="w-32-px h-32-px bg-primary-light text-primary-600 rounded-circle d-inline-flex align-items-center justify-content-center">
                            <iconify-icon icon="iconamoon:eye-light"></iconify-icon>
                        </a>
                        <a href="javascript:void(0)"
                            class="w-32-px h-32-px bg-success-focus text-success-main rounded-circle d-inline-flex align-items-center justify-content-center">
                            <iconify-icon icon="lucide:edit"></iconify-icon>
                        </a>
                        <a href="javascript:void(0)"
                            class="w-32-px h-32-px bg-danger-focus text-danger-main rounded-circle d-inline-flex align-items-center justify-content-center">
                            <iconify-icon icon="mingcute:delete-2-line"></iconify-icon>
                        </a>
                    </td>
                </tr>
                <tr>
                    <td class="sorting_1">
                        <div class="form-check style-check d-flex align-items-center">
                            <input class="form-check-input" type="checkbox">
                            <label class="form-check-label">
                                05
                            </label>
                        </div>
                    </td>
                    <td><a href="javascript:void(0)" class="text-primary-600">#105986</a></td>
                    <td>
                        <div class="d-flex align-items-center">
                            <img src="assets/images/user-list/user-list5.png" alt=""
                                class="flex-shrink-0 me-12 radius-8">
                            <h6 class="text-md mb-0 fw-medium flex-grow-1">Leslie Alexander</h6>
                        </div>
                    </td>
                    <td>15 March 2024</td>
                    <td class="dt-type-numeric">$150.00</td>
                    <td> <span
                            class="bg-warning-focus text-warning-main px-24 py-4 rounded-pill fw-medium text-sm">Pending</span>
                    </td>
                    <td>
                        <a href="javascript:void(0)"
                            class="w-32-px h-32-px bg-primary-light text-primary-600 rounded-circle d-inline-flex align-items-center justify-content-center">
                            <iconify-icon icon="iconamoon:eye-light"></iconify-icon>
                        </a>
                        <a href="javascript:void(0)"
                            class="w-32-px h-32-px bg-success-focus text-success-main rounded-circle d-inline-flex align-items-center justify-content-center">
                            <iconify-icon icon="lucide:edit"></iconify-icon>
                        </a>
                        <a href="javascript:void(0)"
                            class="w-32-px h-32-px bg-danger-focus text-danger-main rounded-circle d-inline-flex align-items-center justify-content-center">
                            <iconify-icon icon="mingcute:delete-2-line"></iconify-icon>
                        </a>
                    </td>
                </tr>
            </tbody>
            <tfoot></tfoot>
        </table>
    </div>
</div> --}}




@section('content')
    {{-- @include('web.dashboard.components.cards') --}}





<div class="container mt-5">
    <!-- Category Form -->
    <div class="card mb-4">
        <div class="card-body">
            <h4 class="card-title">Add New Category</h4>
            {{-- all error --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('dashboard.categories.store') }}" method="post" class="mx-auto" enctype="multipart/form-data">
                @csrf
                <div class="form-group mb-3">
                    <label for="name">Category Name</label>
                    <input type="text" id="name" name="name" class="form-control" placeholder="Enter category name" >
                    @if($errors->has('name'))
                        <div class="text-danger">{{ $errors->first('name') }}</div>
                    @endif
                </div>
              
                <div class="form-group mb-3">
                    <label for="image">Category Image</label>
                    <input type="file"  name="c_image"class="form-control" >
                    @if($errors->has('c_image'))
                        <div class="text-danger">{{ $errors->first('c_image') }}</div>
                    @endif
                </div>
                <button type="submit" class="btn btn-primary">Create</button>
            </form>
        </div>

    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Category List</h4>
            <p class="card-description">Below is the list of categories.</p>
            <div class="table-responsive">
                <table id="categoryTable" class="table table-striped">
                    <thead>
                        <tr>
                            <th>Category Name</th>
                            <th>Img</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tree as $d)
                        <tr>
                            <td>{{ $d->name }}</td>
                            <td>
                                <img src="{{ asset($d->image_path) }}" alt="{{ $d->name }}" class="img-fluid" style="max-width: 80px;">
                            </td>
                            <td>
                                <a href="{{ route('dashboard.categories.edit', $d->id) }}" class="btn btn-sm btn-primary">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <form action="{{ route('dashboard.categories.destroy', $d->id) }}" method="post" style="display:inline;">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    </div>


@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $('#categoryTable').DataTable({
                "paging": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "lengthChange": true,
                "pageLength": 10
            });
        });
    </script>
@endsection
