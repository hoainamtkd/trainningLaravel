<?php

namespace App\Http\Controllers\Inside;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class AuthController extends Controller
{
    public function __construct() { }

    public function login(){ 
    	return view('auth.login');
    }
    public function logout(){
    	Auth::logout();
    	return redirect()->route('login_cp');
    }
}
