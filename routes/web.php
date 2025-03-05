<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PdfController;

use App\Http\Middleware\EnsureTokenIsValid;


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

Route::get('/', function () { return view('welcome'); });
Route::get('/error', function () { return view('error'); });

Route::middleware([EnsureTokenIsValid::class])->group(function () {

    Route::get('/url-to-pdf', [PdfController::class, 'urlToPdf']);

});




