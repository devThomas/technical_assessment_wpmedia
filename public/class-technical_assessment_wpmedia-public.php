<?php
/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://thomas.enlightenment-idea.com/
 * @since      1.0.0
 *
 * @package    Technical_assessment_wpmedia
 * @subpackage Technical_assessment_wpmedia/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Technical_assessment_wpmedia
 * @subpackage Technical_assessment_wpmedia/public
 * @author     Thomas Boff <thomas.boff.dev@gmail.com>
 */
class Tawp_Technical_Assessment_Wpmedia_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param string $plugin_name  The $plugin_name is the name of the plugin.
	 * @param string $version      The $version is the version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version     = $version;
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Technical_assessment_wpmedia_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Technical_assessment_wpmedia_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/technical_assessment_wpmedia-public.css', array(), $this->version, 'all' );
	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Technical_assessment_wpmedia_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Technical_assessment_wpmedia_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/technical_assessment_wpmedia-public.js', array( 'jquery' ), $this->version, false );
	}
	/**
	 * Add the template public for display the sitemap link on front end.
	 *
	 * @since    1.0.0
	 */
	public function add_sitemap_link() {
		$filepath = get_stylesheet_directory() . '/sitemap.html';

		if ( file_exists( $filepath ) ) {
			include plugin_dir_path( __FILE__ ) . 'partials/technical_assessment_wpmedia-public-display.php';
		}
	}
}
