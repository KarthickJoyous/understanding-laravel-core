<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Admin\LoginRequest;

class LoginController extends Controller
{
    public function form()
    {
        return view('admin.auth.login');
    }

    public function login(LoginRequest $request)
    {
        try {

            $login = Auth::guard('admin')->attempt($request->only(['email', 'password']), $request->remember);

            throw_if(! $login, new Exception("Invalid Email/Password"));

            return to_route('admin.welcome')->with('flash_success', 'Login success.');
        } catch (Exception $e) {
            return redirect()->back()->with('flash_error', $e->getMessage());
        }
    }
}
