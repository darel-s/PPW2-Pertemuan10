<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ControllerBuku;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Di sini adalah tempat Anda dapat mendaftarkan rute web untuk aplikasi Anda. Rute-rute ini dimuat oleh RouteServiceProvider, dan semuanya akan ditetapkan ke grup middleware "web". Buat sesuatu yang hebat!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [ProfileController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
});

Route::middleware('admin.access.buku')->group(function () {
    // Definisikan rute yang memerlukan otentikasi admin di sini
    Route::get('/buku', [ControllerBuku::class, 'index']);
    Route::get('/buku/create', [ControllerBuku::class, 'create'])->name('buku.create');
    Route::post('/buku', [ControllerBuku::class, 'store'])->name('buku.store');
    Route::delete('/buku/{id}', [ControllerBuku::class, 'destroy'])->name('buku.destroy');
    Route::get('/buku/edit/{id}', [ControllerBuku::class, 'edit'])->name('buku.edit');
    Route::post('/buku/update/{id}', [ControllerBuku::class, 'update'])->name('buku.update');
    Route::get('/buku/search', [ControllerBuku::class, 'search'])->name('buku.search');
});


require __DIR__.'/auth.php';
