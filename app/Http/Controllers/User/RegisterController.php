<?php

namespace App\Http\Controllers\User;

use Exception;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\User\RegisterRequest;

class RegisterController extends Controller
{
    public function form()
    {
        return view('user.auth.register');
    }

    public function register(RegisterRequest $request)
    {
        try {

            $user = User::create($request->only(['name', 'email']) + [
                'password' => Hash::make($request->password)
            ]);

            Auth::guard('web')->login($user, $request->remember);

            return to_route('welcome')->with('flash_success', 'Registration success.');
        } catch (Exception $e) {
            return redirect()->back()->with('flash_error', $e->getMessage());
        }
    }
}
