<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;



class AccountController extends Controller
{
    // this method will show register page 
    public function register() {
        return view('account.register');

    }
    // this method will register a user 
    public function processRegister(Request $request) {
        $validator = Validator::make($request->all(),[
            'name' => 'required|string|min:3',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:4',
            'password_confirmation'=> 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->route('account.register')->withInput()->withErrors($validator);
         

    }
    // Now register User 
    $user = new User();
    $user->name = $request->name;
    $user->email = $request->email;
    $user->password = Hash::make($request->password);
    $user->save();

    return redirect()->route('account.login')->with('success','You have registered Sucessfully.');
  
}
public function login() {
    return view('account.login');
}
// public function authenticate(Request $request) {
//    $validator = Validator::make($request->all(),[
//     'email' => "required|email",
//     'password '=> "required"
//    ]);
//    if ($validator->fails()) {
//     return redirect()->route('account.login')->withInput()->withErrors($validator);
//    }
//    if (Auth::attempt(['email' =>$request->email, 'password' =>$request->password])) {
//         return redirect()->route('account.profile');

// } else {
//             return redirect()->route('account.login')->with('error','Either email/password is incorrect');
// }

// }
public function authenticate(Request $request){
    $credetials = [
        'email' => $request->email,
        'password' => $request->password,
        ];
        if (Auth::attempt($credetials)) {
            return redirect()->route('account.profile')->with('success', 'Login berhasil');
            }
            return back()->with('error', 'Email or Password salah');
}

public function profile(){
    return view('account.profile');
}






}
