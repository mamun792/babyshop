<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
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
        Log::info('user role name is '.Auth::user()->roles->first()->name);
        // dd(Auth::user()->roles->first()->name);
         switch (Auth::user()->roles->first()->name) {
            case 'administrator':
                return redirect(route('dashboard', absolute: false));
                break;
            case 'customer':
                return redirect()->route('dashboard.user.customer.dashboard');
                break;
            case 'affiliate':
                return redirect()->route('dashboard.affiliate.dashboard');
                break;
            default:
                return redirect()->route('dashboard');
                break;

        }

        return redirect()->intended('/');
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
