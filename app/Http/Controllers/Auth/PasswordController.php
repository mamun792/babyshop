<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class PasswordController extends Controller
{
    /**
     * Update the user's password.
     */
    public function update(Request $request): RedirectResponse
    {
        //  all are required fields

        $vali= $request->validate([
            'current_password' => 'required',
            'password' => 'required',
            'password_confirmation' => 'required',
        ]);
//    check if the current password is correct
        if (!Hash::check($vali['current_password'], $request->user()->password)) {
          toastr()->error('The current password is incorrect');
           
        }
//        check if the new password is the same as the current password
        if (Hash::check($vali['password'], $request->user()->password)) {
            toastr()->error('The new password cannot be the same as the current password');
          
        }
        $validated = $request->validateWithBag('updatePassword', [
            'current_password' => ['required', 'current_password'],
            'password' => ['required', Password::defaults(), 'confirmed'],
        ]);

        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);
     
   
    toastr()->success('Password Updated Successfully');
        return back()->with('status', 'password-updated');
    }
}
