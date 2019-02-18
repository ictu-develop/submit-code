<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 18/02/2019
 * Time: 09:06
 */

require_once '../core/SetupSecretKey.php';

$setupSecretKey = new SetupSecretKey();

require '../../../../../wp-config.php';

if (current_user_can('administrator')) {
    if (isset($_POST['key'])) {
        $key = $_POST['key'];
        $setupSecretKey = new SetupSecretKey();
        $result =  $setupSecretKey->setup($key);

        if ($result)
            header('location: ' . get_site_url() . '/wp-admin/admin.php?page=submit-code-secret_key');
        else
            echo 'false';
    } else
        echo 'false';
} else {
    echo 'prohibited';
}