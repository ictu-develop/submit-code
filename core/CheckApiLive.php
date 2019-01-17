<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 17/01/2019
 * Time: 22:33
 */

class CheckApiLive
{
    private $api_url = 'https://api.judge0.com';

    function isLive()
    {
        $ch = curl_init($this->api_url);
        curl_setopt($ch, CURLOPT_HEADER  , false);
        curl_setopt($ch, CURLOPT_NOBODY  , true);
        $response = trim(curl_exec($ch));
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        return $httpCode;
    }
}