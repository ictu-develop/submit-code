<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 02/02/2019
 * Time: 20:51
 */

class GetToken
{
    private $url = 'https://api.judge0.com/submissions?base64_encoded=true&wait=false';

    function get($source_code, $stdin, $expected_output, $lang_id, $cpu_time_limit) {
        $form_data = '{
            "source_code": "'.$source_code.'",
            "language_id": '.$lang_id.',
            "stdin": "'.$stdin.'",
            "expected_output": "'.$expected_output.'",
            "cpu_time_limit": '.$cpu_time_limit.'
        }';

        $ch = curl_init($this->url);
        curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt ($ch, CURLOPT_POSTFIELDS, $form_data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = trim(curl_exec($ch));
        curl_close($ch);

        $response = json_decode($response);
        return $response->token ;
    }

}