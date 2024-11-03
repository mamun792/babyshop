<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;

class CustomUserRegisterController extends Controller
{
   public function customRegister(RegisterRequest $request)
   {
      // return $request->all();
      

      $validated = $request->validated();
      $password = bcrypt('1234');
      $user = new User();
      $user->name = $request->name;
      $user->password = $password;
      $user->phone = $request->phone;
      $user->email = $request->email;
      
      $user->street_address = $request->address;
      $user->save();

      toastr()->success('User created successfully');
      return redirect()->back()->with('registeredUser', $user->id);
   }
}
