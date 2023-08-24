<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://thomas.enlightenment-idea.com/
 * @since      1.0.0
 *
 * @package    Technical_assessment_wpmedia
 * @subpackage Technical_assessment_wpmedia/admin/partials
 */

 if(isset($_POST["crawl_home"])){
    do_action('crawl_home_page');
 }

 if (wp_next_scheduled('cron_crawl_home_page')) {
    echo 'The Cron Task is active , for disactivated please uncheck the checkbox';
} else {
    echo 'The Cron Task is not active, for activate please check the checkbox';
}
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->

<form method="POST">
  <input type="submit" name="crawl_home" value="Generate sitemap">
  <label for="cron_checkbox">Set crawl each hour ?</label>
  <input type="checkbox" name="cron_checkbox" <?php if (wp_next_scheduled('cron_crawl_home_page')) echo 'checked'; ?>>
</form>

<?php if(get_transient('site_map_url_tmp_data')) { ?>

            <form method="POST">
                <input type="submit" name="get_data" value="Show data from storage">
            </form>

<?php } ?>

<?php

if (isset($_POST["crawl_home"]) || isset($_POST["get_data"])) {
    $siteMapUrls = get_transient('site_map_url_tmp_data');

    if ($siteMapUrls && is_array($siteMapUrls)) {
        if(isset($_POST["crawl_home"])) {
            echo '<h2>Result from the sitemap</h2>';
        } else {
            echo '<h2>Result from the Temporary data</h2>';
        }
        
        echo '<ul>';
        foreach ($siteMapUrls as $link) {
            echo '<li>' . $link . '</li>';
        }
        echo '</ul>';
    } else {
        echo 'Error Loading Temporary Data';
    }
}
?>