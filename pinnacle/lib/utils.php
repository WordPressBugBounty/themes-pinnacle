<?php
/**
 * Utility functions.
 *
 * @package Pinnacle Theme
 */

/**
 * Page titles
 */
function pinnacle_title() {
	if ( is_home() ) {
		if ( get_option( 'page_for_posts', true ) ) {
			$title = get_the_title( get_option( 'page_for_posts', true ) );
		} else {
			$title = __( 'Latest Posts', 'pinnacle' );
		}
	} elseif ( is_archive() ) {
		$title = get_the_archive_title();
	} elseif ( is_search() ) {
		/* translators: %s is the search term */
		$title = sprintf( __( 'Search Results for %s', 'pinnacle' ), get_search_query() );
	} elseif ( is_404() ) {
		$title = __( 'Not Found', 'pinnacle' );
	} else {
		$title = get_the_title();
	}
	return apply_filters( 'kadence_title', $title );
}

/**
 * Filter for archive titles
 *
 * @param string $title the archive title.
 */
function pinnacle_filter_archive_title( $title ) {
		$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
	if ( is_category() ) {
		$title = single_cat_title( '', false );
	} elseif ( is_tag() ) {
		$title = single_tag_title( '', false );
	} elseif ( is_author() ) {
		/* translators: %s is the author name */
		$title = sprintf( __( 'Author: %s', 'pinnacle' ), get_the_author() );
	} else if ( $term ) {
		$title = $term->name;
	} elseif ( is_day() ) {
		/* translators: %s is the day */
		$title = sprintf( __( 'Day: %s', 'pinnacle' ), get_the_date() );
	} elseif ( is_month() ) {
		/* translators: %s is the month */
		$title = sprintf( __( 'Month: %s', 'pinnacle' ), get_the_date( 'F Y' ) );
	} elseif ( is_year() ) {
		/* translators: %s is the year */
		$title = sprintf( __( 'Year: %s', 'pinnacle' ), get_the_date( 'Y' ) );
	}
		return $title;
}
add_filter( 'get_the_archive_title', 'pinnacle_filter_archive_title' );
