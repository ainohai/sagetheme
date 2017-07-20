<?php
/**
 * Created by PhpStorm.
 * User: aino
 * Date: 14.4.2017
 * Time: 10:42
 */

namespace Roots\Sage\KlabPage;

use Roots\Sage\ContentInBox\KlabContentInBox;
use Roots\Sage\KlabLabMemberSlider;
use Roots\Sage\KlabLabMembers\KlabLabMembers;

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

        $this->echoPageAndSection();
        $this->echoAfterPage();
        $this->echoChildren();
        $this->echoAfterChildren();
    }

    public function echoPageAndSection() {
        echo '<section class="'. \Roots\Sage\KlabTemplFunctions\constructWrapperSectionClasses() .'">';
        $this->echoPage();
        echo '</section>';

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
                global $isChildWithinLoop;
                $isChildWithinLoop = true;
                include (locate_template($template_name, false, false));
                $isChildWithinLoop = false;
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

class KlabLabMemberSliderPage extends \Roots\Sage\KlabPage\KlabDefaultPage
{
    public function echoPage()
    {
        $mainContent = new KlabContentInBox();
        $mainContent->setContent(get_the_content());

        $sliderPosts = new KlabLabMemberSlider\KlabLabMemberSlider();
        $sliderPosts->echoPosts();

        $mainContent->run();

    }

    protected function echoAfterPage()
    {
        \Roots\Sage\KlabTemplFunctions\echoDivider();
        $labMembers = new KlabLabMembers();
        $labMembers->echoPosts();

        $alumni = new KlabLabMembers(true);
        $alumni->echoPosts();
    }
}
?>