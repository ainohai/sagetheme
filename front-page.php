<?php use Roots\Sage\KlabNewsBlock;
use Roots\Sage\KlabMiddleNoPic;
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

<?php KlabMiddleNoPic\echoBlock($wp_query, true, false); ?>

<?php //contents of custom facebook feed plugin ?>
<section class="postSection facebookFeed">
    <div class="mdl-cell  mdl-cell--6-col mdl-cell--2-offset mdl-card">

        <h1 class="mdl-card__title-text">Klefström lab on facebook </h1>
        <?php echo do_shortcode('[custom-facebook-feed]'); ?>
    </div>

</section>




