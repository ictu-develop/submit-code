<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 20/01/2019
 * Time: 15:24
 */

header('Content-Type: application/json; charset=UTF-8');

class DashBroadInDayResult
{
    public $date;
    public $visitor_submit;
    public $correct;
    public $incorrect;
}

require '../core/DashBoardInDay.php';
require '../../../../../wp-config.php';

$date = current_time('Y-m-d');
$date = date('Y-m-d', strtotime($date));

$resutl = [];

for ($i = 0; $i < 7; $i++) {
    $dashBoardInDay = new DashBoardInDay($date);
    $dashBroadInDayResult = new DashBroadInDayResult();

    $dashBroadInDayResult->date = $date;
    $dashBroadInDayResult->submit_total = $dashBoardInDay->submit_total();
    $dashBroadInDayResult->correct = $dashBoardInDay->correct();
    $dashBroadInDayResult->incorrect = $dashBoardInDay->incorrect();

    $resutl[] = $dashBroadInDayResult;

    $date = date('Y-m-d', strtotime($date.' - 1 days'));
}

echo json_encode($resutl);