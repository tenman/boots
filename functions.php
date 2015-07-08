<?php
if ( ! defined( 'ABSPATH' ) ) {
	
    exit;
}
include_once( get_theme_root() . '/raindrops/childs/boots/inc.php');
include_once( get_theme_root() . '/raindrops/childs/boots/functions.php');
include_once( get_stylesheet_directory() . '/config.php');

/**
 * Already, using the parent theme, to take over the setting
 * false Setting child own
 * true  same behavior as the parent theme
 */
$boots_genetic_parents	= false;
/**
 * Sticky Menu
 */
$boots_sticky_menu		= true;




add_action( 'after_setup_theme', 'boots_init' );

	function boots_init() {

		add_filter( 'body_class', 'boots_body_classes' );
		add_action( 'wp_enqueue_scripts', 'boots_enqueue' );
		
		if ( ! has_nav_menu( 'primary' ) ) {
			$boots_sticky_menu = false;
		}
	}

add_action( 'raindrops_extend_style_type', 'boots_extend_style' );
/**
 * override Parent default colors
 * @param type $val
 * @return type
 * 
 */
if ( ! function_exists( 'boots_fallback_footer_color_default' ) ) {
	function boots_fallback_footer_color_default( $val ) {
		global $raindrops_child_base_setting_args;
		return raindrops_warehouse_clone( 'raindrops_footer_color' );
	}
}
if ( ! function_exists( 'boots_fallback_hyperlink_color_default' ) ) {
	function boots_fallback_hyperlink_color_default( $val ) {
		global $raindrops_child_base_setting_args;
		return raindrops_warehouse_clone( 'raindrops_hyperlink_color' );
	}
}
if ( ! function_exists( 'boots_fallback_fonts_color_default' ) ) {
	function boots_fallback_fonts_color_default( $val ) {
		global $raindrops_child_base_setting_args;
		return raindrops_warehouse_clone( 'raindrops_default_fonts_color' );
	}
}
if ( ! function_exists( 'boots_fallback_footer_link_color' ) ) {
	function boots_fallback_footer_link_color( $val ) {
		global $raindrops_child_base_setting_args;
		return raindrops_warehouse_clone( 'raindrops_footer_link_color' );
	}
}
if ( ! function_exists( 'boots_fallback_header_textcolor' ) ) {
	function boots_fallback_header_textcolor( $val ) {
		global $raindrops_child_base_setting_args;
		return  get_theme_mod( 'header_textcolor', 'ffffff' );
	}
}

if ( ! function_exists('boots_darkness') ) {
/**
 * Determination of depth of color
 * @param type $r
 * @param type $g
 * @param type $b
 * @return float value 0-255
 */

	function boots_darkness( $r , $g, $b ) {

		$r = $r * 299;
		$g = $g * 587;
		$b = $b * 114;
		$result= ( $r + $g + $b ) / 1000;

		return $result; 
	}
}
if ( ! function_exists('raindrops_indv_css_boots') ) {
/**
 * 
 * @return type
 */	
	function raindrops_indv_css_boots() {
		/**
		 * Create Color from base color
		 */
		$base_color					 = raindrops_warehouse_clone( 'raindrops_base_color' );
		$base_color					 = apply_filters( 'boots_base_color', $base_color );
		$complementary_base_color	 = raindrops_complementary_color( $base_color );

		/**
		 * fallback in the case of very dark color is set to base_color
		 */
		$hex2rgb = raindrops_hex2rgb_array_clone( $base_color );
		$darkness = (float) boots_darkness($hex2rgb[0],$hex2rgb[1],$hex2rgb[2]);
		
		if( function_exists( 'boots_darkness' ) && $darkness < 60 ) {
			$hover_contrast_color = '#f55';
		} else {
			$hover_contrast_color = $base_color;
		}

		/**
		 * Detect Link Color from link color settings
		 */
		$hyper_link_color			 = raindrops_warehouse_clone( 'raindrops_hyperlink_color' );
		$complementary_link_color	 = raindrops_warehouse_clone( 'raindrops_complementary_color_for_title_link' );
		/**
		 * Create border rgba color from base color setting
		 */
		$rgba_border = raindrops_hex2rgba( $base_color, 0.2 );
		$rgba_border_3 = raindrops_hex2rgba( $base_color, 0.3 );

		/**
		 * Create gradient from base color setting
		 */
		$gradient = raindrops_gradient_single_clone( '-4', 'asc' );
		/**
		 * Create Original color for accent
		 */
		$accent_color				 = '#336699';
		$complementary_accent_color	 = raindrops_complementary_color( $hyper_link_color );
		/**
		 * Detect config for design
		 */
		$page_width					 = raindrops_warehouse_clone( 'raindrops_fluid_max_width' );

		$css = <<<BOOTSCSS
	   html{background:#fff;}
		.home.rd-type-boots  .sticky{
			background:{$rgba_border};
		}
	   .entry-content blockquote{
		%c5%;
		border-left: 10px solid {$rgba_border};
	   }
	   .entry-content blockquote:before {
			%c5%;
			background:transparent;
	   }
	   .entry-content table th,
	   .entry-content table td{
			border-bottom: 1px solid {$rgba_border};
		}
		.entry-content table tr:first-child td,
		.entry-content table th{
			border-top: 1px solid {$rgba_border};
		}
		.entry-content fieldset{
			border: 1px solid {$rgba_border};
		}
		.entry-content legend{
			color: {$complementary_base_color};
		}
		.rd-type-boots select option:nth-child(even) {
			%c5%;
		}
		.rd-type-boots select option:nth-child(odd) {
			%c4%;

		}
		.rd-type-boots .sticky-single-follow-text.anytime a{

			border: 1px solid {$rgba_border};
			%c5%;
			color: {$complementary_base_color};	
		}
		.rd-type-boots #wp-calendar {
			border:none;
		}
		.rd-type-boots #ft #wp-calendar caption{
			%c5%;
		}
		.rd-type-boots #wp-calendar th{
			%c_5%;
		}
		.rd-type-boots #ft #wp-calendar th{
			%c_5%;
		}

		.rd-type-boots #wp-calendar tbody td{
			border: 1px solid {$rgba_border};
			%c3%;
			text-align:center;
		}
		.rd-type-boots .post-group_by-category-title a,
		.rd-type-boots .post-group_by-category-title{

			text-align:center;
			margin:0;
		}
		.rd-type-boots .post-group_by-category-title + ul{
			border: 1px solid {$rgba_border};
			margin:0;

		}
		.rd-type-boots #ft #wp-calendar{
			%c2%;
		}
		.rd-type-boots #ft #wp-calendar tbody td{
			border: 1px solid {$rgba_border};
			%c2%;
			text-align:center;
		}

		.rd-type-boots .rsidebar #wp-calendar tbody td a,
		.rd-type-boots .lsidebar #wp-calendar tbody td a{
			border: 1px solid {$rgba_border};
			%c4%;
			width:100%;
			height:100%;
			display:block;
			text-decoration:none;
		}
		.rd-type-boots #wp-calendar tbody #today{
			%c_3%;
		}
		.rd-type-boots #wp-calendar tfoot #next a,
		.rd-type-boots #wp-calendar tfoot #prev a{
			%c_4%;
			display:inline-block;
			text-align:center;
			text-decoration:none;
		}
		.rd-type-boots .rsidebar  li,
		.rd-type-boots .lsidebar li{
			color:#999; 
		}
		.rd-type-boots .lsidebar .widget_rss a,
		.rd-type-boots .lsidebar .widget_rss a {
			%c5%;
			display:inline-block;
		}
		.rd-type-boots .post-group_by-category-title{
			padding:.6em .6em;
		}
		
		#ft .footer-widget .widgettitle,
		.rd-type-boots .rsidebar .widget .widgettitle,
		.rd-type-boots .lsidebar .widget .widgettitle{
			%c_1%;
			padding:.6em .6em 1em;
			margin-left:-5px;
		}
		.rd-type-boots .raindrops-pinup-entries .entry-title{
			%c_5%;
		}
		.rd-type-boots .lsidebar .widget_rss .widgettitle{
			background:transparent;
			display:block;
			height:2em;
		}
		.rd-type-boots input[type="password"],	
		.rd-type-boots input[type="url"],	
		.rd-type-boots input[type="tell"],
		.rd-type-boots input[type="search"],
		.rd-type-boots input[type="datetime-local"],
		.rd-type-boots input[type="datetime"],
		.rd-type-boots input[type="number"],
		.rd-type-boots .entry-content textarea,
		.rd-type-boots .entry-content input[type="email"],
		.rd-type-boots .entry-content input[type="text"],
		.rd-type-boots .entry-content input[type="submit"], 
		.rd-type-boots .entry-content input[type="reset"], 
		.rd-type-boots .entry-content input[type="file"],
		.rd-type-boots .social textarea,
		.rd-type-boots .social input[type="text"],
		.rd-type-boots .social input[type="submit"], 
		.rd-type-boots .social input[type="reset"], 
		.rd-type-boots .social input[type="file"]{
			border:1px solid {$rgba_border};
			%c5%;
		}
		.rd-type-boots input[type="submit"]{
			%c4%;
			border:1px solid {$rgba_border};
		}
		#nav-below-comments .nav-next a,
		#nav-below-comments .nav-previous a,
		#nav-above-comments .nav-next a,
		#nav-above-comments .nav-previous a,
		#ft .footer-widget + ul li .rsswidget,
		.rd-type-boots .edit-link,
		.rd-type-boots .entry-content .more-link,
		.rd-type-boots .entry-content .raindrops-excerpt-more{
			%c5%;
			border:1px solid {$rgba_border_3};
		}
		.rd-type-boots .entry-meta{
			border-bottom:1px solid {$rgba_border_3};
		}
		.rd-type-boots .yui-t4 #yui-main + .yui-b,
		.rd-type-boots .yui-t5 #yui-main + .yui-b,
		.rd-type-boots .yui-t6 #yui-main + .yui-b{
			border-left:1px solid {$rgba_border_3};
		}
		.rd-type-boots .yui-t1 #yui-main + .yui-b,
		.rd-type-boots .yui-t2 #yui-main + .yui-b,
		.rd-type-boots .yui-t3 #yui-main + .yui-b{
			border-right:1px solid {$rgba_border_3};
		}
		.rd-type-boots .rsidebar{
			border-left:1px solid {$rgba_border_3};
		}
		.rsidebar .eco-archive > .month , .lsidebar .eco-archive > .month,
		.rsidebar .eco-archive > .year, .lsidebar .eco-archive > .year{
			border-bottom:1px solid {$rgba_border_3};
		}

		#comments .pingback a:not(.comment-edit-link),
		#comments .pingback{
			%c_1%;
			border:1px solid {$rgba_border_3};
		}
		#comments .comment{
			%c4%;
			border:1px solid {$rgba_border_3};
		}
		.comment-author{
			%c5%;
			border:1px solid {$rgba_border_3};
		}
		.comment .reply{
			%c3%;
		}
		.pingback .comment-edit-link{
			%c5%;
			border:1px solid {$rgba_border_3};
		}
		.comment .comment-edit-link{
			%c_3%;
			border:1px solid {$rgba_border_3};
		}
		.rd-type-boots hr.tear {
			height:16px;
			background:linear-gradient(-135deg, #fff 4px, transparent 0) 0 4px,linear-gradient(135deg, #fff 4px, {$rgba_border_3} 0) 0 4px;
			background-color: #fff;
			background-position: left bottom !important;
			background-repeat: repeat-x !important;
			background-size: 8px 8px;
			width:100%;
		}
	@media screen and (min-width : 641px){

		.child-boots #access .children a,
		.child-boots #access .sub-menu a{
			%c_5%;
		}
	}
	@media screen and (max-width : 640px){
		.entry-content dl{
			border:1px solid {$rgba_border_3};
		}
		.entry-content dt{
			%c_1%;
		 }
		 .entry-content dd{
			 %c5%;
		 }
	}
		#ft .widget_tag_cloud .tagcloud a:hover,
		#ft .eco-archive .year a:hover, 			
		#ft .eco-archive .month a:hover,			
		#ft a:hover{
			color:{$complementary_base_color};
		}

		.rsidebar .eco-archive .month a:hover, 
		.lsidebar .eco-archive .month a:hover,
		.rsidebar .eco-archive .year a:hover, 
		.lsidebar .eco-archive .year a:hover,
		.lsidebar .widget_tag_cloud .tagcloud a:hover,
		.rd-type-boots #site-title:hover span,
		.rd-type-boots #site-title a:focus span,
		.rd-type-boots #access .sub-menu.focus > a,
		.rd-type-boots #access .chilren.focus > a,
		.rd-type-boots #access .sub-menu:hover > a,
		.rd-type-boots #access .chilren:hover > a,
			.rd-type-boots #access li a:hover{
			color:{$hover_contrast_color};
		}
		#ft{
			{$gradient}
		}
		.rd-type-boots .lsidebar > ul > li > ul > li:nth-child(10n+1):hover a,
		.rd-type-boots .lsidebar > ul > li > ul > li:nth-child(10n+1):hover{
			%c5%;
		}
		.rd-type-boots .lsidebar > ul > li > ul > li:nth-child(10n+2):hover a,
		.rd-type-boots .lsidebar > ul > li > ul > li:nth-child(10n+2):hover{
			%c4%;
		}
		.rd-type-boots .lsidebar > ul > li > ul > li:nth-child(10n+3):hover a,
		.rd-type-boots .lsidebar > ul > li > ul > li:nth-child(10n+3):hover{
			%c3%;
		}
		.rd-type-boots .lsidebar > ul > li > ul > li:nth-child(10n+4):hover a,
		.rd-type-boots .lsidebar > ul > li > ul > li:nth-child(10n+4):hover{
			%c2%;
		}
		.rd-type-boots .lsidebar > ul > li > ul > li:nth-child(10n+5):hover a,
		.rd-type-boots .lsidebar > ul > li > ul > li:nth-child(10n+5):hover{
			%c1%;
		}
		.rd-type-boots .lsidebar > ul > li > ul > li:nth-child(10n+6):hover a,
		.rd-type-boots .lsidebar > ul > li > ul > li:nth-child(10n+6):hover{
			%c_1%;
		}
		.rd-type-boots .lsidebar > ul > li > ul > li:nth-child(10n+7):hover a,
		.rd-type-boots .lsidebar > ul > li > ul > li:nth-child(10n+7):hover{
			%c1%;
		}
		.rd-type-boots .lsidebar > ul > li > ul > li:nth-child(10n+8):hover a,
		.rd-type-boots .lsidebar > ul > li > ul > li:nth-child(10n+8):hover{
			%c2%;
		}
		.rd-type-boots .lsidebar > ul > li > ul > li:nth-child(10n+9):hover a,
		.rd-type-boots .lsidebar > ul > li > ul > li:nth-child(10n+9):hover{
			%c3%;
		}
		.rd-type-boots .lsidebar > ul > li > ul > li:nth-child(10n+10):hover a,
		.rd-type-boots .lsidebar > ul > li > ul > li:nth-child(10n+10):hover{
			%c4%;

		}

		.rd-type-boots .rsidebar > ul > li > ul > li:nth-child(10n+1):hover a,
		.rd-type-boots .rsidebar > ul > li > ul > li:nth-child(10n+1):hover{
			%c5%;
		}
		.rd-type-boots .rsidebar > ul > li > ul > li:nth-child(10n+2):hover a,
		.rd-type-boots .rsidebar > ul > li > ul > li:nth-child(10n+2):hover{
			%c4%;
		}
		.rd-type-boots .rsidebar > ul > li > ul > li:nth-child(10n+3):hover a,
		.rd-type-boots .rsidebar > ul > li > ul > li:nth-child(10n+3):hover{
			%c3%;
		}
		.rd-type-boots .rsidebar > ul > li > ul > li:nth-child(10n+4):hover a,
		.rd-type-boots .rsidebar > ul > li > ul > li:nth-child(10n+4):hover{
			%c2%;
		}
		.rd-type-boots .rsidebar > ul > li > ul > li:nth-child(10n+5):hover a,
		.rd-type-boots .rsidebar > ul > li > ul > li:nth-child(10n+5):hover{
			%c1%;
		}
		.rd-type-boots .rsidebar > ul > li > ul > li:nth-child(10n+6):hover a,
		.rd-type-boots .rsidebar > ul > li > ul > li:nth-child(10n+6):hover{
			%c_1%;
		}
		.rd-type-boots .rsidebar > ul > li > ul > li:nth-child(10n+7):hover a,
		.rd-type-boots .rsidebar > ul > li > ul > li:nth-child(10n+7):hover{
			%c1%;
		}
		.rd-type-boots .rsidebar > ul > li > ul > li:nth-child(10n+8):hover a,
		.rd-type-boots .rsidebar > ul > li > ul > li:nth-child(10n+8):hover{
			%c2%;
		}
		.rd-type-boots .rsidebar > ul > li > ul > li:nth-child(10n+9):hover a,
		.rd-type-boots .rsidebar > ul > li > ul > li:nth-child(10n+9):hover{
			%c3%;
		}
		.rd-type-boots .rsidebar > ul > li > ul > li:nth-child(10n+10):hover a,
		.rd-type-boots .rsidebar > ul > li > ul > li:nth-child(10n+10):hover{
			%c4%;

		}
		.rd-type-boots .lsidebar > ul > .widget_recent-post-groupby-cat ul li:hover a,
		.rd-type-boots .lsidebar > ul > .widget_recent-post-groupby-cat ul li:hover,
		.rd-type-boots .rsidebar > ul > li > ul > li a,
		.rd-type-boots .rsidebar > ul > li > ul > li a{
			background:none!important;
		}
			
		.rd-type-boots .lsidebar > ul > li > div > ul > li:nth-child(10n+1):hover a,
		.rd-type-boots .lsidebar > ul > li > div > ul > li:nth-child(10n+1):hover{
			%c5%;
		}
		.rd-type-boots .lsidebar > ul > li > div > ul > li:nth-child(10n+2):hover a,
		.rd-type-boots .lsidebar > ul > li > div > ul > li:nth-child(10n+2):hover{
			%c4%;
		}
		.rd-type-boots .lsidebar > ul > li > div > ul > li:nth-child(10n+3):hover a,
		.rd-type-boots .lsidebar > ul > li > div > ul > li:nth-child(10n+3):hover{
			%c3%;
		}
		.rd-type-boots .lsidebar > ul > li > div > ul > li:nth-child(10n+4):hover a,
		.rd-type-boots .lsidebar > ul > li > div > ul > li:nth-child(10n+4):hover{
			%c2%;
		}
		.rd-type-boots .lsidebar > ul > li > div > ul > li:nth-child(10n+5):hover a,
		.rd-type-boots .lsidebar > ul > li > div > ul > li:nth-child(10n+5):hover{
			%c1%;
		}
		.rd-type-boots .lsidebar > ul > li > div > ul > li:nth-child(10n+6):hover a,
		.rd-type-boots .lsidebar > ul > li > div > ul > li:nth-child(10n+6):hover{
			%c_1%;
		}
		.rd-type-boots .lsidebar > ul > li > div > ul > li:nth-child(10n+7):hover a,
		.rd-type-boots .lsidebar > ul > li > div > ul > li:nth-child(10n+7):hover{
			%c1%;
		}
		.rd-type-boots .lsidebar > ul > li > div > ul > li:nth-child(10n+8):hover a,
		.rd-type-boots .lsidebar > ul > li > div > ul > li:nth-child(10n+8):hover{
			%c2%;
		}
		.rd-type-boots .lsidebar > ul > li > div > ul > li:nth-child(10n+9):hover a,
		.rd-type-boots .lsidebar > ul > li > div > ul > li:nth-child(10n+9):hover{
			%c3%;
		}
		.rd-type-boots .lsidebar > ul > li > div > ul > li:nth-child(10n+10):hover a,
		.rd-type-boots .lsidebar > ul > li > div > ul > li:nth-child(10n+10):hover{
			%c4%;

		}
		.rd-type-boots .rsidebar > ul > li > div > ul > li:nth-child(10n+1):hover a,
		.rd-type-boots .rsidebar > ul > li > div > ul > li:nth-child(10n+1):hover{
			%c5%;
		}
		.rd-type-boots .rsidebar > ul > li > div > ul > li:nth-child(10n+2):hover a,
		.rd-type-boots .rsidebar > ul > li > div > ul > li:nth-child(10n+2):hover{
			%c4%;
		}
		.rd-type-boots .rsidebar > ul > li > div > ul > li:nth-child(10n+3):hover a,
		.rd-type-boots .rsidebar > ul > li > div > ul > li:nth-child(10n+3):hover{
			%c3%;
		}
		.rd-type-boots .rsidebar > ul > li > div > ul > li:nth-child(10n+4):hover a,
		.rd-type-boots .rsidebar > ul > li > div > ul > li:nth-child(10n+4):hover{
			%c2%;
		}
		.rd-type-boots .rsidebar > ul > li > div > ul > li:nth-child(10n+5):hover a,
		.rd-type-boots .rsidebar > ul > li > div > ul > li:nth-child(10n+5):hover{
			%c1%;
		}
		.rd-type-boots .rsidebar > ul > li > div > ul > li:nth-child(10n+6):hover a,
		.rd-type-boots .rsidebar > ul > li > div > ul > li:nth-child(10n+6):hover{
			%c_1%;
		}
		.rd-type-boots .rsidebar > ul > li > div > ul > li:nth-child(10n+7):hover a,
		.rd-type-boots .rsidebar > ul > li > div > ul > li:nth-child(10n+7):hover{
			%c1%;
		}
		.rd-type-boots .rsidebar > ul > li > div > ul > li:nth-child(10n+8):hover a,
		.rd-type-boots .rsidebar > ul > li > div > ul > li:nth-child(10n+8):hover{
			%c2%;
		}
		.rd-type-boots .rsidebar > ul > li > div > ul > li:nth-child(10n+9):hover a,
		.rd-type-boots .rsidebar > ul > li > div > ul > li:nth-child(10n+9):hover{
			%c3%;
		}
		.rd-type-boots .rsidebar > ul > li > div > ul > li:nth-child(10n+10):hover a,
		.rd-type-boots .rsidebar > ul > li > div > ul > li:nth-child(10n+10):hover{
			%c4%;
		}

BOOTSCSS;
		return apply_filters( __FUNCTION__, $css );
	}
}

if ( ! function_exists('boots_body_classes') ) {
	function boots_body_classes( $classes ) {

		global $raindrops_current_theme_slug;

		$boots_page_width = raindrops_warehouse_clone( "raindrops_page_width" );

		if ( empty( $boots_page_width ) ) {

			$boots_page_width = 'doc5';
		}

		$classes[] = 'page-width-' . $boots_page_width;
		$classes[] = 'child-' . $raindrops_current_theme_slug;

		return apply_filters( 'boots_body_classes', $classes );
	}
}
if ( ! function_exists('boots_enqueue') ) {
	function boots_enqueue() {

		global $raindrops_current_data_version, $boots_sticky_menu;

		if( false === $boots_sticky_menu ) {
			return false;
		}

		wp_register_script( 'boots-extend-script', get_stylesheet_directory_uri().'/boots.js', array('jquery'),$raindrops_current_data_version, true );
		wp_enqueue_script( 'boots-extend-script' );
	}
}
if ( ! function_exists('raindrops_sidebar_menus') ) {
	function raindrops_sidebar_menus( $position = 'default' ) {

		global $post, $raindrops_wp_version ;

		if ( 'default' == $position ) {

			echo '<li>';
			the_widget( 'raindrops_recent_post_group_by_category_widget' );
			echo '</li>';
			echo '<li>';
			the_widget( 'raindrops_extend_archive_Widget' );
			echo '</li>';
		} else {

			wp_list_categories( 'show_count=1&title_li=<h2 class="h2 widget-title">' . esc_html__( 'Categories', 'Raindrops' ) . '</h2>&echo=1' );
		}
		wp_reset_postdata();
	}
}
if ( ! function_exists('boots_options_field_owner_check') ) {
	
	function boots_options_field_owner_check() {

		global $raindrops_child_base_setting_args;

		foreach ( $raindrops_child_base_setting_args as $add ) {

			$option_name = $add[ 'option_name' ];
			$boots_theme_settings[ $option_name ] = $add[ 'option_value' ];
		}

		update_option( 'raindrops_theme_settings', $boots_theme_settings );

		if ( file_exists( get_stylesheet_directory() . '/images/headers/wp3.jpg' ) ) {

			$raindrops_site_image			 = get_stylesheet_directory_uri() . '/images/headers/wp3.jpg';
			$raindrops_site_thumbnail_image	 = get_stylesheet_directory_uri() . '/images/headers/wp3-thumbnail.jpg';
		} else {

			$raindrops_site_image			 = get_template_directory_uri() . '/images/headers/wp3.jpg';
			$raindrops_site_thumbnail_image	 = get_template_directory_uri() . '/images/headers/wp3-thumbnail.jpg';
		}
		set_theme_mod( 'default-image', $raindrops_site_image );
	}
}
if ( ! function_exists('boots_extend_style') ) {
	function boots_extend_style() {

		raindrops_register_styles( "boots" );
		
		/**
		 * Set boots efault value for Customizer
		 */	
		add_filter('raindrops_fallback_footer_color_default', 'boots_fallback_footer_color_default');
		add_filter( 'raindrops_fallback_hyperlink_color_default', 'boots_fallback_hyperlink_color_default' );
		add_filter( 'raindrops_fallback_fonts_color_default', 'boots_fallback_fonts_color_default' );
		add_filter( 'raindrops_fallback_footer_link_color', 'boots_fallback_footer_link_color');
		add_filter( 'raindrops_fallback_header_textcolor', 'boots_fallback_header_textcolor' );

	}
}

if ( isset( $raindrops_child_base_setting_args ) && !empty( $raindrops_child_base_setting_args ) ) {

	$boots_current_theme_data	 = wp_get_theme();
	$boots_current_theme		 = $boots_current_theme_data->get( 'Name' );
	$boots_option_field			 = get_option( 'raindrops_theme_settings' );

	if ( false == $boots_genetic_parents && 
		isset( $boots_option_field[ 'raindrops_options_owner' ] ) && 
		$boots_option_field[ 'raindrops_options_owner' ] !== $boots_current_theme ) {

		boots_options_field_owner_check();
	}
	
	/**
	 * Transitional Setting for raindrops version 1.302 and older 
	 */
	
	$raindrops_current_data			 = wp_get_theme( 'raindrops' );
	$raindrops_current_data_version	 = $raindrops_current_data->get( 'Version' );
	$raindrops_version_compare		 = version_compare(  '1.302', $raindrops_current_data_version, '<=');
	if ( true == $raindrops_version_compare && !isset( $boots_option_field[ 'raindrops_options_owner' ] ) ) {
		boots_options_field_owner_check();
	}
	$raindrops_base_setting = $raindrops_child_base_setting_args;
}