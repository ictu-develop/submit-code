<?php

require '../core/SaveSourceCode.php';

if (isset($_POST['comment_post_ID']) && $_POST['comment_author']
    && $_POST['comment_author_email'] && $_POST['comment_content']
    && $_POST['pass']) {
    $comment_post_ID = $_POST['comment_post_ID'];
    $comment_author = $_POST['comment_author'];
    $comment_author_email = $_POST['comment_author_email'];
    $comment_content = $_POST['comment_content'];
    $user_id = $_POST['user_id'];
    $pass = $_POST['pass'];
    $request = new SaveSourceCode();
    echo $request->save($comment_post_ID, $comment_author, $comment_author_email, $comment_content, $user_id, $pass);
}