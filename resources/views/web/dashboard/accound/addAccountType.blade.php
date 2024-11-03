<div>
    @extends('web.dashboard.app')
    @section('content')
        <div class="container mt-5">
            {{-- <a href="{{ route('dashboard.accounts.addAccountType') }}" class="btn btn-dark">
                <i class="fas fa-arrow-left"></i>
            </a> --}}
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card shadow-sm border-light">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <span class="text-center flex-grow-1">Add Account</span>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('dashboard.accounts.storeAccountType') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="accountName" class="form-label">Account Name</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        id="scconutName" name="name" placeholder="Enter Account type"
                                        value="{{ old('name') }}">

                                    @error('name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>




                                <div class="d-flex justify-content-center mt-4">
                                    <button type="submit" class="btn btn-primary">Add Account</button>
                                </div>
                            </form>
                        </div>
                    </div>

                   

                    <div class="card mt-5 shadow-sm">
                        <div class="card-header d-flex justify-content-between align-items-center ">
                            <h5 class="mb-0 text-center flex-grow-1">Account Types</h5>
                        </div>
                    
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col" class="text-center">SL</th>
                                        <th scope="col">Account Name</th>
                                        <th scope="col" class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($accountTypes as $key => $accountType)
                                        <tr>
                                            <th scope="row" class="text-center">{{ $key + 1 }}</th>
                                            <td>{{ $accountType->name }}</td>
                                            <td class="text-center">
                                                <a href="{{ route('dashboard.accounts.editAccountType', $accountType->id) }}"
                                                    class="btn btn-sm btn-primary me-2" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                
                                                <form action="{{ route('dashboard.accounts.deleteAccountType', $accountType->id) }}"
                                                    method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" title="Delete"
                                                        onclick="return confirm('Are you sure you want to delete this account type?')">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    
                        <div class="card-footer text-end">
                            @if ($accountTypes->isNotEmpty())
                                <p class="mb-0">
                                    Showing <strong>{{ $accountTypes->firstItem() }}</strong> to
                                    <strong>{{ $accountTypes->lastItem() }}</strong> of
                                    <strong>{{ $accountTypes->total() }}</strong> entries
                                </p>
                            @else
                                <p class="mb-0">No entries found.</p>
                            @endif
                        </div>
                    </div>
                    
                    <div class="mt-4 d-flex justify-content-center">
                        {{ $accountTypes->links('pagination::bootstrap-5') }}
                    </div>
                    

                </div>
                
            </div>

            
        </div>
        @endsection
    </div>
