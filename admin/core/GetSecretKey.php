<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 18/02/2019
 * Time: 09:44
 */

class GetSecretKey
{

    function get()
    {
        global $wpdb;
        $prefix = $wpdb->prefix;
        $index = 0;

        $sql = "SELECT key_content FROM " . $prefix . "secret_key";

        $result = $wpdb->get_results($sql);

        foreach ($result as $value){
            $index++;
        }

        if ($index == 1)
            return $result[0]->key_content;
        else
            return null;
    }

}

$obj = new GetSecretKey();
$obj->get();