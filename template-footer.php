<?php
/**
 * Template Name: Footer
 */

//Pages having footer-template are printed in footer.
?>

<div class="mdl-cell mdl-cell--4-col">
    <?php the_content(); ?>
</div>


<?php

/*$args = array(
    'post_type' => 'attachment',
    'numberposts' => -1,
    'post_status' => null,
    'post_parent' => null, // any parent
);
$attachments = get_posts($args);
if ($attachments) {
    foreach ($attachments as $post) {
        setup_postdata($post);
        the_title();
        the_attachment_link($post->ID, false);
        the_excerpt();
    }
}
*/
//var_dump($get_posts);