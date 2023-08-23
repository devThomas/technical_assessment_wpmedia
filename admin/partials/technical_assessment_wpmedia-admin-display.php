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
  <label for="site_url">URL du site :</label>
  <input type="text" name="site_url" id="site_url" required>

  <label for="page_frequency">Fréquence des pages :</label>
  <select name="page_frequency" id="page_frequency" required>
    <option value="always">Toujours</option>
    <option value="hourly">Toutes les heures</option>
    <option value="daily">Tous les jours</option>
    <option value="weekly">Toutes les semaines</option>
    <option value="monthly">Tous les mois</option>
    <option value="yearly">Tous les ans</option>
    <option value="never">Jamais</option>
  </select>

  <label for="page_priority">Priorité des pages :</label>
  <input type="number" name="page_priority" id="page_priority" min="0" max="1" step="0.1" required>

  <input type="submit" name="crawl_home" value="Générer le sitemap">
</form>