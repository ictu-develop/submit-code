<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 12/22/18
 * Time: 4:12 AM
 */

class ReadSourceCode
{

    function read($user_id, $post_id){
        require '../../../../wp-config.php';
        require 'collection/Source.php';
        $array = [];

        $args = array(
            'user_id' => $user_id,
            'post_id' => $post_id,
            'orderby' => 'comment_ID',
            'order' => 'DESC',
        );

        $comments = get_comments($args);
        foreach ($comments as $value){
            if ($value->comment_type === 'source_code') {
                $array[] = new Source($value->comment_date, $value->pass, $value->comment_content);
            }
        }

        $hashMap = ['user_id' => $user_id, 'post_id' => $post_id, 'source' => $array];
        return $hashMap;
    }
}