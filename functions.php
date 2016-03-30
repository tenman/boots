<?php
if ( !defined( 'ABSPATH' ) ) {
	exit;
}
include_once( get_theme_root() . '/raindrops/childs/inc.php');
include_once( get_theme_root() . '/raindrops/childs/functions.php');
include_once( get_stylesheet_directory() . '/config.php');
/**
 * Already, using the parent theme, to take over the setting
 * false Setting child own
 * true  same behavior as the parent theme
 */
$boots_genetic_parents = false;
/**
 * Setup
 */
function raindrops_child_init() {
	/* broad color type setting */
	add_action( 'raindrops_include_after', 'boots_extend_styles' );
	add_filter( 'body_class', 'boots_body_classes' );

	add_filter( 'raindrops_nav_menu_primary_html', 'boots_hash_link_change' );
	add_action( 'after_setup_theme', 'raindrops_child_init' );
	//unregister_default_headers( array('raindrops') );

}
	add_action( 'raindrops_extend_style_type', 'boots_extend_style' );
	add_action( 'switch_theme', 'boots_uninstall' );
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

/**
 * 
 * @global type $raindrops_child_base_setting_args
 */
function boots_options_field_owner_check() {

	global $raindrops_child_base_setting_args;
	
	$parent_theme_settings = get_option( 'raindrops_theme_settings');
	
	set_theme_mod( 'parent_theme_settings', $parent_theme_settings );

	foreach ( $raindrops_child_base_setting_args as $add ) {

		$option_name							 = $add[ 'option_name' ];
		$boots_theme_settings[ $option_name ]	 = $add[ 'option_value' ];
	}

	update_option( 'raindrops_theme_settings', $boots_theme_settings );

	$raindrops_site_image = '';

	set_theme_mod( 'default-image', $raindrops_site_image );
}
/**
 * 
 */
function puddle_uninstall(){
 
	update_option("raindrops_theme_settings", get_theme_mod( 'parent_theme_settings') );
}
if ( ! function_exists('raindrops_sidebar_menus') ) {
	/**
	 * 
	 * @global type $post
	 * @global type $raindrops_wp_version
	 * @param type $position
	 */
	function raindrops_sidebar_menus( $position = 'default' ) {

		global $post, $raindrops_wp_version ;

		if ( 'default' == $position ) {
			
			if( is_user_logged_in() ) {
				echo '<li><div class="link-to-sidebar-settings">';
				echo '<div>
					<h3>Default Sidebar</h3>
					<a href="'.admin_url('widgets.php').'">'. __('Set Widgets', 'raindrops' ). '</a><br />or</br />
					<a href="'.admin_url('customize.php?autofocus[section]=raindrops_theme_settings_sidebar').'">'. __('Change Columns', 'raindrops' ). '</a>	
				</div>';
				
				echo '</div></li>';
			}

		} else {
			
			if( is_user_logged_in() ) {
			echo '<li><div class="link-to-sidebar-settings">';
				echo '<div>
					<h3>Extra Sidebar</h3>
					<a href="'.admin_url('widgets.php').'">'. __('Set Widgets', 'raindrops' ). '</a>
						<br />or</br />
					<a href="'.admin_url('widgets.php').'">'. __('Change Columns', 'raindrops' ). '</a>	
				</div>';
				echo '</div></li>';
				
			}
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
/**
 * 
 */
if ( isset( $raindrops_child_base_setting_args ) && !empty( $raindrops_child_base_setting_args ) ) {

	$boots_current_theme_data	 = wp_get_theme();
	$boots_current_theme		 = $boots_current_theme_data->get( 'Name' );
	$boots_option_field			 = get_option( 'raindrops_theme_settings' );

	if ( false == $boots_genetic_parents &&
	isset( $boots_option_field[ 'raindrops_options_owner' ] ) &&
	$boots_option_field[ 'raindrops_options_owner' ] !== $boots_current_theme ) {

		boots_options_field_owner_check();
	}
	if ( false == $boots_genetic_parents ) {
		$raindrops_base_setting = $raindrops_child_base_setting_args;
	}
}?>