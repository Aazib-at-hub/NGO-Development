<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * Show the registration form.
     */
    public function showRegisterForm()
    {
        return view('signup.register');
    }

    /**
     * Show the login form.
     */
    public function showLoginForm()
    {
        return view('login.login');
    }

    // Register new user
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Check if it's an API request
        if ($request->expectsJson()) {
            $token = $user->createToken('api_token')->plainTextToken;

            return response()->json([
                'message' => 'User registered successfully',
                'user' => $user,
                'token' => $token,
            ], 201);
        }

        // Web request - login the user and redirect
        Auth::login($user);
        return redirect()->route('blog.index')->with('success', 'Registration successful!');
    }

    // Login user
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            if ($request->expectsJson()) {
                throw ValidationException::withMessages([
                    'email' => ['The provided credentials are incorrect.'],
                ]);
            }
            return back()->withErrors(['email' => 'Invalid credentials']);
        }

        // Check if it's an API request
        if ($request->expectsJson()) {
            // Delete old tokens
            $user->tokens()->delete();

            $token = $user->createToken('api_token')->plainTextToken;

            return response()->json([
                'message' => 'Login successful',
                'user' => $user,
                'token' => $token,
            ]);
        }

        // Web request - login and redirect
        Auth::login($user, $request->remember);
        return redirect()->route('blog.index')->with('success', 'Login successful!');
    }

    // Logout user
    public function logout(Request $request)
    {
        if ($request->expectsJson()) {
            $request->user()->tokens()->delete();

            return response()->json([
                'message' => 'Logged out successfully'
            ]);
        }

        // Web request
        Auth::logout();
        return redirect()->route('login')->with('success', 'Logged out successfully!');
    }
}
