<div>
    @extends('web.dashboard.app')
    @section('content')
        {{-- @include('web.dashboard.components.cards') --}}

        <div class="container mt-5">
            <div class="row">
                <div class="col-md-10">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center">
                                <a href="{{ route('dashboard.accounts.addPurpose') }}" class="btn btn-dark btn-sm me-2">
                                    {{-- Add purpose --}}
                                    <i class="fas fa-plus"></i>
                                </a>
                            </div>
                            <span class="text-center flex-grow-1">Purpose</span>
                        </div>



                        {{-- <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Credit Or Debit purpose</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($purposes as $index => $purpose)
                                            <tr>
                                                <th scope="row">{{ $index + 1 }}</th> <!-- Using $index to display the row number -->
                                                <td>{{ $purpose->name }}</td>
                                                <td>
                                                    <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" 
                                                       data-id="{{ $purpose->id }}" 
                                                       data-name="{{ $purpose->name }}">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table> --}}


                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Purpose Name</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($purposes as $index => $purpose)
                                    <tr>
                                        <th scope="row">
                                            {{ $index + 1 + ($purposes->currentPage() - 1) * $purposes->perPage() }}
                                        </th>
                                        <td>{{ $purpose->name }}</td>
                                        <td>
                                            <a href="{{ route('dashboard.accounts.editPurpose', ['id' => $purpose->id]) }}"
                                                class="btn btn-sm btn-primary">
                                                <i class="fas fa-edit"></i>
                                            </a>

                                            <form
                                                action="{{ route('dashboard.accounts.deletePurpose', ['id' => $purpose->id]) }}"
                                                method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Are you sure you want to delete this purpose?')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="mb-3 text-center">
                            @if ($purposes->isNotEmpty())
                                <p class="mb-0">
                                    Showing
                                    <strong>{{ $purposes->firstItem() }}</strong> to
                                    <strong>{{ $purposes->lastItem() }}</strong> of
                                    <strong>{{ $purposes->total() }}</strong> entries
                                </p>
                            @else
                                <p class="mb-0">No entries found.</p>
                            @endif
                        </div>



                        <div class="mt-4">
                                        {{ $purposes->links('pagination::bootstrap-5') }}
                                    </div>



                    </div>

                </div>
            </div>
        </div>
            @endsection
        </div>
