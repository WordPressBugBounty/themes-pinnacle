<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive.
 *
 * Override this template by copying it to yourtheme/woocommerce/archive-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.4.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
 	get_header();
	
	get_template_part('templates/shop/shop', 'page-header'); ?>

		<div id="content" class="container">
   			<div class="row">
     			<div class="main <?php echo esc_attr( pinnacle_main_class() ); ?>" role="main">
     			<?php 

     			do_action( 'woocommerce_before_main_content' );


			/**
			 * woocommerce_archive_description hook.
			 *
			 * @hooked woocommerce_taxonomy_archive_description - 10
			 * @hooked woocommerce_product_archive_description - 10
			 */
			do_action( 'woocommerce_archive_description' );

			if ( have_posts() ) {

				/**
				 * woocommerce_before_shop_loop hook
				 * @hooked woocommerce_result_count - 20
				 * @hooked woocommerce_catalog_ordering - 30
				 */
				do_action( 'woocommerce_before_shop_loop' );
				
				woocommerce_product_loop_start();

					if ( version_compare( WC_VERSION, '3.3', '>' ) ) {
						
						if ( wc_get_loop_prop( 'total' ) ) {

							while ( have_posts() ) : the_post();
								/**
								 * Hook: woocommerce_shop_loop.
								 *
								 * @hooked WC_Structured_Data::generate_product_data() - 10
								 */
								do_action( 'woocommerce_shop_loop' );

								wc_get_template_part( 'content', 'product' );

							endwhile; // end of the loop. 

						}
					} else {
						while ( have_posts() ) : the_post();

								wc_get_template_part( 'content', 'product' );

						endwhile; // end of the loop. 
					}

					woocommerce_product_loop_end();
				/**
				 * woocommerce_after_shop_loop hook
				 *
				 * @hooked woocommerce_pagination - 10
				 */
				do_action( 'woocommerce_after_shop_loop' );
			} else {
					if ( version_compare( WC_VERSION, '3.3', '<' ) ) {
						if ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) {
							wc_get_template( 'loop/no-products-found.php' );
						}
					} else {
						/**
						 * Hook: woocommerce_no_products_found.
						 *
						 * @hooked wc_no_products_found - 10
						 */
						do_action( 'woocommerce_no_products_found' );
					}

				} ?>
				</div>
				<?php 
					do_action( 'woocommerce_after_main_content' );


				get_sidebar(); ?>
	      	</div><!-- /.row-->
   		</div><!-- /.content -->
  </div><!-- /.wrap -->
  <?php get_footer(); ?>