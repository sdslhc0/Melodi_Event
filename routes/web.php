<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\KategoriController;
use App\Http\Controllers\Backend\AcaraController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\BookingController as BackendBookingController;
use App\Http\Controllers\Backend\ReviewController as BackendReviewController;
use App\Http\Controllers\Backend\PaketBundlingController;
use App\Http\Controllers\Backend\ExportController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Frontend Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [FrontendController::class, 'home'])->name('home');
Route::get('/kategori', [FrontendController::class, 'kategori'])->name('kategori');
Route::get('/acara/{acara}', [FrontendController::class, 'detailAcara'])->name('acara.detail');
Route::get('/booking/check-date', [BookingController::class, 'checkDate'])->name('booking.checkDate');
Route::post('/contact/send', [ContactController::class, 'send'])->name('contact.send');

/*
|--------------------------------------------------------------------------
| Authenticated User Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    // Booking
    Route::post('/booking-order', [BookingController::class, 'storeOrder'])->name('booking.storeOrder');
    Route::get('/riwayat-booking', [BookingController::class, 'riwayat'])->name('booking.riwayat');

    // Review
    Route::post('/review', [ReviewController::class, 'store'])->name('review.store');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| Backend Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'admin'])->prefix('backend')->name('backend.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Export Data
    Route::post('/export', [ExportController::class, 'export'])->name('export');

    // Kategori CRUD
    Route::resource('kategori', KategoriController::class)->except(['show']);

    // Acara CRUD
    Route::resource('acara', AcaraController::class)->except(['show']);

    // User CRUD
    Route::resource('user', UserController::class)->except(['show']);


    // Bundling Packages CRUD
    Route::resource('bundling', PaketBundlingController::class)->except(['show']);

    // Booking management
    Route::get('/booking', [BackendBookingController::class, 'index'])->name('booking.index');
    Route::get('/booking/{booking}', [BackendBookingController::class, 'show'])->name('booking.show');
    Route::get('/booking/{booking}/edit', [BackendBookingController::class, 'edit'])->name('booking.edit');
    Route::put('/booking/{booking}', [BackendBookingController::class, 'update'])->name('booking.update');
    Route::patch('/booking/{booking}/status', [BackendBookingController::class, 'updateStatus'])->name('booking.updateStatus');

    // Review management
    Route::get('/review', [BackendReviewController::class, 'index'])->name('review.index');
    Route::delete('/review/{review}', [BackendReviewController::class, 'destroy'])->name('review.destroy');

    // Admin Profile
    Route::get('/profile', [\App\Http\Controllers\Backend\ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [\App\Http\Controllers\Backend\ProfileController::class, 'update'])->name('profile.update');
});

require __DIR__.'/auth.php';
