<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 20/01/2019
 * Time: 15:24
 */

header('Content-Type: application/json; charset=UTF-8');

class DashBroadLast7DayResult
{
    public $date;
    public $submit_total;
    public $correct;
    public $incorrect;
    public $visitor_submit;
}

require_once '../core/DashBoardInDay.php';
require_once '../../../../../wp-config.php';

$date = current_time('Y-m-d');
$date = date('Y-m-d', strtotime($date));

$result = [];

for ($i = 0; $i < 7; $i++) {
    $dashBoardInDay = new DashBoardInDay($date);
    $dashBroadInDayResult = new DashBroadLast7DayResult();

    $dashBroadInDayResult->date = $date;
    $dashBroadInDayResult->submit_total = $dashBoardInDay->submit_total();
    $dashBroadInDayResult->correct = $dashBoardInDay->correct();
    $dashBroadInDayResult->incorrect = $dashBoardInDay->incorrect();
    $dashBroadInDayResult->visitor_submit = $dashBoardInDay->visitor_submit();

    $result[] = $dashBroadInDayResult;

    $date = date('Y-m-d', strtotime($date.' - 1 days'));
}

echo json_encode($result);