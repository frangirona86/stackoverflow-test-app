<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use App\Models\ApiRequest;
use Illuminate\Support\Facades\Validator;


class ApiService 
{

    public function ApiStackOverFlowRequest($tagged, $todate = '', $fromdate = '')
   {
        $response = Http::get('https://api.stackexchange.com/2.3/questions', [
            'fromdate' => $fromdate,
            'todate' => $todate,
            'order' => 'desc',
            'sort' => 'activity',
            'tagged' => $tagged,
            'site' => 'stackoverflow'
        ]);


      
        ApiRequest::create([
                'fromdate' => $fromdate,
                'todate' => $todate,
                'tagged' => $tagged,    
                'response_data' => $response->body()
        ]);
      

        return $response;
   } 
}