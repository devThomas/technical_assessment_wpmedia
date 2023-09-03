<?php
/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://thomas.enlightenment-idea.com/
 * @since      1.0.0
 *
 * @package    Technical_assessment_wpmedia
 * @subpackage Technical_assessment_wpmedia/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Technical_assessment_wpmedia
 * @subpackage Technical_assessment_wpmedia/admin
 * @author     Thomas Boff <thomas.boff.dev@gmail.com>
 */

namespace Tawp_Technical_Assessment_Wpmedia;

class Tawp_Technical_Assessment_Wpmedia_Admin {

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
	 * @param string $plugin_name       The name of this plugin.
	 * @param string $version           The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version     = $version;
	}

	/**
	 * Register the stylesheets for the admin area.
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
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/technical_assessment_wpmedia-admin.css', array(), $this->version, 'all' );
	}

	/**
	 * Register the JavaScript for the admin area.
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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/technical_assessment_wpmedia-admin.js', array( 'jquery' ), $this->version, false );
	}
	/**
	 * Add menu My plugin in dashboard settings section.
	 *
	 * @since    1.0.0
	 */
	public function add_menu() {
		if ( current_user_can( 'manage_options' ) ) {
			add_options_page(
				'my plugin',
				'my plugin',
				'manage_options',
				'my-plugin-settings',
				array( $this, 'admin_view' )
			);
		}
	}
	/**
	 * Display notice.
	 *
	 * @since    1.0.0
	 * @param string $info  Is a string with the key of the translation message info.
	 */
	public function display_information( $info = '' ) {
		if ( ! empty( $info ) ) {
			$text = '';
			switch ( $info ) {
				case 'cron_actif':
					$text = __( 'cron_actif', 'technical_assessment_wpmedia' );
					break;
				case 'cron_not_actif':
					$text = __( 'cron_not_actif', 'technical_assessment_wpmedia' );
					break;
			}
			?>
			<div class="notice notice-info">
				<p><?php echo esc_html( $text ); ?></p>
			</div>
			<?php
		}
	}
	/**
	 * Load the admin View.
	 *
	 * @since    1.0.0
	 */
	public function admin_view() {
		include plugin_dir_path( __FILE__ ) . 'partials/technical_assessment_wpmedia-admin-display.php';
	}
	/**
	 * Load the admin View.
	 *
	 * @since    1.0.0
	 */
	public function crawl_home_page() {
		$urls = $this->generate_new_sitemap();
		$this->store_temporary_data( $urls );
		return $urls;
	}
	/**
	 * The main function called by the admin page for crawl the home page and create a sitemap.
	 *
	 * @since    1.0.0
	 */
	private function generate_new_sitemap() {
		if ( isset( $_POST['tawp_nonce_field'] ) ) {
			$tawp_nonce_field = sanitize_text_field( wp_unslash( $_POST['tawp_nonce_field'] ) );
			if ( ! wp_verify_nonce( $tawp_nonce_field, 'tawp_nonce_action' ) ) {
				return 'nonce_error';
			}
		}
		if ( get_transient( 'site_map_url_tmp_data' ) ) {
			delete_transient( 'site_map_url_tmp_data' );
		}
		$site_map_path = ABSPATH . '/sitemap.html';
		if ( file_exists( $site_map_path ) ) {
			wp_delete_file( $site_map_path );
		}
		if ( isset( $_POST['cron_checkbox'] ) && 'on' === $_POST['cron_checkbox'] ) {
			// Vérifie si le cron existe déjà.
			if ( ! wp_next_scheduled( 'cron_crawl_home_page' ) ) {
				// Configurer le cron pour s'exécuter toutes les heures.
				wp_schedule_event( time(), 'hourly', 'cron_crawl_home_page' );
			}
		} elseif ( isset( $_POST['crawl_home'] ) && ! isset( $_POST['cron_checkbox'] ) ) {
			// Supprimer le cron.
			wp_clear_scheduled_hook( 'cron_crawl_home_page' );
		}
		return $this->sitemap_generator();
	}
	/**
	 * Store links Temporary data from the Crawl sitemap
	 *
	 * @since    1.0.0
	 * @param array $data  Links array to be set in temp data.
	 */
	private function store_temporary_data( $data ) {
		$expiration = 3600;
		set_transient( 'site_map_url_tmp_data', $data, $expiration );
	}
	/**
	 * The function who crawl home and generate the sitemap from home
	 *
	 * @since    1.0.0
	 */
	private function sitemap_generator() {
		$url      = home_url();
		$response = wp_remote_get( $url );
		if ( ! is_wp_error( $response ) && wp_remote_retrieve_response_code( $response ) === 200 ) {
			$html = wp_remote_retrieve_body( $response );
			$dom  = new \DOMDocument();
			libxml_use_internal_errors( true );
			$dom->loadHTML( $html );
			libxml_clear_errors();
			$urls      = array();
			$links     = $dom->getElementsByTagName( 'a' );
			$urls_tmp  = array();
			$urls_html = array();
			foreach ( $links as $link ) {
				$href = $link->getAttribute( 'href' );
				if ( ! empty( $href ) ) {
					if ( ! filter_var( $href, FILTER_VALIDATE_URL ) ) {
						$parsed_url = wp_parse_url( $url );
						$base_url   = $parsed_url['scheme'] . '://' . $parsed_url['host'];
						$href       = $base_url . $href;
					}
					$urls_html[] = '<li><a href="' . esc_url( $href ) . '">' . esc_html( $href ) . '</a></li>';
					$urls_tmp[]  = esc_url( $href );
				}
			}
			$sitemap_html  = '<html><head><title>Sitemap</title></head><body><ul>' . implode( '', $urls_html ) . '</ul></body></html>';
			$sitemap_html .= '</ul></body></html>';
			$file_path     = ABSPATH . 'sitemap.html';
			WP_Filesystem();
			global $wp_filesystem;
			if ( $wp_filesystem ) {
				if ( $wp_filesystem->put_contents( $file_path, $sitemap_html, FS_CHMOD_FILE ) ) {
					echo 'the sitemap is created succefluy';
					return $urls_tmp;
				} else {
					echo 'Error when register sitemap.';
				}
			} else {
				echo 'Error : file system not available.';
			}
		}
	}
}
