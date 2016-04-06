<?php	
if ( !defined( 'ABSPATH' ) ) {
	exit;
}
include_once( get_theme_root() . '/raindrops/childs/inc.php');
include_once( get_theme_root() . '/raindrops/childs/functions.php');
include_once( get_stylesheet_directory() . '/config.php');

/**
 * Setup
 */
function raindrops_child_init() {
	/* broad color type setting */
	add_action( 'raindrops_include_after', 'boots_extend_styles' );
	add_filter( 'body_class', 'boots_body_classes' );

	add_filter( 'raindrops_nav_menu_primary_html', 'boots_hash_link_change' );
	add_action( 'after_setup_theme', 'raindrops_child_init' );
	add_filter('raindrops_base_setting_args', 'boots_base_setting_args');
}

add_action( 'raindrops_extend_style_type', 'boots_extend_style' );
add_filter( 'wp_nav_menu_args', 'boots_remove_fallback_cb' );
add_action( 'switch_theme', 'boots_uninstall' );

function boots_base_setting_args( $args ) {
	return $raindrops_child_base_setting_args;
}
/**
 * 
 * @param array $args
 * @return string
 */
function boots_remove_fallback_cb( $args ) {
	$args[ 'fallback_cb' ] = '';
	return $args;
}

/**
 * 
 * @param type $html
 * @return type
 */
function boots_hash_link_change( $html ) {

	return str_replace( 'href="#doc3"', 'href="#"', $html );
}

/**
 * Determination of depth of color
 * @param type $r
 * @param type $g
 * @param type $b
 * @return float value 0-255
 */
function boots_darkness( $r, $g, $b ) {

	$r		 = $r * 299;
	$g		 = $g * 587;
	$b		 = $b * 114;
	$result	 = ( $r + $g + $b ) / 1000;

	return $result;
}

/**
 * 
 * @global type $raindrops_current_theme_slug
 * @param type $classes
 * @return type
 */
function boots_body_classes( $classes ) {

	global $raindrops_current_theme_slug;

	$boots_page_width = raindrops_warehouse_clone( "raindrops_page_width" );

	if ( empty( $boots_page_width ) ) {

		$boots_page_width = 'doc5';
	}

	$classes[]	 = 'page-width-' . $boots_page_width;
	$classes[]	 = 'child-' . $raindrops_current_theme_slug;

	return apply_filters( 'boots_body_classes', $classes );
}

function boots_uninstall() {
	global $parent_theme_settings;

	update_option( 'raindrops_theme_settings', $parent_theme_settings );
}

/**
 * 
 * @global type $post
 * @global type $raindrops_wp_version
 * @param type $position
 */
function raindrops_sidebar_menus( $position = 'default' ) {

	global $post, $raindrops_wp_version;

	if ( 'default' == $position ) {

		if ( is_user_logged_in() ) {

			$customizer_url = 'customize.php?autofocus[section]=raindrops_theme_settings_sidebar';

			echo '<li><div class="link-to-sidebar-settings">';
			echo '<div>
					<h3>Default Sidebar</h3>
					<a href="' . admin_url( 'widgets.php' ) . '">' . __( 'Set Widgets', 'raindrops' ) . '</a><br />or</br />		
					<a href="' . admin_url( $customizer_url ) . '">' . __( 'Change Columns', 'raindrops' ) . '</a>	
				</div>';

			echo '</div></li>';
		}
	} else {

		if ( is_user_logged_in() ) {
			echo '<li><div class="link-to-sidebar-settings">';
			echo '<div>
					<h3>Extra Sidebar</h3>
					<a href="' . admin_url( 'widgets.php' ) . '">' . __( 'Set Widgets', 'raindrops' ) . '</a>
						<br />or</br />
					<a href="' . admin_url( 'widgets.php' ) . '">' . __( 'Change Columns', 'raindrops' ) . '</a>	
				</div>';
			echo '</div></li>';
		}
	}
}

/**
 * 
 */
function boots_extend_style() {

	raindrops_register_styles( "boots" );
	/**
	 * Set boots efault value for Customizer
	 */
	add_filter( 'raindrops_fallback_footer_color_default', 'raindrops_child_fallback_footer_color_default' );
	add_filter( 'raindrops_fallback_hyperlink_color_default', 'raindrops_child_fallback_hyperlink_color_default' );
	add_filter( 'raindrops_fallback_fonts_color_default', 'raindrops_child_fallback_fonts_color_default' );
	add_filter( 'raindrops_fallback_footer_link_color', 'raindrops_child_fallback_footer_link_color' );
	add_filter( 'raindrops_fallback_header_textcolor', 'raindrops_child_fallback_header_textcolor' );
}

?>