<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AppDataController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (auth()->check()) {
        return redirect('/'.auth()->user()->role.'/dashboard.html');
    }

    return redirect('/login.html');
});

Route::view('/index.html', 'index');

Route::middleware('guest')->group(function () {
    Route::get('/login.html', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.perform');
    Route::get('/signup.html', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/signup', [AuthController::class, 'register'])->name('register.perform');
    Route::get('/auth/google', [AuthController::class, 'redirectToGoogle'])->name('auth.google');
    Route::get('/auth/google/callback', [AuthController::class, 'handleGoogleCallback'])->name('auth.google.callback');
    Route::get('/forgot-password.html', [PasswordResetController::class, 'showRequestForm'])->name('password.request');
    Route::post('/forgot-password', [PasswordResetController::class, 'sendCode'])->name('password.email.code');
    Route::get('/verify-reset-code.html', [PasswordResetController::class, 'showVerifyForm'])->name('password.verify.form');
    Route::post('/verify-reset-code', [PasswordResetController::class, 'verifyCode'])->name('password.verify.code');
    Route::get('/reset-password.html', [PasswordResetController::class, 'showResetForm'])->name('password.reset.form');
    Route::post('/reset-password', [PasswordResetController::class, 'resetPassword'])->name('password.update.from.code');
});

Route::middleware('auth')->group(function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/session-user', [AuthController::class, 'sessionUser'])->name('session.user');
    Route::get('/app-data', [AppDataController::class, 'index'])->name('app.data');

    Route::prefix('member')->middleware('role:member')->group(function () {
        Route::view('/dashboard.html', 'member.dashboard');
            Route::view('/profile.html', 'member.profile');
        Route::view('/schedule.html', 'member.schedule');
        Route::view('/checkin.html', 'member.checkin');
        Route::view('/workouts.html', 'member.workouts');
        Route::view('/coaches.html', 'member.coaches');
        Route::view('/supplements.html', 'member.supplements');
        Route::post('/profile/update', [ProfileController::class, 'updateProfile'])->name('profile.update');
    });

    Route::prefix('user')->middleware('role:user')->group(function () {
        Route::view('/dashboard.html', 'user.dashboard');
            Route::view('/profile.html', 'user.profile');
        Route::view('/explore.html', 'user.explore');
        Route::view('/near-gyms.html', 'user.near-gyms');
        Route::view('/near-coaches.html', 'user.near-coaches');
        Route::post('/profile/update', [ProfileController::class, 'updateProfile'])->name('profile.update');
    });

    Route::prefix('coach')->middleware('role:coach')->group(function () {
        Route::view('/dashboard.html', 'coach.dashboard');
        Route::view('/profile.html', 'coach.profile');
        Route::view('/clients.html', 'coach.clients');
        Route::view('/workouts.html', 'coach.workouts');
        Route::post('/profile/update', [ProfileController::class, 'updateProfile'])->name('profile.update');
    });

    Route::prefix('admin')->middleware('role:admin')->group(function () {
        Route::view('/dashboard.html', 'admin.dashboard');
        Route::view('/profile.html', 'admin.profile');
        Route::view('/coaches.html', 'admin.coaches');
        Route::view('/members.html', 'admin.members');
        Route::view('/inventory.html', 'admin.inventory');
        Route::post('/profile/update', [ProfileController::class, 'updateProfile'])->name('profile.update');
    });
});
