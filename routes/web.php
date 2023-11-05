<?php

use App\Http\Controllers\ClientContactController;
use App\Http\Controllers\ClientController;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserProfileController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('/client-contacts', [ClientContactController::class, 'index'])->name('client.contacts.index');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::patch('/user-profile', [UserProfileController::class, 'update'])->name('user.profile.update');
    Route::patch('/upload-profile-image', [UserController::class, 'updateProfileImage'])->name('user.profile.image.update');
    Route::post('/user', [UserController::class, 'store'])->name('user.store');
    Route::patch('/user/{user}', [UserController::class, 'update'])->name('user.update');

    Route::post('/client-contacts', [ClientContactController::class, 'store'])->name('client.contacts.store');
    Route::patch('/client-contacts/{clientContact}', [ClientContactController::class, 'update'])->name('client.contacts.update');
});

require __DIR__ . '/auth.php';
