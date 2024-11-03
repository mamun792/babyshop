<div>
    @extends('web.dashboard.app')
    @section('content')
        <div class="container mt-5">
            <div class="row">
                <div class="col-md-12">
                    <h6 class="mb-4">Account Summary</h6>
                </div>


                <div class="col-md-12 mb-3">
                    <div class="card shadow-sm mb-4">

                        <div class="card-body">
                            <form action="{{ route('dashboard.accounts.balance') }}" method="GET">
                                @csrf
                                <div class="row align-items-end">
                                    <!-- Start Date -->
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="start_date">Start Date</label>
                                            <input type="date" name="start_date" id="start_date" class="form-control">
                                        </div>
                                    </div>

                                    <!-- End Date -->
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="end_date">End Date</label>
                                            <input type="date" name="end_date" id="end_date" class="form-control">
                                        </div>
                                    </div>

                                    <!-- Account Type -->
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="account_type">Account Type</label>
                                            <select name="account_type" id="account_type" class="form-control">
                                                <option value="all">All</option>
                                                <option value="credit">Credit</option>
                                                <option value="debit">Debit</option>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Quick Date Filters (Dropdown) -->
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="quick_date_filter">Quick Date Filter</label>
                                            <select name="quick_date_filter" id="quick_date_filter" class="form-control">
                                                <option value="">Select Date Range</option>
                                                <option value="today">Today</option>
                                                <option value="yesterday">Yesterday</option>
                                                <option value="last_7_days">Last 7 Days</option>
                                                <option value="last_30_days">Last 30 Days</option>
                                                <option value="this_month">This Month</option>
                                            </select>
                                        </div>
                                    </div>

                                   

                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <label for="per_page">Per Page</label>
                                            <select name="per_page" id="per_page" class="form-control">
                                                <option value="10">10</option>
                                                <option value="20">20</option>
                                                <option value="50">50</option>
                                                <option value="100">100</option>
                                            </select>
                                        </div>
                                    </div>


                                    

                                    <div class="col-md-auto d-flex align-items-center gap-2">
                                        <!-- Filter Button with Sync Icon -->
                                        <button type="submit"
                                            class="btn btn-dark d-flex align-items-center justify-content-center"
                                            style="width: 40px; height: 40px;">
                                            <i class="fas fa-sync-alt"></i>
                                        </button>
                                    
                                        <!-- Reset Button with Redo Icon -->
                                        <a href="{{ route('dashboard.accounts.balance') }}"
                                            class="btn btn-danger d-flex align-items-center justify-content-center"
                                            style="width: 40px; height: 40px;">
                                            <i class="fas fa-redo"></i>
                                        </a>
                                    
                                        <!-- Download Button with Download Icon -->
                                        <a href="#" id="exportButton" class="btn btn-primary d-flex align-items-center justify-content-center"
                                        aria-label="Download" style="width: 40px; height: 40px;">
                                        <i class="fas fa-download"></i>
                                     </a>
                                     
                                    </div>
                                    
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Transaction Table -->
                <div class="col-md-8 ">
                    <div class="card mb-4 shadow-sm">
                        <div class="card-header bg-light">
                            <p class="mb-0">Transaction History</p>
                        </div>
                        <div class="card-body">
                            <table class="table table-hover" id="transactionsTable">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Date</th>
                                        <th>Purpose</th>
                                        <th>Type</th>
                                        <th>Account</th>
                                        <th>Amount</th>
                                        <th>Comment</th>
                                        <th>Inserted By</th>
                                        <th>Balance</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($transactions as $transaction)
                                        <tr>
                                            <td>{{ \Carbon\Carbon::parse($transaction->transaction_date)->format('d-m-Y') }}</td>
                                            <td>{{ $transaction->purpose->name }}</td>
                                            <td>
                                                <span class="badge {{ $transaction->transaction_type == 'credit' ? 'bg-success' : 'bg-danger' }}">
                                                    {{ $transaction->transaction_type == 'credit' ? 'Income' : 'Expense' }}
                                                </span>
                                            </td>
                                            <td>{{ $transaction->account->name }}</td>
                                            <td>{{ number_format($transaction->amount, 2) }}</td>
                                            <td>{{ $transaction->comments ?? 'N/A' }}</td>
                                            <td>{{ authUserRoles() }}</td>
                                            <td>{{ number_format($balance, 2) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr class="bg-light">
                                        <td colspan="4" class="text-end"><strong>Total Income</strong></td>
                                        <td><strong>{{ number_format($totalIncome, 2) }}</strong></td>
                                        <td colspan="2" class="text-end"><strong>Total Expense</strong></td>
                                        <td><strong>{{ number_format($totalExpense, 2) }}</strong></td>
                                    </tr>
                                    <tr class="bg-secondary text-white">
                                        <td colspan="7" class="text-end"><strong>Final Balance</strong></td>
                                        <td><strong>{{ number_format($balance, 2) }}</strong></td>
                                    </tr>
                                </tfoot>
                            </table>
                            
                            {{-- pahe number showing --}}
                            <div class="d-flex justify-content-between">
                                <div>
                                    Showing {{ $transactions->firstItem() }} to {{ $transactions->lastItem() }} of total
                                    {{ $transactions->total() }} entries
                                </div>
                                <div>
                                    {{ $transactions->links() }}
                                </div>


                            </div>
                        </div>
                    </div>
                </div>

                <!-- Financial Summary -->
                <div class="col-md-4">
                    <div class="card shadow-sm mb-4">
                        <div class="card-header bg-light">
                            <p class="mb-0">Financial Summary</p>
                        </div>
                        <div class="card-body">
                            <div class="totals mt-3">
                                <p><strong>Total Income:</strong> <span
                                        class="text-success">{{ number_format($totalIncome, 2) }}</span></p>
                                <p><strong>Total Expense:</strong> <span
                                        class="text-danger">{{ number_format($totalExpense, 2) }}</span></p>
                                <hr>
                                <p class="h5"><strong>Balance:</strong> <span
                                        class="text-primary">{{ number_format($balance, 2) }}</span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection

</div>

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.0/xlsx.full.min.js"></script>

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
