<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImageUploadController;
use App\Http\Controllers\WebhooksController;
use App\Http\Controllers\HomeController;

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('image/upload', [App\Http\Controllers\ImageUploadController::class, 'store'])->name('image.upload');
Route::get('/get-response/{success}/{data?}', [App\Http\Controllers\HomeController::class, 'receive'])->middleware('guest')->name('video.response');