<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 25/02/2019
 * Time: 20:28
 */

class Submissions
{
    private $url = 'https://api.chamcode.net/submissions/requestJudge0Api.php';

    function request($source_code, $stdin, $expected_output, $lang_id, $cpu_time_limit, $domain, $secret_key)
    {
        $post_params = "source=$source_code&lang_id=$lang_id&stdin=$stdin&expected_output=$expected_output&&domain=$domain&secret_key=$secret_key";

        $ch = curl_init($this->url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_params);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = trim(curl_exec($ch));
        curl_close($ch);

        //$response = json_decode($response);
        return $response;
    }
    
}