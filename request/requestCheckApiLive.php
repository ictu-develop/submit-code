<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 17/01/2019
 * Time: 22:37
 */

header('Content-Type: application/json; charset=UTF-8');

class HttpCodeResult{
    public $httpCode;
}

require '../core/CheckApiLive.php';

$request = new CheckApiLive();
$httpCode = $request->isLive();

$httpCodeObj = new HttpCodeResult();
$httpCodeObj->httpCode = $httpCode;
echo json_encode($httpCodeObj);