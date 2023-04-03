<?php

use App\Http\Controllers\WebCourierController;
use Illuminate\Support\Facades\Route;

Route::get('/', [WebCourierController::class, 'index']);
Route::post('/metadata', [WebCourierController::class, 'get_courier_metadata'])->name('metadata');
Route::post('/create', [WebCourierController::class, 'create_shipment'])->name('create');
Route::post('/void', [WebCourierController::class, 'void_shipment'])->name('void');
Route::post('/status', [WebCourierController::class, 'shipment_status'])->name('status');
Route::post('/track', [WebCourierController::class, 'track_shipment'])->name('track');
