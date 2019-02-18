<?php
/**
 * Plugin Name:       Submit Code
 * Description:       Submit your code (I'm Tester)
 * Version:           1.0.8
 * Author:            IndieTeam
 * Author URI:
 * Text Domain:
 * License:
 * License URI:
 * GitHub Plugin URI:
 */

require_once 'template/SubmitTemplate.php';
require_once 'admin/ChartTemplate.php';
require_once 'widget/TopCodeWidget.php';
require_once 'admin/SecretKeyTemplate.php';

// User template
$submit = new SubmitTemplate();

$submit->addFilterContent();
$submit->addFilterSubmit();


// Admin
add_action('admin_menu', 'admin_menu');

function admin_menu()
{
    add_menu_page('Submit Code', 'Submit Code', 'manage_options', 'submit-code', 'dashBroad');
    add_submenu_page( 'submit-code', 'DashBroad', 'DashBroad', 'manage_options', 'submit-code', 'dashBroad' );
    add_submenu_page( 'submit-code', 'Secret key', 'Secret key', 'manage_options', 'submenu2_slug', 'secretKey' );
}

function dashBroad()
{
    $chartTemplate = new ChartTemplate();
    $chartTemplate->title();
    $chartTemplate->today();
    $chartTemplate->last7Day();
    $chartTemplate->total();
    $chartTemplate->top_post();
}

function secretKey() {
    $secretKeyTemplate = new SecretKeyTemplate();
    $secretKeyTemplate->title();
    $secretKeyTemplate->form();
}