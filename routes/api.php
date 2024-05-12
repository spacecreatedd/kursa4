<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TourController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TicketsController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\ComparisonController;


Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    
    Route::post('/countries', [AdminController::class, 'createCountry']);
    Route::post('/hotels', [AdminController::class, 'createHotel']);
    Route::post('/tickets', [AdminController::class, 'createTicket']);
    Route::post('/tour-operators', [AdminController::class, 'createTourOperator']);
    Route::post('/tours', [AdminController::class, 'createTour']);

    Route::post('/add-ticket/{id}', [TicketsController::class, 'add_ticket']);
    Route::post('/get-ticket-owners', [TicketsController::class, 'get_ticket']);
    Route::delete('/remove-ticket/{id}', [TicketsController::class, 'remove_ticket']);

    Route::post('/add-like/{id}', [LikeController::class, 'add_like']);
    Route::post('/get-like', [LikeController::class, 'get_like']);
    Route::delete('/remove-like/{id}', [LikeController::class, 'remove_like']);

    Route::post('/add-comparison/{id}', [ComparisonController::class, 'add_comparison']);
    Route::post('/get-comparison', [ComparisonController::class, 'get_comparison']);
    Route::delete('/remove-comparison/{id}', [ComparisonController::class, 'remove_comparison']);

    Route::get('/get-tickets', [AdminController::class, 'get_ticket']);
    Route::get('/get-countries', [AdminController::class, 'get_country']);
    Route::get('/get-hotels', [AdminController::class, 'get_hotel']);
    Route::get('/get-touroperators', [AdminController::class, 'get_tour_operators']);
});



Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/get-tours', [TourController::class, 'get_tour']);

// this.countries = this.$store.dispatch('GET_COUNTRIES');
// this.tickets = this.$store.dispatch('GET_TICKETS');
// this.hotels = this.$store.dispatch('GET_HOTELS');
// this.tourOperatos = this.$store.dispatch('GET_TOUROPERATORS');