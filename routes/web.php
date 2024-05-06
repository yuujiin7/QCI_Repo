<?php

use App\Http\Controllers\TsgController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ServiceReportController;
use App\Http\Controllers\ImageController;

// Route::post();
// Route::put();
// Route::patch();
// Route::delete();
// Route::options();

// Route::get('/users', function (Request $request) {
//     dd($request);
//     return null;
// });

// Route::get('get-text', function () {
//     return response('Hello World', 200)
//         ->header('Content-Type', 'text/plain');
// });

# Home
Route::get('/', function () {
    return view('index');
});


# User
Route::get('/users', [UserController::class, 'index']) ->name('login');
Route::get('/user/{id}', [UserController::class, 'show']);

# TSG
Route::get('/tsg', [TsgController::class, 'index']);
Route::get('/tsg/{id}', [TsgController::class, 'show']);

# Service Report
Route::get('/service-reports', [ServiceReportController::class, 'index']);
Route::get('/service-reports/{id}', [ServiceReportController::class, 'show']);

# File
Route::get('/storage/{folder}/{file}', 'FileController@show');

# Image
Route::post('/upload', [ImageController::class, 'upload'])->name('upload');
Route::get('/images/{id}/download', [ImageController::class, 'download'])->name('image.download');