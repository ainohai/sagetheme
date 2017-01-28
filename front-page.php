<?php use Roots\Sage\KlabNewsBlock;
use Roots\Sage\KlabFullPicSingleCol;
?>

<?php KlabFullPicSingleCol\echoBlock($wp_query, null, true, true); ?>
<?php //news ?>

<?php
$args = array (
    'post_type' => 'klab_news'
);
?>

<?php $newsQuery = new WP_Query( $args ); ?>
<?php KlabNewsBlock\echoNewsBlock($newsQuery) ?>





