<?php
/**
 * Template Name: Publications
 */
?>

<?php use Roots\Sage\KlabTemplFunctions;
use Roots\Sage\KlabFullPicSingleCol;
?>

<?php global $wp_query;?>

<?php
KlabFullPicSingleCol\echoBlock($wp_query, null, true, true, false);

KlabFullPicSingleCol\echoBlock($wp_query, null, false, false, true); ?>




<?php
$publicationsQuery = new WP_Query();
$publicationsQuery->query(array(
    'post_type' => 'klab_publication',
    'posts_per_page' => -1,
    'orderby' => 'menu_order',
    'order' => 'ASC',
));

?>
<?php
if ($publicationsQuery->have_posts()) {
    $postsArray = $publicationsQuery->get_posts();
    $blockModifier = 'publicationsList';?>


    <section class="<?php echo KlabTemplFunctions\constructSectionClasses($wp_query, $blockModifier, false); ?>">


        <div class = "mdl-cell--8-col mdl-cell--1-offset-desktop mdl-card">
            <h3>Selected publications</h3>
            <?php
            while ($publicationsQuery->have_posts()) : $publicationsQuery->the_post();

                publicationsListItem();

            endwhile;
            ?>
        </div>
    </section>
<?php }
?>

<?php function publicationsListItem() {

    global $post;
    $blockName = 'publicationItem';

    $metadataArray =  get_post_meta( $post->ID);

    ?>
    <div class="mdl-cell--12-col <?php echo $blockName; ?> editableContent"
         data-postTypeSlug="<?php echo get_post_type($post); ?>"
         data-id="<?php $post->ID;?>">

                <span class="<?php echo $blockName ?>__authors">
                    <?php echo$metadataArray["klab_publication_authors"][0] ?>
                </span></br>
        <span class=" <?php echo $blockName ?>__title">
                    <?php the_title(); ?>
                </span></br>

        <span class="<?php echo $blockName ?>__details">
                    <?php echo$metadataArray["klab_publication_publicationDetails"][0] ?>
                </span></br>


    </div>

    <?php
}?>


