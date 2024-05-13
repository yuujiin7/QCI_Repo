<?php

use App\Http\Controllers\TsgController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ServiceReportController;
use App\Models\User;

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

#Common naming Routes
//index - Show all data in the table
//show - show a single data
//create - show the form to create a new data
//store - save the new data
//edit - show the form to edit a data
//update - save the edited data
//destroy - delete a data


# Home
Route::get('/', function () {
    return view('index');
});

# login
Route::get('/login', [UserController::class, 'login']);

# Register
Route::get('/register', [UserController::class, 'register']);

# Store
Route::post('/store', [UserController::class, 'store']);

# Logout
Route::get('/logout', [UserController::class, 'logout']);




# User
Route::get('/user/{id}', [UserController::class, 'show']);

# TSG
Route::get('/tsg', [TsgController::class, 'index']);
Route::get('/tsg/{id}', [TsgController::class, 'show']);

# Service Report
Route::get('/service-reports', [ServiceReportController::class, 'index']);
Route::get('/service-report/{id}', [ServiceReportController::class, 'show']);

# File
Route::get('/storage/{folder}/{file}', 'FileController@show');

