<?php
/**
 * Created by PhpStorm.
 * User: aino
 * Date: 17.4.2017
 * Time: 9:36
 */

namespace Roots\Sage\KlabEchoPostType;


use Roots\Sage\KlabPostSection\KlabInMediaSection;

class KlabInMedia extends KlabAbstractEchoPostType
{

    const POST_TYPE_SLUG = 'klab_lab_in_media';
    const BLOCK_MODIFIER = 'inMedia';
    const MONTHS = array(
        '01' => 'Tammikuu',
        '02' => 'Helmikuu',
        '03' => 'Maaliskuu',
        '04' => 'Huhtikuu',
        '05' => 'Toukokuu',
        '06' => 'Kesäkuu',
        '07' => 'Heinäkuu',
        '08' => 'Elokuu',
        '09' => 'Syyskuu',
        '10' => 'Lokakuu',
        '11' => 'Marraskuu',
        '12' => 'Joulukuu'
    );
    private $month;
    private $year;

    public function __construct()
    {
        parent::__construct(self::POST_TYPE_SLUG, self::BLOCK_MODIFIER, array('posts_per_page' => 15));

    }

    protected function echoPostContent ()
    {
        global $wp_query;
        $savedQuery = $wp_query;

        $args = array (
            'posts_per_page' => -1,
            'orderby' => 'publish_date',
            'order' => 'DESC',
            'post_type' => $this::POST_TYPE_SLUG,

        );

        $wp_query = new \WP_Query( $args );

        $this->month = '';
        $this->year = '';

        if ($wp_query->have_posts() ) {

            while (have_posts()) : the_post();

                $this->echoWpLoopContents();

            endwhile;
        }
        $wp_query->reset_postdata();
        $wp_query = $savedQuery;
    }

    protected function echoWpLoopContents()
    {
        global $post;

        if (get_the_date('m', $post->ID) != $this->month || get_the_date('Y', $post->ID) != $this->year) {
            $this->month = get_the_date('m', $post->ID);
            $this->year = get_the_date('Y', $post->ID);

            ?>
            <div class="mdl-cell mdl-cell--12-col">
                <div class="postSection__title">
                    <h2 class="postSection__title-text"> <?php echo self::MONTHS[$this->month] . ' ' . $this->year ?></h2>
                </div>
            </div>
            <?php
        }

        $news = new KlabInMediaSection();
        $news->setTitle(get_the_title());
        $news->setContent(get_the_content());
        $news->setImage(get_the_post_thumbnail($post->ID, 'thumbnail'));

        $metadataArray =  get_post_meta( $post->ID);
        $url = $metadataArray["klab_lab_in_media_klabInMediaUrl"][0];
        $news->setUrl($url);

        $news->setSiteName($metadataArray['klab_lab_in_media_klabInMedia_site_name'][0]);

        $news->run();
    }

} ?>