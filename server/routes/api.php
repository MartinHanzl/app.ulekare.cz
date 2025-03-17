<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::group([
    'prefix' => 'note',
], function () {
    Route::get('', [\App\Http\Controllers\Api\NoteController::class, 'index']);
    Route::get('{id}', [\App\Http\Controllers\Api\NoteController::class, 'show'])->where('id', '[0-9]+');
    Route::post('{id?}', [\App\Http\Controllers\Api\NoteController::class, 'store']);
    Route::delete('{id}', [\App\Http\Controllers\Api\NoteController::class, 'destroy'])->where('id', '[0-9]+');
});
