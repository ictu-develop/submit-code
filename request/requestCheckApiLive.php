<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 17/01/2019
 * Time: 22:37
 */

header('Content-Type: application/json; charset=UTF-8');

require '../core/CheckApiLive.php';

$request = new CheckApiLive();
$result = $request->isLive();

echo $result;