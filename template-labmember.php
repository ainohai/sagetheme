<?php
/**
 * Template Name: Lab Member Template
 */
?>

<?php use Roots\Sage\KlabTemplFunctions;
?>

<?php global $wp_query;?>

<?php //KlabTemplFunctions\getPageHeaderAndContent($wp_query, false, false) ?>

<?php
$args = array (
    'post_type' => 'klab_lab_member'
);
?>

<?php $labQuery = new WP_Query( $args ); ?>
<?php KlabTemplFunctions\dumpPostData($labQuery) ?>
