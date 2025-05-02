<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookingController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::prefix('bookings')->group(function () {
    Route::get('/', [BookingController::class, 'index']);  // Mengambil daftar pemesanan
    Route::get('{id}', [BookingController::class, 'show']);  // Mengambil pemesanan berdasarkan ID
    Route::post('/', [BookingController::class, 'store']);  // Membuat pemesanan baru
    Route::put('{id}', [BookingController::class, 'update']);  // Mengupdate pemesanan
    Route::delete('{id}', [BookingController::class, 'destroy']);  // Menghapus pemesanan
});