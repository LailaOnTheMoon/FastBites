<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
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

        $user = auth()->user();

if ($user->account_type === \App\Models\User::ROLE_SUPER_ADMIN) {
    return redirect()->route('super-admin.dashboard');
}

if ($user->account_type === \App\Models\User::ROLE_ADMIN) {
    return redirect()->route('admin.dashboard');
}

if ($user->account_type === \App\Models\User::ROLE_KITCHEN_MANAGER) {
    return redirect()->route('kitchen.dashboard');
}

if ($user->account_type === \App\Models\User::ROLE_USER_MANAGER) {
    return redirect()->route('user-management.dashboard');
}

return redirect('/');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
