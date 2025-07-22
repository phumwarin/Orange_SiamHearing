<?php

namespace App\Http\Controllers;

use App\Http\Request\LoginRequest;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * Show login view.
     */
    public function loginView()
    {
        return view('admin.login.login-page', [
            'layout' => 'login'
        ]);
    }

    /**
     * Show register view.
     */
    public function registerView()
    {
        return view('admin.login.register', [
            'layout' => 'register'
        ]);
    }

    /**
     * Authenticate login user.
     */
    public function login(LoginRequest $request)
    {
        if (!\Auth::attempt([
            'email' => $request->email,
            'password' => $request->password
        ])) {
            throw new \Exception('Wrong email or password.');
        }

        $user = \Auth::user();
        session()->put('branch_id', $user->ref_branch_id);
    }

    /**
     * Logout user.
     */
    public function logout()
    {
        \Auth::logout();
        return redirect()->intended('/admin/job');
    }
}
