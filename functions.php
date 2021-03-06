<?php
/**
 * Sage includes
 *
 * The $sage_includes array determines the code library included in your theme.
 * Add or remove files to the array as needed. Supports child theme overrides.
 *
 * Please note that missing files will produce a fatal error.
 *
 * @link https://github.com/roots/sage/pull/1042
 */
$sage_includes = [
  'lib/assets.php',    // Scripts and stylesheets
  'lib/extras.php',    // Custom functions
  'lib/setup.php',     // Theme setup
  'lib/titles.php',    // Page titles
  'lib/wrapper.php',   // Theme wrapper class
  'lib/customizer.php', // Theme customizer
  'lib/klab_templateFunctions.php', // view related things often used in templates
  'lib/klab_navMenus.php', //
    //post types
    'templates/postTypeTemplates/KlabAbstractEchoPostType.php',
    'templates/postTypeTemplates/KlabNews.php',
    'templates/postTypeTemplates/KlabPublications.php',
     'templates/postTypeTemplates/KlabResearchTopic.php',
    'templates/postTypeTemplates/KlabLabMemberSlider.php',
    'templates/postTypeTemplates/KlabLabMembers.php',
    'templates/postTypeTemplates/KlabInMedia.php',
    //Page classes
    'templates/pages/KlabDefaultPage.php',
    'templates/pages/KlabDefaultEntryPage.php',
    'templates/pages/KlabBigSidePic.php',
    'templates/pages/KlabMapPage.php',
    'templates/pages/KlabTitleAndContentPage.php',
    //post sections
    'templates/contentBlocks/KlabAbstractPostSection.php',
    'templates/contentBlocks/KlabFullPageImage.php',
    'templates/contentBlocks/KlabContentInBox.php',
    'templates/contentBlocks/KlabContentSide.php',
    'templates/contentBlocks/KlabBigSidePicSection.php',
    'templates/contentBlocks/KlabPublicationSection.php',
    'templates/contentBlocks/KlabLabMemberSection.php',
    'templates/contentBlocks/KlabInMediaSection.php'

];

foreach ($sage_includes as $file) {
  if (!$filepath = locate_template($file)) {
    trigger_error(sprintf(__('Error locating %s for inclusion', 'sage'), $file), E_USER_ERROR);
  }

  require_once $filepath;
}
unset($file, $filepath);
?>