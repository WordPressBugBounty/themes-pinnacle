<?php
/**
 * Front Page Template
 *
 * @package Pinnacle Theme
 */

get_header();

global $pinnacle;
if ( isset( $pinnacle['mobile_switch'] ) && '1' === $pinnacle['mobile_switch'] ) {
	if ( isset( $pinnacle['choose_mobile_slider'] ) && ! empty( $pinnacle['choose_mobile_slider'] ) ) {
		$m_home_header = $pinnacle['choose_mobile_slider'];
	} else {
		$m_home_header = '';
	}
	if ( 'flex' === $m_home_header ) {
		get_template_part( 'templates/mobile_home/mobileflex', 'slider' );
	} elseif ( 'pagetitle' === $m_home_header ) {
		get_template_part( 'templates/mobile_home/page-title', 'mhome' );
	} elseif ( 'video' === $m_home_header ) {
		get_template_part( 'templates/mobile_home/mobilevideo', 'block' );
	}
}
if ( isset( $pinnacle['choose_home_header'] ) && ! empty( $pinnacle['choose_home_header'] ) ) {
	$home_header = $pinnacle['choose_home_header'];
} else {
	$home_header = 'pagetitle';
}
if ( 'flex' === $home_header ) {
	get_template_part( 'templates/home/flex', 'slider' );
} elseif ( 'carousel' === $home_header ) {
	get_template_part( 'templates/home/carousel', 'slider' );
} elseif ( 'latest' === $home_header ) {
	get_template_part( 'templates/home/latest', 'slider' );
} elseif ( 'video' === $home_header ) {
	get_template_part( 'templates/home/video', 'block' );
} elseif ( 'pagetitle' === $home_header ) {
	get_template_part( 'templates/home/page-title', 'home' );
}
?>
<div id="content" class="container homepagecontent">
	<div class="row">
		<div class="main <?php echo esc_attr( pinnacle_main_class() ); ?>" role="main">
			<?php
			if ( isset( $pinnacle['homepage_layout']['enabled'] ) ) {
				$layout = $pinnacle['homepage_layout']['enabled'];
			} else {
				$layout = array(
					'block_four' => 'Page Content',
				);
			}
			if ( is_home() ) {
				if ( ! isset( $layout['block_four'] ) ) {
					$layout['block_four'] = 'Page Content';
				}
			}
			if ( $layout ) :
				foreach ( $layout as $key => $value ) {
					switch ( $key ) {

						case 'block_one':
							get_template_part( 'templates/home/callto', 'action' );
							break;

						case 'block_two':
							get_template_part( 'templates/home/example', 'iconmenu' );
							break;

						case 'block_four':
							if ( is_home() ) {
								global $postcolumn;
								if ( pinnacle_display_sidebar() ) {
									$display_sidebar = true;
									$fullclass       = '';
								} else {
									$display_sidebar = false;
									$fullclass       = 'fullwidth';
								}
								if ( isset( $pinnacle['home_post_summery'] ) && 'full' === $pinnacle['home_post_summery'] ) {
									$summary   = 'full';
									$postclass = 'single-article fullpost';
									$contentid = 'homelatestpost';
								} elseif ( isset( $pinnacle['home_post_summery'] ) && 'grid' === $pinnacle['home_post_summery'] ) {
									if ( isset( $pinnacle['home_post_grid_columns'] ) ) {
										$blog_grid_column = $pinnacle['home_post_grid_columns'];
									} else {
										$blog_grid_column = '3';
									}
									$summary   = 'grid';
									$postclass = 'postlist';
									$contentid = 'kad-blog-grid-case';
									if ( '2' === $blog_grid_column ) {
										$itemsize   = 'tcol-md-6 tcol-sm-6 tcol-xs-12 tcol-ss-12';
										$postcolumn = '2';
									} elseif ( '3' === $blog_grid_column ) {
										$itemsize   = 'tcol-md-4 tcol-sm-4 tcol-xs-6 tcol-ss-12';
										$postcolumn = '3';
									} else {
										$itemsize   = 'tcol-md-3 tcol-sm-4 tcol-xs-6 tcol-ss-12';
										$postcolumn = '4';
									}
								} else {
									$summary   = 'normal';
									$postclass = 'postlist';
									$contentid = 'homelatestpost';
								}
								?>
								<div id="<?php echo esc_attr( $contentid ); ?>" class="homecontent <?php echo esc_attr( $fullclass ); ?>  <?php echo esc_attr( $postclass ); ?> clearfix home-margin"> 
									<?php
									if ( 'full' === $summary ) {
										if ( $display_sidebar ) {
											while ( have_posts() ) :
												the_post();
												get_template_part( 'templates/content', 'fullpost' );
											endwhile;
										} else {
											while ( have_posts() ) :
												the_post();
												get_template_part( 'templates/content', 'fullpostfull' );
											endwhile;
										}
									} elseif ( 'grid' === $summary ) {
										?>
										<div id="kad-blog-grid" class="rowtight init-masonry" data-masonry-selector=".b_item">
											<?php
											while ( have_posts() ) :
												the_post();
												?>
												<div class="<?php echo esc_attr( $itemsize ); ?> b_item kad_blog_item">
													<?php get_template_part( 'templates/content', 'post-grid' ); ?>
												</div>
											<?php endwhile; ?>
										</div>
										<?php
									} else {
										if ( $display_sidebar ) {
											while ( have_posts() ) :
												the_post();
												get_template_part( 'templates/content', get_post_format() );
											endwhile;
										} else {
											while ( have_posts() ) :
												the_post();
												get_template_part( 'templates/content', 'fullwidth' );
											endwhile;
										}
									}
									?>
								</div> 
								<?php
								if ( $wp_query->max_num_pages > 1 ) :
									if ( function_exists( 'pinnacle_wp_pagination' ) ) {
										pinnacle_wp_pagination();
									} else {
										?>
										<nav class="post-nav">
											<ul class="pager">
												<li class="previous"><?php next_posts_link( __( '&larr; Older posts', 'pinnacle' ) ); ?></li>
												<li class="next"><?php previous_posts_link( __( 'Newer posts &rarr;', 'pinnacle' ) ); ?></li>
											</ul>
										</nav>
										<?php
									}
								endif;
							} else {
								?>
								<div class="homecontent clearfix home-margin"> 
									<?php get_template_part( 'templates/content', 'page' ); ?>
								</div>
								<?php
							}
							break;

						case 'block_five':
							get_template_part( 'templates/home/blog', 'home' );
							break;

						case 'block_six':
								get_template_part( 'templates/home/portfolio', 'carousel' );
							break;

						case 'block_seven':
								get_template_part( 'templates/home/icon', 'menu' );
							break;
					}
				}
			endif;
			?>
		</div><!-- /.main -->
		<?php get_sidebar(); ?>
	</div><!-- /.row-->
</div><!-- /.content -->
</div><!-- /.wrap -->
<?php get_footer(); ?>
