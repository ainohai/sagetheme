<?php
/**
 * Template Name: Lab Member Template
 */
?>

<?php use Roots\Sage\KlabTemplFunctions;
use Roots\Sage\KlabFullPicSingleCol;
use Roots\Sage\KlabLabMemberSlider;
use Roots\Sage\KlabLabContentSide;
?>

<?php
$pageTitle = null;
$currentPage = null;
while (have_posts()) : the_post();

    global $post;
    $currentPage = $post;
    $pageTitle = $post->post_title;

endwhile;

$args = array (
    'post_type' => 'klab_lab_slideshow',
    'posts_per_page' => -1,
    'orderby' => 'menu_order',
    'order' => 'ASC',
);
?>

<?php $sliderQuery = new WP_Query( $args ); ?>
<?php Roots\Sage\KlabLabMemberSlider\echoBlock($sliderQuery, $pageTitle); ?>

<?php global $wp_query;?>

<?php KlabFullPicSingleCol\echoBlock($wp_query, null, false, false, true); ?>

<?php
$args = array (
    'post_type' => 'klab_lab_member',
    'posts_per_page' => -1,
    'orderby' => array('menu_order', 'modified'),
    'order' => 'ASC',
);

$labQuery = new WP_Query( $args );
$terms = get_terms( 'labMemberPosition', array(
    'hide_empty' => true,
    'orderby' => 'term_order'
));


if ($labQuery->have_posts()) {
    $resultArray = KlabTemplFunctions\getPostsOrderedByTaxonomyCats('labMemberPosition', $labQuery);
    ?>
    <section class="<?php echo KlabTemplFunctions\constructSectionClasses($labQuery, 'klabLabMember', false); ?>">
        <div class="mdl-grid">
            <?php
            foreach ($resultArray as $category=>$postArray) {
                ?>

                <div class="mdl-cell mdl-cell--9-col ">
                    <h2><?php echo $category ?></h2>
                </div>


                <?php
                foreach ($postArray as $post) {
                    echoLabmember();
                }

            }
            ?>
        </div>
    </section>
    <?php
}

$childQuery = new WP_Query();
$childQuery->query(array(
    'post_type' => 'page',
    'post_parent'    => $currentPage->ID,
    'posts_per_page' => -1,
    'orderby' => 'menu_order',
    'order' => 'ASC',
));

if ($childQuery->have_posts()) { ?>
    <section class="<?php echo KlabTemplFunctions\constructSectionClasses($childQuery, 'labMemberChildren', false); ?>">

        <?php
        while ($childQuery->have_posts()) : $childQuery->the_post();
            KlabLabContentSide\echoContent('child', $post->post_title);
        endwhile; ?>

    </section>
    <?php
}
?>

<?php
function echoLabmember () {

    global $post;
    $blockName = 'labMember';
    $imageSize = 'thumbnail';
    ?>

    <div class="editableContent mdl-grid <?php echo $blockName; ?>"
         data-postTypeSlug="<?php echo get_post_type($post); ?>"
         data-id="<?php echo $post->ID; ?>" id="<?php echo $post->post_name ?>">



        <div class="mdl-cell  mdl-card mdl-cell--3-col">
            <div class="mdl-card__media">
                <?php if (has_post_thumbnail($post->ID)) { ?>
                    <?php  the_post_thumbnail($imageSize);  ?>
                <?php } else { ?>
                    <i class="material-icons  mdl-list__item-avatar">person</i>
                <?php }?>
            </div>

        </div>

        <div class="mdl-cell mdl-cell--9-col mdl-card <?php echo $blockName . "__content" ?>">

            <h3 class="mdl-card__title-text"><?php the_title(); ?></h3>

            <?php
            $metadataArray =  get_post_meta( $post->ID);
            echo '<span class="'.$blockName.'__title">'. $metadataArray["klab_lab_member_klabMemberTitle"][0] .'</span>';
            ?>
            <div class="mdl-card__supporting-text">
                <?php
                echo '<p>'. $metadataArray['klab_lab_member_klabMemberDescription'][0].'</p>'?></div>

        </div>
    </div>

    <?php

}
?>