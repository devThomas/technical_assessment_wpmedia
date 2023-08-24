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
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->

<form method="POST" style="margin-top:50px;">
  <input type="submit" name="crawl_home" value="Generate sitemap">
</form>

<form method="POST" style="margin-top:50px;">
    <input type="submit" name="get_data" value="Show data from storage">
</form>

<?php

if (isset($_POST["crawl_home"]) || isset($_POST["get_data"])) {
    $siteMapUrls = get_transient('site_map_url_tmp_data');

    if ($siteMapUrls && is_array($siteMapUrls)) {
        echo '<h2>Result from the sitemap</h2>';
        echo '<ul>';
        foreach ($siteMapUrls as $link) {
            echo '<li>' . $link . '</li>';
        }
        echo '</ul>';
    } else {
        echo 'Error Loading Data : No data in the storage or the data is not valid';
    }
}
?>