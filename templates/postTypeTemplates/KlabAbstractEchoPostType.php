<?php
/**
 * Created by PhpStorm.
 * User: aino
 * Date: 5.3.2017
 * Time: 14:52
 */

namespace Roots\Sage\KlabEchoPostType;

use Roots\Sage\KlabTemplFunctions;


abstract class KlabAbstractEchoPostType
{
    private $args = array (
        'posts_per_page' => -1,
        'orderby' => array('menu_order', 'modified'),
        'order' => 'ASC',
    );
    private $printEditingComponents = false;
    protected $wpQuery;
    protected $postTypeSlug;
    protected $blockModifier;
    private $sectionArgs;

    public function __construct($postTypeSlug, $blockModifier)
    {
        if (!post_type_exists($postTypeSlug)){
            throw new InvalidArgumentException("post type doesn't exist");
        }

        $this->postTypeSlug = $postTypeSlug;
        $this->args = array_merge($this->args, array('post_type' => $postTypeSlug));
        if( current_user_can('editor') || current_user_can('administrator')) {
            $this->printEditingComponents = true;
        }
        $this->blockModifier = ($blockModifier == null) ? '' : $blockModifier;

        $this->wpQuery = new \WP_Query( $this->args );

    }

    public function echoPosts() {
        if(!$this->printEditingComponents){
            $this->echoPostContent();
        }
        else {
            $this->echoAdminStart();
            $this->echoPostContent();
            $this->echoAdminEnd();
        }

    }

    protected function echoAdminStart() {
        echo '<div class = "adminPostTypeSect">';

        $postTypeInfo = get_post_type_object( $this->postTypeSlug );
        ?>

        <div class="adminEdit adminEdit--modPostsButtons">
 <?php
            $this->addButton(admin_url( 'edit.php?post_type='.$this->postTypeSlug), $postTypeInfo->labels->all_items);
            $this->addButton(admin_url( 'post-new.php?post_type='.$this->postTypeSlug), $postTypeInfo->labels->add_new);
            $this->addButton(admin_url( 'edit.php?post_type='.$this->postTypeSlug .'&page=order-post-types-'.$this->postTypeSlug), 'Reorder');
            $this->afterButtons();
?>
        </div>
        <?php


    }

    protected function afterButtons(){}

    protected function addButton($url, $label) {
        echo '<a href =" '. $url .'"';
        echo '<button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored">';
        echo $label;
        echo '</button>
            </a>';
    }

    protected function echoAdminEnd() {
        echo '</div>';
    }


    protected function echoPostContent ()
    {
        global $wp_query;
        $savedQuery = $wp_query;
        $wp_query = $this->wpQuery;

        if ($wp_query->have_posts() ) {
            while (have_posts()) : the_post();

                 $this->echoWpLoop();

            endwhile;
         }
        $wp_query->reset_postdata();
        $wp_query = $savedQuery;
    }

    protected abstract function echoWpLoop();

    /**
     * @param mixed $sectionArgs
     */
    public function setSectionArgs($sectionArgs)
    {
        $this->sectionArgs = $sectionArgs;
    }


}