<?php 
add_action( 'woocommerce_before_shop_loop', 'pinnacle_woo_archive_top', 20 );
function pinnacle_woo_archive_top() {
	?>
	<div class="kad-shop-top">
		<div class="row">
			<div class="col-md-6 col-sm-6 col-xs-6">
				<?php woocommerce_result_count(); ?>
			</div>
			<div class="col-md-6 col-sm-6 col-xs-6">
				<?php woocommerce_catalog_ordering(); ?>
			</div>
		</div>
	</div>
	<?php 
}
add_action( 'woocommerce_before_shop_loop', 'pinnacle_woo_cat_loop', 60 );
function pinnacle_woo_cat_loop() {
	if ( version_compare( WC_VERSION, '3.3', '<' ) ) {
		if ( ! is_search() ) {
			global $woocommerce_loop;
			?>
			<div class="clearfix <?php echo pinnacle_category_layout_css(); ?> rowtight product_category_padding"> 
				<?php
				if ( empty( $woocommerce_loop['columns'] ) ) $woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 );
					woocommerce_product_subcategories();
				?>
			</div>
			<?php 
		}
	}
}