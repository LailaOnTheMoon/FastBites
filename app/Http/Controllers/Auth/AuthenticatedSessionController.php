<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        $user = Auth::guard('web')->user() ?? Auth::guard('customer')->user();

        if ($user instanceof Customer) {
            return redirect()->route('dashboard');
        }

        if ($user instanceof User && $user->account_type === User::ROLE_SUPER_ADMIN) {
            return redirect()->route('super-admin.dashboard');
        }

        if ($user instanceof User && $user->account_type === User::ROLE_ADMIN) {
            return redirect()->route('admin.dashboard');
        }

        if ($user instanceof User && $user->account_type === User::ROLE_KITCHEN_MANAGER) {
            return redirect()->route('kitchen.dashboard');
        }

        if ($user instanceof User && $user->account_type === User::ROLE_USER_MANAGER) {
            return redirect()->route('user-management.dashboard');
        }

        return redirect('/');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        if (Auth::guard('web')->check()) {
            Auth::guard('web')->logout();
        }

        if (Auth::guard('customer')->check()) {
            Auth::guard('customer')->logout();
        }

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
