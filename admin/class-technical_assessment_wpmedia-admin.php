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
class Technical_assessment_wpmedia_Admin {

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
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

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

	public function add_menu()
    {
		if (current_user_can('administrator')) {
			// add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position );
			add_options_page(
				'my plugin', // Titre de la page
				'my plugin', // Titre du menu
				'manage_options', // Capacité requise pour accéder à la page
				'my-plugin-settings', // Slug de la page
				array( $this, 'admin_view' ) // Fonction de rappel pour afficher la page
			);
		}
    }

	public function admin_view() {
        include( plugin_dir_path( __FILE__ ) . 'partials/technical_assessment_wpmedia-admin-display.php' );
    }

	public function crawl_home_page() {
		$urls = $this->generate_new_sitemap();
		$this->store_temporary_data($urls);
    }

	private function generate_new_sitemap() {
		$sitemapPath = get_stylesheet_directory() . '/sitemap.xml';
		if (get_transient('site_map_url_tmp_data')) {
			delete_transient('site_map_url_tmp_data');
		}
		if (file_exists($sitemapPath)) {
			unlink($sitemapPath);
		} 
		return $this->sitemap_generator();
	}

	private function store_temporary_data ($data) {
		$expiration = 3600;
		set_transient('site_map_url_tmp_data', $data, $expiration);
	}

	private function sitemap_generator () {
		
		$url = home_url();
		$html = file_get_contents($url);

		if ($html !== false) {
			$dom = new DOMDocument();
			libxml_use_internal_errors(true); 
			$dom->loadHTML($html);
			libxml_clear_errors();

			$urls = [];
			$links = $dom->getElementsByTagName('a');

			foreach ($links as $link) {
				$href = $link->getAttribute('href');
				if (!empty($href)) {
					if (filter_var($href, FILTER_VALIDATE_URL) === false) {
						$parsedUrl = parse_url($url);
						$baseUrl = $parsedUrl['scheme'] . '://' . $parsedUrl['host'];
						$href = $baseUrl . $href;
					}
					$urls[] = $href;
				}
			}
			$sitemap = '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL;
			$sitemap .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . PHP_EOL;
			foreach ($urls as $url) {
				$sitemap .= "\t<url>" . PHP_EOL;
				$sitemap .= "\t\t<loc>" . htmlspecialchars($url) . "</loc>" . PHP_EOL;
				$sitemap .= "\t</url>" . PHP_EOL;
			}
			$sitemap .= '</urlset>';
			file_put_contents(get_stylesheet_directory() . '/sitemap.xml', $sitemap);
			//storage the file in /upload 
			$upload_dir = wp_upload_dir();
			$upload_path = trailingslashit($upload_dir['path']);
			$file_path = $upload_path . 'home.html';
			file_put_contents($file_path, $html);

			return $urls;

		} else {
			echo 'error Url not found';
		}
	}

}
