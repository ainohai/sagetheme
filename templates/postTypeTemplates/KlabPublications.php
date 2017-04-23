<?php
/**
 * Created by PhpStorm.
 * User: aino
 * Date: 17.4.2017
 * Time: 9:36
 */

namespace Roots\Sage\KlabEchoPostType;


use Roots\Sage\KlabPostSection\KlabPublicationSection;

class KlabPublications extends KlabAbstractEchoPostType
{

    const POST_TYPE_SLUG = 'klab_publication';
    const BLOCK_MODIFIER = 'publicationsList';
    const SELECTED_TITLE = 'Selected publications';
    const ALL_TITLE = 'Full list of publications';

    public function __construct($onlySelectedPublications = false, $htmlSection = false)
    {
        $pubsFilter = null;
        if ($onlySelectedPublications) {
            $pubsFilter = array('meta_key' => 'klab_publication_selectedPublication',
                'meta_value_num' => 1);
        }
        parent::__construct(self::POST_TYPE_SLUG, self::BLOCK_MODIFIER, $pubsFilter, $htmlSection);

        $listTitle = $onlySelectedPublications ? $this::SELECTED_TITLE : $this::ALL_TITLE;
        $this->setListTitle($listTitle);

    }

    protected function echoWpLoopContents()
    {
        global $post;
        $publications = new KlabPublicationSection();
        $metadataArray =  get_post_meta( $post->ID);
        $authors = $metadataArray["klab_publication_authors"][0] .".";
        $publicationDetails = $this->publicationDetails($metadataArray);
        $publications->setTitle(get_the_title());
        $publications->setAuthors($authors);
        $publications->setPublicationDetails($publicationDetails);
        $publications->setPubmedGuid($metadataArray['klab_publication_uid'][0]);

        $publications->run();
    }

    private function publicationDetails($metaDataArray){
    /*    klab_publication_authors : Array ( [0] => Wiese KE, Haikala HM, von Eyss B, Wolf E, Esnault C, Rosenwald A, Treisman R, Klefström J, Eilers M )
klab_publication_source : Array ( [0] => EMBO J )
klab_publication_uid : Array ( [0] => 25896507 )
klab_publication_pubdate : Array ( [0] => 2015 Jun 3 )
klab_publication_volume : Array ( [0] => 34 )
klab_publication_issue : Array ( [0] => 11 )
klab_publication_pages : Array ( [0] => 1554-71 )
klab_publication_fulljournalname : Array ( [0] => The EMBO journal )
klab_publication_booktitle : Array ( [0] => )
klab_publication_medium : Array ( [0] => )
klab_publication_edition : Array ( [0] => )
klab_publication_publisherlocation : Array ( [0] => )
klab_publication_publishername : Array ( [0] => )
_edit_lock : Array ( [0] => 1492371853:1 )
_edit_last : Array ( [0] => 1 )
klab_publication_selectedPublication : Array ( [0] => on )


        Tieteelliset artikkelit muotoa Tekijät. Otsikko. Lehti Issue:sivut, vuosi.
        Kirjat muotoa Tekijät. Otsikko. In book: editorit (eds) kirjan nimi. Kustantaja (vuosi). Sivut
*/
    $publicationDetails = '';
    $journal = $metaDataArray['klab_publication_fulljournalname'][0];
    $issue = $metaDataArray['klab_publication_issue'][0];
    $pages = $metaDataArray['klab_publication_pages'][0];
    $year = $this->extractPublicationYear($metaDataArray);
    $book = $metaDataArray['klab_publication_booktitle'][0];

    if (isset($journal)) {
        //TODO: Move <strong> to template class where it belongs.
        $publicationDetails .= "<strong>" .$journal . "</strong>";

        if (isset($issue)) {
            $publicationDetails .= " " . $issue;
            if (isset($pages)) {
                $publicationDetails .= ":" . $pages;
            }
        }

        if (isset($year)) {
            $publicationDetails .= ", " . $year;
        }
    }

    else if (isset($book)) {
        $publicationDetails .= "In book: " . $book;
    }

    $publicationDetails .= ".";

        return $publicationDetails;

    }

    private function extractPublicationYear($metadata) {
        $pubdate = $metadata['klab_publication_pubdate'][0];
        $dateArr = explode(' ', $pubdate);
        return $dateArr[0];
    }
} ?>