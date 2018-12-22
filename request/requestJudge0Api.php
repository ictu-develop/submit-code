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
 * lang_id: 10 (C++ - g++ 7.2.0)
 * lang_id: 22 (Go -1.9)
 * lang_id: 34 (Python - 3.6.0)
 *
 * */

header('Content-Type: application/json; charset=UTF-8');

require '../core/Judge0Api.php';

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
        case 4: {
            setcookie('lang_id', $lang_id, time() + 86400 * 365, '/');
            break;
        }
        case 10:
            {
                setcookie('lang_id', $lang_id, time() + 86400 * 365, '/');
                break;
            }
        case 22:
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
                $cpu_time_limit = 2;
                break;
            }
    }

    $request = new Judge0Api();
    echo $request->submissions($source, $stdin, $expected_output, $lang_id, $cpu_time_limit);
}
