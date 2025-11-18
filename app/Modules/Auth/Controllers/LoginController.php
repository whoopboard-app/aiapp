<?php

namespace App\Modules\Auth\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Show the login form
     */
    public function show()
    {
        return view('auth.login');
    }
    
    /**
     * Handle login authentication
     */
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        
        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            
            // Check if user needs onboarding
            if (!auth()->user()->onboarded_at) {
                return redirect()->intended(route('onboarding.start'));
            }
            
            return redirect()->intended(route('workspace.dashboard'));
        }
        
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }
}
