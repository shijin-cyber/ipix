<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
{
    $credentials = $request->only('email', 'password');

    if (Auth::guard('admin')->attempt($credentials)) {
        return redirect()->route('admin.dashboard');
    }

    return back()->withErrors(['email' => 'These credentials do not match our records.']);
}


    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect('/admin/login');
    }
}