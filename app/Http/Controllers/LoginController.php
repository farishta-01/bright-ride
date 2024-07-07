<?php

namespace App\Http\Controllers;


use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        // Validate the login request
        $request->validate([
            'username' => 'required|regex:/^[a-zA-Z0-9_]+$/',
            'password' => 'required',
        ]);

        // Extract credentials from the request
        $credentials = $request->only('username', 'password');

        // Attempt to authenticate user
        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Check user role
            if ($user->role === 'admin') {
                return redirect(route('admin.home'));
            } else {
                return redirect(route('frontend.home'));
            }
        }

        // Authentication failed, redirect back to the login page with an error message
        return redirect()->route('login.page')->with('error', 'Invalid credentials.');
    }

    public function showLoginForm()
    {
        if (Auth::check()) {
            return redirect('/');
        }
        return view('login');
    }
    public function logout()
    {
        Auth::logout();
        return redirect(route('frontend.home'));
    }

}
