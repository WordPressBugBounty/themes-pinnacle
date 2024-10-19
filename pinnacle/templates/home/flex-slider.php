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
if ( isset( $pinnacle['slider_captions'] ) ) {
	  $captions = $pinnacle['slider_captions'];
} else {
	  $captions = '';
}
if ( isset( $pinnacle['home_slider'] ) ) {
	  $slides = $pinnacle['home_slider'];
} else {
	  $slides = '';
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
		  <div id="imageslider" class="kt-slider">
			<div class="flexslider kt-flexslider loading" style="max-width:<?php echo esc_attr( $slidewidth ); ?>px; margin-left: auto; margin-right:auto;" data-flex-speed="<?php echo esc_attr( $pausetime ); ?>" data-flex-anim-speed="<?php echo esc_attr( $transtime ); ?>" data-flex-animation="<?php echo esc_attr( $transtype ); ?>" data-flex-auto="<?php echo esc_attr( $autoplay ); ?>">
				<ul class="slides">
					<?php
					foreach ( $slides as $slide ) :
						if ( ! empty( $slide['target'] ) && $slide['target'] == 1 ) {
							$target = '_blank';
						} else {
							$target = '_self';
						}
						if ( empty( $slide['attachment_id'] ) ) {
							$slide['attachment_id'] = attachment_url_to_postid( $slide['url'] );
						}
						if ( empty( $slide['attachment_id'] ) ) {
							$img = array(
								'src'    => $slide['url'],
								'width'  => $slidewidth,
								'height' => $slideheight,
								'alt'    => $slide['description'],
								'srcset' => '',
							);
						} else {
							$img = pinnacle_get_image_array( $slidewidth, $slideheight, true, null, $slide['description'], $slide['attachment_id'], false );
						}
						?>
						<li> 
							<?php
							if ( ! empty( $slide['link'] ) ) {
								echo '<a href="' . esc_url( $slide['link'] ) . '" target="' . esc_attr( $target ) . '">';
							}
							?>
							<img src="<?php echo esc_url( $img['src'] ); ?>" width="<?php echo esc_attr( $img['width'] ); ?>" height="<?php echo esc_attr( $img['height'] ); ?>" <?php echo wp_kses_post( $img['srcset'] ); ?> alt="<?php echo esc_attr( $img['alt'] ); ?>" />
								  <?php if ( $captions == '1' ) { ?>
									  <div class="flex-caption">
										  <?php
											if ( ! empty( $slide['title'] ) ) {
												echo '<div class="captiontitle headerfont">' . esc_html( $slide['title'] ) . '</div>';
											}
											if ( ! empty( $slide['description'] ) ) {
												echo '<div><div class="captiontext headerfont"><p>' . esc_html( $slide['description'] ) . '</p></div></div>';
											}
											?>
									  </div> 
									<?php } ?>
								  <?php
								if ( ! empty( $slide['link'] ) ) {
									echo '</a>';
								}
								?>
						  </li>
					  <?php endforeach; ?>
				</ul>
			</div> <!--Flex Slides-->
		  </div><!--Container-->
</div><!--sliderclass-->
