<?php
/**
 * Template Name: Bio
 */
?>
<?php use Roots\Sage\KlabTemplFunctions;
?>

<?php global $wp_query;?>

<?php KlabTemplFunctions\getPageHeaderAndContent($wp_query, false, true) ?>

$postsArray = $wpQuery->get_posts();
$postId = $postsArray[0]->ID;

<?php //news ?>

<?php
$args = array (
    'post_type' => 'klab_news'
);
?>

<?php $newsQuery = new WP_Query( $args ); ?>
<?php KlabTemplFunctions\getPageHeaderAndContent($newsQuery, true, true) ?>

<?php //news ?>

<?php
$args = array (
    'post_type' => 'klab_lab_member'
);
?>

<?php $labQuery = new WP_Query( $args ); ?>
<?php KlabTemplFunctions\dumpPostData($labQuery) ?>

<?php //contents of custom facebook feed plugin ?>
<section class="postSection facebook-feed">
  <h1> Klefström lab on facebook </h1>
  <?php echo do_shortcode('[custom-facebook-feed]'); ?>
  <section/>




