<?php 

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ThreadController;
use App\Http\Controllers\ReplyController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth'])->group(function () {

    // 🔹 **Thread Routes**
    Route::get('/threads', [ThreadController::class, 'index'])->name('threads.index'); // List all threads
    Route::get('/threads/create', [ThreadController::class, 'create'])->name('threads.create'); // Create form
    Route::post('/threads', [ThreadController::class, 'store'])->name('threads.store'); // Store new thread
    Route::get('/threads/{thread}', [ThreadController::class, 'show'])->name('threads.show'); // Show single thread

    // ✅ Add thread editing functionality
    
    Route::get('/threads/{thread}/edit', [ThreadController::class, 'edit'])->name('threads.edit'); // Edit form
    Route::put('/threads/{thread}', [ThreadController::class, 'update'])->name('threads.update'); // Update thread
    Route::delete('/threads/{thread}', [ThreadController::class, 'destroy'])->name('threads.destroy'); // Delete thread

    // 🔹 **Reply Routes**
    Route::post('/threads/{thread}/replies', [ReplyController::class, 'store'])->name('replies.store'); // Add reply
    Route::get('/replies/{reply}/edit', [ReplyController::class, 'edit'])->name('replies.edit'); // Edit reply
    Route::put('/replies/{reply}', [ReplyController::class, 'update'])->name('replies.update'); // Update reply
    Route::delete('/replies/{reply}', [ReplyController::class, 'destroy'])->name('replies.destroy'); // Delete reply

    // 🔹 **Profile Routes**
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Include authentication routes
require __DIR__.'/auth.php';
