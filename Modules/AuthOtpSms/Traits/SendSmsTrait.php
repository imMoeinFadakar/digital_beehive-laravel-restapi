<?php

namespace Modules\AuthOtpSms\Traits;

use Exception;

trait SendSmsTrait {

    public function sendSms(string $phoneNumber,int $code)   
    {
        $username = env("IPPANEL_USERNAME");
            $password = env("IPPANEL_PASSWORD");
            $from = env("IPPANEL_SENDER");
            $pattern_code = env("IPPANEL_PATTERN_CODE") ;
            $to = array($phoneNumber);
            $input_data = array("code" => $code );
            $url = "https://ippanel.com/patterns/pattern?username=" . $username . "&password=" . urlencode($password) . "&from=$from&to=" . json_encode($to) . "&input_data=" . urlencode(json_encode($input_data)) . "&pattern_code=$pattern_code";
            $handler = curl_init($url);
            curl_setopt($handler, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($handler, CURLOPT_POSTFIELDS, $input_data);
            curl_setopt($handler, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($handler);
    
    }





}
