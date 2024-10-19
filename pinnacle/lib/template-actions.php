<?php
/**
 * Template Actions
 */

add_action('kt_after_pagecontent', 'pinnacle_page_comments');
function pinnacle_page_comments() {
 global $pinnacle;
 if(isset($pinnacle['page_comments']) && $pinnacle['page_comments'] == 1) {
  comments_template('/templates/comments.php');
 }
}

function pinnacle_get_post_head_content() {
	global $post;
	if ( has_post_format( 'video' )) {
              $headcontent = get_post_meta( $post->ID, '_kad_video_blog_head', true );
              if(empty($headcontent) || $headcontent == 'default') {
                  if(!empty($pinnacle['video_post_blog_default'])) {
                        $headcontent = $pinnacle['video_post_blog_default'];
                    } else {
                        $headcontent = 'video';
                    }
              }
        } else if (has_post_format( 'gallery' )) {
              $headcontent = get_post_meta( $post->ID, '_kad_gallery_blog_head', true );
              if(empty($headcontent) || $headcontent == 'default') {
                  if(!empty($pinnacle['gallery_post_blog_default'])) {
                        $headcontent = $pinnacle['gallery_post_blog_default'];
                    } else {
                        $headcontent = 'flex';
                    }
              }
        } elseif (has_post_format( 'image' )) {
               $headcontent = get_post_meta( $post->ID, '_kad_blog_head', true );
	            if(empty($headcontent) || $headcontent == 'default') {
	                  if(!empty($pinnacle['image_post_blog_default'])) {
	                        $headcontent = $pinnacle['image_post_blog_default'];
	                    } else {
	                        $headcontent = 'image';
	                    }
	            }
        } else {
                  $headcontent = 'none';
        } 
        return $headcontent;
}