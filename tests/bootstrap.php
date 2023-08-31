<?php
/**
 * PHPUnit bootstrap file.
 *
 * @package WordPress
 */

$_tests_dir = getenv( 'WP_TESTS_DIR' );
if ( ! $_tests_dir ) {
  $_tests_dir = 'C:/xampp/htdocs/wordpress-tests-lib';
}
$_tests_dir = 'C:/xampp/htdocs/wordpress-tests-lib';


// Load the main WordPress tests bootstrap file.
require_once $_tests_dir . '/includes/bootstrap.php';

require_once 'C:\xampp\htdocs\wordpress_plugin_test\wp-content\plugins\technical_assessment_wpmedia\technical_assessment_wpmedia.php';