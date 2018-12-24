<?php

require '../core/SaveSourceCode.php';

if (isset($_POST['post_id']) && $_POST['author']
    && $_POST['email'] && $_POST['source']
    && $_POST['pass']) {

    $post_id = $_POST['post_id'];
    $author = $_POST['author'];
    $email = $_POST['email'];
    $source = $_POST['source'];
    $user_id = $_POST['user_id'];
    $pass = $_POST['pass'];

    $request = new SaveSourceCode();
    echo $request->save($post_id, $author, $email, $source, $user_id, $pass);
}