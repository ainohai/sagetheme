
<!--<div class="page-content mdl-color--white mdl-shadow--4dp content mdl-color-text--grey-800 mdl-cell mdl-cell--12-col">
--><?php while (have_posts()) : the_post(); ?>
    <?php global $post; ?>
  <div class="editableContent" data-postTypeSlug = "<?php echo get_post_type($post); ?>" data-id="<?php the_ID();?>" >
  <?php get_template_part('templates/page', 'header'); ?>
  <?php get_template_part('templates/content', 'page'); ?>
  </div>
<?php endwhile; ?>
    </div>
  <!--</div>-->
</div>