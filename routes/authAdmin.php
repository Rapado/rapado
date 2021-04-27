<?php

use App\Http\Controllers\Auth\Admin\AuthenticatedSessionAdminController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\Admin\RegisteredUserAdminController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

Route::get('/admin/register', [RegisteredUserAdminController::class, 'create'])
                ->middleware('guest')
                ->name('admin.register');

Route::post('/admin/register', [RegisteredUserAdminController::class, 'store'])
                ->middleware('guest');

Route::get('/admin/login', [AuthenticatedSessionController::class, 'create'])
                ->middleware('guest');

Route::post('/admin/login', [AuthenticatedSessionAdminController::class, 'store'])
                ->middleware('guest')->name('admin.login');

Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])
                ->middleware('guest')
                ->name('password.request');

Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])
                ->middleware('guest')
                ->name('password.email');

Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])
                ->middleware('guest')
                ->name('password.reset');

Route::post('/reset-password', [NewPasswordController::class, 'store'])
                ->middleware('guest')
                ->name('password.update');

Route::get('/verify-email', [EmailVerificationPromptController::class, '__invoke'])
                ->middleware('auth:admin')
                ->name('verification.notice');

Route::get('/verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
                ->middleware(['auth:admin', 'signed', 'throttle:6,1'])
                ->name('verification.verify');

Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                ->middleware(['auth:admin', 'throttle:6,1'])
                ->name('verification.send');

Route::get('/confirm-password', [ConfirmablePasswordController::class, 'show'])
                ->middleware('auth:admin')
                ->name('password.confirm');

Route::post('/confirm-password', [ConfirmablePasswordController::class, 'store'])
                ->middleware('auth:admin');

Route::post('/admin/logout', [AuthenticatedSessionAdminController::class, 'destroy'])
                ->middleware('auth:admin')
                ->name('admin.logout');
