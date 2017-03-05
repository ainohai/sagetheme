<?php
/**
 * Template Name: Contact Info Template
 */
use Roots\Sage\KlabFullPicSingleCol;
use Roots\Sage\KlabBigSidePic;
use Roots\Sage\KlabLabContentSide;
use Roots\Sage\KlabTemplFunctions;
?>


<?php
$currentPage = $post;
KlabFullPicSingleCol\echoBlock($wp_query, null, true, true, false); ?>

<?php
KlabBigSidePic\echoContent('contact');

?>

<?php
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
