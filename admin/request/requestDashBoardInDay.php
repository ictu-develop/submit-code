<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 20/01/2019
 * Time: 15:24
 */

    header('Content-Type: application/json; charset=UTF-8');

class DashBroadInDayResult{
    public $submit_total;
    public $correct;
    public $incorrect;
    public $visitor_submit;
}

if (isset($_GET['date'])) {

    require_once '../core/DashBoardInDay.php';
    require_once '../../../../../wp-config.php';

    $date = $_GET['date'];

    $dashBoardInDay = new DashBoardInDay($date);
    $dashBroadInDayResult = new DashBroadInDayResult();

    $dashBroadInDayResult->submit_total = $dashBoardInDay->submit_total();
    $dashBroadInDayResult->correct = $dashBoardInDay->correct();
    $dashBroadInDayResult->incorrect = $dashBoardInDay->incorrect();
    $dashBroadInDayResult->visitor_submit = $dashBoardInDay->visitor_submit();

    echo json_encode($dashBroadInDayResult);
}