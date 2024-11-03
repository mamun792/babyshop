@extends('web.dashboard.app')
@section('content')

<div class="container mt-5">
    <a href="{{ route('dashboard.accounts.addAccountType') }}" class="btn btn-dark">
        <i class="fas fa-arrow-left"></i>
    </a>
    <div class="row justify-content-center">
        
        <div class="col-md-8">
            <div class="card shadow-sm border-light">
                <div class="card-header text-center">
                    <p>{{ isset($accountType) ? 'Edit Account Type' : 'Add Account Type' }}</p>
                </div>

                <div class="card-body">
                    <form action="{{ isset($accountType) ? route('dashboard.accounts.updateAccountType', $accountType->id) : route('dashboard.accounts.storeAccountType') }}" method="POST">
                        @csrf
                        @if(isset($accountType))
                            @method('PATCH')
                        @endif
                        
                        <div class="mb-3">
                            <label for="accountName" class="form-label">Account Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="accountName" name="name" placeholder="Enter Account Name"
                                value="{{ old('name', $accountType->name ?? '') }}">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-center mt-4">
                            <button type="submit" class="btn btn-primary">
                                {{ isset($accountType) ? 'Update Account' : 'Add Account' }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
