<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\VesselScheduleController;
use App\Models\VesselSchedule;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $start = now()->subMonth()->startOfMonth();
    $end = now()->endOfMonth();
    $schedules = VesselSchedule::whereBetween('etd_sub', [$start, $end])
        ->orderBy('etd_sub', 'asc')
        ->get();
    return view('landing', compact('schedules'));
})->name('home');

Route::post('/contact', [ContactController::class, 'store'])->name('contact.submit');

// Custom Admin Path (Dapat diubah via .env Key: ADMIN_PATH)
$adminPath = env('ADMIN_PATH', 'sanwa-internal-portal');

// Admin Guest Routes (Di-protect Rate Limiter max 5x coba per 1 menit)
Route::middleware('guest')->prefix($adminPath)->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->middleware('throttle:5,1');
});

// Admin Protected Routes (Di-protect Middleware Auth)
Route::middleware('auth')->prefix($adminPath)->name('admin.')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::resource('schedules', VesselScheduleController::class)->except(['show']);
});
