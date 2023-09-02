<?php
/**
 * PHPUnit bootstrap file.
 *
 * @package WordPress
 */

$_tests_dir = getenv( 'WP_TESTS_DIR' );
if ( ! $_tests_dir ) {
  $_tests_dir = rtrim( sys_get_temp_dir(), '/\\' ) . '/wordpress-tests-lib';
}


// Load the main WordPress tests bootstrap file.
require_once 'C:/xampp/htdocs/wordpress-tests-lib/includes/bootstrap.php';

require_once __DIR__ . '/../technical_assessment_wpmedia.php';
