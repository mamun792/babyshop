<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Purpose;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Carbon\Carbon;

use Illuminate\Support\Facades\Log;

class AccountsController extends Controller
{
    public function income(Request $request)
    {

        $creditsQuery = Transaction::with(['purpose', 'account'])
            ->select('transactions.*')->where('transaction_type', 'credit');

        $creditsQuery = $this->applyFilters($creditsQuery, $request);
        $accountTypes = Account::latest()->get();

        $credits = $creditsQuery->latest()->paginate(10);

        $totalAmount = $creditsQuery->sum('amount');

        return view('web.dashboard.accound.income', compact('credits', 'accountTypes', 'totalAmount'));
    }

    public function expense(Request $request)
    {
        $creditsQuery = Transaction::with(['purpose', 'account'])
            ->select('transactions.*')->where('transaction_type', 'debit');

        $creditsQuery = $this->applyFilters($creditsQuery, $request);
        $accountTypes = Account::latest()->get();

        $credits = $creditsQuery->latest()->paginate(10);

        $totalAmount = $creditsQuery->sum('amount');
        return view('web.dashboard.accound.expense', compact('credits', 'accountTypes', 'totalAmount'));
    }


    public function manageBalance()
    {
       
        return view('web.dashboard.accound.manageBalance');
    }


    public function balance(Request $request)
    {
        
        $query = Transaction::with(['account', 'purpose']);

        
        if ($request->start_date && $request->end_date) {
            $startDate = Carbon::parse($request->start_date)->startOfDay();
            $endDate = Carbon::parse($request->end_date)->endOfDay();
            $query->whereBetween('transaction_date', [$startDate, $endDate]);
        }

       
        if ($request->quick_date_filter) {
            $this->applyQuickDateFilter($query, $request->quick_date_filter);
        }

      
        $this->filterByAccountType($query, $request->account_type);

      
        $totalIncome = (clone $query)->where('transaction_type', 'credit')->sum('amount');
        $totalExpense = (clone $query)->where('transaction_type', 'debit')->sum('amount');
        $balance = $totalIncome - $totalExpense;

       $page= $request->per_page;
        
       $transactions = $query->latest('transaction_date')->paginate($page);

        return view('web.dashboard.accound.balance', compact('transactions', 'totalIncome', 'totalExpense', 'balance'));
    }

    /**
     * Apply quick date filters to the query.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $quickDateFilter
     */
    private function applyQuickDateFilter($query, $quickDateFilter)
    {
        switch ($quickDateFilter) {
            case 'today':
                $query->where('transaction_date', '>=', Carbon::today())
                    ->where('transaction_date', '<=', Carbon::now());
                break;
            case 'yesterday':
                $query->whereDate('transaction_date', Carbon::yesterday());
                break;
            case 'last_7_days':
                $query->where('transaction_date', '>=', Carbon::now()->subDays(7));
                break;
            case 'last_30_days':
                $query->where('transaction_date', '>=', Carbon::now()->subDays(30));
                break;
            case 'this_month':
                $query->whereMonth('transaction_date', Carbon::now()->month)
                    ->whereYear('transaction_date', Carbon::now()->year);
                break;
            default:
              
                break;
        }
    }

    /**
     * Filter transactions by account type.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string|null $accountType
     */
    private function filterByAccountType($query, $accountType)
    {
        if ($accountType === 'credit') {
            $query->where('transaction_type', 'credit');
        } elseif ($accountType === 'debit') {
            $query->where('transaction_type', 'debit');
        }
    }


    public function fundTransfer()
    {
       
        return view('web.dashboard.accound.fundTransfer');
    }

    public function accountPurpose()
    {
        $purposes = Purpose::latest()->paginate(10);
        return view('web.dashboard.accound.accountPurpose', compact('purposes'));
    }

    public function addCredit()
    {
        $purposes = Purpose::latest()->get();
        $accountTypes = Account::latest()->get();
        return view('web.dashboard.accound.addCredit', compact('purposes', 'accountTypes'));
    }

    public function debit()
    {
        $purposes = Purpose::latest()->get();
        $accountTypes = Account::latest()->get();
        return view('web.dashboard.accound.debit', compact('purposes', 'accountTypes'));
    }

    public function addPurpose()
    {

        return view('web.dashboard.accound.addPurpose');
    }

    public function storePurpose(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:purposes|max:255',
        ]);



        Purpose::create($validated);

        toastr()->success('Purpose added successfully!');

        return redirect()->route('dashboard.accounts.accountPurpose');
    }

    public function editPurpose($id)
    {

        $purpose = Purpose::findOrFail($id);
        return view('web.dashboard.accound.editPurpose', compact('purpose'));
    }


    public function updatePurpose(Request $request, $id)
    {

        $purpose = Purpose::findOrFail($id);



        $validated = $request->validate([
            'name' => 'required|max:255',
        ]);

        $purpose->update($validated);

        toastr()->success('Purpose updated successfully!');

        return redirect()->route('dashboard.accounts.accountPurpose');
    }

    public function deletePurpose($id)
    {
        $purpose = Purpose::findOrFail($id);
        $purpose->delete();

        toastr()->error('Purpose deleted successfully!');

        return redirect()->route('dashboard.accounts.accountPurpose');
    }

    public function addAccountType()
    {
        $accountTypes = Account::latest()->paginate(10);
        return view('web.dashboard.accound.addAccountType', compact('accountTypes'));
    }

    public function storeAccountType(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:accounts|max:255',
        ]);


        Account::create($validated);

        toastr()->success('Account type added successfully!');

        return redirect()->route('dashboard.accounts.addAccountType');
    }

    public function editAccountType($id)
    {
        $accountType = Account::findOrFail($id);
        return view('web.dashboard.accound.editAccountType', compact('accountType'));
    }

    public function updateAccountType(Request $request, $id)
    {
        $accountType = Account::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|max:255',
        ]);

        $accountType->update($validated);

        toastr()->success('Account type updated successfully!');

        return redirect()->route('dashboard.accounts.addAccountType');
    }

    public function deleteAccountType($id)
    {
        $accountType = Account::findOrFail($id);
        $accountType->delete();

        toastr()->error('Account type deleted successfully!');

        return redirect()->route('dashboard.accounts.addAccountType');
    }

    private function applyFilters($query, Request $request)
    {

        if ($request->filled('transaction_type')) {
            $query->byType($request->input('transaction_type'));
        }


        if ($request->filled('account_type')) {
            $query->byAccountType($request->input('account_type'));
        }

        $query->byDateRange($request->input('startDate'), $request->input('endDate'));

        return $query;
    }
}
