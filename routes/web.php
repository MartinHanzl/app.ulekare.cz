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

Route::get('/', function () {
    return view('welcome');
});

Route::group([
    'prefix' => 'notes',
], function () {
    Route::get('', [\App\Http\Controllers\NoteController::class, 'index'])->name('notes.index');
    Route::get('/create', [\App\Http\Controllers\NoteController::class, 'create'])->name('notes.create');
});
