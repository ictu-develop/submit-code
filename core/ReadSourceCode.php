<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 12/22/18
 * Time: 4:12 AM
 */

class ReadSourceCode
{

    function read($user_id, $post_id)
    {
        require '../../../../wp-config.php';
        require 'collection/Source.php';

        global $wpdb;
        $array = [];

        $sql = "SELECT * FROM wp_submit 
                WHERE user_id = '$user_id'
                AND post_id = '$post_id'
                ORDER BY submit_id DESC ";

        $result = $wpdb->get_results($sql);
        foreach ($result as $value) {
            if ($value->language !== null)
                $array[] = new Source($value->time, $value->pass, $value->source, $value->language);
            else
                $array[] = new Source($value->time, $value->pass, $value->source, '');
        }

        $hashMap = ['user_id' => $user_id, 'post_id' => $post_id, 'source' => $array];
        return $hashMap;
    }
}