<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn() => redirect()->route('login'))->name('home');

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// Authenticated Routes
Route::middleware('auth')->group(function () {
    // Forum Routes
    Route::prefix('forum')->name('forum.')->group(function () {
        Route::get('/', [ForumController::class, 'index'])->name('index');
        Route::get('/create', [ForumController::class, 'create'])->name('create');
        Route::post('/', [ForumController::class, 'store'])->name('store');
        Route::get('/{thread}', [ForumController::class, 'show'])->name('show');
        Route::get('/{thread}/edit', [ForumController::class, 'edit'])->name('edit');
        Route::put('/{thread}', [ForumController::class, 'update'])->name('update');
        Route::delete('/{thread}', [ForumController::class, 'destroy'])->name('destroy');
        
        // Reply Routes
        Route::post('/{thread}/reply', [ForumController::class, 'storeReply'])->name('reply.store');
        Route::get('/reply/{reply}/edit', [ForumController::class, 'editReply'])->name('reply.edit');
        Route::put('/reply/{reply}', [ForumController::class, 'updateReply'])->name('reply.update');
        Route::delete('/reply/{reply}', [ForumController::class, 'destroyReply'])->name('reply.destroy');
        Route::post('/reply/{reply}/report', [ForumController::class, 'report'])->name('reply.report');
    });

    // Admin Routes
    Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {
        // Dashboard
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        
        // Reports
        Route::get('/reports', [AdminController::class, 'reports'])->name('reports');
        Route::post('/reply/{reply}/hide', [AdminController::class, 'hideReply'])->name('reply.hide');
        
        // Users
        Route::get('/users', [AdminController::class, 'users'])->name('users');
        
        // Categories (using resource controller)
        Route::get('/categories', [AdminController::class, 'index'])->name('categories.index');
        Route::get('/categories/create', [AdminController::class, 'create'])->name('categories.create');
        Route::post('/categories', [AdminController::class, 'store'])->name('categories.store');
        Route::get('/categories/{category}/edit', [AdminController::class, 'edit'])->name('categories.edit');
        Route::put('/categories/{category}', [AdminController::class, 'update'])->name('categories.update');
        Route::delete('/categories/{category}', [AdminController::class, 'destroy'])->name('categories.destroy');
    });
});