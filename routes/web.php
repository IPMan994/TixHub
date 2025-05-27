<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [EventController::class, 'index'])->name('home');
Route::get('/explore', [EventController::class, 'explore'])->name('explore');
Route::get('/events/{id}', [EventController::class, 'show'])->name('events.show');

// Auth Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin Routes
Route::middleware(['auth', 'Admin'])->prefix('Admin')->group(function () {
    Route::get('/Admin/login', [AuthController::class, 'showAdminLoginForm'])->name('Admin.login');
    Route::post('/Admin/login', [AuthController::class, 'AdminLogin'])->name('Admin.login.submit');
    Route::get('/Admin/register', [AuthController::class, 'showAdminRegisterForm'])->name('Admin.register');
    Route::post('/Admin/register', [AuthController::class, 'AdminRegister'])->name('Admin.register.submit');
    Route::get('/Admin/dashboard', [AdminController::class, 'dashboard'])->name('Admin.dashboard');
    Route::get('/Admin/events/create', [AdminController::class, 'createEvent'])->name('Admin.events.create');
    Route::post('/Admin/events', [AdminController::class, 'storeEvent'])->name('Admin.events.store');
    Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    });
    Route::resource('Admin', 'AdminController');
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('Admin.dashboard');
    Route::get('/events/create', [AdminController::class, 'createEvent'])->name('Admin.events.create');
    Route::post('/events', [AdminController::class, 'storeEvent'])->name('Admin.events.store');
    Route::delete('/events/{event}', [AdminController::class, 'destroyEvent'])->name('Admin.events.destroy');
});

// User Routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [UserController::class, 'profile'])->name('user.profile');
    Route::post('/events/{event}/book', [UserController::class, 'bookTicket'])->name('events.book');
});

Route::middleware(['auth', 'Admin'])->group(function () {
    Route::get('/events/create', [EventController::class, 'create'])->name('events.create');
    Route::post('/events', [EventController::class, 'store'])->name('events.store');
});
