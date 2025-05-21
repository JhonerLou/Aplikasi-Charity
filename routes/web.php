<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\CampaignController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/redirect', [DashboardController::class, 'redirectToDashboard'])->name('dashboard.redirect');
});

Route::middleware(['auth', 'is_admin'])->group(function () {
    Route::get('/admin/users', [UserController::class, 'index'])->name('user.index');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/campaign', [CampaignController::class, 'index'])->name('campaign.index');
    Route::get('/campaign/create', [CampaignController::class, 'create'])->name('campaign.create');
    Route::post('/campaign/edit', [CampaignController::class, 'store'])->name('campaign.edit');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/donation', [DonationController::class, 'index'])->name('donation.index');
    Route::get('/donation/create', [DonationController::class, 'create'])->name('donation.create');
    Route::post('/donation/edit', [DonationController::class, 'store'])->name('donation.store');
    Route::post('/donation/pay', [DonationController::class, 'pay'])->name('donation.pay');
});

// Route::post('/webhook/xendit', function (Request $request) {
//     $data = $request->all();
//     Log::info('Xendit webhook received:', $data);
//     return response()->json(['status' => 'success']);
// });

require __DIR__ . '/auth.php';
