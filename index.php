<?php
/**
 * Plugin Name:       Submit Code
 * Description:       Submit your code (I'm Tester)
 * Version:           1.0.1
 * Author:            IndieTeam
 * Author URI:
 * Text Domain:
 * License:
 * License URI:
 * GitHub Plugin URI:
 */

require 'core/SubmitTemplate.php';

$submit = new SubmitTemplate();
$submit->addFilterContent();
$submit->addFilterSubmit();