<?php
/**
 * Created by PhpStorm.
 * User: aino
 * Date: 14.4.2017
 * Time: 10:42
 */

namespace Roots\Sage\KlabPage;


use Roots\Sage\ContentInBox\KlabContentInBox;

class KlabDefaultPage
{
    protected $wp_query;
    protected $post;

    public function __construct()
    {

        global $wp_query, $post;
        $this->wp_query = $wp_query;
        $this->post = $post;

    }

    public function run() {

        $this->echoPage();
        $this->echoAfterPage();
        $this->echoChildren();
        $this->echoAfterChildren();
    }

    public function echoPage() {

                $contentInBox = new KlabContentInBox(false, false);
                $contentInBox->setContent(get_the_content());
                $contentInBox->setTitle(get_the_title());
                $contentInBox->setImage(get_the_post_thumbnail('medium'));
                $contentInBox->run();
    }

    protected function echoChildren() {

        global $wp_query, $post;
        $savedQuery = $wp_query;

        $wp_query = new \WP_Query( array(
            'post_type' => 'page',
            'post_parent' => $this->post->ID,
            'posts_per_page' => -1,
            'orderby' => 'menu_order'
        ));

        if ($wp_query->have_posts()) : while ($wp_query->have_posts()) : the_post();

            // get the template name for the child page
            $template_name = get_post_meta( $post->ID, '_wp_page_template', true );

            if ($template_name == 'default') {

                $child = new KlabDefaultPage();
                $child->run();
            }
            else {
                locate_template($template_name, true, true);
            }

        endwhile; endif;

        $wp_query->reset_postdata();
        $wp_query = $savedQuery;
    }

    protected function echoAfterPage() {
        return;
    }

    protected function echoAfterChildren(){
        return;
    }

}