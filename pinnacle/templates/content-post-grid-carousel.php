<?php global $post, $pinnacle, $postcolumn;
            if(!empty($postcolumn)) {
              if($postcolumn == '3') {
                $image_width = 370; 
                $image_height = 246;
              } else if($postcolumn == '2') {
                $image_width = 560;
                $image_height = 370;
              } else {
                $image_width = 340;
                $image_height = 226;
              }
            } else {
              $image_width = 340;
              $image_height = 226;
            }?>
              <div id="post-<?php esc_attr(the_ID()); ?>" class="blog_item postclass grid_item">
                  <?php
                        $img = pinnacle_get_image_array( $image_width, $image_height, true,'iconhover', get_the_title(), null, true); ?>
                        <div class="imghoverclass img-margin-center">
                              <a href="<?php the_permalink()  ?>" title="<?php the_title_attribute(); ?>">
                                 <img src="<?php echo esc_url($img['src']); ?>" alt="<?php the_title_attribute(); ?>" <?php echo 'width="'.esc_attr($img['width']).'" height="'.esc_attr($img['height']).'"';?> <?php echo $img['srcset']; ?> class="<?php echo esc_attr($img['class']);?>" style="display:block;">
                              </a> 
                        </div>
                        <?php $image = null; $thumbnailURL = null;   ?>
                        <div class="postcontent">
                          <header>
                              <a href="<?php the_permalink() ?>">
                                <h5 class="entry-title"><?php the_title();?></h5>
                              </a>
                              <?php get_template_part('templates/entry', 'meta-subhead'); ?>
                          </header>
                          <div class="entry-content color_body">
                                <p>
                                  <?php echo pinnacle_excerpt(16); ?> 
                                  <a href="<?php the_permalink() ?>"><?php echo __('Read More', 'pinnacle');?></a>
                                </p> 
                              </div>
                          <footer class="clearfix">
                          </footer>
                        </div><!-- Text size -->
            </div> <!-- Blog Item -->