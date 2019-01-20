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
    public $wpdb;

    function __construct($date)
    {
        $this->date = date('Y-m-d', strtotime($date));
        $this->day = date('d', strtotime($this->date));
        $this->month = date('m', strtotime($this->date));
        $this->year = date('Y', strtotime($this->date));
    }

    // Return count
    function submit_total()
    {
        global $wpdb;
        $prefix = $wpdb->prefix;

        $ymd = "$this->year-$this->month-$this->day";

        $sql = "SELECT COUNT(*) FROM ".$prefix."submit WHERE DATE(time) = '".$ymd."'";
        $result = $wpdb->get_var($sql);
        return $result;
    }

    // Return count
    function correct()
    {
        global $wpdb;
        $prefix = $wpdb->prefix;

        $ymd = "$this->year-$this->month-$this->day";

        $sql = "SELECT COUNT(*) FROM ".$prefix."submit WHERE DATE(time) = '".$ymd."' AND total = correct";
        $result = $wpdb->get_var($sql);
        return $result;
    }

    // Return count
    function incorrect()
    {
        global $wpdb;
        $prefix = $wpdb->prefix;

        $ymd = "$this->year-$this->month-$this->day";

        $sql = "SELECT COUNT(*) FROM ".$prefix."submit WHERE DATE(time) = '".$ymd."' AND total != correct";
        $result = $wpdb->get_var($sql);
        return $result;
    }

}