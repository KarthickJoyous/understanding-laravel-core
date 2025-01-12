<?php

namespace App\Http\Controllers\User;

use Exception;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\User\LoginRequest;

class LoginController extends Controller
{
    public function form()
    {
        return view('user.auth.login');
    }

    public function login(LoginRequest $request)
    {
        try {

            $login = Auth::guard('web')->attempt($request->only(['email', 'password']), $request->remember);

            throw_if(! $login, new Exception("Invalid Email/Password"));

            return to_route('welcome')->with('flash_success', 'Login success.');
        } catch (Exception $e) {
            return redirect()->back()->with('flash_error', $e->getMessage());
        }
    }
}
