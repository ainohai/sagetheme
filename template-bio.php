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

<?php
global $wp_query, $post;

$blockName = 'bio';

         KlabBigSidePic\echoContent($blockName); ?>


        <?php
        $cv = get_post_meta( $post->ID, 'page_cv', true );

         if (!empty($cv)) {

             KlabLabContentSide\echoContent('bioDetails', 'CV', $cv)
          ?>


<?php }?>