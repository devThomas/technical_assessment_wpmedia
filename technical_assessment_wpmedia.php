<?php
/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://thomas.enlightenment-idea.com/
 * @since             1.0.0
 * @package           Technical_assessment_wpmedia
 *
 * @wordpress-plugin
 * Plugin Name:       technical assessment wpmedia
 * Plugin URI:        https://thomas.enlightenment-idea.com/
 * Description:       technical assessment for wpmedia
 * Version:           1.0.0
 * Author:            Thomas Boff
 * Author URI:        https://thomas.enlightenment-idea.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       technical_assessment_wpmedia
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'TECHNICAL_ASSESSMENT_WPMEDIA_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-technical_assessment_wpmedia-activator.php
 */
function activate_technical_assessment_wpmedia() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-technical_assessment_wpmedia-activator.php';
	Tawp_Technical_Assessment_Wpmedia_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-technical_assessment_wpmedia-deactivator.php
 */
function deactivate_technical_assessment_wpmedia() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-technical_assessment_wpmedia-deactivator.php';
	Tawp_Technical_Assessment_Wpmedia_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_technical_assessment_wpmedia' );
register_deactivation_hook( __FILE__, 'deactivate_technical_assessment_wpmedia' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-technical_assessment_wpmedia.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_technical_assessment_wpmedia() {

	$plugin = new Tawp_Technical_Assessment_Wpmedia();
	$plugin->run();

}
run_technical_assessment_wpmedia();
