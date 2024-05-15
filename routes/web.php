<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});

Route::fallback(function (Request $request) {
    return response()->json([
        'success' => false,
        'message' => 'Bad Request'
    ], 400);
});
