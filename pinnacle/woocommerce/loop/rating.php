<?php
/**
 * Loop Rating
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.6.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly.

global $product, $pinnacle;

if ( function_exists( 'wc_review_ratings_enabled' ) ) {
	if ( ! wc_review_ratings_enabled() ) {
		return;
	}
} else if ( get_option( 'woocommerce_enable_review_rating' ) == 'no' ) {
	return;
}
if ( isset( $pinnacle['shop_rating'] ) ) {
	$show_rating = $pinnacle['shop_rating'];
} else {
	$show_rating = 1;
}
	if ( '1' == $show_rating ) {
		$rating_html = wc_get_rating_html( $product->get_average_rating() );
		if ( $rating_html ) { ?>
				<a href="<?php the_permalink(); ?>"><?php echo $rating_html; ?></a>
	<?php } else { 
			echo '<span class="notrated">'.__('not rated', 'pinnacle').'</span>'; 
		} 
	}
