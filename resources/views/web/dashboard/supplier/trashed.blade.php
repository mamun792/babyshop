@extends('web.dashboard.app', ['page' => 'supplier'])







@section('content')
    {{-- @include('web.dashboard.components.cards') --}}

    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">

            <div class="card-header d-flex  align-items-center ">
                <a href="{{ route('dashboard.supplier.list') }}" class="btn btn-info btn-sm" title="back">
                    {{--  back icon --}}
                    <i class="fas fa-arrow-left"></i> Back
                </a>
                <p class="mb-0 flex-grow-1 text-center">Trashed Suppliers</p>


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
                          

                            @if ($suppliers->isEmpty())
                                <tr>
                                    <td colspan="6" class="text-center text-muted">No suppliers available.</td>
                                </tr>
                            @else
                                @foreach ($suppliers as $supplier)
                                    <tr>
                                        <td>{{ $supplier->id }}</td>
                                        <td>{{ $supplier->supplier_name }}</td>
                                        <td>{{ $supplier->company_name }}</td>
                                        <td>{{ $supplier->company_phone }}</td>
                                        <td>{{ $supplier->company_address }}</td>
                                        <td>
                                            @if ($supplier->trashed())
                                                <form action="{{ route('dashboard.supplier.restore', $supplier->id) }}"
                                                    method="POST" style="display: inline;">
                                                    @csrf
                                                    <button type="submit" class="btn btn-success btn-sm">
                                                        <i class="fas fa-undo"></i> Restore
                                                    </button>
                                                </form>
                                                <form action="{{ route('dashboard.supplier.forceDelete', $supplier->id) }}"
                                                    method="POST" style="display: inline;"
                                                    onsubmit="return confirm('Are you sure you want to permanently delete this supplier?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">
                                                        <i class="fas fa-trash-alt"></i> Delete
                                                    </button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @endif

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
