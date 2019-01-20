<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 20/01/2019
 * Time: 15:24
 */

    header('Content-Type: application/json; charset=UTF-8');

class DashBroadInDayResult{
    public $visitor_submit;
    public $correct;
    public $incorrect;
}

require '../core/DashBoardInDay.php';

require '../../../../../wp-config.php';
$today = current_time('Y-m-d');

$dashBoardInDay = new DashBoardInDay($today);
$dashBroadInDayResult = new DashBroadInDayResult();

$dashBroadInDayResult->visitor_submit = $dashBoardInDay->visitor_submit();
$dashBroadInDayResult->correct = $dashBoardInDay->correct();
$dashBroadInDayResult->incorrect = $dashBoardInDay->incorrect();

echo json_encode($dashBroadInDayResult);
