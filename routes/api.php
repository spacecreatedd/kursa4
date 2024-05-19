<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TourController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TicketsController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\ComparisonController;


Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::put('/profile', [AuthController::class, 'profile']);
    
    Route::post('/countries', [AdminController::class, 'createCountry']);
    Route::post('/hotels', [AdminController::class, 'createHotel']);
    Route::post('/tickets', [AdminController::class, 'createTicket']);
    Route::post('/tour-operators', [AdminController::class, 'createTourOperator']);
    Route::post('/tours', [AdminController::class, 'createTour']);

    Route::post('/add-ticket/{id}', [TicketsController::class, 'add_ticket']);
    Route::get('/get-ticket-owners', [TicketsController::class, 'get_ticket']);
    Route::delete('/remove-ticket/{id}', [TicketsController::class, 'remove_ticket']);

    Route::post('/add-like/{id}', [LikeController::class, 'add_like']);
    Route::get('/get-like', [LikeController::class, 'get_like']);
    Route::delete('/remove-like/{id}', [LikeController::class, 'remove_like']);

    Route::post('/add-comparison/{id}', [ComparisonController::class, 'add_comparison']);
    Route::get('/get-comparison', [ComparisonController::class, 'get_comparison']);
    Route::delete('/remove-comparison/{id}', [ComparisonController::class, 'remove_comparison']);

    Route::get('/get-tickets', [AdminController::class, 'get_ticket']);
    Route::get('/get-countries', [AdminController::class, 'get_country']);
    Route::get('/get-hotels', [AdminController::class, 'get_hotel']);
    Route::get('/get-touroperators', [AdminController::class, 'get_tour_operators']);
    
    Route::get('/get-one-owner/{id}', [TicketsController::class, 'get_one_owner']);
    Route::get('/get-one-comparison/{id}', [ComparisonController::class, 'get_one_comparison']);

    Route::get('/user', function (Request $request) {
        return Auth::user();
    });
});



Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/get-tours', [TourController::class, 'get_tour']);
Route::get('/get-one-tour/{id}', [TourController::class, 'get_one_tour']);
Route::get('/get-countries', [TourController::class, 'get_country']);
Route::get('/get-hotels', [TourController::class, 'get_hotel']);
Route::get('/get-tickets', [TourController::class, 'get_ticket']);
Route::get('/get-operators', [TourController::class, 'get_operator']);
Route::get('/search-tour', [TourController::class, 'search_tour']);

// this.countries = this.$store.dispatch('GET_COUNTRIES');
// this.tickets = this.$store.dispatch('GET_TICKETS');
// this.hotels = this.$store.dispatch('GET_HOTELS');
// this.tourOperatos = this.$store.dispatch('GET_TOUROPERATORS');