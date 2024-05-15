<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiRequestController;
use App\Http\Middlewares\ValidatorMiddleware;

Route::get('/', [ApiRequestController::class, 'fetchData']);
