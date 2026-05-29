<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CounterController;
use App\Http\Controllers\ContactController;

Route::get('/counter', [CounterController::class, 'getCount']);
Route::post('/counter/increment', [CounterController::class, 'increment']);
Route::middleware('throttle:5,1')->post('/contact', [ContactController::class, 'store']);
