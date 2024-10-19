<div class="sliderclass kad-desktop-slider">
  <?php  global $pinnacle;
if ( isset( $pinnacle['slider_size'] ) ) {
	  $slideheight = $pinnacle['slider_size'];
} else {
	  $slideheight = 400;
}
if ( isset( $pinnacle['slider_size_width'] ) ) {
	  $slidewidth = $pinnacle['slider_size_width'];
} else {
	  $slidewidth = 1140;
}
if ( isset( $pinnacle['trans_type'] ) ) {
	  $transtype = $pinnacle['trans_type'];
} else {
	  $transtype = 'slide';
}
if ( isset( $pinnacle['slider_transtime'] ) ) {
	  $transtime = $pinnacle['slider_transtime'];
} else {
	  $transtime = '300';
}
if ( isset( $pinnacle['slider_autoplay'] ) && $pinnacle['slider_autoplay'] == '1' ) {
	  $autoplay = 'true';
} else {
	  $autoplay = 'false';
}
if ( isset( $pinnacle['slider_pausetime'] ) ) {
	  $pausetime = $pinnacle['slider_pausetime'];
} else {
	  $pausetime = '7000';
} ?>
	<div id="imageslider" class="">
	  <div class="flexslider kt-flexslider loading" style="max-width:<?php echo esc_attr( $slidewidth ); ?>px; margin-left: auto; margin-right:auto;" data-flex-speed="<?php echo esc_attr( $pausetime ); ?>" data-flex-anim-speed="<?php echo esc_attr( $transtime ); ?>" data-flex-animation="<?php echo esc_attr( $transtype ); ?>" data-flex-auto="<?php echo esc_attr( $autoplay ); ?>">
		  <ul class="slides">
			<?php
			$loop = new WP_Query();
			$loop->query(
				array(
					'posts_per_page' => 4,
				)
			);
			if ( $loop ) :
				while ( $loop->have_posts() ) :
					$loop->the_post();
					$img = pinnacle_get_image_array( $slidewidth, $slideheight, true, null, null, null, true );
						?>
						<li> 
							<a href="<?php the_permalink(); ?>">
								<img src="<?php echo esc_url( $img['src'] ); ?>" width="<?php echo esc_attr( $img['width'] ); ?>" height="<?php echo esc_attr( $img['height'] ); ?>" alt="<?php echo esc_attr( $img['alt'] ); ?>" />
								<div class="flex-caption">
									<div class="captiontitle headerfont"><?php the_title(); ?></div>
								</div> 
							</a>
						</li>
					<?php
				endwhile;
			else :
				?>
			 	<li class="error-not-found"><?php esc_html_e( 'Sorry, no blog entries found.', 'pinnacle' ); ?></li>
			 	<?php
			endif;
			?>
			<?php
			wp_reset_postdata();
			?>
			  </ul>
		  </div> <!--Flex Slides-->
		</div><!--Container-->
</div><!--sliderclass-->
