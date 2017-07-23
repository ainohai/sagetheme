<?php

namespace Roots\Sage\KlabEchoNews;
use Roots\Sage\ContentInBox\KlabContentInBox;
use Roots\Sage\KlabTemplFunctions;
use Roots\Sage\KlabSingleColCard;
use Roots\Sage\KlabEchoPostType;

class KlabNews extends KlabEchoPostType\KlabAbstractEchoPostType  {

    const POST_TYPE_SLUG = 'klab_news';
    const BLOCK_MODIFIER = 'news';

    public function __construct()
    {
        parent::__construct(self::POST_TYPE_SLUG, self::BLOCK_MODIFIER, null, true);
        parent::setSectionArgs(array('echoSection' => false));

    }

    protected function echoPostContent ()
        {
            global $wp_query;
            $savedQuery = $wp_query;
            $wp_query = $this->wpQuery;

            $totalPostCount = $wp_query->post_count;
            $i = $totalPostCount;

            if ($totalPostCount > 1) {
                echo '<div class="'. KlabTemplFunctions\constructSectionClasses(self::BLOCK_MODIFIER) .'">';
            }

            if ($wp_query->have_posts() ) {
                while (have_posts()) : the_post();

                    $i = --$i;
                    if ($i != 0) {
                        $this->echoWpLoopContents();
                    } else {
                        echo ($totalPostCount > 1) ? '</div>' : '';

                        echo '<div class="mdl-grid">';
                        $this->lastPost();
                        $this->facebookFeed();
                        echo '</div> '; //<!--end mdl-grid -->
                    }
                endwhile;
            }
            $wp_query->reset_postdata();
            $wp_query = $savedQuery;
        }

        protected function echoWpLoopContents ()
        {
            global $post; ?>

            <div class="mdl-grid editableContent <?php echo self::BLOCK_MODIFIER; ?>">

                <?php if (has_post_thumbnail($post->ID)) { ?>
                    <div class="mdl-cell mdl-cell--3-col  <?php echo self::BLOCK_MODIFIER; ?>__image">
                        <div class="postSection__media"  style="background-image: url('<?php echo the_post_thumbnail_url()?>'">
                        </div>
                    </div>
                <?php } else { ?>
                    <div class="mdl-cell mdl-cell--3-col mdl-layout--large-screen-only  <?php echo self::BLOCK_MODIFIER; ?>__image">
                        <div class="postSection__title">
                            <h2 class="postSection__title-text"><?php the_title() ?></h2>
                        </div>
                    </div>
                <?php } ?>

                <div class="mdl-cell  mdl-cell--9-col <?php echo self::BLOCK_MODIFIER; ?>__text">
                    <div class="postSection__title">
                        <h2 class="postSection__title-text"><?php the_title() ?></h2>
                    </div>
                    <div class="postSection__supporting-text"><?php the_content(); ?></div>
                </div>
            </div>
            <?php
        }

        private function lastPost() {
            global $post;
            ?>

            <div
                class="mdl-cell  mdl-cell--6-col  <?php echo KlabTemplFunctions\constructSectionClasses(self::BLOCK_MODIFIER, true, true); ?>">
                <?php
                $lastNews = new KlabContentInBox(false, false, false, true);
                $lastNews->setTitle(get_the_title());
                $lastNews->setContent(get_the_content());
                $lastNews->setImage(get_the_post_thumbnail($post->ID, 'medium'));
                $lastNews->run();
                //KlabSingleColCard\echoContent(true, true, 'singleNews'); ?>
            </div>
        <?php   }

        private function facebookFeed () {
    //contents of custom facebook feed plugin ?>
            <div class="mdl-cell  mdl-cell--6-col postSection postSection--facebookFeed">
                    <div class="postSection__title">
                        <h2 class="postSection__title-text">Klefström lab on facebook </h2>
                    </div>
                    <div class="postSection__supporting-text">
                        <?php echo do_shortcode('[custom-facebook-feed]'); ?>
                    </div>

            </div>

            <?php
        }
}
?>