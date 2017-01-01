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



    <div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">

        <header class="headerImg header mdl-layout__header mdl-layout__header--scroll">
            <?php
            do_action('get_header');
            get_template_part('templates/header');
            ?>
        </header>


        <main class="main mdl-layout__content" >

            <?php include Wrapper\template_path();?>

            <?php
            //do_action('get_footer');
            //get_template_part('templates/footer');
            //wp_footer();
            ?>
            <footer class="mdl-mega-footer">

            </footer>
        </main><!-- /.main -->
        <?php if (Setup\display_sidebar()) : ?>
            <aside class="sidebar">
                <?php include Wrapper\sidebar_path(); ?>
            </aside><!-- /.sidebar -->
        <?php endif; ?>

    </div>

</body>
</html>
