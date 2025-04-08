<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FreelancerController;
use App\Http\Controllers\FreelancerAuthController;
use App\Http\Controllers\FiverrAccountController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('freelancers', FreelancerController::class)
    ->middleware(['auth', 'verified'])
    ->parameters(['freelancers' => 'freelancer'])
    ->names('freelancers');

Route::get('/freelancers/set-password', [FreelancerAuthController::class, 'showPasswordForm'])->name('freelancers.set-password');
Route::post('/freelancers/set-password', [FreelancerAuthController::class, 'updatePassword'])->name('freelancers.update-password');

Route::resource('fiverr-accounts', FiverrAccountController::class)
    ->middleware(['auth', 'verified'])
    ->parameters(['fiverr-accounts' => 'fiverrAccount'])
    ->names('fiverr-accounts');

Route::resource('tasks', TaskController::class)
    ->middleware(['auth', 'verified'])
    ->parameters(['tasks' => 'task'])
    ->names('tasks');

require __DIR__ . '/auth.php';
