<?php
/**
 * Pinnacle initial setup and constants
 *
 * @package Pinnacle Theme.
 */

/**
 * Pinnacle initial setup and constants
 */
function kadence_setup() {
	// Register Menus.
	register_nav_menus(
		array(
			'primary_navigation' => __( 'Primary Navigation', 'pinnacle' ),
			'topbar_navigation'  => __( 'Topbar Navigation', 'pinnacle' ),
			'footer_navigation'  => __( 'Footer Navigation', 'pinnacle' ),
		)
	);
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'title-tag' );
	add_image_size( 'pinnacle_widget-thumb', 60, 60, true );
	add_post_type_support( 'attachment', 'page-attributes' );
	add_theme_support( 'post-formats', array( 'gallery', 'image', 'video' ) );
	add_theme_support( 'automatic-feed-links' );
	add_editor_style( '/assets/css/editor-style.css' );
	global $pinnacle;
	// Gutenberg Support.
	add_theme_support(
		'editor-color-palette',
		array(
			array(
				'name'  => __( 'Primary Color', 'pinnacle' ),
				'slug'  => 'pinnacle-primary',
				'color' => ( isset( $pinnacle['primary_color'] ) && ! empty( $pinnacle['primary_color'] ) ? $pinnacle['primary_color'] : '#f3690e' ),
			),
			array(
				'name'  => __( 'Lighter Primary Color', 'pinnacle' ),
				'slug'  => 'pinnacle-primary-light',
				'color' => ( isset( $pinnacle['primary20_color'] ) && ! empty( $pinnacle['primary20_color'] ) ? $pinnacle['primary20_color'] : '#f5873f' ),
			),
			array(
				'name'  => __( 'Very light gray', 'pinnacle' ),
				'slug'  => 'very-light-gray',
				'color' => '#eee',
			),
			array(
				'name'  => esc_html__( 'White', 'pinnacle' ),
				'slug'  => 'white',
				'color' => '#fff',
			),
			array(
				'name'  => __( 'Very dark gray', 'pinnacle' ),
				'slug'  => 'very-dark-gray',
				'color' => '#444',
			),
			array(
				'name'  => esc_html__( 'Black', 'pinnacle' ),
				'slug'  => 'black',
				'color' => '#000',
			),
		)
	);
	add_theme_support( 'align-wide' );
	add_theme_support( 'responsive-embeds' );
}
add_action( 'after_setup_theme', 'kadence_setup' );

