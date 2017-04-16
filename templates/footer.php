<footer class="mdl-mega-footer">
    <?php dynamic_sidebar('sidebar-footer');

    $templateName = 'template-footer.php';
    $args = array(
        'post_type' => 'page',
        'posts_per_page' => -1,
        'orderby' => array('menu_order', 'modified'),
        'order' => 'ASC',
        'meta_query' => array(
            array(
                'key' => '_wp_page_template',
                'value' => $templateName
            )
        )
    );
    global $wp_query;
    $savedQuery = $wp_query;

    $wp_query = new WP_Query( $args );

    //var_dump($wp_query);
    if( $wp_query->have_posts() ){ ?>

        <div class="mdl-grid">

            <?php

            while (have_posts()) : the_post();

                locate_template($templateName, true, false);

            endwhile;
            ?>
        </div>
        <?php
    }
    $wp_query->reset_postdata();
    $wp_query = $savedQuery;?>



</footer>