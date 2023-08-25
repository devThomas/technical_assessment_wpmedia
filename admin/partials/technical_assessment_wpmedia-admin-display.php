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

if ( isset( $_POST['crawl_home'] ) ) {
	if ( isset( $_POST['tawp_nonce_field'] ) ) {
		$tawp_nonce_field = sanitize_text_field( wp_unslash( $_POST['tawp_nonce_field'] ) );
	}
	if ( wp_verify_nonce( $tawp_nonce_field, 'tawp_nonce_action' ) ) {
		do_action( 'tawp_crawl_home_page' );
	}
}
if ( wp_next_scheduled( 'cron_crawl_home_page' ) ) {
	do_action( 'tawp_admin_notices', 'cron_actif' );
} else {
	do_action( 'tawp_admin_notices', 'cron_not_actif' );
}

$tawp_cron_checkbox_checked = '';
if ( wp_next_scheduled( 'cron_crawl_home_page' ) ) {
	$tawp_cron_checkbox_checked = true;
}
?>
<form method="POST">
	<?php wp_nonce_field( 'tawp_nonce_action', 'tawp_nonce_field' ); ?>
	<input type="submit" name="crawl_home" value="Generate sitemap">
	<label for="cron_checkbox">Set crawl each hour ?</label>
	<input type="checkbox" name="cron_checkbox" <?php echo checked( $tawp_cron_checkbox_checked ); ?> >
</form>

<?php
if ( get_transient( 'site_map_url_tmp_data' ) ) {
	?>

	<form method="POST">
		<?php wp_nonce_field( 'tawp_nonce_action', 'tawp_nonce_field' ); ?>
		<input type="submit" name="get_data" value="Show data from storage">
	</form>

<?php } ?>

<?php

if ( isset( $_POST['crawl_home'] ) || isset( $_POST['get_data'] ) ) {
	$tawp_site_map_urls = get_transient( 'site_map_url_tmp_data' );
	if ( $tawp_site_map_urls && is_array( $tawp_site_map_urls ) ) {
		if ( isset( $_POST['crawl_home'] ) ) {
			echo '<h2>Result from the sitemap</h2>';
		} else {
			echo '<h2>Result from the Temporary data</h2>';
		}
		echo '<ul>';
		foreach ( $tawp_site_map_urls as $tawp_link ) {
			echo '<li>' . esc_url( $tawp_link ) . '</li>';
		}
		echo '</ul>';
	} else {
		echo 'Error Loading Temporary Data';
	}
}
?>