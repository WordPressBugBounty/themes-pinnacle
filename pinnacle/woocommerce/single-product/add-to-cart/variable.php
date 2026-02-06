<?php
/**
 * Variable product add to cart
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version 9.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product, $post, $pinnacle;

$attribute_keys  = array_keys( $attributes );
$variations_json = wp_json_encode( $available_variations );
$variations_attr = function_exists( 'wc_esc_json' ) ? wc_esc_json( $variations_json ) : _wp_specialchars( $variations_json, ENT_QUOTES, 'UTF-8', true );

do_action('woocommerce_before_add_to_cart_form'); ?>


<form class="variations_form cart" action="<?php echo esc_url( apply_filters( 'woocommerce_add_to_cart_form_action', $product->get_permalink() ) ); ?>" method="post" enctype='multipart/form-data' data-product_id="<?php echo absint( $product->get_id() ); ?>" data-product_variations="<?php echo $variations_attr; // WPCS: XSS ok. ?>">
	<?php do_action( 'woocommerce_before_variations_form' ); ?>

	<?php if ( empty( $available_variations ) && false !== $available_variations ) : ?>
		<p class="stock out-of-stock"><?php _e( 'This product is currently out of stock and unavailable.', 'pinnacle' ); ?></p>
	<?php else : ?>
	<table class="variations" cellspacing="0" role="presentation">
		<tbody>
			<?php foreach ( $attributes as $attribute_name => $options ) : ?>
				<tr>
					
					<th class="product_label"><label for="<?php echo esc_attr( sanitize_title( $attribute_name ) ); ?>"><?php echo wc_attribute_label( $attribute_name ); // WPCS: XSS ok. ?></label></th>
					<td class="product_value">
					<?php
								$selected = isset( $_REQUEST[ 'attribute_' . sanitize_title( $attribute_name ) ] ) ? wc_clean( $_REQUEST[ 'attribute_' . sanitize_title( $attribute_name ) ] ) : $product->get_variation_default_attribute( $attribute_name );
								wc_dropdown_variation_attribute_options( array( 'options' => $options, 'attribute' => $attribute_name, 'product' => $product, 'selected' => $selected, 'class'=>'kad-select') );
								/**
								 * Filters the reset variation button.
								 *
								 * @since 2.5.0
								 *
								 * @param string  $button The reset variation button HTML.
								 */
								echo end( $attribute_keys ) === $attribute_name ? wp_kses_post( apply_filters( 'woocommerce_reset_variations_link', '<a class="reset_variations" href="#" aria-label="' . esc_attr__( 'Clear options', 'pinnacle' ) . '">' . esc_html__( 'Clear selection', 'pinnacle' ) . '</a>' ) ) : '';
							?>

					</td>
				</tr>
	        <?php endforeach;?>
		</tbody>
	</table>
	<div class="reset_variations_alert screen-reader-text" role="alert" aria-live="polite" aria-relevant="all"></div>
	<?php do_action( 'woocommerce_after_variations_table' ); ?>
	<?php if ( version_compare( WC_VERSION, '3.4', '<' ) ) {
		do_action( 'woocommerce_before_add_to_cart_button' ); 
	} ?>

	<div class="single_variation_wrap_kad single_variation_wrap" style="display:block;">
		<?php 

		/**
		 * Hook: woocommerce_before_single_variation.
		 */
		do_action( 'woocommerce_before_single_variation' );

		/**
		* woocommerce_single_variation hook. Used to output the cart button and placeholder for variation data.
		* @since 2.4.0
		* @hooked woocommerce_single_variation - 10 Empty div for variation data.
		* @hooked woocommerce_single_variation_add_to_cart_button - 20 Qty and cart button.
		*/
		do_action( 'woocommerce_single_variation' );

		/**
		 * Hook: woocommerce_after_single_variation.
		 */
		do_action( 'woocommerce_after_single_variation' ); ?>

	</div>

	
	<?php if ( version_compare( WC_VERSION, '3.4', '<' ) ) {
		do_action( 'woocommerce_after_add_to_cart_button' ); 
	} ?>

	<?php endif; ?>
	<?php do_action( 'woocommerce_after_variations_form' ); ?>
</form>

<?php do_action('woocommerce_after_add_to_cart_form'); ?>
