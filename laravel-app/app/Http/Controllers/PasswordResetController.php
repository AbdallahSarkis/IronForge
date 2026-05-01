<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class PasswordResetController extends Controller
{
    private const SESSION_EMAIL_KEY = 'password_reset_email';

    private const SESSION_VERIFIED_KEY = 'password_reset_verified';

    public function showRequestForm(): View
    {
        return view('auth.forgot-password');
    }

    public function sendCode(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'email' => ['required', 'email'],
        ]);

        $user = User::where('email', $data['email'])->first();

        if (! $user) {
            throw ValidationException::withMessages([
                'email' => 'No account found with this email.',
            ]);
        }

        $code = (string) random_int(100000, 999999);

        DB::table('password_reset_codes')->where('email', $user->email)->delete();

        DB::table('password_reset_codes')->insert([
            'email' => $user->email,
            'code_hash' => Hash::make($code),
            'expires_at' => now()->addMinutes(10),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Mail::raw(
            "Your IRONFORGE password reset verification code is: {$code}\n\nThis code expires in 10 minutes.",
            function ($message) use ($user): void {
                $message->to($user->email)
                    ->subject('IRONFORGE Password Reset Code');
            }
        );

        $request->session()->put(self::SESSION_EMAIL_KEY, $user->email);
        $request->session()->forget(self::SESSION_VERIFIED_KEY);

        return redirect('/verify-reset-code.html')->with('status', 'Verification code sent to your email.');
    }

    public function showVerifyForm(Request $request): View|RedirectResponse
    {
        if (! $request->session()->has(self::SESSION_EMAIL_KEY)) {
            return redirect('/forgot-password.html');
        }

        return view('auth.verify-reset-code');
    }

    public function verifyCode(Request $request): RedirectResponse
    {
        $request->validate([
            'code' => ['required', 'digits:6'],
        ]);

        $email = (string) $request->session()->get(self::SESSION_EMAIL_KEY);

        if (! $email) {
            return redirect('/forgot-password.html');
        }

        $record = DB::table('password_reset_codes')->where('email', $email)->first();

        if (! $record) {
            throw ValidationException::withMessages([
                'code' => 'Verification code not found. Request a new one.',
            ]);
        }

        if (now()->greaterThan($record->expires_at)) {
            DB::table('password_reset_codes')->where('email', $email)->delete();

            throw ValidationException::withMessages([
                'code' => 'Verification code expired. Request a new one.',
            ]);
        }

        if (! Hash::check($request->string('code')->toString(), $record->code_hash)) {
            throw ValidationException::withMessages([
                'code' => 'Invalid verification code.',
            ]);
        }

        $request->session()->put(self::SESSION_VERIFIED_KEY, true);

        return redirect('/reset-password.html');
    }

    public function showResetForm(Request $request): View|RedirectResponse
    {
        if (! $this->canReset($request)) {
            return redirect('/forgot-password.html');
        }

        return view('auth.reset-password');
    }

    public function resetPassword(Request $request): RedirectResponse
    {
        if (! $this->canReset($request)) {
            return redirect('/forgot-password.html');
        }

        $data = $request->validate([
            'password' => ['required', 'confirmed', 'min:8'],
        ]);

        $email = (string) $request->session()->get(self::SESSION_EMAIL_KEY);

        $user = User::where('email', $email)->first();

        if (! $user) {
            return redirect('/forgot-password.html')->withErrors([
                'email' => 'Account not found. Please try again.',
            ]);
        }

        $user->password = Hash::make($data['password']);
        $user->setRememberToken(Str::random(60));
        $user->save();

        DB::table('password_reset_codes')->where('email', $email)->delete();

        $request->session()->forget([self::SESSION_EMAIL_KEY, self::SESSION_VERIFIED_KEY]);

        return redirect('/login.html')->with('status', 'Password updated successfully. Please sign in.');
    }

    private function canReset(Request $request): bool
    {
        return $request->session()->has(self::SESSION_EMAIL_KEY)
            && (bool) $request->session()->get(self::SESSION_VERIFIED_KEY, false);
    }
}
