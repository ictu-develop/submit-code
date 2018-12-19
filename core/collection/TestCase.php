<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 12/16/18
 * Time: 5:22 PM
 */

class TestCase
{
    public $input;
    public $output;

    function __construct($input, $output)
    {
        $this->input = $input;
        $this->output = $output;
    }
}