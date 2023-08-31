<?php

use PHPUnit\Framework\TestCase;

define( 'TAWP_PLUGIN_NAME', 'technical_assessment_wpmedia' );
define( 'TAWP_PLUGIN_VERSION', '1.0.0' );

use Tawp_Technical_Assessment_Wpmedia\Tawp_Technical_Assessment_Wpmedia_Admin;



class Tawp_Technical_Assessment_Wpmedia_Admin_Test extends TestCase {

    private $admin;
    private $urls_sitemap;

    public function setUp() {
        parent::setUp();
        wp_set_current_user(1);
        $this->admin = new Tawp_Technical_Assessment_Wpmedia_Admin(TAWP_PLUGIN_NAME, TAWP_PLUGIN_VERSION);
        
    }

    public function test_enqueue_styles() {
        
        $this->admin->enqueue_styles();
        $this->assertTrue(wp_style_is(TAWP_PLUGIN_NAME, 'enqueued'));
    }

    /**
     * Test enqueue_scripts method.
     */
    public function test_enqueue_scripts() {
     
        $this->admin->enqueue_scripts();
        $this->assertTrue(wp_script_is(TAWP_PLUGIN_NAME, 'enqueued'));
    }

    /**
     * Test add_menu method.
     */
    public function test_add_menu() {
        $this->admin->add_menu();
        global $submenu;
        $this->assertArrayHasKey('options-general.php', $submenu);
        $this->assertContains('my plugin', wp_list_pluck($submenu['options-general.php'], 0));
    }

    /**
     * Test display_information method.
     */
    public function test_display_information() {
        ob_start();
        $this->admin->display_information('cron_actif');
        $output = ob_get_clean();
        $this->assertContains('cron_actif', $output);

        ob_start();
        $this->admin->display_information('cron_not_actif');
        $output = ob_get_clean();
        $this->assertContains('cron_not_actif', $output);
    }

    /**
     * Test crawl_home_page method.
     */
    public function test_crawl_home_page() {

        //check the crawl_home_page with set cron.
        $_POST['crawl_home'] = true;
        $_POST['cron_checkbox'] = 'on';
        $urls = $this->admin->crawl_home_page();
        $this->assertNotEmpty($urls);
        $this->assertInternalType('array', $urls);
        $this->assertEquals($urls, get_transient('site_map_url_tmp_data') );
        //verify is cron is activated
        $this->assertIsInt(wp_next_scheduled('cron_crawl_home_page'));
        

        //cron task check then with no POST set
        unset($_POST['cron_checkbox']);
        unset($_POST['crawl_home']);
        $urls = $this->admin->crawl_home_page();
        $this->assertNotEmpty($urls);
        $this->assertInternalType('array', $urls);
        $this->assertEquals($urls, get_transient('site_map_url_tmp_data') );
        //verify if cron is still activated
        $this->assertIsInt(wp_next_scheduled('cron_crawl_home_page'));
        unset($_POST['cron_checkbox']);

        //check the crawl_home_page without cron checkbox.
        $_POST['crawl_home'] = true;
        $urls = $this->admin->crawl_home_page();
        $this->assertNotEmpty($urls);
        $this->assertInternalType('array', $urls);
        $this->assertEquals($urls, get_transient('site_map_url_tmp_data') );
        //verify if cron is desactivated.
        $this->assertFalse(wp_next_scheduled('cron_crawl_home_page'), 'The cron is not desactivated.');
        unset($_POST['crawl_home']);
    }

    public function testSitemapFileExists() {
        $path = ABSPATH . 'sitemap.html';
        $this->assertFileExists($path, 'the sitemap.html file is not set. ');
    
    }



}
