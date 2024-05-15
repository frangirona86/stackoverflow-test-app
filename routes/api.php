<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiRequestController;
use App\Http\Middlewares\ValidatorMiddleware;

Route::get('/', [ApiRequestController::class, 'fetchData']);

Route::fallback(function (Request $request) {
    return response()->json([
        'success' => false,
        'message' => 'Bad Request'
    ], 400);
});
