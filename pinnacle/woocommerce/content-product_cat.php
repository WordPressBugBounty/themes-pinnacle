<?php
/**
 * The template for displaying product category thumbnails within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product-cat.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 4.7.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $woocommerce_loop, $pinnacle;

// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) ) {
	$woocommerce_loop['loop'] = 0; 
}
$woocommerce_loop['loop']++;

if (is_shop() || is_product_category() || is_product_tag() ) {
	if ( isset( $pinnacle['product_cat_layout']) ) {
		$product_cat_column = $pinnacle['product_cat_layout'];
	} else { 
		$product_cat_column = 3;
	}
} else {
	if ( empty( $woocommerce_loop['columns'] ) ) {
		$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 3 );
	}
	$product_cat_column = $woocommerce_loop['columns'];
}
if ( '3' == $product_cat_column ) { 
	$itemsize = 'tcol-md-4 tcol-sm-4 tcol-xs-6 tcol-ss-12'; 
} else if ( '5' == $product_cat_column ){
	$itemsize = 'tcol-md-25 tcol-sm-3 tcol-xs-4 tcol-ss-6';
} else {
	$itemsize = 'tcol-md-3 tcol-sm-4 tcol-xs-4 tcol-ss-6'; 
}
if ( ! is_shop() && ! is_product_category() && ! is_product_tag() ) {
	$woocommerce_loop['columns'] = $product_cat_column;
}
?>
<div class="<?php echo esc_attr( $itemsize ); ?> kad_shop_default kad_product">
	<div <?php wc_product_cat_class( 'product-category postclass grid_item ', $category ); ?>>
	<?php
	/**
	 * woocommerce_before_subcategory hook.
	 *
	 * @hooked woocommerce_template_loop_category_link_open - 10
	 */
	do_action( 'woocommerce_before_subcategory', $category );

	/**
	 * woocommerce_before_subcategory_title hook.
	 *
	 * @hooked woocommerce_subcategory_thumbnail - 10
	 */
	do_action( 'woocommerce_before_subcategory_title', $category );

	/**
	 * woocommerce_shop_loop_subcategory_title hook.
	 *
	 * @hooked woocommerce_template_loop_category_title - 10
	 */
	do_action( 'woocommerce_shop_loop_subcategory_title', $category );

	/**
	 * woocommerce_after_subcategory_title hook
	 */
	do_action( 'woocommerce_after_subcategory_title', $category );
	/**
	 * The woocommerce_after_subcategory hook.
	 *
	 * @hooked woocommerce_template_loop_category_link_close - 10
	 */
	do_action( 'woocommerce_after_subcategory', $category );
	?>
	</div>
</div>
