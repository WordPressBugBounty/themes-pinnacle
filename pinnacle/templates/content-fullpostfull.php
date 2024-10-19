<?php global $post, $pinnacle; $slide_sidebar = 1170;
            if ( has_post_format( 'video' )) {
              $headcontent = get_post_meta( $post->ID, '_kad_video_blog_head', true );
              $swidth      = get_post_meta( $post->ID, '_kad_video_posthead_width', true );
              if(empty($headcontent) || $headcontent == 'default') {
                  if(!empty($pinnacle['video_post_blog_default'])) {
                        $headcontent = $pinnacle['video_post_blog_default'];
                    } else {
                        $headcontent = 'video';
                    }
              }
              if (!empty($swidth)){
                $slidewidth = $swidth;
              } else {
                $slidewidth = $slide_sidebar;
              } 
            } else if (has_post_format( 'gallery' )) {
              $headcontent = get_post_meta( $post->ID, '_kad_gallery_blog_head', true );
              $height      = get_post_meta( $post->ID, '_kad_gallery_posthead_height', true );
              $swidth      = get_post_meta( $post->ID, '_kad_gallery_posthead_width', true );
              if(empty($headcontent) || $headcontent == 'default') {
                  if(!empty($pinnacle['gallery_post_blog_default'])) {
                        $headcontent = $pinnacle['gallery_post_blog_default'];
                    } else {
                        $headcontent = 'carouselslider';
                    }
              }
              if (!empty($height)) {
                $slideheight = $height;
              } else {
                $slideheight = 400;
              }
              if (!empty($swidth)){
                $slidewidth = $swidth;
              } else {
                $slidewidth = $slide_sidebar;
              }
            } elseif (has_post_format( 'image' )) {
               $headcontent = get_post_meta( $post->ID, '_kad_image_blog_head', true );
               $swidth      = get_post_meta( $post->ID, '_kad_posthead_width', true );
              if(empty($headcontent) || $headcontent == 'default') {
                  if(!empty($pinnacle['image_post_blog_default'])) {
                          $headcontent = $pinnacle['image_post_blog_default'];
                    } else {
                          $headcontent = 'image';
                    }
              }
              if (!empty($swidth)){
                $slidewidth = $swidth;
              } else {
                $slidewidth = $slide_sidebar;
              } 
            } else {
              $headcontent = 'none';
            }  ?>
      <div class="single-article">
          <article <?php post_class('postclass'); ?>>
              <?php if ($headcontent == 'flex') { ?>
              <section class="postfeat">
                <div class="flexslider kt-flexslixer loading kad-light-gallery" style="max-width:<?php echo esc_attr($slidewidth);?>px;" data-flex-speed="7000" data-flex-anim-speed="400" data-flex-animation="fade" data-flex-auto="true">
                  <ul class="slides">
                    <?php $image_gallery = get_post_meta( $post->ID, '_kad_image_gallery', true );
                          if(!empty($image_gallery)) {
                            $attachments = array_filter( explode( ',', $image_gallery ) );
                              if ($attachments) {
                              foreach ($attachments as $attachment) {
                              	$img = pinnacle_get_image_array( $slidewidth, $slideheight, true, null, get_the_title(), $attachment, false );
                                echo '<li><a href="'.esc_url($img['full']).'" data-rel="lightbox"><img src="'.esc_url($img['src']).'"/></a></li>';
                              }
                            }
                          }?>                            
                  </ul>
                </div> <!--Flex Slides-->
              </section>
            <?php } else if ($headcontent == 'carouselslider') { ?>
              <section class="postfeat">
                <div id="imageslider" class="loading">
                  <div class="carousel_slider_outer fredcarousel fadein-carousel" style="overflow:hidden; max-width:<?php echo esc_attr($slidewidth);?>px; height: <?php echo esc_attr($slideheight);?>px; margin-left: auto; margin-right:auto;">
                      <div class="carousel_slider initcarouselslider" data-carousel-container=".carousel_slider_outer" data-carousel-transition="600" data-carousel-height="<?php echo esc_attr($slideheight); ?>" data-carousel-auto="true" data-carousel-speed="9000" data-carousel-id="carouselslider">
                          <?php $image_gallery = get_post_meta( $post->ID, '_kad_image_gallery', true );
                                if(!empty($image_gallery)) {
                                    $attachments = array_filter( explode( ',', $image_gallery ) );
                                        if ($attachments) {
                                            foreach ($attachments as $attachment) {
                                            	$img = pinnacle_get_image_array( false, $slideheight, false, null, get_the_title(), $attachment, false );
                                                echo '<div class="carousel_gallery_item" style="float:left; display: table; position: relative; text-align: center; margin: 0; width:auto; height:'.esc_attr($img['height']).'px;">';
                                                  echo '<div class="carousel_gallery_item_inner" style="vertical-align: middle; display: table-cell;">';
                                                    echo '<img src="'.esc_url($img['src']).'" width="'.esc_attr($img['width']).'" height="'.esc_attr($img['height']).'" />';
                                                ?>
                                                  </div>
                                                </div>
                                              <?php } 
                                        } 
                                }?>
                      </div>
                      <div class="clearfix"></div>
                        <a id="prevport-carouselslider" class="prev_carousel icon-angle-left" href="#"></a>
                        <a id="nextport-carouselslider" class="next_carousel icon-angle-right" href="#"></a>
                    </div> 
                </div>
              </section>
            <?php } else if ($headcontent == 'video') { ?>
              <section class="postfeat">
                  <div class="videofit" style="max-width: <?php echo esc_attr($slidewidth);?>px; margin-left: auto; margin-right: auto;">
                      <?php echo get_post_meta( $post->ID, '_kad_post_video', true ); ?>
                  </div>
              </section>
            <?php } else if ($headcontent == 'image') {
            	if ( has_post_thumbnail() ) {
            		$img = pinnacle_get_image_array( $slidewidth, false, false, null, get_the_title(), get_post_thumbnail_id(), false );
                	?>
                    <section class="postfeat">
                        <div class="imghoverclass post-single-img">
                          <a href="<?php echo esc_url($img['full']); ?>" data-rel="lightbox" class="">
                            <img src="<?php echo esc_url($img['src']); ?>" alt="<?php the_title(); ?>" />
                          </a>
                        </div>
                    </section>
                  <?php } ?>
            <?php } ?>
            <?php if(isset($pinnacle['hide_author_img']) && $pinnacle['hide_author_img'] == '1') {
                get_template_part('templates/entry', 'meta-author'); 
            } ?>
            <header>
              <a href="<?php the_permalink() ?>">
                <h1 class="entry-title"><?php the_title(); ?></h1>
              </a>
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
      </div>
