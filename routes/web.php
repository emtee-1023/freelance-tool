<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\FreelancerController;
use App\Http\Controllers\FreelancerAuthController;
use App\Http\Controllers\FiverrAccountController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\IsAdmin;


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

Route::resource('admins', AdminController::class)
    ->middleware(['auth', 'verified', IsAdmin::class])
    ->parameters(['admins' => 'admin'])
    ->names('admins');

Route::resource('freelancers', FreelancerController::class)
    ->middleware(['auth', 'verified'])
    ->parameters(['freelancers' => 'freelancer'])
    ->names('freelancers');

Route::post('/freelancers', [FreelancerController::class, 'store']);


Route::get('/freelancers/set-password', [FreelancerAuthController::class, 'showPasswordForm'])->name('freelancers.set-password');
Route::post('/freelancers/set-password', [FreelancerAuthController::class, 'updatePassword'])->name('freelancers.update-password');

Route::resource('fiverr-accounts', FiverrAccountController::class)
    ->middleware(['auth', 'verified'])
    ->parameters(['fiverr-accounts' => 'fiverrAccount'])
    ->names('fiverr-accounts');

Route::post('/fiverr-accounts', [FiverrAccountController::class, 'store'])->name('fiverr-accounts.store');


Route::resource('tasks', TaskController::class)
    ->middleware(['auth', 'verified'])
    ->parameters(['tasks' => 'task'])
    ->names('tasks');

Route::resource('clients', ClientController::class)
    ->middleware(['auth', 'verified', IsAdmin::class])
    ->parameters(['clients' => 'client'])
    ->names('clients');

Route::post('/clients', [ClientController::class, 'store'])->name('clients.store');


require __DIR__ . '/auth.php';
