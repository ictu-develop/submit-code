<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 20/01/2019
 * Time: 15:24
 */

header('Content-Type: application/json; charset=UTF-8');

class DashBroadTotalResult
{
    public $submit_total;
    public $correct;
    public $incorrect;
    public $visitor_submit;
}


require_once '../core/DashBroadTotal.php';
require_once '../../../../../wp-config.php';

$date = $_GET['date'];

$dashBoardTotal = new DashBroadTotal();
$dashBroadInDayResult = new DashBroadTotalResult();

$dashBroadInDayResult->submit_total = $dashBoardTotal->submit_total();
$dashBroadInDayResult->correct = $dashBoardTotal->correct();
$dashBroadInDayResult->incorrect = $dashBoardTotal->incorrect();
$dashBroadInDayResult->visitor_submit = $dashBoardTotal->visitor_submit();

echo json_encode($dashBroadInDayResult);