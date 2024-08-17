<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('call_api')) {
    function call_api($url, $headers = ['Content-Type: application/json'], $method = 'GET', $request = null) {
        $ch = curl_init();
    
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    
        switch ($method) {
            case 'PUT':
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
                curl_setopt($ch, CURLOPT_POSTFIELDS, $request);
                break;
            case 'DELETE':
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
                curl_setopt($ch, CURLOPT_POSTFIELDS, $request);
                break;
            case 'POST':
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $request);
                break;
            default:
                break;
        }
    
        $response = curl_exec($ch);
    
        curl_close($ch);
    
        if (curl_errno($ch)) {
            return 'Error:' . curl_error($ch);
        } else {
            return $response;
        }
    }
}