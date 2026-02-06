<?php
/**
 * Single Product Image
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     9.7.0
 */


if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// Note: `wc_get_gallery_image_html` was added in WC 3.3.2 and did not exist prior. This check protects against theme overrides being used on older versions of WC.
if ( ! function_exists( 'wc_get_gallery_image_html' ) ) {
	return;
}

global $post, $woocommerce, $product, $pinnacle;
$columns           = apply_filters( 'woocommerce_product_thumbnails_columns', 5 );
$post_thumbnail_id = $product->get_image_id();
$full_size_image   = wp_get_attachment_image_src( $post_thumbnail_id, 'full' );
$image_title       = get_post_field( 'post_excerpt', $post_thumbnail_id );
if ( ! empty( $image_title ) ) {
	$light_title = $image_title;
} else {
	$light_title = get_the_title( $post_thumbnail_id );
}
$wrapper_classes = apply_filters( 'woocommerce_single_product_image_gallery_classes', array(
	'woocommerce-product-gallery',
	'woocommerce-product-gallery--' . ( $product->get_image_id() ? 'with-images' : 'without-images' ),
	'woocommerce-product-gallery--columns-' . absint( $columns ),
	'images',
	'kad-light-gallery',
) );
if ( version_compare( WC_VERSION, '3.0', '>' ) ) {
	if ( isset( $pinnacle['product_gallery_slider'] ) && 1 == $pinnacle['product_gallery_slider'] ) {
		$galleryslider = 'woo_product_slider_enabled';
		$galslider = true;
	} else {
		$galleryslider = 'woo_product_slider_disabled';
		$galslider = false;
	}
	if ( isset( $pinnacle['product_gallery_zoom'] ) && 1 == $pinnacle['product_gallery_zoom'] ) {
		$galleryzoom = 'woo_product_zoom_enabled';
		$galzoom = true;
	} else {
		$galleryzoom = 'woo_product_zoom_disabled';
		$galzoom = false;
	}
} else {
	$galleryslider = 'woo_product_slider_disabled';
	$galslider = false;
	$galleryzoom = 'woo_product_zoom_disabled';
	$galzoom = false;
}
if ( isset( $pinnacle['product_simg_resize'] ) && 0 == $pinnacle['product_simg_resize'] ) {
	$presizeimage = 0;
} else {
	$presizeimage     = 1;
	$productimgwidth  = 456;
	$productimgheight = $productimgwidth;	
}
?>
<div class="<?php echo esc_attr( implode( ' ', array_map( 'sanitize_html_class', $wrapper_classes ) ) ); ?>" data-columns="<?php echo esc_attr( $columns ); ?>" style="opacity: 0; transition: opacity .25s ease-in-out;">
	<div class="woocommerce-product-gallery__wrapper <?php echo esc_attr( $galleryslider . ' ' . $galleryzoom ); ?>">
	<?php
		if ( ! $galslider ) {
			echo '<div class="product_image postclass">';
		}
		$attributes = array(
			'title'                   => $image_title,
			'data-caption'            => get_post_field( 'post_excerpt', $post_thumbnail_id ),
			'data-src'                => $full_size_image ? $full_size_image[0] : '',
			'data-large_image'        => $full_size_image ? $full_size_image[0] : '',
			'data-large_image_width'  => $full_size_image ? $full_size_image[1] : '',
			'data-large_image_height' => $full_size_image ? $full_size_image[2] : '',
		);
		if ( has_post_thumbnail() ) {
			if ( $presizeimage == 1 ) {
				$alt = esc_attr( get_post_meta( get_post_thumbnail_id(), '_wp_attachment_image_alt', true ) );
				if ( ! empty( $alt ) ) {
					$alttag	= $alt;
				} else {
					$alttag	= $light_title;
				}
		        $html  = '<div data-thumb="' . get_the_post_thumbnail_url( $post->ID, 'shop_thumbnail' ) . '" class="woocommerce-product-gallery__image"><a href="' . esc_url( $full_size_image[0] ) . '" title="' . esc_attr( $light_title ) . '">';
				$html .= pinnacle_get_full_image_output( $productimgwidth, $productimgheight, true, 'attachment-shop_single shop_single wp-post-image', $alttag, $post_thumbnail_id, false, false, false, $attributes );
				$html .= '</a></div>';
			} else {
				$html  = '<div data-thumb="' . get_the_post_thumbnail_url( $post->ID, 'shop_thumbnail' ) . '" class="woocommerce-product-gallery__image"><a href="' . esc_url( $full_size_image[0] ) . '">';
				$html .= get_the_post_thumbnail( $post->ID, 'shop_single', $attributes );
				$html .= '</a></div>';
			}
		} else {
			$wrapper_classname = $product->is_type( 'variable' ) && ! empty( $product->get_available_variations( 'image' ) ) ?
				'woocommerce-product-gallery__image woocommerce-product-gallery__image--placeholder' :
				'woocommerce-product-gallery__image--placeholder';
			$html  = sprintf( '<div class="%s">', esc_attr( $wrapper_classname ) );
			$html .= sprintf( '<img src="%s" alt="%s" class="wp-post-image" />', esc_url( wc_placeholder_img_src( 'woocommerce_single' ) ), esc_html__( 'Awaiting product image', 'pinnacle' ) );
			$html .= '</div>';
		}

		echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', $html, $post_thumbnail_id );
		if ( ! $galslider ) {
			echo '</div>';
		}
		if ( ! $galslider ) {
			echo '<div class="product_thumbnails thumbnails">';
		}
		do_action( 'woocommerce_product_thumbnails' ); 
		if ( ! $galslider ) {
			echo '</div>';
		}
		?>		
	</div>
</div>
