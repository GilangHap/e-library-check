<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\HomeController;

// Home Routes
Route::get('/', [HomeController::class, 'index'])->name('beranda'); 

Route::get('/home', function () {
    return redirect()->route('dashboard');
})->name('home');

// User Profile Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', function () {
        return view('profile.show');
    })->name('profile.show');
    
    Route::get('/settings', function () {
        return view('settings');
    })->name('settings');
});

//login routes
Route::get('/login', function () {
    return view('login');
})->name('login');

Route::get('/register', function () {
    return view('register');
})->name('register');

Route::get('/logout', function () {
    return view('logout');    
})->name('logout');


// Peminjaman Routes
Route::prefix('peminjaman')->middleware(['auth'])->group(function () {
    Route::get('/', function () {
        return view('peminjaman.index');
    })->name('peminjaman.index');
    // Add more routes for peminjaman if needed
});

// Admin Routes
Route::prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');

    // User Routes
    Route::get('/users', [AdminController::class, 'users'])->name('users.index');

    // Book Routes
    Route::get('/books', [BookController::class, 'index'])->name('books.index');
    Route::post('/books', [BookController::class, 'store'])->name('books.store');
    Route::get('/admin/books/{book}/edit', [BookController::class, 'edit'])->name('admin.books.edit');
    Route::delete('/admin/books/{book}', [BookController::class, 'destroy'])->name('admin.books.destroy');
    // Add more admin routes here as needed
});

// Define the route for admin.books.index
Route::get('/admin/books', [BookController::class, 'index'])->name('admin.books.index');

// Define the route for books.index
Route::get('/books', [BookController::class, 'index'])->name('books.index');
