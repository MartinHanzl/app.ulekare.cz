<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [\App\Http\Controllers\NoteController::class, 'index']);
Route::get('/poznamka/{id?}', [\App\Http\Controllers\NoteController::class, 'show'])->name('poznamka');
Route::post('/update/{id?}', [\App\Http\Controllers\NoteController::class, 'store'])->name('update');
Route::delete('/delete/{id}', [\App\Http\Controllers\NoteController::class, 'destroy'])->name('delete')->where('id', '[0-9]+');
