<?php


use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\CampaignController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\DashboardController;
Route::get('/', function () {
    return view('welcome');
});



Route::middleware(middleware: 'auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'is_admin'])->group(function () {
    Route::get('/admin/users', [UserController::class, 'index'])->name('users.index');
});


Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('Dashboard');
    Route::get('/dashboard/redirect', [DashboardController::class, 'redirectToDashboard'])->name('dashboard.redirect');
});


Route::resource('donations', DonationController::class)
    ->middleware('auth');


Route::resource('campaign', CampaignController::class)
    ->middleware('auth');


Route::resource('campaign', CampaignController::class);


Route::middleware(['auth'])->group(function () {


    Route::get('/campaign', [CampaignController::class, 'index'])->name('campaign.index');
    ;
    Route::get('/campaign/create', [CampaignController::class, 'create'])->name('campaign.create');

    Route::post('/campaign/edit', [CampaignController::class, 'store'])->name('campaign.edit');
});

Route::middleware(['auth'])->group(function () {


    Route::get('/donation', [DonationController::class, 'index'])->name('donation.index');
    ;
    Route::get('/donation/create', [DonationController::class, 'create'])->name('donation.create');

    Route::post('/donation/edit', [DonationController::class, 'store'])->name('donation.store');
    Route::post('/donation/pay', [DonationController::class, 'pay'])->name('donation.index');
});




Route::post('/webhook/xendit', function (Request $request) {
    // Verify the webhook signature if necessary
    $data = $request->all();

    // Process the webhook data
    // For example, update the donation status in the database

    Log::info('Xendit webhook received:', $data);

    return response()->json(['status' => 'success']);
});

require __DIR__ . '/auth.php';
