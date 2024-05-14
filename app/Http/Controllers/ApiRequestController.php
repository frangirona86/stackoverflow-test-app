<?php

namespace App\Http\Controllers;

use App\Models\ApiRequest;
use Illuminate\Http\Request;

class ApiRequestController extends Controller
{
   public function fetchData(Request $request)
    {
        return response()->json('initial config');
    }
}
