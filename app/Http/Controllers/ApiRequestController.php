<?php

namespace App\Http\Controllers;

use App\Models\ApiRequest;
use Illuminate\Http\Request;
use App\Http\Requests\BaseRequest;

use App\Services\ApiService;


class ApiRequestController extends Controller
{

   public function __construct(ApiService $apiService)
   {
        $this->apiService = $apiService;
   }

   public function fetchData(BaseRequest $request)
    {

        $tagged = $request->input('tagged');
        $todate = $request->input('todate');
        $fromdate = $request->input('fromdate');

        $data = ApiRequest::where('tagged', $tagged)
        ->where('todate', $todate)
        ->where('fromdate', $fromdate)
        ->first();
    
        if($data)
        {
            return response()->json(json_decode($data->response_data, true));
        } 
        else
        {
            $data = $this->apiService->ApiStackOverFlowRequest($tagged , $todate , $fromdate);
        }

        return response()->json($data->json());
    }
}
