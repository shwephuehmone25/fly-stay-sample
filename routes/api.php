<?php

use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FlightController;
use App\Http\Controllers\BookingController;

Route::prefix('auth')->group(function () {
    // Register a new user
    Route::post('register', [AuthController::class, 'register']);

    // Login a user
    Route::post('login', [AuthController::class, 'login']);

    // Logout the user
    Route::middleware('auth:sanctum')->post('logout', [AuthController::class, 'logout']);
});

Route::prefix('flights')->middleware('auth:sanctum')->group(function () {
    // Get all flights
    Route::get('/', [FlightController::class, 'index']);

    // Get a single flight by ID
    Route::get('{flight}', [FlightController::class, 'show']);

    // Store a new flight
    Route::post('/', [FlightController::class, 'store']);

    // Update an existing flight
    Route::put('{flight}', [FlightController::class, 'update']);

    // Delete a flight
    Route::delete('{flight}', [FlightController::class, 'destroy']);
});

Route::prefix('flight')->middleware('auth:sanctum')->group(function () {
    // Get all flight bookings for a user
    Route::get('/', [BookingController::class, 'getAllFlightsBookings']);

    // Get a single flight booking by ID
    Route::get('{booking}', [BookingController::class, 'show']);

    // Store a new flight booking
    Route::post('/book', [BookingController::class, 'bookFlight']);

    // Update a flight booking
    Route::put('{booking}', [BookingController::class, 'update']);

    // Cancel a flight booking
    Route::put('{booking}/cancel', [BookingController::class, 'cancelFlight']);
});

Route::prefix('hotel')->middleware('auth:sanctum')->group(function () {
    // Store a new hotel booking
    Route::post('/book', [BookingController::class, 'bookHotel']);

    // Cancel a hotel booking
    Route::put('{booking}/cancel', [BookingController::class, 'cancelHotelBooking']);
});
