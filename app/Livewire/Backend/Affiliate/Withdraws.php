<?php

namespace App\Livewire\Backend\Affiliate;

use App\Models\AffiliateWithdraw;
use Livewire\Component;
use Livewire\WithPagination;

class Withdraws extends Component
{
    use WithPagination;
    public $status;

    public function statusUpdate($id,$status){
        $find=AffiliateWithdraw::find($id);
        if($find){
            if($find->status=='rejected'){
                flash()->success('This request already rejected');
                return;
            }
            if($status=='rejected'){
                $find->user->balance += $find->amount;
                $find->user->save();
            }
            $find->status=$status;
            $find->save();
            flash()->success('Status updated successfully');
        }
    }

    public function render()
    {
        $payments=AffiliateWithdraw::latest()->paginate(10);

        return view('livewire.backend.affiliate.withdraws',compact('payments'));
    }
}
