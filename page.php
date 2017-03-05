<?php
use Roots\Sage\KlabFullPicSingleCol;


KlabFullPicSingleCol\echoBlock($wp_query, null, true, true, false);

KlabFullPicSingleCol\echoBlock($wp_query, null, false, false, true); ?>

<?php $wp_query->reset_postdata(); ?>

<?php
//show child pages

global $wp_query;

$wp_query = new WP_Query( array(
    'post_type' => 'page',
    'post_parent' => $post->ID,
    'posts_per_page' => -1,
    'orderby' => 'menu_order'
));

if ($wp_query->have_posts()) : while ($wp_query->have_posts()) : the_post();

    // get the template name for the child page
    $template_name = get_post_meta( $post->ID, '_wp_page_template', true );
    $template_name = ( 'default' == $template_name ) ? 'page.php' : $template_name;

    locate_template( $template_name, true, true );

endwhile; endif;
?>
<?php $wp_query->reset_postdata(); ?>

