<?php
/**
 * Template Name: Bio
 */
?>
<?php
use Roots\Sage\KlabTemplFunctions;
use Roots\Sage\KlabBigSidePic;
use Roots\Sage\KlabLabContentSide;
use Roots\Sage\KlabFullPicSingleCol;
?>

<?php //print_r(get_intermediate_image_sizes());?>

<?php
global $wp_query, $post;
$blockName = 'bio'; ?>


    <section class="<?php echo KlabTemplFunctions\constructSectionClasses($wp_query, $blockName); ?>">


        <?php KlabBigSidePic\echoContent('bio'); ?>


        <?php
        $cv = get_post_meta( $post->ID, 'page_cv', true );

         if (!empty($cv)) {

             KlabLabContentSide\echoContent('bioDetails', 'CV', $cv)
         //endwhile; ?>

    </section>

<?php } ?>