<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 12/2/18
 * Time: 2:23 PM
 */

class Submissions
{
    private $url = 'https://api.judge0.com/submissions';

    function submit($token)
    {
        $ch = curl_init($this->url.'/'.$token.'?base64_encoded=true');
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = trim(curl_exec($ch));
        curl_close($ch);

        return $response;
    }

}
