<?php use Roots\Sage\KlabNavMenus;
?>

  <div class="mdl-layout__header-row top-nav dark-bg ">
     <a class="helsinkiUni" href="https://www.helsinki.fi/en"><img src="<?php echo get_template_directory_uri()?>/assets/images/hy-logo.png"/> University of Helsinki</h1>
     </a>
      <div class="mdl-layout-spacer"></div>
      <!-- Right aligned menu below button -->
      <button id="klab_intra_links"
              class="mdl-button mdl-js-button mdl-button--icon">
          <i class="material-icons">more_vert</i>
      </button>
      <?php KlabNavMenus\echoIntraLinks() ?>

  </div>
  <div class="header-title mdl-layout__header-row">
      <a class="mdl-layout-title" href="<?= esc_url(home_url('/')); ?>"><h1><?php bloginfo('name'); ?></h1>
    </a>
  </div>
  <div class="mdl-layout__header-row primary-accent-bg primary-nav">
      <div class="mdl-layout-spacer"></div>
      <!-- Navigation -->

      <?php KlabNavMenus\echoPrimaryNavigation() ?>
      <?php  /*annoying to fiddle with wordpress nav html structure -> lets do it from scratch with wpQuery.
  if (has_nav_menu('klab-home-primary-menu')) :
          echo strip_tags(wp_nav_menu([  'container' => false,
                       'echo' => false,
                       'theme_location' => 'klab-home-primary-menu',
                       'menu_class' => 'nav',
                       'items_wrap'      => '%3$s']), '<a>'
           );
      endif;*/?>
  </div>

