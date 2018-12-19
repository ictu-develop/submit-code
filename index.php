<?php
/**
 * Plugin Name:       Submit Code
 * Description:       Submit your code (I'm Tester)
 * Version:           1.0.0
 * Author:            IndieTeam
 * Author URI:
 * Text Domain:
 * License:
 * License URI:
 * GitHub Plugin URI:
 */

require 'core/SubmitCode.php';

$submitCode = new SubmitCode();
$submitCode->addFilterContent();
$submitCode->addFilterSubmit();