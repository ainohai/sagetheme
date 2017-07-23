<?php
/**
 * Template Name: Three equal columns
 */


global $wp_query;

//TODO: Refactor like the rest.
Roots\Sage\KlabTemplFunctions\echoDivider();
echo '<div class="postSection postSection--affiliateLinks">';
echo '<div class="mdl-grid">';
echo '<div class="mdl-cell mdl-cell--12-col">
          <div class="postSection__title">
              <h2 class="postSection__title-text">'.  get_the_title() . '</h2></div></div>';
echo '<div class="mdl-cell mdl-cell--12-col">';
echo '<div class="mdl-grid threeColumnContainer">';
Roots\Sage\KlabTemplFunctions\echo3Column();
Roots\Sage\KlabTemplFunctions\echo3Column('page_secondColumn');
Roots\Sage\KlabTemplFunctions\echo3Column('page_thirdColumn');
echo '</div></div>';

echo '</div></div>';


?>