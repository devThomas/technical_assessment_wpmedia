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

namespace Tawp_Technical_Assessment_Wpmedia;

class Tawp_Technical_Assessment_Wpmedia_Deactivator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function deactivate() {

		wp_clear_scheduled_hook( 'cron_crawl_home_page' );
	}
}
