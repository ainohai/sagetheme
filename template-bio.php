<?php
/**
 * Template Name: Bio
 */
?>
<?php use Roots\Sage\KlabTemplFunctions;
use Roots\Sage\KlabSidePic;
?>

<?php global $wp_query;?>

<?php KlabSidePic\echoBlock($wp_query, array(['key'=>'page_biodetails'], ['key'=>'page_cv', 'title' => 'CV'])); ?>

