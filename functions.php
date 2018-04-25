<?php

if ( !defined( 'ABSPATH' ) ) {
	exit;
}
include_once( get_stylesheet_directory() . '/config.php' );
/**
 * Setup
 */
add_action( 'after_setup_theme', 'raindrops_child_init' );

function raindrops_child_init() {
	/* add_action( 'wp_head', 'raindrops_gallerys' ); */
	add_filter( 'raindrops_indv_css_boots', 'raindrops_embed_css' );

	$raindrops_use_featured_image_emphasis = raindrops_warehouse_clone( 'raindrops_use_featured_image_emphasis' );

	if ( 'yes' == $raindrops_use_featured_image_emphasis ) {

		$raindrops_post_image_position = raindrops_warehouse_clone( 'raindrops_featured_image_position' );

		add_filter( 'raindrops_post_thumbnail_size_main_query', 'raindrops_post_thumbnail_size_in_the_loop', 10, 3 );

		switch ( $raindrops_post_image_position ) {

			case( 'front' ):
				add_filter( 'raindrops_indv_css_boots', 'raindrops_post_thumbnail_size_block_style' );
				break;
			case( 'left' ):
				add_filter( 'raindrops_indv_css_boots', 'raindrops_post_thumbnail_size_lefty_style' );
				break;

			default:
		}
	}

	add_filter( 'raindrops_indv_css_boots', 'raindrops_custom_site_title_style' );
	add_filter( 'raindrops_indv_css_boots_pre', 'raindrops_apply_google_font_import_rule_for_site_title' );
	add_filter( 'raindrops_indv_css_boots_pre', 'raindrops_apply_google_font_import_rule_for_primary_menu' );
	add_filter( 'raindrops_indv_css_boots', 'raindrops_apply_google_font_styles_for_site_title' );
	add_filter( 'raindrops_indv_css_boots', 'raindrops_apply_google_font_styles_for_primary_menu' );
	add_filter( 'raindrops_indv_css_boots', 'raindrops_color_pallet_category' );
	add_filter( 'raindrops_indv_css_boots', 'raindrops_filter_archive_grid' );
	add_filter( 'raindrops_indv_css_boots', 'raindrops_gutenberg_front_end_style_filter' );

	add_filter( 'raindrops_keep_content_width', 'labo_boots_raindrops_keep_content_width' );
	add_action( 'raindrops_include_after', 'boots_extend_styles' );
	add_filter( 'body_class', 'boots_body_classes' );
	add_filter( 'raindrops_nav_menu_primary_html', 'boots_hash_link_change' );
	add_filter( 'raindrops_base_setting_args', 'boots_base_setting_args', 0 );
	add_filter( 'raindrops_embed_meta_echo', 'raindrops_child_customizer_relate' );

	add_filter( 'raindrops_custom_header_args', 'boots_header_args', 11 );
}

add_action( 'raindrops_extend_style_type', 'boots_extend_style' );
add_filter( 'wp_nav_menu_args', 'boots_remove_fallback_cb' );
add_action( 'switch_theme', 'boots_uninstall' );

if ( is_multisite() ) {

	add_filter( 'raindrops_theme_settings_raindrops_style_type', 'boots_setting_val' );

	function boots_setting_val( $val ) {
		global $raindrops_current_theme_name;

		if ( !empty( $raindrops_current_theme_name ) && function_exists( 'raindrops_indv_css_' . $raindrops_current_theme_name ) ) {
			return $raindrops_current_theme_name;
		}
		return $val;
	}

}

function boots_base_setting_args( $args ) {
	return $raindrops_child_base_setting_args;
}

function raindrops_child_customizer_relate( $content ) {
	$css = raindrops_design_output( 'boots' );
	return $content . '<style class="boots" type="text/css">' . $css . '</style>';
}

function labo_boots_raindrops_keep_content_width( $return_value ) {
	return false;
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
 * Overwrite Parent default colors
 * @param type $val
 * @return type
 * 
 */
if ( !function_exists( 'raindrops_child_fallback_footer_color_default' ) ) {

	function raindrops_child_fallback_footer_color_default() {
		global $raindrops_child_base_setting_args;

		return $raindrops_child_base_setting_args[ 'raindrops_footer_color' ][ 'option_value' ];
	}

}
if ( !function_exists( 'raindrops_child_fallback_hyperlink_color_default' ) ) {

	function raindrops_child_fallback_hyperlink_color_default() {
		global $raindrops_child_base_setting_args;
		return $raindrops_child_base_setting_args[ 'raindrops_hyperlink_color' ][ 'option_value' ];
	}

}
if ( !function_exists( 'raindrops_child_fallback_fonts_color_default' ) ) {

	function raindrops_child_fallback_fonts_color_default() {
		global $raindrops_child_base_setting_args;
		return $raindrops_child_base_setting_args[ 'raindrops_default_fonts_color' ][ 'option_value' ];
	}

}

if ( !function_exists( 'raindrops_child_fallback_footer_link_color' ) ) {

	function raindrops_child_fallback_footer_link_color() {
		global $raindrops_child_base_setting_args;
		return $raindrops_child_base_setting_args[ 'raindrops_footer_link_color' ][ 'option_value' ];
	}

}
if ( !function_exists( 'raindrops_child_fallback_header_textcolor' ) ) {

	function raindrops_child_fallback_header_textcolor() {
		global $raindrops_child_base_setting_args;
		return get_theme_mod( 'header_textcolor', 'ffffff' );
	}

}

function boots_extend_style() {

	raindrops_register_styles( "boots" );
	/**
	 * Set boots default value for Customizer
	 */
	add_filter( 'raindrops_fallback_footer_color_default', 'raindrops_child_fallback_footer_color_default' );
	add_filter( 'raindrops_fallback_hyperlink_color_default', 'raindrops_child_fallback_hyperlink_color_default' );
	add_filter( 'raindrops_fallback_fonts_color_default', 'raindrops_child_fallback_fonts_color_default' );
	add_filter( 'raindrops_fallback_footer_link_color', 'raindrops_child_fallback_footer_link_color' );
	add_filter( 'raindrops_fallback_header_textcolor', 'raindrops_child_fallback_header_textcolor' );

	add_filter( 'raindrops_color_type_default_color', 'raindrops_child_fallback_fonts_color_default' );
	add_filter( 'raindrops_color_type_default_link_color', 'raindrops_child_fallback_hyperlink_color_default' );
	add_filter( 'raindrops_color_type_default_footer_link_color', 'raindrops_child_fallback_footer_link_color' );
}

add_action( 'wp_enqueue_scripts', 'boots_scripts' );

function boots_scripts() {
	global $boots_current_data_version;

	if ( !is_user_logged_in() ) {
		$boots_current_data_version = null;
	}

	$script_file_uri = get_theme_file_uri( 'boots.js' );

	if ( file_exists( get_stylesheet_directory() . '/boots.js' ) ) {

		wp_register_script( 'boots-script', $script_file_uri, array( 'jquery', 'jquery-migrate' ), $boots_current_data_version, true );
		wp_enqueue_script( 'boots-script' );
	}
}

function boots_header_args( $args ) {

	$args[ 'default-image' ] = '';

	return $args;
}