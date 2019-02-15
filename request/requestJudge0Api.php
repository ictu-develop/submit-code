<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 12/16/18
 * Time: 5:07 PM
 */

/*
 *
 * lang_id: 26 (java JDK 9)
 * lang_id: 4 (C - gcc 7.2.0)
 * lang_id: 15 (C++ - g++ 4.8.5)
 * lang_id: 22 (Go -1.9)
 * lang_id: 34 (Python - 3.6.0)
 * lang_id: 16 (C# (mono 5.4.0.167))
 *
 * */

header('Content-Type: application/json; charset=UTF-8');

require '../core/Submissions.php';
require '../core/GetToken.php';

const In_Queue = 1;
const Processing = 2;
const Accepted = 3;
const Wrong_Answer = 4;
const Time_Limit_Exceeded = 5;
const Compilation_Error = 6;
const Runtime_Error_SIGSEGV_ = 7;
const Runtime_Error_SIGXFSZ = 8;
const Runtime_Error_SIGFPE = 9;
const Runtime_Error_SIGABRT = 10;
const Runtime_Error_NZEC = 11;
const Runtime_Error_Other = 12;
const Internal_Error = 13;

if (isset($_POST['stdin']) && isset($_POST['expected_output']) && $_POST['source'] && $_POST['lang_id']) {
    $stdin = $_POST['stdin'];
    $expected_output = $_POST['expected_output'];
    $source = $_POST['source'];
    $lang_id = (int)$_POST['lang_id'];
    $cpu_time_limit = 5; // default is 2 second

    switch ($lang_id) {
        case 26:
            {
                $cpu_time_limit = 10;
                setcookie('lang_id', $lang_id, time() + 86400 * 365, '/');
                break;
            }
        case 16:
            {
                $cpu_time_limit = 10;
                setcookie('lang_id', $lang_id, time() + 86400 * 365, '/');
                break;
            }
        case 15:
            {
                setcookie('lang_id', $lang_id, time() + 86400 * 365, '/');
                break;
            }
        case 30:
            {
                setcookie('lang_id', $lang_id, time() + 86400 * 365, '/');
                break;
            }
        case 33:
            {
                setcookie('lang_id', $lang_id, time() + 86400 * 365, '/');
                break;
            }
        case 34:
            {
                setcookie('lang_id', $lang_id, time() + 86400 * 365, '/');
                break;
            }
        default:
            {
                $cpu_time_limit = 5;
                break;
            }
    }

    $requestToken = new GetToken();
    $token = $requestToken->get($source, $stdin, $expected_output, $lang_id, $cpu_time_limit);

    $requestSubmissions = new Submissions();
    $result = $requestSubmissions->submit($token);
    $resultJson = json_decode($result);

    $index = 0;

    while ($index <= 21) {
        if ($resultJson->status->id == Processing || $resultJson->status->id == In_Queue) {
            $result = $requestSubmissions->submit($token);
            $resultJson = json_decode($result);
            sleep(0.5);
        } else
            break;

        $index++;
    }

    echo $result;
}
