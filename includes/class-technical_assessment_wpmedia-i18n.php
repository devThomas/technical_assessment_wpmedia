<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://thomas.enlightenment-idea.com/
 * @since      1.0.0
 *
 * @package    Technical_assessment_wpmedia
 * @subpackage Technical_assessment_wpmedia/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Technical_assessment_wpmedia
 * @subpackage Technical_assessment_wpmedia/includes
 * @author     Thomas Boff <thomas.boff.dev@gmail.com>
 */
class Technical_assessment_wpmedia_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'technical_assessment_wpmedia',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
