<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

use App\Http\Controllers\PdfController;

use App\Http\Middleware\EnsureTokenIsValid;

use App\Models\Call;

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

Route::middleware([EnsureTokenIsValid::class])->group(function () {

    Route::get('/url-to-pdf', [PdfController::class, 'urlToPdf']);

});

Route::fallback(function(Request $request) {
    
    Call::create(array(
        'address' => $request->ip(),
        'url' => $request->fullUrl(),
        'result' => 'route',
    ));

    return response()->json([
        'status' => 'error',
        'message' => 'Invalid route',
    ]);

});


