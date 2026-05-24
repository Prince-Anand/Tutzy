<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Tutor;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function loginPost(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            $fallback = Auth::user()->role === 'tutor' 
                        ? route('tutor.dashboard') 
                        : route('student.dashboard');

            return redirect()->intended($fallback);
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function signupStudentPost(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'], // password_confirmation can be added later
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'student',
        ]);

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->intended(route('student.dashboard'));
    }

    public function signupTutorPost(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'], // password_confirmation can be added later
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'tutor',
        ]);

        // Create a default tutor profile for the new user
        Tutor::create([
            'user_id' => $user->id,
            'subject_id' => 1, // Default subject
            'name' => $user->name,
            'slug' => Str::slug($user->name) . '-' . uniqid(),
            'bio' => 'I am a new tutor on Tutzy. I look forward to helping students achieve their goals!',
            'country' => 'Global',
            'hourly_rate' => 25.00,
        ]);

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->intended(route('tutor.dashboard'));
    }

    public function login()
    {
        return view('auth.login');
    }

    public function signupStudent()
    {
        return view('auth.signup-student');
    }

    public function signupTutor()
    {
        return view('auth.signup-tutor');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function redirectToGoogle()
    {
        // Placeholder for Socialite redirect
        return redirect()->back()->with('status', 'Google OAuth redirect placeholder');
    }

    public function handleGoogleCallback()
    {
        // Placeholder for Socialite callback
        return redirect()->route('login')->with('status', 'Google OAuth callback placeholder');
    }
}
