<article <?php post_class(); ?>>
  <header>
      <div class="mdl-card__title">
            <h2 class="mdl-card__title-text"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
      </div>
      <?php get_template_part('templates/entry-meta'); ?>
  </header>
  <!--<div class="entry-summary">
    <?php //the_excerpt(); ?>
  </div>-->
</article>