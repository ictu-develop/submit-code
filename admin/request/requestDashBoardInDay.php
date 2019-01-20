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
}

if (isset($_GET['date'])) {

    require '../core/DashBoardInDay.php';
    require '../../../../../wp-config.php';

    $date = $_GET['date'];

    $dashBoardInDay = new DashBoardInDay($date);
    $dashBroadInDayResult = new DashBroadInDayResult();

    $dashBroadInDayResult->submit_total = $dashBoardInDay->submit_total();
    $dashBroadInDayResult->correct = $dashBoardInDay->correct();
    $dashBroadInDayResult->incorrect = $dashBoardInDay->incorrect();

    echo json_encode($dashBroadInDayResult);
}