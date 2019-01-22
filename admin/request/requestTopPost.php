<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 22/01/2019
 * Time: 23:29
 */

header('Content-Type: application/json; charset=UTF-8');

class TopPostResult {
    public $post_link;
    public $post_id;
    public $post_title;
    public $total;
}

require_once '../core/DashBroadTotal.php';
require_once '../../../../../wp-config.php';

$dashBroadTotal = new DashBroadTotal();
$result = $dashBroadTotal->top_post();

$newResult = [];

foreach ($result as $value) {
    $topPostResult = new TopPostResult();

    $topPostResult->post_link = get_permalink($value->post_id, );
    $topPostResult->post_id = $value->post_id;
    $topPostResult->post_title = $value->post_title;
    $topPostResult->total = $value->total;

    $newResult[] = $topPostResult;
}

echo json_encode($newResult);