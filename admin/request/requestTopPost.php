<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 22/01/2019
 * Time: 23:29
 */

header('Content-Type: application/json; charset=UTF-8');

require_once '../core/DashBroadTotal.php';
require_once '../../../../../wp-config.php';

$dashBroadTotal = new DashBroadTotal();
echo json_encode($dashBroadTotal->top_post());