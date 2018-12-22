<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 12/22/18
 * Time: 4:13 AM
 */

header('Content-Type: application/json; charset=UTF-8');

require '../core/ReadSourceCode.php';

if (isset($_POST['user_id']) && isset($_POST['post_id'])) {
    $user_id = $_POST['user_id'];
    $post_id = $_POST['post_id'];

    $request = new ReadSourceCode();
    $result = $request->read($user_id, $post_id);

    echo json_encode($result);
}