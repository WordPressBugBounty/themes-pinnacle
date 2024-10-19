<section class="pagefeat sliderclass">
	<?php global $post;
	$height = get_post_meta( $post->ID, '_kad_posthead_height', true );
	$swidth = get_post_meta( $post->ID, '_kad_posthead_width', true );
	if ( ! empty( $swidth ) ) {
		$slidewidth = $swidth;
	} else {
		$slidewidth = 1240;
	}
	if ( ! empty( $height ) ) {
		$slideheight = $height;
	} else {
		$slideheight = 400;
	} ?>
	<div class="flexslider loading kt-flexslider" style="max-width:<?php echo esc_attr( $slidewidth ); ?>px;" data-flex-speed="7000" data-flex-anim-speed="400" data-flex-animation="fade" data-flex-auto="true">
		<ul class="slides">
			  <?php
				$image_gallery = get_post_meta( $post->ID, '_kad_image_gallery', true );
				if ( ! empty( $image_gallery ) ) {
					$attachments = array_filter( explode( ',', $image_gallery ) );
					if ( $attachments ) {
						foreach ( $attachments as $attachment ) {
								  $img = pinnacle_get_image_array( $slidewidth, $slideheight, true, null, null, $attachment, false );
							  echo '<li><img src="' . esc_url( $img['src'] ) . '"/></li>';
						}
					}
				}
				?>
									  
				</ul>
		  </div> <!--Flex Slides-->
</section>
