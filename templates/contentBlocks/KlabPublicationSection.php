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
            '<span class="mdl-cell mdl-cell--12-col '. $this->sectionName . '__authors">'
            . $this->authors .
            ' </span><br>' : ''; ?>

        <?php
        if (!empty($this->title)) {
            echo $this->constructTitle();
            } ?>

        <?php    echo (!empty($this->publicationDetails)) ?
        '<span class="mdl-cell mdl-cell--12-col '. $this->sectionName . '__details">' .
        $this->publicationDetails
        . ' </span>'
        : ''; ?>

        <?php
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

        $title = $this->title;

        if (isset($this->pubmedGuid)) {
            $title = ' <a href ="' . $this::PUBMED_BASE_URL . $this->pubmedGuid . '">' . $title .'</a>';
        }

        $titleSpan = '<span class="mdl-cell mdl-cell--12-col ' . $this->sectionName . '__title">' .
        $title
        . ' </span>';

        return $titleSpan;

    }


}?>