<?php

use App\Http\Controllers\TsgController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\UserController;




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

Route::get('/', function () {
    return view('Welcome');
});

Route::get('/users', [UserController::class, 'index']) ->name('login');

Route::get('/user/{id}', [UserController::class, 'show']);

Route::get('/tsg', [TsgController::class, 'index']);
Route::get('/tsg/{id}', [TsgController::class, 'show']);