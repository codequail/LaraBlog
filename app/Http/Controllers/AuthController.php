<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use App\Models\User;

class AuthController extends Controller
{
    // Function Register a new user
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            // For API requests, return a JSON response with validation errors
            if ($this->isApiRequest($request)) {
                return response()->json(['errors' => $validator->errors()], 400);
            }

            // For web requests, redirect with errors
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Return a JSON response for API requests
        if ($this->isApiRequest($request)) {
            $token = $user->createToken('LaravelPassportGrantClient')->accessToken;
            return response()->json([
                'message' => 'Registration successful.',
                'token' => $token
            ], 201);
        }

        // Redirect for web requests
        return redirect()->route('login')->with('success', 'Registration successful.');
    }

    // Function check "is API request?" 
    private function isApiRequest(Request $request)
    {
        return $request->is('api/*');
    }

    // Function Login user (web)
    public function login(Request $request)
    {
        // Validate the form data
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Attempt to log the user in
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            // Authentication passed...
            $intendedUrl = session()->get('url.intended', '/');
            return redirect()->intended($intendedUrl)->with('success', 'Logged in successfully.');
        }

        // Authentication failed...
        throw ValidationException::withMessages([
            'email' => [trans('auth.failed')],
        ]);
    }


    // Function Login user (API)
    public function apiLogin(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('LaravelPassportGrantClient')->accessToken;
            return response()->json(['token' => $token], 200);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }

    // Function logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'You have been logged out.');
    }

    public function showLoginForm()
    {
        return view('login');
    }

    public function showRegistrationForm()
    {
        return view('register');
    }
}
