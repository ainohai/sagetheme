<?php use Roots\Sage\KlabNavMenus;
?>
<header class="mdl-layout__header">
    <div class="mdl-layout__header-row header__row--dark-bg ">
        <a class="helsinkiUni" href="https://www.helsinki.fi/en"><img src="<?php echo get_template_directory_uri()?>/assets/images/hy-logo.png"/> University of Helsinki</a>
        <div class="mdl-layout-spacer"></div>
        <!-- Right aligned menu below button -->
        <button class="mdl-button mdl-js-button mdl-button--icon klabIntraLinks">
            <i class="material-icons">more_vert</i>
        </button>
        <?php KlabNavMenus\echoIntraLinks() ?>
    </div>
    <!--<div class="mdl-layout--large-screen-only header-title mdl-layout__header-row">
        <a class="mdl-layout-title" href="<?= esc_url(home_url('/')); ?>">
            <h1><?php //bloginfo('name'); ?></h1>
        </a>
    </div>-->
    <!--<div class="mdl-layout--small-screen-only mdl-layout__header-row dark-bg">
        <a class="mdl-layout-title" href="<?= esc_url(home_url('/')); ?>"><h1><?php bloginfo('name'); ?></h1>
        </a>
    </div>-->
    <div class="mdl-layout__header-row  mdl-layout__header-row--primary-bg">

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
</header>

<!--<div class="mdl-layout__drawer mdl-layout--small-screen-only header-drawer">
    <span class="mdl-layout-title"><?php //bloginfo('name'); ?></span>
    <?php //KlabNavMenus\echoPrimaryNavigation() ?>
</div>-->

