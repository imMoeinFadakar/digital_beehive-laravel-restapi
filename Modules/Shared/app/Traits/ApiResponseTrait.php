<?php

namespace Modules\Shared\Traits;

trait ApiResponseTrait {

    public function api($data = [],$method = '',$message = '',$status = true,$code = 200) 
    {
        
        $response = [
            "message"=> $message ?: ($method ? $this->message($method) : ""),
            "status"=> $status,
            "code"=> $code,
            "data" => $data,
        ];


        return response()->json($response,
        ($code && $code >= 200 && $code < 600) ? $code : 500);

    }

    public function message($method)
    {
        $model = str_replace('Controller','',explode('\\',explode('::',$method)[0])[count(explode('\\',explode('::',$method)[0])) - 1]);   
        return   $model . ' ' . explode("::", $method)[1] . " " ."successful";
    }


}
