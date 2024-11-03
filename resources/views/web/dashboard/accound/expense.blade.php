<div>
    @extends('web.dashboard.app')
    @section('content')
        

        <div class="container mt-3">
            <div class="row">
                <div class="col-md-12">

                    <div class="d-flex justify-content-start mb-3 gap-2">
                        <button class="btn btn-dark btn-sm ml-3" id="addFormButton">
                            <i class="fas fa-plus-circle"></i>
                        </button>


                        <a class="nav-link" href="#" id="addActionButton">



                            <div id="debitSection">
                                <!-- Debit Button -->
                                <button class="btn btn-primary btn-sm" id="debitButton">
                                    <i class="fas fa-receipt"></i> Debit
                                </button>
                            </div>
                        </a>


                        <a href="#" id="exportButton" class="btn btn-primary d-flex align-items-center justify-content-center"
                        aria-label="Download" style="width: 40px; height: 40px;">
                        <i class="fas fa-download"></i>
                     </a>

                    </div>



                    <div class="card">
                        <div class="card-body">


                           

                            <!-- Debit Section -->
                            <div class="card mb-12" id="debitTableSection" >

                                <p class="text-center">Debit/Expense Records</p>

                                <div class="card-body">
                                    <form action="{{ route('dashboard.accounts.expense') }}" method="GET">
                                        @csrf
                                        <div
                                            class="form-row d-flex justify-content-between align-items-end flex-wrap gap-2">
                                            <div class="col-md-3 mb-3">
                                                <input type="text" class="form-control date-input" id="startDate"
                                                    placeholder="Start Date" name="startDate" onfocus="(this.type='date')"
                                                    onblur="(this.type='text')" />
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <input type="text" class="form-control date-input" id="endDate"
                                                    placeholder="End Date" name="endDate" onfocus="(this.type='date')"
                                                    onblur="(this.type='text')" />
                                            </div>

                                            <div class="col-md-4 mb-3">
                                                <select class="form-select" id="selectOption" name="account_type">
                                                    <option>Select One</option>
                                                    @foreach ($accountTypes as $accountType)
                                                        <option value="{{ $accountType->id }}">{{ $accountType->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <input type="hidden" name="transaction_type" value="debit">

                                            <div class="col-md-auto d-flex align-items-center mb-3 gap-2">
                                               
                                                <button
                                                    class="btn btn-dark d-flex align-items-center justify-content-center"
                                                    style="width: 40px; height: 40px;">
                                                    <i class="fas fa-sync-alt"></i>
                                                </button>

                                               
                                                <a href="{{ route('dashboard.accounts.income') }}"
                                                    class="btn btn-danger d-flex align-items-center justify-content-center"
                                                    style="width: 40px; height: 40px;">
                                                    <i class="fas fa-redo"></i>
                                                </a>
                                            </div>
                                        </div>

                                    </form>

                                    <table class="table table-striped" id="transactionsTable">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Date</th>
                                                <th>Purpose</th>
                                                <th>Debit From</th>
                                                <th>Amount</th>
                                                <th>Comment</th>
                                                <th>Inserted</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ($credits->isEmpty())
                                                <tr>
                                                    <td colspan="7" class="text-center">No entries found.</td>
                                                </tr>
                                            @else
                                                @foreach ($credits as $index => $debit)
                                                    <tr>
                                                        <td>{{ $credits->firstItem() + $index }}</td>
                                                        <td>{{ \Carbon\Carbon::parse($debit->transaction_date)->format('Y-m-d') }}
                                                        </td>
                                                        <td>{{ $debit->purpose->name ?? 'N/A' }}</td>
                                                        <td>{{ $debit->account->name ?? 'N/A' }}
                                                            <span class="badge bg-danger">
                                                                @if ($debit->transaction_type == 'credit')
                                                                    Credit
                                                                @else
                                                                    Debit
                                                                @endif
                                                            </span>
                                                        </td>
                                                        <td>{{ number_format($debit->amount, 2) }}</td>
                                                        <td>{{ $debit->comments ?? 'N/A' }}</td>
                                                        <td>{{ Auth::user()->name }}</td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                        </tbody>

                                        @if (!$credits->isEmpty())
                                            <tfoot>
                                                <tr>
                                                    <td colspan="4" class="text-end"></td>
                                                    <td><strong>= {{ number_format($totalAmount, 2) }} ৳ </strong></td>
                                                    <td colspan="2"></td>
                                                </tr>
                                            </tfoot>
                                        @endif
                                    </table>

                                    <!-- Pagination Links -->
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            Showing {{ $credits->firstItem() }} to {{ $credits->lastItem() }} of total
                                            {{ $credits->total() }} entries
                                        </div>
                                        <div>
                                            {{ $credits->links() }}
                                        </div>


                                    </div>

                                </div>
                            </div>


                        </div>
                    </div>

                </div>
            </div>
        </div>
    @endsection

    @section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.0/xlsx.full.min.js"></script>
        <script>
            // just for debit button click event form submit
            let selectedAction = 'debit';

            document.addEventListener('DOMContentLoaded', function() {

               

                document.getElementById('addActionButton').addEventListener('click', function(e) {
                    e.preventDefault();


                     if (selectedAction === 'debit') {
                        console.log('Toggling to credit');
                        selectedAction = 'credit';
                      

                    }
                });


                document.getElementById('addFormButton').addEventListener('click', function(e) {
                    e.preventDefault(); 


                   if (selectedAction === 'debit') {
                        console.log('Redirecting to debit route');
                        window.location.href = "{{ route('dashboard.accounts.debit') }}";
                    } else {
                        alert('Please select either Credit or Debit before proceeding.');
                    }
                });
            });


          
        </script>

<script>
    document.getElementById('exportButton').addEventListener('click', function() {
       
        var table = document.getElementById("transactionsTable");
        var sheet = XLSX.utils.table_to_sheet(table);
        var workbook = XLSX.utils.book_new();
        XLSX.utils.book_append_sheet(workbook, sheet, "SheetJS");
        XLSX.writeFile(workbook, "transaction-history.xlsx");

    });

      
</script>
    @endsection
