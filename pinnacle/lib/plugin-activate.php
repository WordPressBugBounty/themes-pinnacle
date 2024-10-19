<?php
/**
 * Add notice for toolkit.
 * Include the TGM_Plugin_Activation class.
 * Register the required plugins for this theme.
 *
 * @package Pinnacle Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
/**
 * Add Notice for toolkit if not installed
 */
function pinnacle_kadence_toolkit_notice() {
	$screen = get_current_screen();
	if ( class_exists( 'virtue_toolkit_welcome' ) || get_transient( 'pinnacle_theme_toolkit_plugin_notice' ) || ! current_user_can( 'manage_options' ) || ! is_object( $screen ) || 'themes' !== $screen->id ) {
		return;
	}
	$installed_plugins = get_plugins();
	if ( ! isset( $installed_plugins['virtue-toolkit/virtue_toolkit.php'] ) ) {
		$button_label = esc_html__( 'Install Pinnacle Toolkit', 'pinnacle' );
		$data_action  = 'install';
	} elseif ( ! Pinnacle_Plugin_Check::active_check( 'virtue-toolkit/virtue_toolkit.php' ) ) {
		$button_label = esc_html__( 'Activate Pinnacle Toolkit', 'pinnacle' );
		$data_action  = 'activate';
	} else {
		return;
	}
	$install_link    = wp_nonce_url(
		add_query_arg(
			array(
				'action' => 'install-plugin',
				'plugin' => 'virtue-toolkit',
			),
			network_admin_url( 'update.php' )
		),
		'install-plugin_virtue-toolkit'
	);
	$activate_nonce  = wp_create_nonce( 'activate-plugin_virtue-toolkit/virtue_toolkit.php' );
	$activation_link = self_admin_url( 'plugins.php?_wpnonce=' . $activate_nonce . '&action=activate&plugin=virtue-toolkit%2Fvirtue_toolkit.php' );
	?>
	<div class="notice updated kt-plugin-install-notice-wrapper" style="position: relative;">
		<h3 class="kt-notice-title"><?php echo esc_html__( 'Thanks for choosing the Pinnacle Theme', 'pinnacle' ); ?></h3>
		<p class="kt-notice-description"><?php /* translators: %s: <strong> */ printf( esc_html__( 'To take full advantage of the Pinnacle Theme please install the %1$sPinnacle Toolkit%2$s, this adds extra settings and features.', 'pinnacle' ), '<strong>', '</strong>' ); ?></p>
		<p class="submit">
			<a class="button button-primary kt-install-toolkit-btn" data-redirect-url="<?php echo esc_url( admin_url( 'themes.php?page=kadence_welcome_page' ) ); ?>" data-activating-label="<?php echo esc_attr__( 'Activating...', 'pinnacle' ); ?>" data-activated-label="<?php echo esc_attr__( 'Activated', 'pinnacle' ); ?>" data-installing-label="<?php echo esc_attr__( 'Installing...', 'pinnacle' ); ?>" data-installed-label="<?php echo esc_attr__( 'Installed', 'pinnacle' ); ?>" data-action="<?php echo esc_attr( $data_action ); ?>" data-install-url="<?php echo esc_attr( $install_link ); ?>" data-activate-url="<?php echo esc_attr( $activation_link ); ?>"><?php echo esc_html( $button_label ); ?></a>
			<a href="<?php echo esc_url( wp_nonce_url( add_query_arg( 'virtue-kadence-toolkit-plugin-notice', 'install' ), 'virtue_toolkit_hide_notices_nonce', '_notice_nonce' ) ); ?>" style="    display: flex; text-decoration: none;" class="notice-dismiss kt-close-notice"><?php esc_html_e( 'Dismiss', 'pinnacle' ); ?></a>
		</p>
	</div>
	<?php
	wp_enqueue_script( 'kadence-toolkit-install' );
}
add_action( 'admin_notices', 'pinnacle_kadence_toolkit_notice' );

/**
 * Hide Notice
 */
function pinnacle_hide_toolkit_plugin_notice() {
	if ( isset( $_GET['virtue-kadence-toolkit-plugin-notice'] ) && isset( $_GET['_notice_nonce'] ) ) {
		if ( ! wp_verify_nonce( wp_unslash( sanitize_key( $_GET['_notice_nonce'] ) ), 'virtue_toolkit_hide_notices_nonce' ) ) {
			wp_die( esc_html__( 'Authorization failed. Please refresh the page and try again.', 'pinnacle' ) );
		}
		set_transient( 'pinnacle_theme_toolkit_plugin_notice', 1, 4 * YEAR_IN_SECONDS );
	}
}
add_action( 'wp_loaded', 'pinnacle_hide_toolkit_plugin_notice' );

/**
 * Add Notice for blocks if not installed
 */
function pinnacle_kadence_blocks_notice() {
	if ( ! class_exists( 'virtue_toolkit_welcome' ) || get_transient( 'pinnacle_theme_blocks_plugin_notice' ) || ! current_user_can( 'manage_options' ) || ! function_exists( 'register_block_type' ) ) {
		return;
	}
	$installed_plugins = get_plugins();
	if ( ! isset( $installed_plugins['kadence-blocks/kadence-blocks.php'] ) ) {
		$button_label = esc_html__( 'Install Kadence Blocks', 'pinnacle' );
		$data_action  = 'install';
	} elseif ( ! Pinnacle_Plugin_Check::active_check( 'kadence-blocks/kadence-blocks.php' ) ) {
		$button_label = esc_html__( 'Activate Kadence Blocks', 'pinnacle' );
		$data_action  = 'activate';
	} else {
		return;
	}
	$install_link    = wp_nonce_url(
		add_query_arg(
			array(
				'action' => 'install-plugin',
				'plugin' => 'kadence-blocks',
			),
			network_admin_url( 'update.php' )
		),
		'install-plugin_kadence-blocks'
	);
	$activate_nonce  = wp_create_nonce( 'activate-plugin_kadence-blocks/kadence-blocks.php' );
	$activation_link = self_admin_url( 'plugins.php?_wpnonce=' . $activate_nonce . '&action=activate&plugin=kadence-blocks%2Fkadence-blocks.php' );
	?>
	<div id="message" class="updated kt-plugin-install-notice-wrapper">
		<h3 class="kt-notice-title"><?php echo esc_html__( 'Thanks for choosing the Pinnacle Theme', 'pinnacle' ); ?></h3>
		<p class="kt-notice-description"><?php /* translators: %s: <strong> <a> */ printf( esc_html__( 'We have a %1$snew plugin%2$s to extend and enhance the Block editor for your site. To take full advantage of the Pinnacle Theme please install the %3$sKadence Blocks%4$s, this adds extra editor blocks settings and features.', 'pinnacle' ), '<a href="https://wordpress.org/plugins/kadence-blocks/" target="_blank">', '</a>', '<strong>', '</strong>' ); ?></p>
		<p class="submit">
			<a class="button button-primary kt-install-guten-btn kt-install-toolkit-btn" data-redirect-url="<?php echo esc_url( admin_url( 'options-general.php?page=kadence_blocks' ) ); ?>" data-activating-label="<?php echo esc_attr__( 'Activating...', 'pinnacle' ); ?>" data-activated-label="<?php echo esc_attr__( 'Activated', 'pinnacle' ); ?>" data-installing-label="<?php echo esc_attr__( 'Installing...', 'pinnacle' ); ?>" data-installed-label="<?php echo esc_attr__( 'Installed', 'pinnacle' ); ?>" data-action="<?php echo esc_attr( $data_action ); ?>" data-install-url="<?php echo esc_attr( $install_link ); ?>" data-activate-url="<?php echo esc_attr( $activation_link ); ?>"><?php echo esc_html( $button_label ); ?></a>
			<a href="<?php echo esc_url( wp_nonce_url( add_query_arg( 'pinnacle-kadence-blocks-plugin-notice', 'install' ), 'pinnacle_blocks_hide_notices_nonce', '_notice_nonce' ) ); ?>" class="notice-dismiss kt-close-guten-notice"><span class="screen-reader-text"><?php esc_html_e( 'Skip', 'pinnacle' ); ?></span></a>
		</p>
	</div>
	<?php
	wp_enqueue_script( 'kadence-toolkit-install' );
}
add_action( 'admin_notices', 'pinnacle_kadence_blocks_notice' );

/**
 * Hide Notice
 */
function pinnacle_hide_blocks_plugin_notice() {
	if ( isset( $_GET['pinnacle-kadence-blocks-plugin-notice'] ) && isset( $_GET['_notice_nonce'] ) ) {
		if ( ! wp_verify_nonce( wp_unslash( sanitize_key( $_GET['_notice_nonce'] ) ), 'pinnacle_blocks_hide_notices_nonce' ) ) {
			wp_die( esc_html__( 'Authorization failed. Please refresh the page and try again.', 'pinnacle' ) );
		}
		set_transient( 'pinnacle_theme_blocks_plugin_notice', 1, 4 * YEAR_IN_SECONDS );
	}
}
add_action( 'wp_loaded', 'pinnacle_hide_blocks_plugin_notice' );


/**
 * Include the TGM_Plugin_Activation class.
 */
require_once dirname( __FILE__ ) . '/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'pinnacle_register_required_plugins' );

/**
 * Register the required plugins for this theme.
 */
function pinnacle_register_required_plugins() {

	$plugins = array(
		array(
			'name'               => 'Virtue/Ascend/Pinnacle Toolkit', // The plugin name.
			'slug'               => 'virtue-toolkit', // The plugin slug (typically the folder name).
			'required'           => false, // If false, the plugin is only 'recommended' instead of required.
			'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
			'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
		),
	);

	$theme_text_domain = 'pinnacle';

	$config = array(
		'domain'           => 'pinnacle',                  // Text domain - likely want to be the same as your theme.
		'default_path'     => '',                          // Default absolute path to pre-packaged plugins.
		'parent_menu_slug' => 'themes.php',                // Default parent menu slug.
		'parent_url_slug'  => 'themes.php',                // Default parent URL slug.
		'menu'             => 'install-required-plugins',  // Menu slug.
		'has_notices'      => false,                       // Show admin notices or not.
		'is_automatic'     => false,                       // Automatically activate plugins after installation or not.
		'message'          => '',                          // Message to output right before the plugins table.
		'strings'          => array(
			'page_title'                      => __( 'Install Required Plugins', 'pinnacle' ),
			'menu_title'                      => __( 'Install Plugins', 'pinnacle' ),
			'installing'                      => __( 'Installing Plugin: %s', 'pinnacle' ), // %1$s = plugin name.
			'oops'                            => __( 'Something went wrong with the plugin API.', 'pinnacle' ),
			'notice_can_install_required'     => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', 'pinnacle' ), // %1$s = plugin name(s).
			'notice_can_install_recommended'  => _n_noop( 'This theme recommends the following plugin, it adds extra features to the theme options and content controls: %1$s. enjoy:)', 'This theme recommends the following plugin, it adds extra features to the theme options and content controls: %1$s. enjoy:)', 'pinnacle' ), // %1$s = plugin name(s).
			'notice_cannot_install'           => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'pinnacle' ), // %1$s = plugin name(s).
			'notice_can_activate_required'    => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'pinnacle' ), // %1$s = plugin name(s).
			'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'pinnacle' ), // %1$s = plugin name(s).
			'notice_cannot_activate'          => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', 'pinnacle' ), // %1$s = plugin name(s).
			'notice_ask_to_update'            => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'pinnacle' ), // %1$s = plugin name(s).
			'notice_cannot_update'            => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', 'pinnacle' ), // %1$s = plugin name(s).
			'install_link'                    => _n_noop( 'Begin installing plugin', 'Begin installing plugins', 'pinnacle' ),
			'activate_link'                   => _n_noop( 'Activate installed plugin', 'Activate installed plugins', 'pinnacle' ),
			'return'                          => __( 'Return to Required Plugins Installer', 'pinnacle' ),
			'plugin_activated'                => __( 'Plugin activated successfully.', 'pinnacle' ),
			'complete'                        => __( 'All plugins installed and activated successfully. %s', 'pinnacle' ), // %1$s = dashboard link.
			'nag_type'                        => 'updated', // Determines admin notice type - can only be 'updated' or 'error'.
		),
	);

	tgmpa( $plugins, $config );

}
