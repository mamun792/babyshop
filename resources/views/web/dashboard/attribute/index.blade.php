@extends('web.dashboard.app', ['page' => 'attribute'])







@section('content')
    {{-- @include('web.dashboard.components.cards') --}}


    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
               <div class="card-header ">
                Attributes List

               </div>
           

                <table id="attributesTable" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                    <thead>
                        <tr>
                            <th>SL.</th>
                            <th>Name</th>
                            <th>Option</th>
                            <th>Action</th>
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
                                        <a href="{{ route('dashboard.attribute.option.add', ['attribute' => $d->id]) }}"
                                            class="btn btn-success btn-sm me-2" title="Add Option">
                                            <i class="fas fa-plus"></i> Add Option
                                        </a>
                                        <a href="{{ route('dashboard.attribute.edit', $d->id) }}"
                                            class="btn btn-primary btn-sm me-2" title="Edit">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <form action="{{ route('dashboard.attribute.destroy', $d->id) }}" method="post"
                                            onsubmit="return confirm('Are you sure you want to delete this attribute?');">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-danger btn-sm" title="Delete">
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
@endsection
@section('js')
    <script>
        $(document).ready(function() {
            $('#attributesTable').DataTable({
                responsive: true,
                paging: true,
                searching: true,
                ordering: true
            });
        });
    </script>
@endsection
