<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //
    public function create(){
        return view('login');
    }
    public function store(Request $request){

        $validated = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        // $user = User::where('email','=', $request->email);
        // if($user && Hash::check($user->password, $request->password)){
        //     Auth::login($user); / 2 nd argument  indicates remember me 
        //     return redirect('classroom.view');
        // }
        $result = Auth::attempt([
            'email' => $request->email,
            'password' => $request->password,
        ], $request->remember);
        if($result){
            return redirect('classroom.view');
        }
        return back()->with('error','Login failed');
    }
}
