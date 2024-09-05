<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
{
  public function index(){
   return view('admin.login');  
  }

  public function authenticate(Request $req){
    $validator = Validator::make($req->all(),[
        'email' => 'required|email',
        'password' => 'required'
    ]);

    if($validator->fails()){
      return redirect()->route('admin.login')
      ->withErrors($validator)
      ->withInput($req->only('email'));
    }else{

      $cred = [
        'email' => $req->email,
        'password' => $req->password
      
      ];

      if(Auth::guard('admin')->attempt($cred)){
         return redirect()->route('admin.dashboard');
      }else{
        return redirect()->route('admin.login')->with('error','email and password is incorrect');
      }

    }
  }
}
