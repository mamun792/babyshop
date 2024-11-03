@extends('web.dashboard.app', ['page' => 'attribute'])







@section('content')
    {{-- @include('web.dashboard.components.cards') --}}






    {{-- <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Striped Table</h4>
                    <p class="card-description"> Add class <code>.table-striped</code>
                    </p>

                    <form action="{{ route('dashboard.attribute.store') }}" method="post" class="p-3 mb-3 border border-1">
                       @csrf
                        <label for="" class="mb-1">Create Attribute :</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="name">
                            <button class="btn btn-outline-dark" type="submit">Create</button>
                        </div>

                    </form>

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th> SL. </th>
                                <th> Name </th>
                                <th> Option </th>
                                <th> Action </th>


                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $d)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $d->name }}</td>
                                <td>
                                    @if (empty($d->options))
                                        N/A
                                    @else
                                    <ul>
                                        @foreach ($d->options as $x)
                                        <li>{{ $x->name }}</li>
                                     
                                        @endforeach
                                      
                                    </ul>
                                    @endif
                           
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <a href="{{ route('dashboard.attribute.option.add', ['attribute' => $d->id]) }}" class="btn btn-success btn-sm">Add Option</a>

                                        <a href="{{ route('dashboard.attribute.edit',$d->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                        <form action="{{ route('dashboard.attribute.destroy',$d->id) }}" method="post">
                                        
                                            @method('DELETE')
                                            @csrf
                                            <button class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    </div>
                            
                                    
                                </td>
                            </tr>
                            @endforeach
                          

                        

                        </tbody>
                    </table>
                </div>
            </div>
        </div> --}}
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
               
                <div class="card-header">
                    Attributes List
                </div>
                

                <!-- Create Attribute Form -->
                <form action="{{ route('dashboard.attribute.store') }}" method="POST" class="p-3 mb-4 border rounded">
                    @csrf
                    <div class="form-group">
                        <label for="attribute-name" class="form-label">Create Attribute:</label>
                        <div class="input-group">
                            <input type="text" id="attribute-name" class="form-control" name="name"
                                placeholder="Enter attribute name" required>
                            <button class="btn btn-outline-dark" type="submit">Create</button>
                        </div>
                    </div>
                </form>

                <!-- Attributes Table -->
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Name</th>
                                <th>Options</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $d)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $d->name }}</td>
                                    <td>
                                        @if ($d->options->isEmpty())
                                            N/A
                                        @else
                                            <ul class="list-unstyled mb-0">
                                                @foreach ($d->options as $x)
                                                    <li>{{ $x->name }}</li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex">
                                            <a href="{{ route('dashboard.attribute.option.add', ['attribute' => $d->id]) }}"
                                                class="btn btn-success btn-sm me-2">
                                                <i class="fas fa-plus"></i> Add Option
                                            </a>
                                            <a href="{{ route('dashboard.attribute.edit', $d->id) }}"
                                                class="btn btn-primary btn-sm me-2">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>
                                            <form action="{{ route('dashboard.attribute.destroy', $d->id) }}" method="POST"
                                                onsubmit="return confirm('Are you sure you want to delete this attribute?');">
                                                @method('DELETE')
                                                @csrf
                                                <button class="btn btn-danger btn-sm">
                                                    <i class="fas fa-trash"></i> Delete
                                                </button>
                                            </form>
                                        </div>
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
            $('.table').DataTable();
        });
    </script>
@endsection
