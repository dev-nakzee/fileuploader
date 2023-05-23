<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImageUploadController;

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
Route::any('/get-response/1/{data}', [App\Http\Controllers\ImageUploadController::class, 'receive'])->name('video.response.success');
Route::any('/get-response/0/{data}', [App\Http\Controllers\ImageUploadController::class, 'failure'])->name('video.response.fail');