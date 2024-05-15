<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

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
        
        if($response)
        {
            
        }

        return $response;
   } 
}