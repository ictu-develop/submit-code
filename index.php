<?php
/**
 * Plugin Name:       Submit Code
 * Description:       Submit your code (I'm Tester)
 * Version:           1.0.4
 * Author:            IndieTeam
 * Author URI:
 * Text Domain:
 * License:
 * License URI:
 * GitHub Plugin URI:
 */

require 'template/SubmitTemplate.php';
require 'admin/ChartTemplate.php';

// User template
$submit = new SubmitTemplate();

$submit->addFilterContent();
$submit->addFilterSubmit();


// Admin
add_action('admin_menu', 'admin_menu');

function admin_menu(){
    add_menu_page( 'Submit Code DashBroad', 'Submit Code DashBroad', 'manage_options', 'submit-code', 'init' );
}

function init(){
    $chartTemplate = new ChartTemplate();
    $chartTemplate->title();
    $chartTemplate->dashBroadInDay();
    $chartTemplate->last7Day();
}