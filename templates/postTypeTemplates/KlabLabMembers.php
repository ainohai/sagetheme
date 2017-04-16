<?php

namespace Roots\Sage\KlabLabMembers;
use Roots\Sage\KlabTemplFunctions;
use Roots\Sage\KlabSingleColCard;
use Roots\Sage\KlabEchoPostType;

class KlabLabMembers extends KlabEchoPostType\KlabAbstractEchoPostType  {

    const POST_TYPE_SLUG = 'klab_lab_member';
    const BLOCK_MODIFIER = 'klabLabMember';
    private $terms;

    public function __construct()
    {
        parent::__construct(self::POST_TYPE_SLUG, self::BLOCK_MODIFIER);
        $this->terms = get_terms( 'labMemberPosition', array(
            'orderby' => 'term_order'
        ));
    }

    protected function echoPostContent ()
    {
        global $wp_query;
        $savedQuery = $wp_query;
        $wp_query = $this->wpQuery;

        if ($wp_query->have_posts() ) {

            $this->echoWpLoop();

        }
        $wp_query->reset_postdata();
        $wp_query = $savedQuery;
    }

    protected function echoWpLoop ()
    {
        $labQuery = $this->wpQuery;
?>
        <div class="mdl-grid">
                    <?php
                    $resultArray = KlabTemplFunctions\getPostsOrderedByTaxonomyCats('labMemberPosition', $labQuery);
                    foreach ($this->terms as $term) {
                        $postArray = $resultArray[$term->slug];

                        ?>

                        <div class="mdl-cell mdl-cell--9-col ">
                            <h2><?php echo $term->name ?></h2>
                        </div>


                        <?php
                        foreach ($postArray as $member) {
                            global $post;
                            $post = $member;
                            $this->echoLabmember();
                        }

                    }
                    ?>
                </div>
<?php
    }

private function echoLabmember () {

        global $post;
        $blockName = 'labMember';
        $imageSize = 'thumbnail';
        ?>

        <div class="editableContent mdl-grid <?php echo $blockName; ?>"
             data-postTypeSlug="<?php echo get_post_type($post); ?>"
             data-id="<?php echo $post->ID; ?>" id="<?php echo $post->post_name ?>">



            <div class="mdl-cell  mdl-card mdl-cell--3-col">
                <div class="mdl-card__media">
                    <?php if (has_post_thumbnail($post->ID)) { ?>
                        <?php  the_post_thumbnail($imageSize);  ?>
                    <?php } else { ?>
                        <i class="material-icons  mdl-list__item-avatar">person</i>
                    <?php }?>
                </div>

            </div>

            <div class="mdl-cell mdl-cell--9-col mdl-card <?php echo $blockName . "__content" ?>">

                <h3 class="mdl-card__title-text"><?php the_title(); ?></h3>

                <?php
                $metadataArray =  get_post_meta( $post->ID);
                echo '<span class="'.$blockName.'__title">'. $metadataArray["klab_lab_member_klabMemberTitle"][0] .'</span>';
                ?>
                <div class="mdl-card__supporting-text">
                    <?php
                    echo '<p>'. $metadataArray['klab_lab_member_klabMemberDescription'][0].'</p>'?></div>

            </div>
        </div>

        <?php

    }

    protected function afterButtons() {
        $this->addButton(admin_url( 'edit-tags.php?taxonomy=labMemberPosition&post_type=klab_lab_member'), 'Lab Member Categories');
        $this->addButton(admin_url( 'edit.php?post_type='.$this->postTypeSlug .'&page=order-post-types-'.$this->postTypeSlug), 'Reorder Categories');

    }
}