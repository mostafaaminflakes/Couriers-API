<?php

use App\Http\Controllers\ApiCourierController;
use Illuminate\Support\Facades\Route;

Route::get('/courier_metadata', [ApiCourierController::class, 'get_courier_metadata']);
Route::get('/create', [ApiCourierController::class, 'create_shipment']);
Route::get('/void', [ApiCourierController::class, 'void_shipment']);
Route::get('/status', [ApiCourierController::class, 'shipment_status']);
Route::get('/track', [ApiCourierController::class, 'track_shipment']);
