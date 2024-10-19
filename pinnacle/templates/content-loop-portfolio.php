<?php
/**
 * Portfolio Summary Content Loop
 */
global $post, $kt_portfolio_loop;

$postsummery = get_post_meta( $post->ID, '_kad_post_summery', true );
?>
<div class="portfolio-item grid_item postclass kad-light-gallery kad_portfolio_fade_in">
	<?php
	if ( has_post_thumbnail( $post->ID ) ) {
			$img = pinnacle_get_image_array( $kt_portfolio_loop['slidewidth'], $kt_portfolio_loop['slideheight'], true, null, get_the_title(), get_post_thumbnail_id( $post->ID ), false );
			?>
			  <div class="portfolio-imagepadding">
				<div class="portfolio-hoverclass">
				  <a href="<?php the_permalink(); ?>" class="kt-portfoliolink">
					  <img src="<?php echo esc_url( $img['src'] ); ?>" width="<?php echo esc_attr( $img['width'] ); ?>" height="<?php echo esc_attr( $img['height'] ); ?>" alt="<?php echo esc_attr( $img['alt'] ); ?>" <?php echo wp_kses_post( $img['srcset'] ); ?> class="kad-lightboxhover">
							  <div class="portfolio-hoverover"></div>
							  <div class="portfolio-table">
								  <div class="portfolio-cell">
									<?php if ( $kt_portfolio_loop['pstyleclass'] == 'padded_style' ) { ?>
										  <a href="<?php the_permalink(); ?>" class="kad-btn kad-btn-primary"><?php echo __( 'View details', 'pinnacle' ); ?></a>
										  <?php if ( $kt_portfolio_loop['lightbox'] == 'true' ) { ?>
												<a href="<?php echo esc_url( $img['full'] ); ?>" class="kad-btn kad-btn-primary plightbox-btn" title="<?php the_title(); ?>" data-rel="lightbox"><i class="icon-search"></i></a>
										  <?php } ?>
								<?php } elseif ( $kt_portfolio_loop['pstyleclass'] == 'flat-no-margin' || $kt_portfolio_loop['pstyleclass'] == 'flat-w-margin' ) { ?>
										  <h5><?php the_title(); ?></h5>
										<?php
										if ( $kt_portfolio_loop['showtypes'] == 'true' ) {
											$terms = get_the_terms( $post->ID, 'portfolio-type' ); if ( $terms ) {
											?>
										  <p class="cportfoliotag">
												<?php
												$output = array();
												foreach ( $terms as $term ) {
													$output[] = $term->name;
												} echo implode( ', ', $output );
												?>
											</p> 
												<?php
											}
										}
										if ( $kt_portfolio_loop['showexcerpt'] == 'true' ) {
											?>
									  <p class="p_excerpt"><?php echo pinnacle_excerpt( 16 ); ?></p> 
											<?php
										}
										if ( $kt_portfolio_loop['lightbox'] == 'true' ) {
											?>
											<a href="<?php echo esc_url( $img['full'] ); ?>" class="kad-btn kad-btn-primary plightbox-btn" title="<?php the_title(); ?>" data-rel="lightbox"><i class="icon-search"></i></a>
											  <?php } ?>
								<?php } ?>
								  </div>
							  </div>
									</a>
								  </div>
							  </div>
					<?php } ?>

				<?php if ( $kt_portfolio_loop['pstyleclass'] == 'padded_style' ) { ?>
			  <a href="<?php the_permalink(); ?>" class="portfoliolink">
				<div class="piteminfo">   
						  <h5><?php the_title(); ?></h5>
						  <?php
							if ( $kt_portfolio_loop['showtypes'] == 'true' ) {
								$terms = get_the_terms( $post->ID, 'portfolio-type' ); if ( $terms ) {
									?>
							  <p class="cportfoliotag">
									<?php
									$output = array();
									foreach ( $terms as $term ) {
										$output[] = $term->name;
									} echo implode( ', ', $output );
									?>
								</p> 
									<?php
								}
							}
							if ( $kt_portfolio_loop['showexcerpt'] == 'true' ) {
								?>
							<p><?php echo pinnacle_excerpt( 16 ); ?></p> 
							<?php } ?>
				  </div>
			  </a>
		  <?php } ?>
		  </div>
