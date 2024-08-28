<?php

use App\Http\Controllers\TsgController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ServiceReportController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\MaintenanceAgreementController;



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



Route::controller(UserController::class)->group(function () {
    # Home
    Route::get('/', [UserController::class, 'login']);
    # Register
    Route::get('/register', [UserController::class, 'register'])->name('register')->middleware('guest');
    # login
    Route::get('/login', [UserController::class, 'login'])->name('login')->middleware('guest');
    Route::post('/login/process', [UserController::class, 'process']);
    # Logout
    Route::post('/logout', [UserController::class, 'logout']);
    # Store
    Route::post('/store', [UserController::class, 'store']);
    # User
    Route::get('/user/{id}', [UserController::class, 'show']);
});




# TSG
// TSG - Protected Routes
Route::middleware('auth')->group(function () {
    Route::get('/tsg', [TsgController::class, 'index']);

    Route::get('/create/tsg', [TsgController::class, 'create']);
    Route::post('/create/tsg', [TsgController::class, 'store']);

    Route::get('/tsg/{id}', [TsgController::class, 'show']);
    Route::put('/tsg/{id}', [TsgController::class, 'update']);

    //delete
    Route::delete('/tsg/{id}', [TsgController::class, 'destroy']);
});


Route::middleware('auth')->group(function () {
    # Service Report
    Route::get('/service-reports', [ServiceReportController::class, 'index'])->name('Service Reports List');

    Route::get('/create/service-report', [ServiceReportController::class, 'create']);
    Route::post('/create/service-report', [ServiceReportController::class, 'store']);

    Route::get('/service-report/{id}', [ServiceReportController::class, 'show']);
    Route::put('/service-report/{id}', [ServiceReportController::class, 'update']);

    Route::delete('/service-report/{id}', [ServiceReportController::class, 'destroy']);

    Route::get('/generate-pdf/{id}', [PdfController::class, 'generatePDF']);
    Route::get('/generate-sr-form/{id}', [PdfController::class, 'index']);
});



Route::middleware('auth')->group(function () {
    Route::get('/ma-reports', [MaintenanceAgreementController::class, 'index']);
    Route::get('/create/ma-report', [MaintenanceAgreementController::class, 'create']);
    Route::post('/create/ma-report', [MaintenanceAgreementController::class, 'store']);
    Route::get('/ma-report/{id}', [MaintenanceAgreementController::class, 'show']);
    Route::put('/ma-report/{id}', [MaintenanceAgreementController::class, 'update']);
    Route::delete('/ma-report/{id}', [MaintenanceAgreementController::class, 'destroy']);
    Route::get('get-maintenance-agreements', [MaintenanceAgreementController::class, 'getMaintenanceAgreements']);
    Route::patch('/renew-maintenance-agreement/{id}', [MaintenanceAgreementController::class, 'renew']);
    route::get('/export-maintenance-agreements', [MaintenanceAgreementController::class, 'exportCsv']);
});
