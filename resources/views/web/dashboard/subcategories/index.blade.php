@extends('web.dashboard.app', ['page' => 'Sub Category'])







@section('content')
    {{-- @include('web.dashboard.components.cards') --}}




    <div class="container mt-5">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Manage Sub Categories</h4>
                <!-- Form for Adding New Sub Category -->
                <form action="{{ route('dashboard.subcategories.store') }}" method="post" class="mb-4" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="name">Sub Category Name</label>
                                <input type="text" id="name" name="name" class="form-control" placeholder="Enter sub category name">
                                @if ($errors->has('name'))
                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="category_id">Category</label>
                                <select name="category_id" id="category_id" class="form-select" required>
                                    @foreach ($category as $d)
                                        <option value="{{ $d->id }}">{{ $d->name }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('category_id'))
                                    <span class="text-danger">{{ $errors->first('category_id') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="image">Upload Image</label>
                                <input type="file" id="image" name="image" class="form-control" accept="image/*">
                                @if ($errors->has('image'))
                                    <span class="text-danger">{{ $errors->first('image') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Create</button>
                </form>
                

                <!-- DataTable for Sub Category List -->
                <div class="table-responsive">
                    <table id="subcategoryTable" class="table table-striped">
                        <thead>
                            <tr>
                                <th>Sub Category Name</th>
                                <th>Img</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tree as $d)
                                <tr>
                                    <td>{{ $d->name }}</td>
                                     <td>
                                    @if ($d->image)
                                    <img src="{{ asset($d->image) }}" alt="{{ $d->name }}" class="img-fluid rounded" style="max-width: 50px;">
                                @else
                                    <span class="text-muted">No Image</span>
                                @endif
            
                            </td>
                                    
                                    <td>
                                        <a href="{{ route('dashboard.subcategories.edit', $d->id) }}"
                                            class="btn btn-sm btn-primary">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <form action="{{ route('dashboard.subcategories.destroy', $d->id) }}" method="post"
                                            style="display:inline;">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('Are you sure?')">
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
            $('#subcategoryTable').DataTable({
                "pageLength": 10,
                "order": [
                    [0, 'asc']
                ],
                "language": {
                    "search": "_INPUT_",
                    "searchPlaceholder": "Search subcategories..."
                },
                "columnDefs": [{
                    "orderable": false,
                    "targets": 1
                }]
            });
        });
    </script>
@endsection
