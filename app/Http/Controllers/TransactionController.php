<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Http\Requests\StoreTransactionRequest;
use App\Http\Requests\UpdateTransactionRequest;
use App\Traits\ImageManipulation;
use Illuminate\Http\Request;



class TransactionController extends Controller
{
    use ImageManipulation;
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }


    public function storeCredit(StoreTransactionRequest $request)
    {

        $documentPath = $this->handleDocumentUpload($request);

        $validatedData = $this->prepareTransactionData($request, $documentPath);
        

         Transaction::create($validatedData);
        $type=$request->transaction_type;
        $message = 'Transaction created successfully';

        toastr()->success($message);


        if($type=='credit'){
         
            return redirect()->route('dashboard.accounts.income');
        }else{
           
            return redirect()->route('dashboard.accounts.expense');
        }
    

     
    }


    public function destroy(Transaction $transaction)
    {
        //
    }

    private function handleDocumentUpload(Request $request): ?string
    {
        if ($request->hasFile('document')) {
            return $this->storeImage($request, 'document', 'transaction');
        }
        return null;
    }

    private function prepareTransactionData(Request $request, ?string $documentPath): array
    {
        $validatedData = $request->validated();
        $validatedData['user_id'] = auth()->id();

       
        if ($documentPath) {
            $validatedData['document'] = $documentPath;
        }

        return $validatedData;
    }

    
}
