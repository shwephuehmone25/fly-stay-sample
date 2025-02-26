<?php

use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\FlightController;
use App\Http\Controllers\BookingController;

Route::prefix('auth')->group(function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    Route::middleware('auth:sanctum')->post('logout', [AuthController::class, 'logout']);
});

Route::prefix('flights')->middleware('auth:sanctum')->group(function () {
    Route::get('/', [FlightController::class, 'index']);
    Route::get('{flight}', [FlightController::class, 'show']);
    Route::post('/', [FlightController::class, 'store']);
    Route::put('{flight}', [FlightController::class, 'update']);
    Route::delete('{flight}', [FlightController::class, 'destroy']);
});

Route::prefix('hotels')->group(function () {
    Route::get('/', [HotelController::class, 'index']);
    Route::post('/', [HotelController::class, 'store']);
    Route::get('/{hotel}', [HotelController::class, 'show']);
    Route::put('/{hotel}', [HotelController::class, 'update']);
    Route::delete('/{hotel}', [HotelController::class, 'destroy']);
});

Route::prefix('flight')->middleware('auth:sanctum')->group(function () {
    Route::get('/', [BookingController::class, 'getAllFlightsBookings']);
    Route::get('{booking}', [BookingController::class, 'show']);
    Route::post('/book', [BookingController::class, 'bookFlight']);
    Route::put('{booking}', [BookingController::class, 'update']);
    Route::put('{booking}/cancel', [BookingController::class, 'cancelFlight']);
});

Route::prefix('hotel')->middleware('auth:sanctum')->group(function () {
    Route::post('/book', [BookingController::class, 'bookHotel']);
    Route::put('{booking}/cancel', [BookingController::class, 'cancelHotelBooking']);
});
