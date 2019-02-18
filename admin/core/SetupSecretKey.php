<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 18/02/2019
 * Time: 08:36
 */

class SetupSecretKey
{

    function create($prefix)
    {
        $sql = "CREATE TABLE IF NOT EXISTS " . $prefix . "secret_key (
                key_id bigint PRIMARY KEY AUTO_INCREMENT NOT NULL,
                key_content text
            )";

        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
    }

    function isExits()
    {
        global $wpdb;
        $prefix = $wpdb->prefix;
        $sql = "SELECT * FROM " . $prefix . "secret_key";

        $num_row = $wpdb->get_var($sql);

        if ($num_row >= 1)
            return true;
        else
            return false;
    }

    function setup($key)
    {
        global $wpdb;
        $prefix = $wpdb->prefix;
        $this->create($prefix);
        $isExits = $this->isExits();

        $data = null;
        $result = null;

        if ($isExits) {
            $data = array(
                'key_content' => $key
            );
            $result = $wpdb->update($prefix . 'secret_key', $data, null);
        } else {
            $data = array(
                'key_content' => $key
            );
            $result = $wpdb->insert($prefix . 'secret_key', $data);
        }

        if ($result == false)
            return false;
        else
            return true;

    }
}