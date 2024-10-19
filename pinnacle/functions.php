<?php
/**
 * Add functions files
 *
 * @package Pinnacle Theme
 */

/**
 * Language setup
 */
function pinnacle_lang_setup() {
	load_theme_textdomain( 'pinnacle', get_template_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'pinnacle_lang_setup' );

/*
 * Init Customizer Options
 */
require_once trailingslashit( get_template_directory() ) . 'themeoptions/redux/framework.php';                   // Customizer framework
require_once trailingslashit( get_template_directory() ) . 'themeoptions/theme_options.php';                     // Customizer framework
require_once trailingslashit( get_template_directory() ) . 'themeoptions/options_assets/pinnacle_extension.php'; // Customizer framework.

/*
 * Init Theme Startup/Core utilities
 */
require_once trailingslashit( get_template_directory() ) . 'lib/classes/class-pinnacle-plugin-check.php'; // Check plugin class.
require_once trailingslashit( get_template_directory() ) . 'lib/utils.php';                               // Utility functions
require_once trailingslashit( get_template_directory() ) . 'lib/init.php';                                // Initial theme setup and constants
require_once trailingslashit( get_template_directory() ) . 'lib/class-pinnacle-get-image.php';            // image_functions
require_once trailingslashit( get_template_directory() ) . 'lib/image_functions.php';                     // image_functions
require_once trailingslashit( get_template_directory() ) . 'lib/sidebar.php';                             // Sidebar class
require_once trailingslashit( get_template_directory() ) . 'lib/config.php';                              // Configuration
require_once trailingslashit( get_template_directory() ) . 'lib/cleanup.php';                             // Cleanup
require_once trailingslashit( get_template_directory() ) . 'lib/nav.php';                                 // Custom nav modifications
require_once trailingslashit( get_template_directory() ) . 'lib/custom.php';                              // Custom functions
require_once trailingslashit( get_template_directory() ) . 'lib/metaboxes.php';                           // Custom metaboxes
require_once trailingslashit( get_template_directory() ) . 'lib/plugin-activate.php';                     // Plugin Activation.

/*
 * Init Widget areas
 */
require_once trailingslashit( get_template_directory() ) . 'lib/widgets.php';                            // Sidebars and widgets.

/*
 * Template Hooks
 */
require_once trailingslashit( get_template_directory() ) . 'lib/comments.php';                         // Custom comments modifications
require_once trailingslashit( get_template_directory() ) . 'lib/authorbox.php';                        // Author box
require_once trailingslashit( get_template_directory() ) . 'lib/custom-woocommerce.php';               // Woocommerce functions
require_once trailingslashit( get_template_directory() ) . 'lib/woo-account.php';                      // Woocommerce functions
require_once trailingslashit( get_template_directory() ) . 'lib/woocommerce/product-archive-hooks.php'; // Woocommerce functions
require_once trailingslashit( get_template_directory() ) . 'lib/template-actions.php';                 // Template actions.

/*
 * Load Scripts
 */
require_once trailingslashit( get_template_directory() ) . 'lib/admin_scripts.php'; // Admin Scripts functions
require_once trailingslashit( get_template_directory() ) . 'lib/scripts.php';       // Scripts and stylesheets
require_once trailingslashit( get_template_directory() ) . 'lib/output_css.php';    // Fontend Custom CSS.

