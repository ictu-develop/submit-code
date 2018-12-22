<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 12/2/18
 * Time: 2:23 PM
 */

class Judge0Api
{
    private $api_url_submit = 'https://api.judge0.com/submissions?wait=true&base64_encoded=true';

    function submissions($source_code, $stdin, $expected_output, $lang_id, $cpu_time_limit)
    {
        $form_data = '{
            "source_code": "'.$source_code.'",
            "language_id": '.$lang_id.',
            "stdin": "'.$stdin.'",
            "expected_output": "'.$expected_output.'",
            "cpu_time_limit": '.$cpu_time_limit.'
        }';

        $ch = curl_init($this->api_url_submit);
        curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt ($ch, CURLOPT_POSTFIELDS, $form_data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = trim(curl_exec($ch));
        return $response;
    }

}
