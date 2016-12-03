<?php
/**
 * Template Name: Publications
 */
?>

<?php use Roots\Sage\KlabTemplFunctions;
?>

<?php global $wp_query;?>

<?php KlabTemplFunctions\getPageHeaderAndContent($wp_query, false, false) ?>


<?php //publications ?>

<?php
$args = array (
    'post_type' => 'klab_publication'
);
?>

<?php $publications = new WP_Query( $args ); ?>
<?php KlabTemplFunctions\dumpPostData($publications) ?>
