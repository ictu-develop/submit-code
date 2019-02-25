<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 17/01/2019
 * Time: 22:33
 */

class CheckApiLive
{
    private $api_url = 'https://api.chamcode.net/submissions/requestCheckApiLive.php';

    function isLive()
    {
        $ch = curl_init($this->api_url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = trim(curl_exec($ch));

        return $response;
    }
}