<?php get_header(); 
	
	get_template_part('templates/page', 'header');

	global $pinnacle;
		
		if(isset($pinnacle['portfolio_style_default'])) {
		    $pstyleclass = $pinnacle['portfolio_style_default'];
		} else {
		   	$pstyleclass = 'padded_style';
		}
		if(isset($pinnacle['portfolio_ratio_default'])) {
            $pimgratio = $pinnacle['portfolio_ratio_default'];
        } else {
            $pimgratio = "square";
        }
        if(isset($pinnacle['portfolio_hover_style_default'])) {
		    $phoverstyleclass = $pinnacle['portfolio_hover_style_default'];
		} else {
		    $phoverstyleclass = 'p_lightstyle';
		}
		if(!empty($pinnacle['portfolio_tax_column'])) {
		 	$portfolio_column = $pinnacle['portfolio_tax_column'];
		 } else {
		 	$portfolio_column = 4;
		 }
		    
		    if ($portfolio_column == '2') {
		    	$itemsize = 'tcol-md-6 tcol-sm-6 tcol-xs-12 tcol-ss-12'; 
		    	$slidewidth = 600;
		    } else if ($portfolio_column == '3'){
		    	$itemsize = 'tcol-md-4 tcol-sm-4 tcol-xs-6 tcol-ss-12'; 
		    	$slidewidth = 400;
		    } else if ($portfolio_column == '6'){
		    	$itemsize = 'tcol-md-2 tcol-sm-3 tcol-xs-4 tcol-ss-6';
		    	$slidewidth = 300; 
		    } else if ($portfolio_column == '5'){
		    	$itemsize = 'tcol-md-25 tcol-sm-3 tcol-xs-4 tcol-ss-6'; 
		    	$slidewidth = 300;
		    } else {
		    	$itemsize = 'tcol-md-3 tcol-sm-4 tcol-xs-6 tcol-ss-12'; 
		    	$slidewidth = 300;
		    }
		    
		    if($pimgratio == 'portrait') {
				$temppimgheight = $slidewidth * 1.35;
				$slideheight = floor($temppimgheight);
			} else if($pimgratio == 'landscape') {
				$temppimgheight = $slidewidth / 1.35;
				$slideheight = floor($temppimgheight);
			} else if($pimgratio == 'widelandscape') {
				$temppimgheight = $slidewidth / 2;
				$slideheight = floor($temppimgheight);
			} else {
				$slideheight = $slidewidth;
			}
			$portfolio_excerpt = 'false'; 
			$portfolio_lightbox = 'false'; 
			$portfolio_item_types = 'true';

			// Set global loop var
        		global $kt_portfolio_loop;
                 $kt_portfolio_loop = array(
                 	'lightbox' => $portfolio_lightbox,
                 	'showexcerpt' => $portfolio_excerpt,
                 	'showtypes' => $portfolio_item_types,
                 	'pstyleclass' => $pstyleclass,
                 	'slidewidth' => $slidewidth,
                 	'slideheight' => $slideheight,
                 	);
		    ?> 
		        <div id="content" class="container">
   					<div class="row">
      					<div class="main <?php echo esc_attr( pinnacle_main_class() ); ?>" role="main">
					      	<?php echo category_description(); ?> 
					      	<?php if (!have_posts()) : ?>
								<div class="alert">
								    <?php _e('Sorry, no results were found.', 'pinnacle'); ?>
								</div>
		  						<?php get_search_form(); ?>
							<?php endif; ?>

							<div id="portfoliowrapper" class="rowtight <?php echo esc_attr($pstyleclass);?> <?php echo esc_attr($phoverstyleclass);?>"> 
								<?php global $wp_query;
								$cat_obj = $wp_query->get_queried_object();
							 	$termslug = $cat_obj->slug;
								query_posts(array( 
									'paged'  			=> $paged,
									'posts_per_page'	=> '12',
									'orderby' 			=> 'menu_order',
									'order' 			=> 'ASC',
									'post_type' 		=> 'portfolio',
									'portfolio-type'	=> $termslug
									) 
								);
							 	while (have_posts()) : the_post(); ?>
									
								<div class="<?php echo esc_attr($itemsize);?> p-item">
					                <?php do_action('kadence_portfolio_loop_start');
												get_template_part('templates/content', 'loop-portfolio'); 
											  do_action('kadence_portfolio_loop_end');
										?>
	                    		</div>
								<?php endwhile; ?>
                			</div> <!--portfoliowrapper-->
                
		                    <?php if ($wp_query->max_num_pages > 1) :
		                           	if(function_exists('pinnacle_wp_pagination')) {
		                            	pinnacle_wp_pagination();
		                            } else { ?>     
			                            <nav id="post-nav" class="pager">
			                                <div class="previous"><?php next_posts_link(__('&larr; Older posts', 'pinnacle')); ?></div>
			                                <div class="next"><?php previous_posts_link(__('Newer posts &rarr;', 'pinnacle')); ?></div>
			                            </nav>
		                           	<?php } 
		                    endif;
                      		$wp_query = null; 
                      		wp_reset_query(); ?>
						</div><!-- /.main -->
						
						<?php get_sidebar(); ?>
     				</div><!-- /.row-->
    			</div><!-- /.content -->
  		</div><!-- /.wrap -->
	<?php get_footer(); ?>