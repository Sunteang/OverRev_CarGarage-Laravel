<?php

// app/Http/Controllers/App/AuthController.php
namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('apps.login'); // create login blade
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if (Auth::guard('web')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        }

        return back()->withErrors([
            'email' => 'Invalid credentials.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function showRegister()
    {
        return view('apps.register'); // optional registration page
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:tbl_users',
            'password' => 'required|string|confirmed|min:6',
        ]);

        // Auto-generate username from name
        $baseUsername = strtolower(str_replace(' ', '.', $validated['name']));
        $username = $baseUsername;
        $counter = 1;

        // Make sure username is unique
        while (\App\Models\User::where('username', $username)->exists()) {
            $username = $baseUsername . $counter;
            $counter++;
        }

        $validated['username'] = $username;

        // Password will be automatically hashed by setPasswordAttribute in User model
        \App\Models\User::create($validated);

        return redirect()->route('user.login')
            ->with('success', 'Account created! Your username: ' . $username);
    }
}
