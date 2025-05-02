<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HaircutController;

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
Route::get('haircuts', [HaircutController::class, 'index']);  // Mendapatkan semua layanan
Route::get('haircuts/{id}', [HaircutController::class, 'show']);  // Mendapatkan layanan berdasarkan ID
Route::post('haircuts', [HaircutController::class, 'store']);  // Menyimpan layanan baru
Route::put('haircuts/{id}', [HaircutController::class, 'update']);  // Mengupdate layanan berdasarkan ID
Route::delete('haircuts/{id}', [HaircutController::class, 'destroy']);  // Menghapus layanan berdasarkan ID
