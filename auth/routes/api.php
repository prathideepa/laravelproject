<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

use App\Http\Controllers\ApiController;

Route::post('/register', [ApiController::class, 'register']);
Route::post('/login',[ApiController::class,'login']);
Route::get('/userlist',[ApiController::class,'userlist'])->middleware('auth:sanctum');
