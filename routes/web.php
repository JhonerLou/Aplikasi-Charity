<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\CampaignController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\GoogleController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::delete('/profile/photo', [ProfileController::class, 'deletePhoto'])->name('profile.photo.delete');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/redirect', [DashboardController::class, 'redirectToDashboard'])->name('dashboard.redirect');
});

Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('admin.users.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/campaign', [CampaignController::class, 'index'])->name('campaign.index');
    Route::get('/campaign/create', [CampaignController::class, 'create'])->name('campaign.create');
    Route::post('/campaign', [CampaignController::class, 'store'])->name('campaign.store');

    // Specific campaign routes
    Route::get('/campaign/{campaign}/edit', [CampaignController::class, 'edit'])->name('campaign.edit');
    Route::put('/campaign/{campaign}', [CampaignController::class, 'update'])->name('campaign.update');
    Route::delete('/campaign/{campaign}', [CampaignController::class, 'destroy'])->name('campaign.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/donation', [DonationController::class, 'index'])->name('donation.index');
    Route::get('/donation/create', [DonationController::class, 'create'])->name('donation.create');
    Route::post('/donation/edit', [DonationController::class, 'store'])->name('donation.store');
    Route::get('/donation/pay', [DonationController::class, 'pay'])->name('donation.pay');
    Route::post('/donation/pay', [DonationController::class, 'pay'])->name('donation.pay');
    Route::get('/donation/success', [DonationController::class, 'success'])->name('donation.success');

});

// Route::post('/webhook/xendit', function (Request $request) {
//     $data = $request->all();
//     Log::info('Xendit webhook received:', $data);
//     return response()->json(['status' => 'success']);
// });


Route::get('/auth/redirect', [GoogleController::class, 'redirect'])->name('redirect');
Route::get('/auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);
require __DIR__ . '/auth.php';
