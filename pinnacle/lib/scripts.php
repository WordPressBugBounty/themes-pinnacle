<?php
/**
 * Enqueue scripts and stylesheets
 *
 * @package Pinnacle Theme.
 */

/**
 * Enqueue scripts and stylesheets
 */
function pinnacle_scripts() {
	global $pinnacle;

	wp_enqueue_style( 'pinnacle_theme', get_template_directory_uri() . '/assets/css/pinnacle.css', false, '185' );
	if ( isset( $pinnacle['skin_stylesheet'] ) && ! empty( $pinnacle['skin_stylesheet'] ) ) {
		$skin = $pinnacle['skin_stylesheet'];
	} else {
		$skin = 'default.css';
	}
	wp_enqueue_style( 'pinnacle_skin', get_template_directory_uri() . '/assets/css/skins/' . $skin, false, null );

	if ( is_child_theme() ) {
		wp_enqueue_style( 'pinnacle_child', get_stylesheet_uri(), false, null );
	}
	if ( is_rtl() ) {
		wp_enqueue_style( 'pinnacle_rtl', get_template_directory_uri() . '/assets/css/rtl.css', false, '184' );
	}
	if ( is_single() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	wp_enqueue_script( 'modernizr', get_template_directory_uri() . '/assets/js/vendor/modernizr-2.7.0.min.js', array( 'jquery' ), null, false );
	wp_enqueue_script( 'masonry' );
	wp_enqueue_script( 'pinnacle_plugins', get_template_directory_uri() . '/assets/js/min/kt_plugins.min.js', array( 'jquery' ), 184, true );
	wp_enqueue_script( 'pinnacle_main', get_template_directory_uri() . '/assets/js/min/kt_main.min.js', array( 'jquery' ), 184, true );

	if ( class_exists( 'woocommerce' ) ) {
		wp_enqueue_script( 'kt-wc-add-to-cart-variation', get_template_directory_uri() . '/assets/js/min/kt-add-to-cart-variation-min.js', array( 'jquery' ), false, '175', true );
		if ( isset( $pinnacle['product_quantity_input'] ) && '1' === $pinnacle['product_quantity_input'] || ! isset( $pinnacle['product_quantity_input'] ) ) {
			wp_enqueue_script( 'wcqi-js', get_template_directory_uri() . '/assets/js/min/wc-quantity-increment.min.js', array( 'jquery' ), false, '184', true );
		}
	}

}
add_action( 'wp_enqueue_scripts', 'pinnacle_scripts', 100 );

/**
 * Add Respond.js for IE8 support of media queries
 */
function pinnacle_ie_support_header() {
	wp_enqueue_script( 'pinnacle-respond', get_template_directory_uri() . '/assets/js/vendor/respond.min.js' );
	wp_script_add_data( 'pinnacle-respond', 'conditional', 'lt IE 9' );
}
add_action( 'wp_enqueue_scripts', 'pinnacle_ie_support_header', 15 );
