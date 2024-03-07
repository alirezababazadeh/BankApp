<?php

use App\Http\Controllers\Api\V1\MoneyTransferController;
use App\Http\Controllers\Api\V1\ReportController;
use App\Http\Middleware\ConvertNumberFormatMiddleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->group(function () {
    Route::middleware([ConvertNumberFormatMiddleware::class])
        ->post('/card-to-card', [MoneyTransferController::class, 'transferByCTC']);
    Route::get('/top-users', [ReportController::class, 'fetchTopUsersWithTransactions']);
});
