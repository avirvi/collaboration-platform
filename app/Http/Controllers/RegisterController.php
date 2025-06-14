<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class RegisterController extends Controller
{
    public function show()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $rules = array(
            'username' => ['required', 'min:3', 'max:60', 'string', 'unique:users,username'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password'  => ['required', 'confirmed', Password::min(8)->mixedCase()->numbers()->symbols()]
        );

        $validated = $request->validate($rules);

        $user = User::create($validated);

        Auth::login($user);

        return redirect()->route('dashboard.index')->with('success', 'User registered successfully!');
    }
}
