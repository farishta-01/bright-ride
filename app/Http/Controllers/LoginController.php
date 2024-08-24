<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        // Validate the login request
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        // Extract credentials from the request
        $credentials = $request->only('username', 'password');

        // Determine if the username is an email
        if (filter_var($credentials['username'], FILTER_VALIDATE_EMAIL)) {
            // If it's an email, update the credentials to use 'email'
            $credentials['email'] = $credentials['username'];
            unset($credentials['username']);
        } else {
            // Ensure 'username' is included in the query if it's not an email
            $credentials['username'] = $credentials['username'];
        }

        // Attempt to authenticate user
        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Check user role and redirect accordingly
            if ($user->role === 'admin') {
                return redirect()->intended(route('admin.home'));
            } else {
                return redirect()->intended(route('frontend.home'));
            }
        }

        // Authentication failed, redirect back to the login page with an error message
        return redirect()->route('login.page')->with('error', 'Invalid credentials.');
    }


    public function register(Request $request)
    {
        // Validate the registration request
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'nullable|string|alpha_num|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|confirmed|min:8',
        ]);

        // Create a new user instance
        $user = User::create([
            'name' => $request->input('name'),
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);

        // Redirect to the login page with a success message
        return redirect()->route('login.page')->with('success', 'You have registered successfully. Please log in.');
    }


    public function showLoginForm()
    {
        if (Auth::check()) {
            return redirect('/');
        }
        return view('login');
    }
    public function showRegisterForm()
    {
        if (Auth::check()) {
            return redirect('/');
        }
        return view('register');
    }

    public function logout()
    {
        Auth::logout();
        return redirect(route('frontend.home'));
    }
}
