<?php

use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Auth\LoginRequest;

public function store(LoginRequest $request): RedirectResponse
{
    $request->authenticate();

    $request->session()->regenerate();

    // Check if user is admin
    if (auth()->user()->email === 'fahribalap123@gmail.com') {
        return redirect()->intended(route('dashboard', absolute: false));
    } else {
        return redirect()->intended(route('tamu.dashboard', absolute: false));
    }
}


