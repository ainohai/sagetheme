<?php use Roots\Sage\KlabNewsBlock;
use Roots\Sage\KlabTemplFunctions;
?>
<?php //news ?>

<?php
$args = array (
    'post_type' => 'klab_news'
);
?>

<?php $newsQuery = new WP_Query( $args ); ?>
<?php KlabNewsBlock\echoNewsBlock($newsQuery) ?>

<?php global $wp_query;?>

<?php KlabTemplFunctions\getPageHeaderAndContent($wp_query, false, false) ?>

<?php //contents of custom facebook feed plugin ?>
<section class="postSection facebook-feed">
    <h1> Klefström lab on facebook </h1>
    <?php echo do_shortcode('[custom-facebook-feed]'); ?>
    <section/>




