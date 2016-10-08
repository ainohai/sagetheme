<?php

use Roots\Sage\Setup;
use Roots\Sage\Wrapper;

?>

<!doctype html>
<html <?php language_attributes(); ?>>
  <?php get_template_part('templates/head'); ?>
  <body <?php body_class(); ?>>
    <!--[if IE]>
      <div class="alert alert-warning">
        <?php _e('You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.', 'sage'); ?>
      </div>
    <![endif]-->


	<div class="mdl-layout mdl-js-layout mdl-layout--fixed-header mdl-color--grey-100">


	<header class=" header mdl-layout__header--transparent  mdl-color-text--grey-800">
	<?php
      do_action('get_header');
      get_template_part('templates/header');
    ?>
	</header>
	<div class="headerImg"></div>
	<div class="page-container">
	<nav class="nav-primary mdl-layout__header-row mdl-layout--large-screen-only">
      <?php
      if (has_nav_menu('primary_navigation')) :
        wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'nav']);
      endif;
      ?>
    </nav>
    <main class="main mdl-layout__content">
          <?php include Wrapper\template_path(); ?>
    </main><!-- /.main -->
        <?php if (Setup\display_sidebar()) : ?>
          <aside class="sidebar">
            <?php include Wrapper\sidebar_path(); ?>
          </aside><!-- /.sidebar -->
        <?php endif; ?>
    <?php
      do_action('get_footer');
      get_template_part('templates/footer');
      wp_footer();
    ?>
	</div>
  </body>
</html>
