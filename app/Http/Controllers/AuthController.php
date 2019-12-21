<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $validator = Validator::make(request()->all(), [
            'email'  => 'required',
            'password' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect('/')
                ->withErrors($validator->errors());
        }else{
            $email = $request->get('email');
            $password = $request->get('password');
            if(Auth::attempt(['email' => $email, 'password' => $password])){
                return redirect('/admin/dashboard');
            }else{
                return redirect('/')->with('fail','wrong email or password');
            }
        }
    }
}

