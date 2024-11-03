<div>
    @extends('web.dashboard.app')
    @section('content')
       

    <div class="container mt-5">
        <div class="card mx-auto" style="max-width: 600px; margin-top: 20px;">
            <div class="card-header d-flex justify-content-between align-items-center">
                <a href="{{ route('dashboard.accounts.income') }}" class="btn btn-dark">
                    <i class="fas fa-arrow-left"></i>
                </a>
                <p class="mb-0 text-center flex-grow-1">Add Debit</p>
            </div>

            {{-- eror  --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
    
            <div class="card-body">
                <div class="container">
                    <form action="{{route('dashboard.accounts.storeCredit')}}" method="POST" enctype="multipart/form-data"> 
                        @csrf

                        <div class="form-row col-md-12">
                            <div class="col-md-12 mb-3">
                                <label for="date">Date</label>
                                <input type="date" class="form-control" id="date" name="transaction_date" placeholder="Select Date">
                            </div>
    
                            <div class="col-md-12 mb-3">
                                <label for="purpose">Purpose</label>
                                <select class="form-select" id="purpose" name="purpose_id">
                                  
                                    @foreach($purposes as $purpose)
                                        <option value="{{ $purpose->id }}">{{ $purpose->name }}</option>
                                    @endforeach
                                </select>
                            </div>
    
                            <div class="col-md-12 mb-3">
                                <label for="amount">Amount</label>
                                <input type="text" class="form-control" id="amount" name="amount" placeholder="Enter Amount">
                            </div>
    
                            <div class="col-md-12 mb-3">
                                <label for="comments">Comment</label>
                                <input type="text" class="form-control" id="comment" name="comments" placeholder="Optional Comment">
                            </div>
    
                            <div class="col-md-12 mb-3">
                                <label for="account_id">Debit From</label>
                                <select class="form-select" id="account_id" name="account_id">
                                    @foreach($accountTypes as $account)
                                        <option value="{{ $account->id }}">{{ $account->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <input type="hidden" name="transaction_type" value="debit">

                            <div class="col-md-12 mb-3">
                                <label for="document">Upload Document</label>
                                <div class="input-group">
                                    <input type="file" class="form-control" id="document" name="document" aria-describedby="uploadDocument">
                                    <label class="input-group-text" for="document">
                                        <i class="fas fa-upload"></i> Choose File
                                    </label>
                                </div>
                                <div class="form-text text-muted">Accepted formats: PDF, JPEG, PNG, max size: 5MB</div>
                            </div>

                            
    
                            <div class="col-md-12 mt-4">
                                <button type="submit" class="btn btn-primary btn-block">Add Debit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    @endsection
</div>
