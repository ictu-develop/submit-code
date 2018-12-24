<?php

class SaveSourceCode
{

    private function create($prefix)
    {
        $sql = "CREATE TABLE IF NOT EXISTS " . $prefix . "submit (
                submit_id bigint PRIMARY KEY AUTO_INCREMENT,
                post_id bigint(20) UNSIGNED	,
                user_id bigint(20) UNSIGNED	,
                author text,
                user_email text,
                source text,
                pass text,
                language text,
                time datetime,
                CONSTRAINT post_id FOREIGN KEY (post_id) REFERENCES wp_posts(ID),
                CONSTRAINT user_id FOREIGN KEY (user_id) REFERENCES wp_users(ID)
            )";

        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
    }

    function save($post_id, $author, $email, $source, $user_id, $pass, $lang)
    {
        require '../../../../wp-config.php';
        $time = current_time('Y-m-d H:i:s');

        global $wpdb;
        $this->create($wpdb->prefix);

        $data = array(
            'post_id' => $post_id,
            'user_id' => $user_id,
            'author' => $author,
            'user_email' => $email,
            'source' => $source,
            'time' => $time,
            'pass' => $pass,
            'language' => $lang
        );

        $insert = $wpdb->insert('wp_submit', $data);

        if ($insert != false)
            return true;
        else
            return false;
    }

}