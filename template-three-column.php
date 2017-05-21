<?php
/**
 * Template Name: Three equal columns
 */


global $wp_query;

//TODO: Refactor like the rest.

echo '<div class="mdl-grid postSection postSection--affiliateLinks">';
echo '<div class="mdl-cell mdl-cell--12-col"><h2>'.  get_the_title() . '</h2></div>';

Roots\Sage\KlabTemplFunctions\echo3Column();
Roots\Sage\KlabTemplFunctions\echo3Column('page_secondColumn');
Roots\Sage\KlabTemplFunctions\echo3Column('page_thirdColumn');

echo '</div>';


?>