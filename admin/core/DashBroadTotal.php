<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 20/01/2019
 * Time: 15:20
 */

class DashBroadTotal
{
    private $prefix;

    function __construct()
    {
        global $wpdb;
        $this->prefix = $wpdb->prefix;
    }

    // Return count
    function submit_total()
    {
        global $wpdb;

        $sql = "SELECT COUNT(*) FROM ".$this->prefix."submit";
        $result = $wpdb->get_var($sql);
        return $result;
    }

    // Return count
    function correct()
    {
        global $wpdb;

        $sql = "SELECT COUNT(*) FROM ".$this->prefix."submit WHERE total = correct";
        $result = $wpdb->get_var($sql);
        return $result;
    }

    // Return count
    function incorrect()
    {
        global $wpdb;

        $sql = "SELECT COUNT(*) FROM ".$this->prefix."submit WHERE total != correct";
        $result = $wpdb->get_var($sql);
        return $result;
    }

    // Return count
    function visitor_submit()
    {
        global $wpdb;
        $total = 0;

        $sql = "SELECT user_id FROM ".$this->prefix."submit GROUP BY user_id";
        $result = $wpdb->get_results($sql);

        foreach ($result as $value)
            $total++;

        return $total;
    }

    function top_post()
    {
        global $wpdb;

        $sql = "SELECT ".$this->prefix."submit.post_id, ".$this->prefix."posts.post_title, ".$this->prefix."posts.guid, COUNT(".$this->prefix."submit.post_id) as total 
                FROM ".$this->prefix."submit, ".$this->prefix."posts 
                WHERE ".$this->prefix."submit.post_id = ".$this->prefix."posts.ID 
                GROUP BY ".$this->prefix."submit.post_id ORDER BY total DESC";

        $result = $wpdb->get_results($sql);

        return $result;
    }

}