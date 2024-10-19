<?php get_template_part('templates/blog', 'post-header');
    global $post, $pinnacle;
        if(pinnacle_display_sidebar()) {
          $slide_sidebar = 848;
        } else {
          $slide_sidebar = 1170;
        }
        // Get Post Head settings
        $headcontent = pinnacle_get_post_head_content();
         ?>
        <div id="content" class="container">
          <div class="row single-article">
            <div class="main <?php echo esc_attr( pinnacle_main_class() ); ?>" role="main">
              <?php while (have_posts()) : the_post(); ?>
                <article <?php post_class('postclass'); ?>>
                  <?php if ($headcontent == 'flex') { 
                  	$height = get_post_meta( $post->ID, '_kad_gallery_posthead_height', true );
             		$swidth = get_post_meta( $post->ID, '_kad_gallery_posthead_width', true );
	                if (!empty($height)){
	                  	$slideheight = $height;
	                } else {
	                  	$slideheight = 400;
	                }
	                if (!empty($swidth)) {
	                  	$slidewidth = $swidth;
	                } else {
	                  	$slidewidth = $slide_sidebar;
	                }?>
                    <section class="postfeat">
                      <div class="flexslider kt-flexslider loading kad-light-gallery" style="max-width:<?php echo esc_attr($slidewidth);?>px;" data-flex-speed="7000" data-flex-anim-speed="400" data-flex-animation="fade" data-flex-auto="true">
                        <ul class="slides">
                          <?php $image_gallery = get_post_meta( $post->ID, '_kad_image_gallery', true );
                                  if(!empty($image_gallery)) {
                                    $attachments = array_filter( explode( ',', $image_gallery ) );
                                      if ($attachments) {
                                      foreach ($attachments as $attachment) {
                                      	$img = pinnacle_get_image_array( $slidewidth, $slideheight, true,null, null, $attachment, false); 
                                        echo '<li><a href="'.esc_attr($img['full']).'" data-rel="lightbox" itemprop="image" itemscope itemtype="https://schema.org/ImageObject">';
                                        echo '<img src="'.esc_attr($img['src']).'" width="'.esc_attr($img['width']).'" height="'.esc_attr($img['height']).'" alt="'.esc_attr($img['alt']).'" itemprop="contentUrl" '.wp_kses_post($img['srcset']).'/>';
                                        echo '<meta itemprop="url" content="'.esc_url($img['src']).'">';
                                        echo '<meta itemprop="width" content="'.esc_attr($img['width']).'">';
                                        echo '<meta itemprop="height" content="'.esc_attr($img['height']).'">';
                                        echo '</a></li>';
                                      }
                                    }
                                  }?>                            
                        </ul>
                      </div> <!--Flex Slides-->
                    </section>
                  <?php } else if ($headcontent == 'carouselslider') { 
                  	$height = get_post_meta( $post->ID, '_kad_gallery_posthead_height', true );
             		$swidth = get_post_meta( $post->ID, '_kad_gallery_posthead_width', true );
	                if (!empty($height)){
	                  	$slideheight = $height;
	                } else {
	                  	$slideheight = 400;
	                }
	                if (!empty($swidth)) {
	                  	$slidewidth = $swidth;
	                } else {
	                  	$slidewidth = $slide_sidebar;
	                }?>
                    <section class="postfeat">
                      <div id="imageslider" class="loading">
                        <div class="carousel_slider_outer fredcarousel fadein-carousel" style="overflow:hidden; max-width:<?php echo esc_attr($slidewidth);?>px; height: <?php echo esc_attr($slideheight);?>px; margin-left: auto; margin-right:auto;">
                            <div class="carousel_slider initcarouselslider" data-carousel-container=".carousel_slider_outer" data-carousel-transition="600" data-carousel-height="<?php echo esc_attr($slideheight); ?>" data-carousel-auto="true" data-carousel-speed="9000" data-carousel-id="carouselslider">
                                <?php $image_gallery = get_post_meta( $post->ID, '_kad_image_gallery', true );
                                      if(!empty($image_gallery)) {
                                          $attachments = array_filter( explode( ',', $image_gallery ) );
                                            if ($attachments) {
                                              foreach ($attachments as $attachment) {
                                              		$img = pinnacle_get_image_array( null, $slideheight, false, null, null, $attachment, false); 
                                                    echo '<div class="carousel_gallery_item" style="float:left; display: table; position: relative; text-align: center; margin: 0; width:auto; height:'.esc_attr($img['height']).'px;">';
                                                    echo '<div class="carousel_gallery_item_inner" style="vertical-align: middle; display: table-cell;" itemprop="image" itemscope itemtype="https://schema.org/ImageObject">';
                                                    echo '<img src="'.esc_attr($img['src']).'" width="'.esc_attr($img['width']).'" height="'.esc_attr($img['height']).'" itemprop="contentUrl" '.wp_kses_post($img['srcset']).' />';
                                                    echo '<meta itemprop="url" content="'.esc_url($img['src']).'">';
                                                    echo '<meta itemprop="width" content="'.esc_attr($img['width']).'">';
                                                    echo '<meta itemprop="height" content="'.esc_attr($img['height']).'">';
                                                      ?>
                                                    </div>
                                                  </div>
                                      <?php } } }?>
                            </div>
                            <div class="clearfix"></div>
                              <a id="prevport-carouselslider" class="prev_carousel icon-angle-left" href="#"></a>
                              <a id="nextport-carouselslider" class="next_carousel icon-angle-right" href="#"></a>
                          </div> 
                      </div>  
                    </section>
                  <?php } else if ($headcontent == 'video') { 
                  	$swidth = get_post_meta( $post->ID, '_kad_video_posthead_width', true ); 
		            if (!empty($swidth)) {
		                $slidewidth = $swidth;
		            } else {
		                $slidewidth = $slide_sidebar;
		            } ?>
                    <section class="postfeat">
                        <div class="videofit" style="max-width: <?php echo esc_attr($slidewidth);?>px; margin-left: auto; margin-right: auto;">
                              <?php echo get_post_meta( $post->ID, '_kad_post_video', true ); ?>
                        </div>
                        <?php if (has_post_thumbnail( $post->ID ) ) { 
                            $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' ); ?>
                            <div itemprop="image" itemscope itemtype="https://schema.org/ImageObject">
                                <meta itemprop="url" content="<?php echo esc_url($image[0]); ?>">
                                <meta itemprop="width" content="<?php echo esc_attr($image[1])?>">
                                <meta itemprop="height" content="<?php echo esc_attr($image[2])?>">
                            </div>
                        <?php } ?>
                    </section>
                  <?php } else if ($headcontent == 'image') {
                  	if ( has_post_thumbnail() ) {
	                  	$swidth = get_post_meta( $post->ID, '_kad_posthead_width', true );
		              	if (!empty($swidth)) {
		               		$slidewidth = $swidth;
		              	} else {
		                	$slidewidth = $slide_sidebar;
		              	}
		              	 $img = pinnacle_get_image_array( $slidewidth, false, false, null, get_the_title(), get_post_thumbnail_id(), false );
	                    ?>
	                    <section class="postfeat">
	                        <div class="imghoverclass post-single-img" itemprop="image" itemscope itemtype="https://schema.org/ImageObject">
	                            <a href="<?php echo esc_url($image_src[0]); ?>" data-rel="lightbox">
	                              <img src="<?php echo esc_url($img['src']); ?>" itemprop="contentUrl" alt="<?php echo esc_attr($img['alt']); ?>" width="<?php echo esc_attr($img['width']); ?>" height="<?php echo esc_attr($img['height'])?>" <?php echo wp_kses_post( $img['srcset'] ); ?> />
	                              <meta itemprop="url" content="<?php echo esc_url($img['src']); ?>">
	                              <meta itemprop="width" content="<?php echo esc_attr($img['width']); ?>px">
	                              <meta itemprop="height" content="<?php echo esc_attr($img['height'])?>px">
	                            </a>
	                          </div>
	                    </section>
                    <?php } ?>
                  <?php } ?>
                  <?php if(isset($pinnacle['hide_author_img']) && $pinnacle['hide_author_img'] == '1') { 
                          get_template_part('templates/entry', 'meta-author'); 
                  } ?>
                  <header>
                      <?php if(isset($pinnacle['single_post_title_output']) && $pinnacle['single_post_title_output'] == 'h2' ) { ?>
                      <h2 class="entry-title"><?php the_title(); ?></h2>
                      <?php 
                      } else if(isset($pinnacle['single_post_title_output']) && $pinnacle['single_post_title_output'] == 'none' ) {
                        // Do nothing
                      } else { ?>
                      <h1 class="entry-title"><?php the_title(); ?></h1>
                      <?php } ?>
                      <?php get_template_part('templates/entry', 'meta-subhead'); ?>
                  </header>
                  <div class="entry-content clearfix">
                    <?php the_content(); ?>
                    <?php wp_link_pages(array('before' => '<nav class="page-nav"><p>' . __('Pages:', 'pinnacle'), 'after' => '</p></nav>')); ?>
                  </div>
                  <footer class="single-footer clearfix">
                    <?php get_template_part('templates/entry', 'meta-footer'); ?>
                  </footer>
                </article>
                <?php if(isset($pinnacle['show_postlinks']) &&  $pinnacle['show_postlinks'] == 1) {
                          get_template_part('templates/entry', 'post-links'); 
                }
                $authorbox = get_post_meta( $post->ID, '_kad_blog_author', true );
                $blog_carousel_recent = get_post_meta( $post->ID, '_kad_blog_carousel_similar', true ); 
                if(empty($authorbox) || $authorbox == 'default') {
                  if(isset($pinnacle['post_author_default']) && ($pinnacle['post_author_default'] == 'yes')) {
                    pinnacle_author_box(); 
                  }
                } else if($authorbox == 'yes'){
                  pinnacle_author_box();
                } 
                if(empty($blog_carousel_recent) || $blog_carousel_recent == 'default' ) { 
                  if(isset($pinnacle['post_carousel_default'])) {
                      $blog_carousel_recent = $pinnacle['post_carousel_default']; 
                  } 
                }
                if ($blog_carousel_recent == 'similar') {
                  get_template_part('templates/similarblog', 'carousel'); 
                } else if( $blog_carousel_recent == 'recent') {
                  get_template_part('templates/recentblog', 'carousel');
                } ?>
                 <?php comments_template('/templates/comments.php'); ?>
            <?php endwhile; ?>
          </div>

