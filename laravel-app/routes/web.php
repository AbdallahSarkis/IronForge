<?php

use App\Http\Controllers\AuthController;
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
});

Route::middleware('auth')->group(function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/session-user', [AuthController::class, 'sessionUser'])->name('session.user');

    Route::prefix('member')->middleware('role:member')->group(function () {
        Route::view('/dashboard.html', 'member.dashboard');
        Route::view('/schedule.html', 'member.schedule');
        Route::view('/checkin.html', 'member.checkin');
        Route::view('/workouts.html', 'member.workouts');
        Route::view('/coaches.html', 'member.coaches');
        Route::view('/supplements.html', 'member.supplements');
    });

    Route::prefix('coach')->middleware('role:coach')->group(function () {
        Route::view('/dashboard.html', 'coach.dashboard');
        Route::view('/clients.html', 'coach.clients');
        Route::view('/workouts.html', 'coach.workouts');
    });

    Route::prefix('admin')->middleware('role:admin')->group(function () {
        Route::view('/dashboard.html', 'admin.dashboard');
        Route::view('/coaches.html', 'admin.coaches');
        Route::view('/members.html', 'admin.members');
        Route::view('/inventory.html', 'admin.inventory');
    });
});
