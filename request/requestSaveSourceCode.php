<?php

/*
 *
 * lang_id: 26 (java JDK 9)
 * lang_id: 4 (C - gcc 7.2.0)
 * lang_id: 15 (C++ - g++ 4.8.5)
 * lang_id: 22 (Go -1.9)
 * lang_id: 34 (Python - 3.6.0)
 *
 * */

require '../core/SaveSourceCode.php';

if (isset($_POST['post_id']) && $_POST['author']
    && $_POST['email'] && $_POST['source']
    && $_POST['pass'] && $_POST['lang_id']) {

    $post_id = $_POST['post_id'];
    $author = $_POST['author'];
    $email = $_POST['email'];
    $source = $_POST['source'];
    $user_id = $_POST['user_id'];
    $pass = $_POST['pass'];
    $lang_id = (int)$_POST['lang_id'];
    $lang = '';

    switch ($lang_id) {
        case 26:
            {
                $lang = 'Java';
                break;
            }
        case 15:
            {
                $lang = 'C/C++';
                break;
            }
        case 16:
            {
                $lang = 'C#';
                break;
            }
        case 34:
            {
                $lang = 'Python';
                break;
            }
        default:
            {
                break;
            }
    }

    $request = new SaveSourceCode();
    echo $request->save($post_id, $author, $email, $source, $user_id, $pass, $lang);
}