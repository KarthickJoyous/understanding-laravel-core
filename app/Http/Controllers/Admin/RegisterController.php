<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Admin\RegisterRequest;

class RegisterController extends Controller
{
    public function form()
    {
        return view('admin.auth.register');
    }

    public function register(RegisterRequest $request)
    {
        try {

            $admin = Admin::create($request->only(['name', 'email']) + [
                'password' => Hash::make($request->password)
            ]);

            Auth::guard('admin')->login($admin, $request->remember);

            return to_route('admin.welcome')->with('flash_success', 'Registration success.');
        } catch (Exception $e) {
            return redirect()->back()->with('flash_error', $e->getMessage());
        }
    }
}
