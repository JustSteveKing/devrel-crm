<?php

declare(strict_types=1);

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

Route::middleware(['guest'])->group(static function (): void {
    Route::post('login', [AuthenticatedSessionController::class, 'store'])->name('login');
    Route::post('register', [RegisteredUserController::class, 'store'])->name('register');
    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])->name('password.email');
    Route::post('reset-password', [NewPasswordController::class, 'store'])->name('password.store');
});

Route::middleware(['auth','throttle:6,1'])->group(static function (): void {
    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])->name('verification.send');
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
    Route::middleware(['signed'])->group(static function (): void {
        Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)->name('verification.verify');
    });
});

