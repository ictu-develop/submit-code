<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 12/22/18
 * Time: 5:42 AM
 */

class Source
{
    public $date;
    public $pass;
    public $source;

    function __construct($date, $pass, $source)
    {
        $this->date = $date;
        $this->pass = $pass;
        $this->source = $source;
    }
}