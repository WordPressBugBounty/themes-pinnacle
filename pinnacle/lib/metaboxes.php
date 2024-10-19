<?php
/**
 * @category Pinnacle Theme
 * @package  Metaboxes
 */

// pinnacle Sidebar Options
function pinnacle_cmb_sidebar_options() {
	$sidebars = array(
		'' => __( 'Default', 'pinnacle' ),
	);
	$nonsidebars = array(
		'topbarright',
		'footer_1',
		'footer_2',
		'footer_3',
		'footer_4',
		'footer_third_1',
		'footer_third_2',
		'footer_third_3',
		'footer_double_1',
		'footer_double_2',
	);
	foreach ( $GLOBALS['wp_registered_sidebars'] as $sidebar ) { 
	    if(!in_array($sidebar['id'], $nonsidebars) ){
	        $sidebars[ $sidebar['id'] ] = $sidebar['name'];
	    }
	}
    return $sidebars;
}

add_action( 'cmb2_render_pinnacle_select_category', 'pinnacle_render_select_category', 10, 2 );
function pinnacle_render_select_category( $field, $meta ) {
    wp_dropdown_categories(array(
            'show_option_none' => __( "All Blog Posts", 'pinnacle' ),
            'hierarchical' => 1,
            'taxonomy' => 'category',
            'orderby' => 'name', 
            'hide_empty' => 0, 
            'name' => $field->args( 'id' ),
            'selected' => $meta  

        ));
    $desc = $field->args( 'desc' );
    if ( !empty( $desc ) ) {
    	echo '<p class="cmb_metabox_description">' . esc_html( $desc ) . '</p>';
    }
}

// Show on tempalte filter
add_filter( 'cmb_show_on', 'kt_metabox_show_on_kt_template', 10, 2 );
function kt_metabox_show_on_kt_template( $display, $meta_box ) {
    if( 'kt-template' !== $meta_box['show_on']['key'] )
        return $display;
    // Get the current ID
    if( isset( $_GET['post'] ) ) $post_id = $_GET['post'];
    elseif( isset( $_POST['post_ID'] ) ) $post_id = $_POST['post_ID'];
    if( !isset( $post_id ) ) return false;

    $template_name = get_page_template_slug( $post_id );
    $template_name = substr($template_name, 0, -4);

    // If value isn't an array, turn it into one
    $meta_box['show_on']['value'] = !is_array( $meta_box['show_on']['value'] ) ? array( $meta_box['show_on']['value'] ) : $meta_box['show_on']['value'];

    // See if there's a match
    if(in_array( $template_name, $meta_box['show_on']['value'] )) {
    	return false;
    } else {
    	return true;
	}
}

// render numbers
add_action( 'cmb_render_kt_text_number', 'kt_cmb_render_kt_text_number', 10, 5 );
function kt_cmb_render_kt_text_number($field_args, $escaped_value, $object_id, $object_type, $field_type_object ) {
    echo $field_type_object->input( array( 'class' => 'cmb_text_small', 'type' => 'kt_text_number' ) );
}
// validate the field
add_filter( 'cmb_validate_kt_text_number', 'kt_cmb_validate_kt_text_number' );
function kt_cmb_validate_kt_text_number($new ) {
   $bnew = preg_replace("/[^0-9]/","",$new);
    return $new;
}
// Get taxonomy
add_filter( 'cmb_render_imag_select_taxonomy', 'imag_render_imag_select_taxonomy', 10, 2 );
function imag_render_imag_select_taxonomy( $field, $meta ) {

    wp_dropdown_categories(array(
            'show_option_none' => __( "All", 'pinnacle' ),
            'hierarchical' => 1,
            'taxonomy' => $field['taxonomy'],
            'orderby' => 'name', 
            'hide_empty' => 0, 
            'name' => $field['id'],
            'selected' => $meta  

        ));
    if ( !empty( $field['desc'] ) ) echo '<p class="cmb_metabox_description">' . $field['desc'] . '</p>';
}
// Get category
add_filter( 'cmb_render_imag_select_category', 'imag_render_imag_select_category', 10, 2 );
function imag_render_imag_select_category( $field, $meta ) {

    wp_dropdown_categories(array(
            'show_option_none' => __( "All Blog Posts", 'pinnacle' ),
            'hierarchical' => 1,
            'taxonomy' => 'category',
            'orderby' => 'name', 
            'hide_empty' => 0, 
            'name' => $field['id'],
            'selected' => $meta  

        ));
    if ( !empty( $field['desc'] ) ) echo '<p class="cmb_metabox_description">' . $field['desc'] . '</p>';

}
// Get pages
add_filter( 'cmb_render_select_pages', 'imag_render_select_pages', 10, 2 );
function imag_render_select_pages( $field, $meta ) {	
	$pages = get_pages(); 
    if (!empty($pages)) {
			 echo '<select name="', $field['id'], '" id="', $field['id'], '">';
			  echo '<option value="default"', $meta == 'default' ? ' selected="selected"' : '', '>Theme Options Default</option>';
		  foreach ($pages as $page) {
		    echo '<option value="', $page->ID, '"', $meta == $page->ID ? ' selected="selected"' : '', '>', $page->post_title, '</option>';
		  }
		  echo '</select>'; 
		}
	
    if ( !empty( $field['desc'] ) ) echo '<p class="cmb_metabox_description">' . $field['desc'] . '</p>';

}
// Get sidebars
add_filter( 'cmb_render_imag_select_sidebars', 'imag_render_imag_select_sidebars', 10, 2 );
function imag_render_imag_select_sidebars( $field, $meta ) {
	global $kad_sidebars;	
	
	 echo '<select name="', $field['id'], '" id="', $field['id'], '">';
  foreach ($kad_sidebars as $side) {
    echo '<option value="', $side['id'], '"', $meta == $side['id'] ? ' selected="selected"' : '', '>', $side['name'], '</option>';
  }
  echo '</select>';
	
    if ( !empty( $field['desc'] ) ) echo '<p class="cmb_metabox_description">' . $field['desc'] . '</p>';

}
// Get sidebars products
add_filter( 'cmb_render_imag_select_sidebars_product', 'imag_render_imag_select_sidebars_product', 10, 2 );
function imag_render_imag_select_sidebars_product( $field, $meta ) {
	global $kad_sidebars;	
	
	 echo '<select name="', $field['id'], '" id="', $field['id'], '">';
	 echo '<option value="default" selected="selected">Theme Options Default</option>';
  foreach ($kad_sidebars as $side) {
    echo '<option value="', $side['id'], '"', $meta == $side['id'] ? ' selected="selected"' : '', '>', $side['name'], '</option>';
  }
  echo '</select>';
	
    if ( !empty( $field['desc'] ) ) echo '<p class="cmb_metabox_description">' . $field['desc'] . '</p>';

}
// post format filter
function kad_metabox_post_format( $display, $meta_box ) {
    if ( 'format' !== $meta_box['show_on']['key'] )
        return $display;

    // If we're showing it based on ID, get the current ID                  
    if( isset( $_GET['post'] ) ) $post_id = $_GET['post'];
    elseif( isset( $_POST['post_ID'] ) ) $post_id = $_POST['post_ID'];
    if( !isset( $post_id ) )
        return $display;

    $format = get_post_format( $post_id );
    if ( false === $format ) {$format = 'standard';}
    if ($format == $meta_box['show_on']['value']) 
    	return true;
    	 else 
        return false;
}
add_filter( 'cmb_show_on', 'kad_metabox_post_format', 10, 2 );

add_filter( 'cmb2_admin_init', 'pinnacle_metaboxes' );
function pinnacle_metaboxes() {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_kad_';

	$pinnacle_blog_post = new_cmb2_box( array(
		'id'         => 'standard_post_metabox',
		'title'      => __("Standard Post Options", 'pinnacle'),
		'object_types'	=> array( 'post' ),
		'priority'   => 'high',
	) );
	$pinnacle_blog_post->add_field( array(
		'name'    => __("Post Summary", 'pinnacle' ),
		'desc'    => '',
		'id'      => $prefix . 'post_summery',
		'type'    => 'select',
		'options' => array(
			'default' 			=> __('Standard Post Default', 'pinnacle' ),
			'text' 	    		=> __('Text', 'pinnacle' ),
			'img_portrait' 	    => __('Portrait Image', 'pinnacle' ),
			'img_landscape' 	=> __('Landscape Image', 'pinnacle' ),
		),
	) );

	$pinnacle_image_blog_post = new_cmb2_box( array(
		'id'         => 'image_post_metabox',
		'title'      => __("Image Post Options", 'pinnacle'),
		'object_types'	=> array( 'post' ),
		'priority'   => 'high',
	) );

	$pinnacle_image_blog_post->add_field( array(
		'name'    => __("Head Content", 'pinnacle' ),
		'desc'    => '',
		'id'      => $prefix . 'blog_head',
		'type'    => 'select',
		'options' => array(
			'default' 	=> __('Image Post Default', 'pinnacle' ),
			'image' 	=> __('Image', 'pinnacle' ),
			'none' 	    => __('None', 'pinnacle' ),
		),
	) );
	$pinnacle_image_blog_post->add_field( array(
			'name' => __("Max Image Width", 'pinnacle' ),
			'desc' => __("Default is: 848 or 1140 on fullwidth posts (Note: just input number, example: 650)", 'pinnacle' ),
			'id'   => $prefix . 'image_posthead_width',
			'type' => 'text_small',
	) );
	$pinnacle_image_blog_post->add_field( array(
			'name'    => __("Post Summary", 'pinnacle' ),
			'desc'    => '',
			'id'      => $prefix . 'image_post_summery',
			'type'    => 'select',
			'options' => array(
				'default' 			=> __('Image Post Default', 'pinnacle' ),
				'text' 	    		=> __('Text', 'pinnacle' ),
				'img_portrait' 	    => __('Portrait Image', 'pinnacle' ),
				'img_landscape' 	=> __('Landscape Image', 'pinnacle' ),
			),
	) );
	$pinnacle_blog_post_sidebar = new_cmb2_box( array(
		'id'         => 'post_metabox',
		'title'      => __("Post Options", 'pinnacle'),
		'object_types'	=> array( 'post' ),
		'priority'   => 'high',
	) );
	$pinnacle_blog_post_sidebar->add_field( array(
		'name' => __('Display Sidebar?', 'pinnacle'),
		'desc' => __('Choose if layout is fullwidth or sidebar', 'pinnacle'),
		'id'   => $prefix . 'post_sidebar',
		'type'    => 'select',
		'options' => array(
			'default' => __('Default', 'pinnacle'),
			'yes' => __('Yes', 'pinnacle'),
			'no' => __('No', 'pinnacle'),
		),
	) );
	$pinnacle_blog_post_sidebar->add_field( array(
		'name'    => __('Choose Sidebar', 'pinnacle'),
		'desc'    => '',
		'id'      => $prefix . 'sidebar_choice',
		'type'    => 'select',
		'options' => pinnacle_cmb_sidebar_options(),
	) );
	$pinnacle_blog_post_sidebar->add_field( array(
		'name' => __('Author Info', 'pinnacle'),
		'desc' => __('Display an author info box?', 'pinnacle'),
		'id'   => $prefix . 'blog_author',
		'type'    => 'select',
		'options' => array(
			'default' => __('Default', 'pinnacle'),
			'no' => __('No', 'pinnacle'),
			'yes' => __('Yes', 'pinnacle'),
		),
	) );
	$pinnacle_blog_post_sidebar->add_field( array(
		'name' => __('Posts Carousel', 'pinnacle'),
		'desc' => __('Display a carousel with similar or recent posts?', 'pinnacle'),
		'id'   => $prefix . 'blog_carousel_similar',
		'type'    => 'select',
		'options' => array(
			'default' => __('Default', 'pinnacle'), 
			'no' => __('No', 'pinnacle'), 
			'recent' => __('Yes - Display Recent Posts', 'pinnacle'),
			'similar' => __('Yes - Display Similar Posts', 'pinnacle'),
		),
	) );
	$pinnacle_blog_post_sidebar->add_field( array(
			'name' => __('Carousel Title', 'pinnacle'),
			'desc' => __('ex. Similar Posts', 'pinnacle'),
			'id'   => $prefix . 'blog_carousel_title',
			'type' => 'text_medium',
	) );


	$pinnacle_blog_page = new_cmb2_box( array(
		'id'         	=> 'bloglist_metabox',
		'title'      	=> __('Blog List Options', 'pinnacle'),
		'object_types'	=> array( 'page' ),
		'show_on' 		=> array('key' => 'page-template', 'value' => array( 'template-blog.php') ),
		'priority'   	=> 'high',
	) );
	$pinnacle_blog_page->add_field( array(
        'name' => __('Blog Category', 'pinnacle'),
        'desc' => __('Select all blog posts or a specific category to show', 'pinnacle'),
        'id' => $prefix .'blog_cat',
        'type' => 'pinnacle_select_category',
    ) );
	$pinnacle_blog_page->add_field( array(
		'name'    => __('How Many Posts Per Page', 'pinnacle'),
		'desc'    => '',
		'id'      => $prefix . 'blog_items',
		'type'    => 'select',
		'options' => array(
			'all' 	=> __('All', 'pinnacle' ),
			'2' 	=> __('2', 'pinnacle' ),
			'3' 	=> __('3', 'pinnacle' ),
			'4' 	=> __('4', 'pinnacle' ),
			'5' 	=> __('5', 'pinnacle' ),
			'6' 	=> __('6', 'pinnacle' ),
			'7' 	=> __('7', 'pinnacle' ),
			'8' 	=> __('8', 'pinnacle' ),
			'9' 	=> __('9', 'pinnacle' ),
			'10' 	=> __('10', 'pinnacle' ),
			'11' 	=> __('11', 'pinnacle' ),
			'12' 	=> __('12', 'pinnacle' ),
			'13' 	=> __('13', 'pinnacle' ),
			'14' 	=> __('14', 'pinnacle' ),
			'15' 	=> __('15', 'pinnacle' ),
			'16' 	=> __('16', 'pinnacle' ),
		),
	) );
	$pinnacle_blog_page->add_field( array(
		'name'    => __('Display Post Content as:', 'pinnacle'),
		'desc'    => '',
		'id'      => $prefix . 'blog_summery',
		'type'    => 'select',
		'options' => array(
			'summery' => __('Summary', 'pinnacle'),
			'full' => __('Full', 'pinnacle'),
		),
	) );

	$pinnacle_blog_grid_page = new_cmb2_box( array(
		'id'         => 'bloggrid_metabox',
		'title'      => __('Blog Grid Options', 'pinnacle'),
		'object_types'	=> array( 'page' ),
		'show_on' => array('key' => 'page-template', 'value' => array( 'template-blog-grid.php')),
		'priority'   => 'high',
	) );
	$pinnacle_blog_grid_page->add_field( array(
        'name' => __('Blog Category', 'pinnacle'),
        'desc' => __('Select all blog posts or a specific category to show', 'pinnacle'),
        'id' => $prefix .'blog_cat',
        'type' => 'pinnacle_select_category',
    ) );
	$pinnacle_blog_grid_page->add_field( array(
		'name'    => __('How Many Posts Per Page', 'pinnacle'),
		'desc'    => '',
		'id'      => $prefix . 'blog_items',
		'type'    => 'select',
		'options' => array(
			'all' 	=> __('All', 'pinnacle' ),
			'2' 	=> __('2', 'pinnacle' ),
			'3' 	=> __('3', 'pinnacle' ),
			'4' 	=> __('4', 'pinnacle' ),
			'5' 	=> __('5', 'pinnacle' ),
			'6' 	=> __('6', 'pinnacle' ),
			'7' 	=> __('7', 'pinnacle' ),
			'8' 	=> __('8', 'pinnacle' ),
			'9' 	=> __('9', 'pinnacle' ),
			'10' 	=> __('10', 'pinnacle' ),
			'11' 	=> __('11', 'pinnacle' ),
			'12' 	=> __('12', 'pinnacle' ),
			'13' 	=> __('13', 'pinnacle' ),
			'14' 	=> __('14', 'pinnacle' ),
			'15' 	=> __('15', 'pinnacle' ),
			'16' 	=> __('16', 'pinnacle' ),
		),
	) );
	$pinnacle_blog_grid_page->add_field( array(
		'name'    => __('Choose Column Layout:', 'pinnacle'),
		'desc'    => '',
		'id'      => $prefix . 'blog_columns',
		'type'    => 'select',
		'options' => array(
			'4' => __('Four Column', 'pinnacle'),
			'3' => __('Three Column', 'pinnacle'),
			'2' => __('Two Column', 'pinnacle'),
		),
	) );
	$pinnacle_page_sidebar = new_cmb2_box( array(
				'id'         => 'page_sidebar',
				'title'      => __('Sidebar Options', 'pinnacle'),
				'object_types'	=> array( 'page' ),
				'show_on' => array( 'key' => 'kt-template', 'value' => array('template-portfolio-grid','template-contact')),
				'priority'   => 'high',
	) );
	$pinnacle_page_sidebar ->add_field( array(
				'name' => __('Display Sidebar?', 'pinnacle'),
				'desc' => __('Choose if layout is fullwidth or sidebar', 'pinnacle'),
				'id'   => $prefix . 'page_sidebar',
				'type'    => 'select',
				'options' => array(
					'no' => __('No', 'pinnacle'),
					'yes' => __('Yes', 'pinnacle'),
				),
	) );
	$pinnacle_page_sidebar ->add_field( array(
				'name'    => __('Choose Sidebar', 'pinnacle'),
				'desc'    => '',
				'id'      => $prefix . 'sidebar_choice',
				'type'    => 'select',
				'options' => pinnacle_cmb_sidebar_options(),
	) );
}