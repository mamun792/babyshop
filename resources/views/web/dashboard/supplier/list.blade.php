@extends('web.dashboard.app', ['page' => 'supplier'])







@section('content')
    {{-- @include('web.dashboard.components.cards') --}}






    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center ">
              All Suppliers

               <a href="{{ route('dashboard.supplier.trashed') }}" class="btn btn-info btn-sm"
               title="Show Trashed Suppliers">
               <i class="fas fa-eye"></i> Trashed
           </a>

            </div>
            <div class="card-body">
                <div class="row">
                    <table class="table table-striped" id="example">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Supplier Name</th>
                                <th>Company Name</th>
                                <th>Company Phone</th>
                                <th>Company Address</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($suppliers as $supplier)
                                <tr>
                                    <td>{{ $supplier->id }}</td>
                                    <td>{{ $supplier->supplier_name }}</td>
                                    <td>{{ $supplier->company_name }}</td>
                                    <td>{{ $supplier->company_phone }}</td>
                                    <td>{{ $supplier->company_address }}</td>
                                    <td>
                                        <!-- Edit Button -->
                                        <a href="{{ route('dashboard.supplier.edit', $supplier->id) }}"
                                            class="btn btn-primary btn-sm" title="Edit Supplier">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>

                                        {{-- <!-- Soft Delete / Disable Button -->
                                        <form action="{{ route('dashboard.supplier.destroy', $supplier->id) }}"
                                            method="POST" style="display: inline;"
                                            onsubmit="return confirm('Are you sure you want to disable this supplier?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-dark btn-sm">
                                                <i class="fas fa-trash-alt"></i> Delete
                                            </button>
                                        </form>

                                        {{--  olnly treast show page  --}}
                                        {{-- <a href="{{ route('dashboard.supplier.trashed') }}" class="btn btn-info btn-sm"
                                            title="Show Trashed Suppliers">
                                            <i class="fas fa-eye"></i> Trashed
                                        </a>  --}}

                                        <!-- Soft Delete / Disable Button -->
                                        <form action="{{ route('dashboard.supplier.destroy', $supplier->id) }}"
                                            method="POST" style="display: inline;"
                                            onsubmit="return confirm('Are you sure you want to disable this supplier?');">
                                            @csrf
                                            @method('DELETE')

                                            @if ($supplier->trashed())
                                                <!-- If the supplier is already trashed -->
                                                <button type="submit" class="btn btn-danger btn-sm">
                                                    <i class="fas fa-undo-alt"></i> Restore
                                                </button>
                                            @else
                                                <!-- If the supplier is active -->
                                                <button type="submit" class="btn btn-dark btn-sm">
                                                    <i class="fas fa-trash-alt"></i> Delete
                                                </button>
                                            @endif
                                        </form>

                                        {{-- Only show trashed suppliers page --}}
                                        {{-- <a href="{{ route('dashboard.supplier.trashed') }}" class="btn btn-info btn-sm"
                                            title="Show Trashed Suppliers">
                                            <i class="fas fa-eye"></i> Trashed
                                        </a> --}}




                                        <!-- Restore and Force Delete Buttons (only shown for trashed records) -->
                                        @if ($supplier->trashed())
                                            <form action="{{ route('supplier.restore', $supplier->id) }}" method="POST"
                                                style="display: inline;">
                                                @csrf
                                                <button type="submit" class="btn btn-success btn-sm">
                                                    <i class="fas fa-undo"></i> Restore
                                                </button>
                                            </form>

                                            <form action="{{ route('supplier.forceDelete', $supplier->id) }}" method="POST"
                                                style="display: inline;"
                                                onsubmit="return confirm('Are you sure you want to permanently delete this supplier?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">
                                                    <i class="fas fa-trash"></i> Delete Permanently
                                                </button>
                                            </form>
                                        @endif
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
        new DataTable('#example');
    </script>
@endsection
