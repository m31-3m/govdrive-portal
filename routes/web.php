<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ServiceRequestController;
use App\Models\ServiceRequest;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

/**
 * UPDATED DASHBOARD ROUTE
 * This now fetches the requests so the table can be displayed here.
 */
Route::get('/dashboard', function () {
    $requests = (auth()->user()->role === 1)
        ? ServiceRequest::with('user')->latest()->get()
        : auth()->user()->serviceRequests()->latest()->get();

    return view('dashboard', compact('requests'));
})->middleware(['auth', 'verified'])->name('dashboard');

// Requirement: Middleware (auth)
Route::middleware('auth')->group(function () {
    // Profile Routes (Laravel Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // CRUD Resource for Service Requests
    Route::resource('requests', ServiceRequestController::class);
    
    // Custom route for Admin to Update Status
    Route::patch('/requests/{serviceRequest}/status', [ServiceRequestController::class, 'updateStatus'])->name('requests.status');
});

require __DIR__.'/auth.php';