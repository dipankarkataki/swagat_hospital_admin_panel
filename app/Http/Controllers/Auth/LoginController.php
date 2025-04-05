<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    use ApiResponse;

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
            return $this->error('Validation Error', $validator->errors(), 422);
        }

        try{
            if( !Auth::attempt($request->only('email', 'password')) ){
                return $this->error('Oops! Invalid Credentials', null, 401);
            }
            return $this->success('Login successful', null, 200);
        }catch(\Exception $e){
            Log::error('Error on login controller Post method: '.$e->getMessage());
            return $this->error('Oops! Something went wrong', null, 500);
        }
    }
}
