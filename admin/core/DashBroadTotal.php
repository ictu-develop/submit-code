<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 20/01/2019
 * Time: 15:20
 */

class DashBroadTotal
{
    private $date;
    private $day;
    private $month;
    private $year;

    // Return count
    function submit_total()
    {
        global $wpdb;
        $prefix = $wpdb->prefix;

        $ymd = "$this->year-$this->month-$this->day";

        $sql = "SELECT COUNT(*) FROM ".$prefix."submit";
        $result = $wpdb->get_var($sql);
        return $result;
    }

    // Return count
    function correct()
    {
        global $wpdb;
        $prefix = $wpdb->prefix;

        $ymd = "$this->year-$this->month-$this->day";

        $sql = "SELECT COUNT(*) FROM ".$prefix."submit WHERE total = correct";
        $result = $wpdb->get_var($sql);
        return $result;
    }

    // Return count
    function incorrect()
    {
        global $wpdb;
        $prefix = $wpdb->prefix;

        $ymd = "$this->year-$this->month-$this->day";

        $sql = "SELECT COUNT(*) FROM ".$prefix."submit WHERE total != correct";
        $result = $wpdb->get_var($sql);
        return $result;
    }

    // Return count
    function visitor_submit(){
        global $wpdb;
        $prefix = $wpdb->prefix;

        $total = 0;

        $sql = "SELECT user_id FROM ".$prefix."submit GROUP BY user_id";
        $result = $wpdb->get_results($sql);

        foreach ($result as $value)

            $total++;
        return $total;
    }

}