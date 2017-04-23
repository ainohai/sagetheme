<?php

namespace Roots\Sage\KlabLabMembers;
use Roots\Sage\KlabPostSection\KlabLabMemberSection;
use Roots\Sage\KlabTemplFunctions;
use Roots\Sage\KlabEchoPostType;

class KlabLabMembers extends KlabEchoPostType\KlabAbstractEchoPostType  {

    const POST_TYPE_SLUG = 'klab_lab_member';
    const BLOCK_MODIFIER = 'klabLabMember';
    const ALUMNI_TERM_ID = 836;
    private $terms;
    private $justAlumni;

    public function __construct($justAlumni = false)
    {
        parent::__construct(self::POST_TYPE_SLUG, self::BLOCK_MODIFIER);
        $this->terms = get_terms( 'labMemberPosition', array(
            'orderby' => 'term_order'
        ));
        $this->justAlumni = $justAlumni;
    }

    protected function echoPostContent ()
    {
        global $wp_query;
        $savedQuery = $wp_query;
        $wp_query = $this->wpQuery;

        if ($wp_query->have_posts() ) {

            $this->echoWpLoopContents();

        }
        $wp_query->reset_postdata();
        $wp_query = $savedQuery;
    }

    protected function echoWpLoopContents ()
    {

        $labQuery = $this->wpQuery;

        global $post;
        $temp = $post;

        echo '<section class ="'. KlabTemplFunctions\constructWrapperSectionClasses() .'">';

                    $resultArray = KlabTemplFunctions\getPostsOrderedByTaxonomyCats('labMemberPosition', $labQuery);
                    foreach ($this->terms as $term) {

                        if ((!$this->justAlumni && $term->term_id != $this::ALUMNI_TERM_ID) ||
                              $this->justAlumni && $term->term_id == $this::ALUMNI_TERM_ID) {

                            $postArray = $resultArray[$term->slug];

                            ?>

                            <div class="mdl-cell mdl-cell--9-col ">
                                <h2><?php echo $term->name ?></h2>
                            </div>


                            <?php
                            foreach ($postArray as $member) {

                                $post = $member;

                                $metadataArray =  get_post_meta( $post->ID);
                                $memberTitle = isset($metadataArray["klab_lab_member_klabMemberTitle"]) ? $metadataArray["klab_lab_member_klabMemberTitle"][0] :'';
                                $currentPos = isset($metadataArray["klab_lab_member_klabMemberCurrentPosition"]) ? $metadataArray["klab_lab_member_klabMemberCurrentPosition"][0] :'';
                                $description = isset($metadataArray["klab_lab_member_klabMemberDescription"]) ? $metadataArray["klab_lab_member_klabMemberDescription"][0] :'';

                                $labMember = new KlabLabMemberSection($this->justAlumni);
                                $labMember->setLabMemberName(get_the_title());
                                //imagesize = thumbnail
                                $labMember->setLabMemberImage(get_the_post_thumbnail());
                                $labMember->setLabMemberTitle($memberTitle);
                                $labMember->setLabMemberCurrentPosition($currentPos);
                                $labMember->setLabMemberDescription($description);

                                $labMember->run();

                            }

                        }
                    }
                echo '</section>';
                $post = $temp;
    }

    protected function afterButtons() {
        $this->addButton(admin_url( 'edit-tags.php?taxonomy=labMemberPosition&post_type=klab_lab_member'), 'Lab Member Categories');
        $this->addButton(admin_url( 'edit.php?post_type='.$this->postTypeSlug .'&page=order-post-types-'.$this->postTypeSlug), 'Reorder Categories');

    }
}?>