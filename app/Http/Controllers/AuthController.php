<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'role' => 'required|in:admin,user',
        ]);

        // Check admin count for admin role
        if ($credentials['role'] === 'admin') {
            $adminCount = User::where('role', 'admin')->count();
            if ($adminCount > 1) {
                Log::warning('Multiple admin login attempt detected', ['email' => $credentials['email']]);
                return back()->withErrors(['role' => 'Only one admin is allowed.']);
            }
        }

        // Attempt authentication
        if (Auth::attempt(['email' => $credentials['email'], 'password' => $credentials['password'], 'role' => $credentials['role']])) {
            $request->session()->regenerate();
            
            // Debug: Log user details
            $user = Auth::user();
            Log::info('User logged in', [
                'user_id' => Auth::id(),
                'email' => $credentials['email'],
                'role' => $user->role ?? 'null',
                'user_class' => get_class($user ?? 'null'),
                'has_isAdmin' => $user ? method_exists($user, 'isAdmin') : false,
            ]);

            // Check if user is authenticated and has isAdmin method
            if ($user && method_exists($user, 'isAdmin')) {
                try {
                    $isAdmin = $user->isAdmin();
                    if ($user->role === null) {
                        Log::warning('User role is null', ['email' => $credentials['email'], 'user_id' => $user->id]);
                        Auth::logout();
                        $request->session()->invalidate();
                        return back()->withErrors(['email' => 'User role is not set. Please contact support.']);
                    }
                    Log::info('isAdmin check', ['email' => $credentials['email'], 'isAdmin' => $isAdmin, 'role' => $user->role]);
                    return $isAdmin ? redirect()->route('admin.dashboard') : redirect()->route('forum.index');
                } catch (\Exception $e) {
                    Log::error('Error calling isAdmin', [
                        'email' => $credentials['email'],
                        'error' => $e->getMessage(),
                        'role' => $user->role ?? 'null',
                    ]);
                    Auth::logout();
                    $request->session()->invalidate();
                    return back()->withErrors(['email' => 'Error checking user role: ' . $e->getMessage()]);
                }
            } else {
                Log::error('User authentication issue or isAdmin method missing', [
                    'email' => $credentials['email'],
                    'user_class' => get_class($user ?? 'null'),
                ]);
                Auth::logout();
                $request->session()->invalidate();
                return back()->withErrors(['email' => 'User model error. Please ensure the correct User model is configured.']);
            }
        }

        Log::warning('Invalid login attempt', ['email' => $credentials['email']]);
        return back()->withErrors(['email' => 'Invalid credentials']);
    }

    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
            'role' => 'required|in:user',
        ]);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => $data['role'],
        ]);

        Auth::login($user);
        Log::info('User registered and logged in', ['user_id' => $user->id, 'email' => $user->email]);

        return redirect()->route('forum.index');
    }

    public function logout(Request $request)
    {
        $userId = Auth::id();
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        Log::info('User logged out', ['user_id' => $userId]);
        return redirect()->route('login');
    }
    
    
}