<div>
    @extends('web.dashboard.app')
    @section('content')
        {{-- @include('web.dashboard.components.cards') --}}


        <div class="container mt-3">
            <div class="row">
                <div class="col-md-12">

                    <div class="d-flex justify-content-start mb-3 gap-2">
                        <button class="btn btn-dark btn-sm ml-3" id="addFormButton">
                            <i class="fas fa-plus-circle"></i> 
                        </button>


                        <a class="nav-link" href="#" id="addActionButton">
                            <div id="creditSection">
                                <!-- Credit Button -->
                                <button class="btn btn-primary btn-sm" id="creditButton">
                                    <i class="fas fa-money-check-alt"></i> Credit
                                </button>
                            </div>
                        
                            <!-- Debit Section (Initially hidden) -->
                            <div id="debitSection" style="display: none;">
                                <!-- Debit Button -->
                                <button class="btn btn-primary btn-sm" id="debitButton">
                                    <i class="fas fa-receipt"></i> Debit
                                </button>
                            </div>
                        </a>
                    
                       
                        <button class="btn btn-success btn-sm ml-3">
                            <i class="fas fa-file-export"></i> Export Credit
                        </button>
                    </div>
                    
                    

                    <div class="card">
                        <div class="card-body">
                           
                    
                            <div class="card mb-12" id="creditTableSection">
                               
                                <p class="text-center">Credit/Income Records</p>
                           
                                <div class="card-body">
                                    <form>
                                        <div class="form-row d-flex justify-content-between gap-1 align-items-end flex-wrap">
                                            <div class="col-md-4 mb-3">
                                                <input type="text" class="form-control" id="purposeComments" placeholder="Purpose, comments...">
                                            </div>
                                            <div class="col-md-2 mb-3">
                                                <input type="date" class="form-control" id="startDate">
                                            </div>
                                            <div class="col-md-2 mb-3">
                                                <input type="date" class="form-control" id="endDate">
                                            </div>
                                            <div class="col-md-2 mb-3">
                                                <select class="form-control" id="selectOption">
                                                    <option>Select One</option>
                                                    <option>Option 1</option>
                                                    <option>Option 2</option>
                                                </select>
                                            </div>
                                            <div class="col-md-1 mb-3 d-flex align-items-end">
                                                <button class="btn btn-dark w-40 d-flex align-items-center justify-content-center">
                                                    <i class="fas fa-sync-alt"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                    
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Date</th>
                                                
                                                <th>Purpose</th>
                                                <th>Credit In</th>
                                                <th>Amount</th>
                                                <th>Comment</th>
                                                <th>Inserted</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td colspan="8" class="text-center">Showing 0 to 0 of total 0 entries</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                    
                            <div class="card mb-12" id="debitTableSection" style="display: none;">
                                <p class="text-center">Debit/Expense Records</p>
                                <div class="card-body">
                                    <form>
                                        <div class="form-row d-flex justify-content-between gap-1 align-items-end flex-wrap">
                                            <div class="col-md-4 mb-3">
                                                <input type="text" class="form-control" id="debitPurposeComments" placeholder="Purpose, comments...">
                                            </div>
                                            <div class="col-md-2 mb-3">
                                                <input type="date" class="form-control" id="debitStartDate">
                                            </div>
                                            <div class="col-md-2 mb-3">
                                                <input type="date" class="form-control" id="debitEndDate">
                                            </div>
                                            <div class="col-md-2 mb-3">
                                                <select class="form-control" id="debitSelectOption">
                                                    <option>Select One</option>
                                                    <option>Option 1</option>
                                                    <option>Option 2</option>
                                                </select>
                                            </div>
                                            <div class="col-md-1 mb-3 d-flex align-items-end">
                                                <button class="btn btn-dark w-40 d-flex align-items-center justify-content-center">
                                                    <i class="fas fa-sync-alt"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                    
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Date</th>
                                                <th>Invoice</th>
                                                <th>Purpose</th>
                                                <th>Debit From</th>
                                                <th>Amount</th>
                                                <th>Comment</th>
                                                <th>Inserted</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td colspan="8" class="text-center">Showing 0 to 0 of total 0 entries</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    @endsection

    @section('js')
        <script>
        let selectedAction = 'credit'; 

document.addEventListener('DOMContentLoaded', function() {
 
    document.getElementById('creditSection').style.display = 'block';
    document.getElementById('debitSection').style.display = 'none';

  
    document.getElementById('addActionButton').addEventListener('click', function(e) {
        e.preventDefault(); 

     
        if (selectedAction === 'credit') {
            console.log('Toggling to debit');
            selectedAction = 'debit';
            document.getElementById('debitSection').style.display = 'block';
            document.getElementById('creditSection').style.display = 'none'; 
           
            document.getElementById('creditTableSection').style.display = 'none';
            document.getElementById('debitTableSection').style.display = 'block';

        } else if (selectedAction === 'debit') {
            console.log('Toggling to credit');
            selectedAction = 'credit';
            document.getElementById('creditSection').style.display = 'block'; 
            document.getElementById('debitSection').style.display = 'none'; 

           
            document.getElementById('creditTableSection').style.display = 'block';
            document.getElementById('debitTableSection').style.display = 'none';
        }
    });

   
    document.getElementById('addFormButton').addEventListener('click', function(e) {
        e.preventDefault(); // Prevent default behavior


        if (selectedAction === 'credit') {
            console.log('Redirecting to credit route');
            window.location.href = "{{ route('dashboard.accounts.addCredit') }}"; 
        } else if (selectedAction === 'debit') {
            console.log('Redirecting to debit route');
            window.location.href = "{{ route('dashboard.accounts.debit') }}"; 
        } else {
            alert('Please select either Credit or Debit before proceeding.');
        }
    });
});


        </script>
    @endsection
</div>