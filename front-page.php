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

<section class="<?php echo KlabTemplFunctions\constructSectionClasses($wp_query, 'labInfo'); ?>">

<?php KlabMiddleNoPic\echoBlock($wp_query, null, false, false); ?>

</section>

<?php //contents of custom facebook feed plugin ?>
<section class="postSection postSection--facebookFeed">
    <div class="mdl-cell mdl-cell--12-col mdl-card">

        <h1 class="mdl-card__title-text">Klefström lab on facebook </h1>
        <?php echo do_shortcode('[custom-facebook-feed]'); ?>
    </div>

</section>




