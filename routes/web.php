<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// Route::get('/venue/delete/{id}', 'App\Http\Controllers\VenueController@deleteVenue');
// Route::post('/venue/update/{id}', 'App\Http\Controllers\VenueController@updateVenue');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('venue', App\Http\Controllers\VenueController::class);


Route::get('slot/create/{id}', [App\Http\Controllers\SlotController::class, 'create']);
Route::resource('slot', App\Http\Controllers\SlotController::class);


Route::get('booking/create/{id}', [App\Http\Controllers\BookingController::class, 'create']);
Route::resource('booking', App\Http\Controllers\BookingController::class);

