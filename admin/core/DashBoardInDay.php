<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 20/01/2019
 * Time: 15:20
 */

class DashBoardInDay
{
    private $date;
    private $day;
    private $month;
    private $year;

    private $prefix;

    function __construct($date)
    {
        global $wpdb;
        $this->prefix = $wpdb->prefix;

        $this->date = date('Y-m-d', strtotime($date));
        $this->day = date('d', strtotime($this->date));
        $this->month = date('m', strtotime($this->date));
        $this->year = date('Y', strtotime($this->date));
    }

    // Return count
    function submit_total()
    {
        global $wpdb;
        $ymd = "$this->year-$this->month-$this->day";

        $sql = "SELECT COUNT(*) FROM ".$this->prefix."submit WHERE DATE(time) = '".$ymd."'";
        $result = $wpdb->get_var($sql);
        return $result;
    }

    // Return count
    function correct()
    {
        global $wpdb;
        $ymd = "$this->year-$this->month-$this->day";

        $sql = "SELECT COUNT(*) FROM ".$this->prefix."submit WHERE DATE(time) = '".$ymd."' AND total = correct";
        $result = $wpdb->get_var($sql);
        return $result;
    }

    // Return count
    function incorrect()
    {
        global $wpdb;
        $ymd = "$this->year-$this->month-$this->day";

        $sql = "SELECT COUNT(*) FROM ".$this->prefix."submit WHERE DATE(time) = '".$ymd."' AND total != correct";
        $result = $wpdb->get_var($sql);
        return $result;
    }

    // Return count
    function visitor_submit()
    {
        global $wpdb;
        $total = 0;

        $ymd = "$this->year-$this->month-$this->day";

        $sql = "SELECT user_id FROM ".$this->prefix."submit WHERE DATE(time) = '".$ymd."' GROUP BY user_id";
        $result = $wpdb->get_results($sql);

        foreach ($result as $value)
            $total++;

        return $total;
    }

}