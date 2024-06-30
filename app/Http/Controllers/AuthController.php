<?php

namespace App\Http\Controllers;

use App\Services\EmailService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function verifyEmail($hash): View
    {
        $user = User::where('hashcode', rawurldecode($hash))->first();

        if (!$user) {
            // The hash did not match any users in the database.
            // You can redirect back with error message
            //return redirect('/')->with('error', 'Invalid verification link');
        }

        if ($user->email_verified_at) {
            // The user has already verified their email.
            // You can redirect back with a message that says "This user has already been verified."
            return view('user.login');
        }

        // The user exists and has not verified their email,
        // so let's update the `email_verified_at` field
        $user->email_verified_at = now();
        $user->save();

        // You might want to log the user in and then redirect them to the home
        // or any other page on your site.
        Auth::login($user);

        return view('user.login');
    }

    public function showLoginForm(): View
    {
        return view('user.login');
    }

    public function handleLogin(Request $request): RedirectResponse
    {
        // Validate the form data
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8'
        ]);

        // Attempt to log the user in
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            // If successful, redirect to their intended location
            return redirect()->intended('/dashboard');
        }

        // If unsuccessful, redirect back to the login form with an error message
        return redirect()->back()->withInput($request->only('email', 'remember'))->withErrors([
            'message' => 'These credentials do not match our records.',
        ]);
    }

    public function handleLogout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
