<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController; // Controller untuk Frontend
use App\Http\Controllers\Admin\PostController as AdminPostController; // Controller untuk Admin
use App\Http\Controllers\ProfileController;



//======================================================================
// RUTE UNTUK PUBLIK / FRONTEND (Bisa diakses semua orang)
//======================================================================


Route::get('/', [PostController::class, 'index'])->name('home');

Route::get('/post/{post:slug}', [PostController::class, 'show'])->name('posts.show');
Route::get('/post/{post:slug}', [PostController::class, 'show'])->name('posts.show');

Route::get('/category/{category:slug}', [PostController::class, 'category'])->name('posts.category');


//======================================================================
// RUTE UNTUK ADMIN / BACKEND (Hanya bisa diakses setelah login)
//======================================================================

Route::get('/dashboard', function () {
    return redirect()->route('admin.posts.index');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {

    Route::resource('posts', AdminPostController::class);
    
});

    // ==========================================================
    // PROFIL
    // ==========================================================
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

require __DIR__.'/auth.php';