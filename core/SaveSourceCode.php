<?php

class SaveSourceCode
{


    function save($comment_post_ID, $comment_author, $comment_author_email, $comment_content, $user_id, $pass){
        $time = date( 'Y-m-d H:m:s');

        require '../../../../wp-load.php';
        $selectTable = $wpdb->get_row("SELECT * FROM wp_comments");

        if(!isset($selectTable->my_custom_posts_column)){
            $wpdb->query("ALTER TABLE wp_comments ADD pass TEXT");
        }

        $data = array(
            'comment_post_ID' => $comment_post_ID,
            'comment_author' => $comment_author,
            'comment_author_email' => $comment_author_email,
            'comment_author_url' => $comment_author_email,
            'comment_content' => $comment_content,
            'comment_type' => 'source_code',
            'comment_parent' => 0,
            'user_id' => $user_id,
            'comment_author_IP' => '::1',
            'comment_agent' => 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.0.10) Gecko/2009042316 Firefox/3.0.10 (.NET CLR 3.5.30729)',
            'comment_date' => $time,
            'comment_approved' => 0,
            'pass' => $pass,
        );

        $insert = $wpdb->insert('wp_comments', $data);

        if ($insert != false)
            return true;
        else
            return false;
    }

}