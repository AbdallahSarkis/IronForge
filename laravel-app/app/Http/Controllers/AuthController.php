<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function showLogin(): View|RedirectResponse
    {
        if (Auth::check()) {
            return redirect('/'.Auth::user()->role.'/dashboard.html');
        }

        return view('login');
    }

    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        if (! Auth::attempt($credentials)) {
            return back()->withErrors([
                'email' => 'Invalid credentials. Use one of the demo accounts.',
            ])->onlyInput('email');
        }

        $request->session()->regenerate();

        return redirect('/'.Auth::user()->role.'/dashboard.html');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login.html');
    }

    public function sessionUser(Request $request): JsonResponse
    {
        $user = $request->user();

        if (! $user) {
            return response()->json(['message' => 'Unauthenticated'], 401);
        }

        return response()->json([
            'name' => $user->name,
            'email' => $user->email,
            'role' => $user->role,
            'initials' => $this->initials($user->name),
            'gradient' => $this->roleGradient($user->role),
        ]);
    }

    private function initials(string $name): string
    {
        $parts = preg_split('/\s+/', trim($name)) ?: [];
        $letters = '';

        foreach (array_slice($parts, 0, 2) as $part) {
            $letters .= strtoupper(substr($part, 0, 1));
        }

        return $letters ?: 'U';
    }

    private function roleGradient(string $role): string
    {
        return match ($role) {
            'admin' => '135deg,#f97316,#ef4444',
            'coach' => '135deg,#4facfe,#a855f7',
            default => '135deg,#22c55e,#16a34a',
        };
    }
}
