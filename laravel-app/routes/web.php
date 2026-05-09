<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AppDataController;
use App\Http\Controllers\NutritionController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SuperAdminController;
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
        Route::view('/schedule.html', 'member.schedule')->middleware('module:schedule');
        Route::view('/checkin.html', 'member.checkin')->middleware('module:checkin');
        Route::view('/workouts.html', 'member.workouts')->middleware('module:workouts');
        Route::view('/coaches.html', 'member.coaches')->middleware('module:coaches');
        Route::view('/supplements.html', 'member.supplements')->middleware('module:supplements');

        Route::middleware('module:nutrition')->group(function () {
            Route::view('/nutrition.html', 'member.nutrition');
            Route::get('/nutrition/summary', [NutritionController::class, 'memberSummary'])->name('member.nutrition.summary');
            Route::post('/nutrition/entries', [NutritionController::class, 'storeMemberEntry'])->name('member.nutrition.entries.store');
            Route::get('/nutrition/body-composition', [NutritionController::class, 'memberBodyComposition'])->name('member.nutrition.body');
            Route::post('/nutrition/body-composition', [NutritionController::class, 'saveMemberBodyComposition'])->name('member.nutrition.body.save');
            Route::put('/nutrition/entries/{entry}', [NutritionController::class, 'updateMemberEntry'])->name('member.nutrition.entries.update');
            Route::delete('/nutrition/entries/{entry}', [NutritionController::class, 'deleteMemberEntry'])->name('member.nutrition.entries.delete');
        });

        Route::post('/profile/update', [ProfileController::class, 'updateProfile'])->name('profile.update');
    });

    Route::prefix('user')->middleware('role:user')->group(function () {
        Route::view('/dashboard.html', 'user.dashboard');
        Route::view('/profile.html', 'user.profile');
        Route::view('/explore.html', 'user.explore')->middleware('module:explore');
        Route::view('/near-gyms.html', 'user.near-gyms')->middleware('module:near-gyms');
        Route::view('/near-coaches.html', 'user.near-coaches')->middleware('module:near-coaches');
        Route::post('/profile/update', [ProfileController::class, 'updateProfile'])->name('profile.update');
    });

    Route::prefix('coach')->middleware('role:coach')->group(function () {
        Route::view('/dashboard.html', 'coach.dashboard');
        Route::view('/profile.html', 'coach.profile');
        Route::view('/clients.html', 'coach.clients')->middleware('module:clients');
        Route::view('/workouts.html', 'coach.workouts')->middleware('module:workouts');
        Route::post('/profile/update', [ProfileController::class, 'updateProfile'])->name('profile.update');
    });

    Route::prefix('nutrition-specialist')->middleware('role:nutrition-specialist')->group(function () {
        Route::view('/dashboard.html', 'nutrition-specialist.dashboard');
        Route::view('/profile.html', 'nutrition-specialist.profile');
        Route::view('/members.html', 'nutrition-specialist.members')->middleware('module:members');
        Route::get('/members/data', [NutritionController::class, 'specialistMembers'])->middleware('module:members')->name('nutrition.specialist.members');
        Route::post('/members/{member}/targets', [NutritionController::class, 'updateMemberTargets'])->middleware('module:members')->name('nutrition.specialist.members.targets');
        Route::post('/profile/update', [ProfileController::class, 'updateProfile'])->name('profile.update');
    });

    Route::prefix('admin')->middleware('role:admin')->group(function () {
        Route::view('/dashboard.html', 'admin.dashboard');
        Route::view('/profile.html', 'admin.profile');
        Route::view('/coaches.html', 'admin.coaches')->middleware('module:coaches');
        Route::view('/members.html', 'admin.members')->middleware('module:members');
        Route::view('/inventory.html', 'admin.inventory')->middleware('module:inventory');
        Route::post('/profile/update', [ProfileController::class, 'updateProfile'])->name('profile.update');
    });

    Route::prefix('super-admin')->middleware('role:super-admin')->group(function () {
        Route::view('/dashboard.html', 'super-admin.dashboard');
        Route::view('/gyms.html', 'super-admin.gyms');
        Route::view('/users.html', 'super-admin.users');
        Route::view('/user-access.html', 'super-admin.user-access');
        Route::view('/reports.html', 'super-admin.reports');
        Route::get('/modules', [SuperAdminController::class, 'modules'])->name('super-admin.modules');
        Route::get('/stats', [SuperAdminController::class, 'stats'])->name('super-admin.stats');
        Route::get('/gyms/data', [SuperAdminController::class, 'gyms'])->name('super-admin.gyms.data');
        Route::get('/users/data', [SuperAdminController::class, 'users'])->name('super-admin.users.data');
        Route::get('/coaches/data', [SuperAdminController::class, 'coaches'])->name('super-admin.coaches.data');
        Route::get('/reports/data', [SuperAdminController::class, 'reports'])->name('super-admin.reports.data');
        Route::post('/users/{id}/role', [SuperAdminController::class, 'changeUserRole'])->name('super-admin.users.role');
        Route::post('/users/{id}/modules', [SuperAdminController::class, 'updateUserModules'])->name('super-admin.users.modules');
        Route::delete('/users/{id}', [SuperAdminController::class, 'deleteUser'])->name('super-admin.users.delete');
    });
});
