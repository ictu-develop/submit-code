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

$submit = new SubmitTemplate();
$submit->addFilterContent();
$submit->addFilterSubmit();