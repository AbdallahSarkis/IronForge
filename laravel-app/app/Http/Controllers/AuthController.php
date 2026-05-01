<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Laravel\Socialite\Facades\Socialite;
use Throwable;

class AuthController extends Controller
{
    public function showLogin(): View|RedirectResponse
    {
        if (Auth::check()) {
            return redirect('/'.Auth::user()->role.'/dashboard.html');
        }

        return view('login');
    }

    public function showRegister(): View|RedirectResponse
    {
        if (Auth::check()) {
            return redirect('/'.Auth::user()->role.'/dashboard.html');
        }

        return view('register');
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

    public function register(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', 'min:8'],
            'gender' => ['required', 'string', 'in:male,female,other'],
            'date_of_birth' => ['required', 'date', 'before:today'],
        ], [], [
            'gender' => 'gender',
            'date_of_birth' => 'date of birth',
        ]);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'role' => 'user',
            'gender' => $data['gender'],
            'date_of_birth' => $data['date_of_birth'],
            'password' => Hash::make($data['password']),
        ]);

        Auth::login($user);
        $request->session()->regenerate();

        return redirect('/user/dashboard.html');
    }

    public function redirectToGoogle(): RedirectResponse
    {
        if (! $this->googleConfigured()) {
            return redirect('/login.html')->withErrors([
                'email' => 'Google sign-up is not configured yet. Add Google credentials in your .env file.',
            ]);
        }

        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback(Request $request): RedirectResponse
    {
        if (! $this->googleConfigured()) {
            return redirect('/login.html')->withErrors([
                'email' => 'Google sign-up is not configured yet. Add Google credentials in your .env file.',
            ]);
        }

        try {
            $googleUser = Socialite::driver('google')->user();
        } catch (Throwable $exception) {
            return redirect('/login.html')->withErrors([
                'email' => 'Google authentication failed. Please try again.',
            ]);
        }

        $email = $googleUser->getEmail();
        if (! $email) {
            return redirect('/login.html')->withErrors([
                'email' => 'Your Google account did not provide an email address.',
            ]);
        }

        $name = $googleUser->getName() ?: $googleUser->getNickname() ?: Str::before($email, '@');
        $avatar = $googleUser->getAvatar();

        $user = User::where('email', $email)->first();

        if (! $user) {
            $user = User::create([
                'name' => $name,
                'email' => $email,
                'role' => 'user',
                'google_id' => $googleUser->getId(),
                'avatar' => $avatar,
                'gender' => 'other',
                'date_of_birth' => null,
                'password' => Hash::make(Str::random(40)),
            ]);
        } else {
            $user->google_id = $googleUser->getId();
            $user->avatar = $avatar;
            $user->save();
        }

        Auth::login($user, true);
        $request->session()->regenerate();

        return redirect('/'.$user->role.'/dashboard.html');
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

        $coachContact = null;
        if ($user->role === 'coach') {
            $coachContact = DB::table('coaches')
                ->where('user_id', $user->id)
                ->first(['phone_number', 'whatsapp_number']);
        }

        return response()->json([
            'name' => $user->name,
            'email' => $user->email,
            'role' => $user->role,
            'gender' => $user->gender,
            'date_of_birth' => $user->date_of_birth?->format('Y-m-d'),
            'location_address' => $user->location_address,
            'location_latitude' => $user->location_latitude,
            'location_longitude' => $user->location_longitude,
            'coach_gym_locations' => $user->coach_gym_locations ?? [],
            'coach_phone_number' => $coachContact?->phone_number,
            'coach_whatsapp_number' => $coachContact?->whatsapp_number,
            'gym_name' => $user->gym_name,
            'gym_open_time' => $user->gym_open_time,
            'gym_close_time' => $user->gym_close_time,
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
            'user' => '135deg,#06b6d4,#0ea5e9',
            default => '135deg,#22c55e,#16a34a',
        };
    }

    private function googleConfigured(): bool
    {
        return (bool) config('services.google.client_id')
            && (bool) config('services.google.client_secret')
            && (bool) config('services.google.redirect');
    }
}
