<?php
function pinnacle_lazy_load_filter() {
	$lazy = false;
	if ( function_exists( 'get_rocket_option' ) && get_rocket_option( 'lazyload' ) ) {
		$lazy = true;
	}
	return apply_filters( 'pinnacle_lazy_load', $lazy );
}
add_filter( 'max_srcset_image_width', 'pinnacle_srcset_max' );
function pinnacle_srcset_max( $string ) {
	return 2000;
}
function pinnacle_img_placeholder() {
	return apply_filters( 'kadence_placeholder_image', get_template_directory_uri() . '/assets/img/post_standard.jpg' );
}
function pinnacle_img_placeholder_cat() {
	return apply_filters( 'kadence_placeholder_image', get_template_directory_uri() . '/assets/img/placement.jpg' );
}
function pinnacle_img_placeholder_small() {
	return apply_filters( 'kadence_placeholder_image_small', get_template_directory_uri() . '/assets/img/post_standard-60x60.jpg' );
}
function pinnacle_post_default_placeholder_override() {
	global $pinnacle;
	$custom_image = $pinnacle['post_summery_default_image']['url'];
	return $custom_image;
}
add_action( 'init', 'kt_check_for_post_image' );
function kt_check_for_post_image() {
	global $pinnacle;
	if ( isset( $pinnacle['post_summery_default_image'] ) && ! empty( $pinnacle['post_summery_default_image']['url'] ) ) {
		add_filter( 'kadence_placeholder_image_small', 'pinnacle_post_default_placeholder_override' );
		add_filter( 'kadence_post_default_placeholder_image', 'pinnacle_post_default_placeholder_override' );
		add_filter( 'kadence_post_default_placeholder_image_square', 'pinnacle_post_default_placeholder_override' );
	}
}
function pinnacle_default_placeholder_image_url() {
	return apply_filters( 'pinnacle_default_placeholder_image_url', get_template_directory_uri() . '/assets/img/placeholder-min.jpg' );
}
function pinnacle_get_options_placeholder_image() {
	global $pinnacle;
	if ( isset( $pinnacle['post_summery_default_image'] ) && isset( $pinnacle['post_summery_default_image']['id'] ) && ! empty( $pinnacle['post_summery_default_image']['id'] ) ) {
		return $pinnacle['post_summery_default_image']['id'];
	} else {
		return '';
	}
}
function pinnacle_get_image_array( $width = null, $height = null, $crop = true, $class = null, $alt = null, $id = null, $placeholder = false ) {
	if ( empty( $id ) ) {
		$id = get_post_thumbnail_id();
	}
	if ( empty( $id ) ) {
		if ( $placeholder == true ) {
			$id = pinnacle_get_options_placeholder_image();
		}
	}
	if ( ! empty( $id ) ) {
		$pinnacle_Get_Image = Pinnacle_Get_Image::getInstance();
		$image = $pinnacle_Get_Image->process( $id, $width, $height );
		if ( empty( $alt ) ) {
			$alt = get_post_meta( $id, '_wp_attachment_image_alt', true );
		}
		$return_array = array(
			'src' => $image[0],
			'width' => $image[1],
			'height' => $image[2],
			'srcset' => $image[3],
			'class' => $class,
			'alt' => $alt,
			'full' => $image[4],
		);
	} else if ( empty( $id ) && $placeholder == true ) {
		if ( empty( $height ) ) {
			$height = $width;
		}
		if ( empty( $width ) ) {
			$width = $height;
		}
		$return_array = array(
			'src' => pinnacle_default_placeholder_image_url(),
			'width' => $width,
			'height' => $height,
			'srcset' => '',
			'class' => $class,
			'alt' => $alt,
			'full' => pinnacle_default_placeholder_image_url(),
		);
	} else {
		$return_array = array(
			'src' => '',
			'width' => '',
			'height' => '',
			'srcset' => '',
			'class' => '',
			'alt' => '',
			'full' => '',
		);
	}

	return $return_array;
}

function pinnacle_get_full_image_output( $width = null, $height = null, $crop = true, $class = null, $alt = null, $id = null, $placeholder = false, $lazy = false, $schema = true, $extra = null ) {
	$img = pinnacle_get_image_array( $width, $height, $crop, $class, $alt, $id, $placeholder );
	if ( $lazy ) {
		if ( pinnacle_lazy_load_filter() ) {
			$image_src_output = 'src="data:image/gif;base64,R0lGODdhAQABAPAAAP///wAAACwAAAAAAQABAEACAkQBADs=" data-lazy-src="' . esc_url( $img['src'] ) . '" ';
		} else {
			$image_src_output = 'src="' . esc_url( $img['src'] ) . '"';
		}
	} else {
		$image_src_output = 'src="' . esc_url( $img['src'] ) . '"';
	}
	$extras = '';
	if ( is_array( $extra ) ) {
		foreach ( $extra as $key => $value ) {
			$extras .= esc_attr( $key ) . '="' . esc_attr( $value ) . '" ';
		}
	} else {
		$extras = $extra;
	}
	if ( ! empty( $img['src'] ) && $schema == true ) {
		$output = '<div itemprop="image" itemscope itemtype="http://schema.org/ImageObject">';
		$output .= '<img ' . $image_src_output . ' width="' . esc_attr( $img['width'] ) . '" height="' . esc_attr( $img['height'] ) . '" ' . $img['srcset'] . ' class="' . esc_attr( $img['class'] ) . '" itemprop="contentUrl" alt="' . esc_attr( $img['alt'] ) . '" ' . $extras . '>';
		$output .= '<meta itemprop="url" content="' . esc_url( $img['src'] ) . '">';
		$output .= '<meta itemprop="width" content="' . esc_attr( $img['width'] ) . 'px">';
		$output .= '<meta itemprop="height" content="' . esc_attr( $img['height'] ) . 'px">';
		$output .= '</div>';
		return $output;

	} elseif ( ! empty( $img['src'] ) ) {
		return '<img ' . $image_src_output . ' width="' . esc_attr( $img['width'] ) . '" height="' . esc_attr( $img['height'] ) . '" ' . $img['srcset'] . ' class="' . esc_attr( $img['class'] ) . '" alt="' . esc_attr( $img['alt'] ) . '" ' . $extras . '>';
	} else {
		return null;
	}
}
