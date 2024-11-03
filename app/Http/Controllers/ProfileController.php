<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Traits\ImageManipulation;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\File;

class ProfileController extends Controller
{
    use ImageManipulation;

    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    

    public function update(ProfileUpdateRequest $request)
    {

        $user = $request->user();

        if ($request->hasFile('avatar')) {
            $imagePath = $this->storeImage($request, 'avatar', 'profiles');
           
                $user->avatar = $imagePath; 
           
        }
    
       
        $validatedData = $request->validated();

      
        unset($validatedData['avatar']);
        $user->fill($validatedData);
    
       
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }
    
      
        $user->save();
        toastr()->success('Profile Updated Successfully');
        return back();
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
