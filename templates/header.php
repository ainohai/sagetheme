<?php use Roots\Sage\KlabNavMenus;
?>
<header class="mdl-layout__header mdl-layout__header--waterfall mdl-layout__header--waterfall-hide-top">
    <div class="mdl-layout__header-row mdl-layout__header-row--uni ">
        <span class="mdl-layout--large-screen-only mdl-layout-title mdl-layout-title--mainKlab">
            <a href="<?php get_site_url()?>"><?php bloginfo('name')?></a></span>
        <div class="mdl-layout-spacer mdl-layout--large-screen-only"></div>
        <a class="klab-helsinkiUni" href="https://www.helsinki.fi/en">
            <img class="klab-helsinkiUni__img"src="<?php echo get_template_directory_uri()?>/assets/images/hy-logo.png"/>
            University of Helsinki
        </a>
        <div class="mdl-layout-spacer mdl-layout--small-screen-only"></div>
        <!-- Right aligned menu below button -->
        <button id="klab-intraLinks" class="mdl-button mdl-js-button mdl-button--icon">
            <i class="material-icons">more_vert</i>
        </button>
    </div>

    <?php
    global $post;
    $frontPageId = get_option( 'page_on_front' );
    $invert = ($post->post_parent == LAB_HOME_PARENT_ID || $post->ID == $frontPageId) ? '' :'invert'; ?>
    <div class="mdl-layout__header-row  mdl-layout__header-row--primary <?php echo $invert ?>">
        <span class="mdl-layout--small-screen-only mdl-layout-title mdl-layout-title--mainKlab"><?php bloginfo('name')?></span>
        <!-- Navigation -->
        <div class="mdl-layout--large-screen-only">
        <?php KlabNavMenus\echoPrimaryNavigation() ?>
        </div>
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

<div class="mdl-layout__drawer mdl-layout--small-screen-only">
    <span class="mdl-layout-title"><?php //bloginfo('name'); ?></span>
    <?php KlabNavMenus\echoPrimaryNavigation() ?>
</div>
<?php KlabNavMenus\echoIntraLinks() ?>

