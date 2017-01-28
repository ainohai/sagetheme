<?php
/**
 * Template Name: Bio
 */
?>
<?php
use Roots\Sage\KlabTemplFunctions;
?>

<?php //print_r(get_intermediate_image_sizes());?>

<?php
global $wp_query, $post;
$blockName = 'bio'; ?>


    <section class="<?php echo KlabTemplFunctions\constructSectionClasses($wp_query, $blockName); ?>">

        <?php $blockName = 'bio--mainContent'; ?>

        <div class="mdl-grid editableContent <?php echo $blockName; ?>"
             data-postTypeSlug="<?php echo get_post_type($post); ?>"
             data-id="<?php $post->ID; ?>">

            <div class="mdl-cell  mdl-card mdl-cell--5-col">
                <div class="mdl-card__media">
                    <?php  the_post_thumbnail('medium');  ?>
                </div>
            </div>

            <div class="mdl-cell mdl-cell--7-col mdl-card <?php echo $blockName . "__bioDetails" ?>">
                <div class="mdl-card__supporting-text">
                    <?php
                    the_content();
                    ?></div>

            </div>

        </div>
        <?php
        $cv = get_post_meta( $post->ID, 'page_cv', true );

         if (!empty($cv)) {
             $blockName = 'bio--cv'; ?>

        <div class="mdl-grid editableContent <?php echo $blockName; ?>"
             data-postTypeSlug="<?php echo get_post_type($post); ?>"
             data-id="<?php $post->ID; ?>">
            <div class="mdl-cell mdl-cell--12-col mdl-card <?php echo $blockName . "__bioDetails" ?>">
                <div class="mdl-card__title">
                    <h2 class="mdl-card__title-text">CV </h2>
                </div>
                <div class="mdl-card__supporting-text"><?php
                    echo apply_filters( 'the_content', wp_kses_post( $cv ) );
                    ?>
                </div>

            </div>

        </div>
        <?php //endwhile; ?>

    </section>

<?php } ?>