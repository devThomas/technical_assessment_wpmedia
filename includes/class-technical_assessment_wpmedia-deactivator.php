<?php

/**
 * Fired during plugin deactivation
 *
 * @link       https://thomas.enlightenment-idea.com/
 * @since      1.0.0
 *
 * @package    Technical_assessment_wpmedia
 * @subpackage Technical_assessment_wpmedia/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    Technical_assessment_wpmedia
 * @subpackage Technical_assessment_wpmedia/includes
 * @author     Thomas Boff <thomas.boff.dev@gmail.com>
 */
class Technical_assessment_wpmedia_Deactivator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function deactivate() {
		register_deactivation_hook(__FILE__, 'crawl_home_page');

	}

	function my_custom_cron_deactivation() {
		// delete cron task
		wp_clear_scheduled_hook('crawl_home_page');
	}

}
