<?php
/**
 * Created by PhpStorm.
 * User: aino
 * Date: 17.4.2017
 * Time: 9:48
 */

namespace Roots\Sage\KlabPostSection;


class KlabPublicationSection extends KlabAbstractPostSection
{
    private $title;
    private $authors;
    private $publicationDetails;
    private $pubmedGuid;
    const PUBMED_BASE_URL = 'https://www.ncbi.nlm.nih.gov/pubmed/';
    const PUBLICATION = 'publicationItem';

    public function __construct() {

        parent::__construct($this::PUBLICATION);
    }

    public function echoContent()
    { ?>

        <?php
        echo (!empty($this->authors)) ?
            '<span class="'. $this->sectionName . '__authors">'
            . $this->authors .
            ' </span><br>' : ''; ?>

        <?php
        if (!empty($this->title)) {
            echo $this->constructTitle();
            } ?>

        <?php    echo (!empty($this->publicationDetails)) ?
        '<span class="'. $this->sectionName . '__details">' .
        $this->publicationDetails
        . ' </span>'
        : ''; ?>

        <?php
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @param mixed $authors
     */
    public function setAuthors($authors)
    {
        $this->authors = $authors;
    }

    /**
     * @param mixed $publicationDetails
     */
    public function setPublicationDetails($publicationDetails)
    {
        $this->publicationDetails = $publicationDetails;
    }

    /**
     * @param string $pubmedGuid
     */
    public function setPubmedGuid($pubmedGuid)
    {
        $this->pubmedGuid = $pubmedGuid;
    }

    private function constructTitle() {
        $titleSpan = '<span class="' . $this->sectionName . '__title">' .
        $this->title
        . ' </span>';

        if (isset($this->pubmedGuid)) {
            return ' <a href ="' . $this::PUBMED_BASE_URL . $this->pubmedGuid . '">' . $titleSpan .'</a>';
        }

        return $titleSpan;

    }


}?>