<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PeminjamanController;

// Home Routes
Route::get('/', [HomeController::class, 'index'])->name('beranda'); 

Route::get('/home', function () {
    return redirect()->route('dashboard');
})->name('home');

Route::get('/peminjaman', [PeminjamanController::class, 'index'])->name('peminjaman.index');

// Route untuk aksi perpanjang peminjaman
Route::post('/peminjaman/perpanjang/{id}', [PeminjamanController::class, 'perpanjang'])->name('peminjaman.perpanjang');

// Route untuk aksi batalkan antrian
Route::delete('/peminjaman/batalkan/{id}', [PeminjamanController::class, 'batalkan'])->name('peminjaman.batalkan');

// Route untuk aksi pinjam buku lagi
Route::get('/peminjaman/pinjam-lagi/{id}', [PeminjamanController::class, 'pinjamLagi'])->name('peminjaman.pinjam-lagi');

// Route untuk menyimpan ulasan
Route::post('/ulasan/store')->name('ulasan.store');
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
