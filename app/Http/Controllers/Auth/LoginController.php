<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function login(Request $request){
        if($request->isMethod('get')){
            return view('pages.auth.login');
        }
        
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if($validator->fails()){
            Log::error('Validator Error'.$validator->errors());
            return redirect()->route('login')->withErrors($validator)->withInput();
        }

        try{
            if( !Auth::attempt($request->only('email', 'password')) ){
                Session::flash('exception', 'Oops! Invalid credentials.');
                return redirect()->route('login')->withInput();
            }
            return redirect()->route('dashboard.index');

        }catch(\Exception $e){
            Log::error('Error on login controller Post method: '.$e->getMessage());
            Session::flash('exception', 'Something went wrong. Please try later.');
            return redirect()->route('login')->withInput();
        }
    }
}
