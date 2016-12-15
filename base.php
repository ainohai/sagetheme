<?php

use Roots\Sage\Setup;
use Roots\Sage\Wrapper;
use Roots\Sage\KlabTemplFunctions;

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

	<!--<div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">-->
    <div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">

	<header class="headerImg header mdl-layout__header mdl-layout__header--transparent">
	<?php
      do_action('get_header');
      get_template_part('templates/header');
    ?>
	</header>

	<div class="page-container">
	<!--<nav class="nav-primary mdl-navigation mdl-typography--body-1-force-preferred-font">

    </nav>-->
    <main class="main mdl-layout__content" >
        <div class="mdl-grid">

            <?php $pageContentClass = KlabTemplFunctions\getPageContentClasses();?>
            <!--<div class="<?php echo $pageContentClass?>">-->

          <?php include Wrapper\template_path();?>
                <!--</div>-->
        </div>
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
