<?php

/**
 * Enqueue CSS & JS
 */

function pinnacle_admin_scripts() {
	wp_register_script( 'kadence-toolkit-install', get_template_directory_uri() . '/assets/js/admin-activate.js', false, 155 );
	wp_enqueue_style( 'kt_admin_css', get_template_directory_uri() . '/assets/css/kt_adminstyles.css', false, 157, false );

	wp_enqueue_script( 'kad_admin_js', get_template_directory_uri() . '/assets/js/kad_adminscripts.js', false, 157, false );
}

add_action( 'admin_enqueue_scripts', 'pinnacle_admin_scripts' );

if ( is_admin() ) {
	if ( pinnacle_is_edit_page() ) {
		function pinnacle_img_upload_scripts() {
			wp_enqueue_media();
			wp_enqueue_script('kadwidget_upload', get_template_directory_uri() . '/assets/js/min/widget_upload.min.js');
		}
		add_action('admin_enqueue_scripts', 'pinnacle_img_upload_scripts');
	}
}

function pinnacle_is_edit_page() {
	if ( ! is_admin() ) {
		return false;
	}
	if ( in_array( $GLOBALS['pagenow'], array( 'post.php', 'post-new.php', 'widgets.php', 'post.php', 'post-new.php' ) ) ) {
		return true;
	}
}

/**
 * Enqueue block editor style
 */
function pinnacle_block_editor_styles() {
	wp_enqueue_style( 'pinnacle-guten-editor-styles', get_template_directory_uri() . '/assets/css/guten-editor-styles.css', false, '1.6.7', 'all' );
}

add_action( 'enqueue_block_editor_assets', 'pinnacle_block_editor_styles' );

/**
 * Add inline css for fonts
 */
function pinnacle_editor_dynamic_css() {
	global $current_screen;
	$the_current_screen = get_current_screen();
	if ( ( method_exists( $the_current_screen, 'is_block_editor' ) && $the_current_screen->is_block_editor() ) || ( function_exists( 'is_gutenberg_page' ) && is_gutenberg_page() ) ) {
		global $pinnacle;
		$options_fonts = array( 'font_h1', 'font_h2', 'font_h3', 'font_h4', 'font_h5', 'font_p' );
		$load_gfonts   = array();
		foreach ( $options_fonts as $options_key ) {
			if ( isset( $pinnacle[ $options_key ] ) && isset( $pinnacle[ $options_key ]['google'] ) && 'false' !== $pinnacle[ $options_key ]['google'] ) {
				// check if it's in the array.
				if ( isset( $load_gfonts[ sanitize_key( $pinnacle[ $options_key ]['font-family'] ) ] ) ) {
					if ( isset( $pinnacle[ $options_key ]['font-weight'] ) && ! empty( $pinnacle[ $options_key ]['font-weight'] ) ) {
						if ( isset( $pinnacle[ $options_key ]['font-style'] ) && ! empty( $pinnacle[ $options_key ]['font-style'] ) && ! is_numeric( $pinnacle[ $options_key ]['font-style'] ) && 'normal' !== $pinnacle[ $options_key ]['font-style'] ) {
							$load_gfonts[ sanitize_key( $pinnacle[ $options_key ]['font-family'] ) ]['font-style'][ $pinnacle[ $options_key ]['font-weight'] . $pinnacle[ $options_key ]['font-style'] ] = $pinnacle[ $options_key ]['font-weight'] . $pinnacle[ $options_key ]['font-style'];
						} else {
							$load_gfonts[ sanitize_key( $pinnacle[ $options_key ]['font-family'] ) ]['font-style'][ $pinnacle[ $options_key ]['font-weight'] ] = $pinnacle[ $options_key ]['font-weight'];
						}
					}
					if ( isset( $pinnacle[ $options_key ]['subsets'] ) && ! empty( $pinnacle[ $options_key ]['subsets'] ) ) {
						$load_gfonts[ sanitize_key( $pinnacle[ $options_key ]['font-family'] ) ]['subsets'][ $pinnacle[ $options_key ]['subsets'] ] = $pinnacle[ $options_key ]['subsets'];
					}
				} else {
					$load_gfonts[ sanitize_key( $pinnacle[ $options_key ]['font-family'] ) ] = array(
						'font-family' => $pinnacle[ $options_key ]['font-family'],
						'font-style'  => array(),
						'subsets'     => array(),
					);
					if ( isset( $pinnacle[ $options_key ]['font-weight'] ) && ! empty( $pinnacle[ $options_key ]['font-weight'] ) ) {
						if ( isset( $pinnacle[ $options_key ]['font-style'] ) && ! empty( $pinnacle[ $options_key ]['font-style'] ) && ! is_numeric( $pinnacle[ $options_key ]['font-style'] ) && 'normal' !== $pinnacle[ $options_key ]['font-style'] ) {
							$load_gfonts[ sanitize_key( $pinnacle[ $options_key ]['font-family'] ) ]['font-style'][ $pinnacle[ $options_key ]['font-weight'] . $pinnacle[ $options_key ]['font-style'] ] = $pinnacle[ $options_key ]['font-weight'] . $pinnacle[ $options_key ]['font-style'];
						} else {
							$load_gfonts[ sanitize_key( $pinnacle[ $options_key ]['font-family'] ) ]['font-style'][ $pinnacle[ $options_key ]['font-weight'] ] = $pinnacle[ $options_key ]['font-weight'];
						}
					}
					if ( isset( $pinnacle[ $options_key ]['subsets'] ) && ! empty( $pinnacle[ $options_key ]['subsets'] ) ) {
						$load_gfonts[ sanitize_key( $pinnacle[ $options_key ]['font-family'] ) ]['subsets'][ $pinnacle[ $options_key ]['subsets'] ] = $pinnacle[ $options_key ]['subsets'];
					}
				}
			}
			if ( 'font_p' === $options_key ) {
				$path      = trailingslashit( get_template_directory() ) . 'lib/gfont-json.php';
				$all_fonts = include $path;
				if ( isset( $all_fonts[ $pinnacle[ $options_key ]['font-family'] ] ) ) {
					$p_font = $all_fonts[ $pinnacle[ $options_key ]['font-family'] ];
					if ( isset( $p_font['variants']['italic']['400'] ) ) {
						$load_gfonts[ sanitize_key( $pinnacle[ $options_key ]['font-family'] ) ]['font-style']['400italic'] = '400italic';
					}
					if ( isset( $p_font['variants']['italic']['700'] ) ) {
						$load_gfonts[ sanitize_key( $pinnacle[ $options_key ]['font-family'] ) ]['font-style']['700italic'] = '700italic';
					}
					if ( isset( $p_font['variants']['normal']['400'] ) ) {
						$load_gfonts[ sanitize_key( $pinnacle[ $options_key ]['font-family'] ) ]['font-style']['400'] = '400';
					}
					if ( isset( $p_font['variants']['normal']['700'] ) ) {
						$load_gfonts[ sanitize_key( $pinnacle[ $options_key ]['font-family'] ) ]['font-style']['700'] = '700';
					}
				}
			}
		}
		if ( ! empty( $load_gfonts ) ) {
			// Build the font family link.
			$link    = '';
			$subsets = array();
			foreach ( $load_gfonts as $gfont_values ) {
				if ( ! empty( $link ) ) {
					$link .= '%7C'; // Append a new font to the string.
				}
				$link .= $gfont_values['font-family'];
				if ( ! empty( $gfont_values['font-style'] ) ) {
					$link .= ':';
					$link .= implode( ',', $gfont_values['font-style'] );
				}
				if ( ! empty( $gfont_values['subsets'] ) ) {
					foreach ( $gfont_values['subsets'] as $subset ) {
						if ( ! in_array( $subset, $subsets ) ) {
							array_push( $subsets, $subset );
						}
					}
				}
			}
			if ( ! empty( $subsets ) ) {
				$link .= '&amp;subset=' . implode( ',', $subsets );
			}
			echo '<link href="//fonts.googleapis.com/css?family=' . esc_attr( str_replace( '|', '%7C', $link ) ) . ' " rel="stylesheet">';

		}
		echo '<style type="text/css" id="pinnacle-editor-font-family">';
		if ( isset( $pinnacle['font_h1'] ) ) {
			echo 'body.block-editor-page .editor-post-title__block .editor-post-title__input, body.block-editor-page .wp-block-heading h1, body.block-editor-page .editor-block-list__block h1, body.block-editor-page .editor-post-title__block .editor-post-title__input {
					font-size: ' . esc_attr( $pinnacle['font_h1']['font-size'] ) . ';
					line-height: ' . esc_attr( $pinnacle['font_h1']['line-height'] ) . ';
					font-weight: ' . esc_attr( $pinnacle['font_h1']['font-weight'] ) . ';
					font-family: ' . esc_attr( $pinnacle['font_h1']['font-family'] ) . ';
					color: ' . esc_attr( $pinnacle['font_h1']['color'] ) . ';
				}';
		}
		if ( isset( $pinnacle['font_h2'] ) ) {
			echo 'body.block-editor-page .wp-block-heading h2, body.block-editor-page .editor-block-list__block h2 {
				font-size: ' . esc_attr( $pinnacle['font_h2']['font-size'] ) . ';
				line-height: ' . esc_attr( $pinnacle['font_h2']['line-height'] ) . ';
				font-weight: ' . esc_attr( $pinnacle['font_h2']['font-weight'] ) . ';
				font-family: ' . esc_attr( $pinnacle['font_h2']['font-family'] ) . ';
				color: ' . esc_attr( $pinnacle['font_h2']['color'] ) . ';
			}';
		}
		if ( isset( $pinnacle['font_h3'] ) ) {
			echo 'body.block-editor-page .wp-block-heading h3, body.block-editor-page .editor-block-list__block h3 {
				font-size: ' . esc_attr( $pinnacle['font_h3']['font-size'] ) . ';
				line-height: ' . esc_attr( $pinnacle['font_h3']['line-height'] ) . ';
				font-weight: ' . esc_attr( $pinnacle['font_h3']['font-weight'] ) . ';
				font-family: ' . esc_attr( $pinnacle['font_h3']['font-family'] ) . ';
				color: ' . esc_attr( $pinnacle['font_h3']['color'] ) . ';
			}';
		}
		if ( isset( $pinnacle['font_h4'] ) ) {
			echo 'body.block-editor-page .wp-block-heading h4, body.block-editor-page .editor-block-list__block h4 {
				font-size: ' . esc_attr( $pinnacle['font_h4']['font-size'] ) . ';
				line-height: ' . esc_attr( $pinnacle['font_h4']['line-height'] ) . ';
				font-weight: ' . esc_attr( $pinnacle['font_h4']['font-weight'] ) . ';
				font-family: ' . esc_attr( $pinnacle['font_h4']['font-family'] ) . ';
				color: ' . esc_attr( $pinnacle['font_h4']['color'] ) . ';
			} body.gutenberg-editor-page .editor-block-list__block .widgets-container .so-widget h4 {font-size:inherit; letter-spacing:normal; font-family:inherit;}';
		}
		if ( isset( $pinnacle['font_h5'] ) ) {
			echo 'body.block-editor-page .wp-block-heading h5, body.block-editor-page .editor-block-list__block h5 {
				font-size: ' . esc_attr( $pinnacle['font_h5']['font-size'] ) . ';
				line-height: ' . esc_attr( $pinnacle['font_h5']['line-height'] ) . ';
				font-weight: ' . esc_attr( $pinnacle['font_h5']['font-weight'] ) . ';
				font-family: ' . esc_attr( $pinnacle['font_h5']['font-family'] ) . ';
				color: ' . esc_attr( $pinnacle['font_h5']['color'] ) . ';
			}';
		}
		if ( isset( $pinnacle['font_p'] ) ) {
			echo '.edit-post-visual-editor, .edit-post-visual-editor p, .edit-post-visual-editor.editor-styles-wrapper p, .edit-post-visual-editor .wp-block-button {
				font-size: ' . esc_attr( $pinnacle['font_p']['font-size'] ) . ';
				font-weight: ' . esc_attr( $pinnacle['font_p']['font-weight'] ) . ';
				font-family: ' . esc_attr( $pinnacle['font_p']['font-family'] ) . ';
				color: ' . esc_attr( $pinnacle['font_p']['color'] ) . ';
			}';
			echo '.block-editor-page .edit-post-visual-editor {
				font-family: ' . esc_attr( $pinnacle['font_p']['font-family'] ) . ';
			}';
		}
		if ( isset( $pinnacle['post_background'] ) && ! empty( $pinnacle['post_background'] ) ) {
			echo '.block-editor-page .edit-post-visual-editor {
				background: ' . esc_attr( $pinnacle['post_background']['background-color'] ) . ';
			}';
		}
		echo '</style>';
	}
}
add_action( 'admin_head-post.php', 'pinnacle_editor_dynamic_css' );
add_action( 'admin_head-post-new.php', 'pinnacle_editor_dynamic_css' );
