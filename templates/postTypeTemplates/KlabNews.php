<?php

namespace Roots\Sage\KlabEchoNews;
use Roots\Sage\KlabTemplFunctions;
use Roots\Sage\KlabSingleColCard;
use Roots\Sage\KlabEchoPostType;

class KlabNews extends KlabEchoPostType\KlabAbstractEchoPostType  {

    const POST_TYPE_SLUG = 'klab_news';
    const BLOCK_MODIFIER = 'news';

    public function __construct()
    {
        parent::__construct(self::POST_TYPE_SLUG, self::BLOCK_MODIFIER);
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
                        //$this->echoWpLoop();
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

        protected function echoWpLoop ()
        {
            global $post; ?>

            <div class="mdl-grid editableContent <?php echo self::BLOCK_MODIFIER; ?>">

                <?php if (has_post_thumbnail($post->ID)) { ?>
                    <div class="mdl-cell mdl-cell--3-col mdl-card <?php echo self::BLOCK_MODIFIER; ?>__image">
                        <div class="mdl-card__media"  style="background-image: url('<?php echo the_post_thumbnail_url()?>'">
                        </div>
                    </div>
                <?php } else { ?>
                    <div class="mdl-cell mdl-cell--3-col mdl-layout--large-screen-only mdl-card <?php echo self::BLOCK_MODIFIER; ?>__image">
                        <div class="mdl-card__media">
                            <h2><?php the_title() ?></h2>
                        </div>
                    </div>
                <?php } ?>

                <div class="mdl-cell mdl-card mdl-cell--9-col <?php echo self::BLOCK_MODIFIER; ?>__text">
                    <h2 class="mdl-card__title-text"><?php the_title() ?></h2>
                    <div class="mdl-card__supporting-text"><?php the_content(); ?></div>
                </div>
            </div>
            <?php
        }

        private function lastPost() { ?>

            <section
                class="mdl-cell mdl-cell--6-col  <?php echo KlabTemplFunctions\constructSectionClasses(self::BLOCK_MODIFIER, true, true); ?>">
                <?php KlabSingleColCard\echoContent(true, true, 'singleNews'); ?>
            </section>
        <?php   }

        private function facebookFeed () {
    //contents of custom facebook feed plugin ?>
            <section class="mdl-cell mdl-cell--6-col postSection postSection--facebookFeed">
                <div class="mdl-card">

                    <h2 class="mdl-card__title-text">Klefström lab on facebook </h2>
                    <?php echo do_shortcode('[custom-facebook-feed]'); ?>
                </div>

            </section>

            <?php
        }
}