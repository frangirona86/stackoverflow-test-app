<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiRequestController;

Route::get('/', [ApiRequestController::class, 'fetchData']);
