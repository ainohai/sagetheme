<?php use Roots\Sage\KlabNewsBlock;
use Roots\Sage\KlabFullPicSingleCol;
?>

<?php KlabFullPicSingleCol\echoBlock($wp_query, null, true, true, false); ?>
<?php KlabFullPicSingleCol\echoBlock($wp_query, null, false, false, true); ?>
<?php //news ?>

<?php
$args = array (
    'post_type' => 'klab_news',
    'posts_per_page' => -1,
    'orderby' => 'menu_order',
    'order' => 'ASC',
);
?>

<?php $newsQuery = new WP_Query( $args ); ?>




<?php KlabNewsBlock\echoNewsBlock($newsQuery) ?>

