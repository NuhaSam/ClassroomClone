<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminTwoFactorAuthenticationController extends Controller
{
    //
    public function index(){
        return view('admins.2fa',[
            'user' => Auth::guard('admin')->user(),
        ]);
    }
}
