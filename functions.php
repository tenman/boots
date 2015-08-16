<?php
if ( ! defined( 'ABSPATH' ) ) {
	
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
$boots_genetic_parents	= false;
/**
 * Sticky Menu
 */
$boots_sticky_menu		= true;

/**
 *  Custom Header for boots Theme
 *
 *
 *
 */
if ( !isset( $boots_custom_header_args ) ) {
    $boots_custom_header_args = array(
        'default-text-color'     => 'efefef'
        , 'width'                  => apply_filters( 'raindrops_header_image_width', 1600 )
        , 'flex-width'             => true
        , 'height'                 => apply_filters( 'raindrops_header_image_height', 310 )
        , 'flex-height'            => true
        , 'header-text'            => true
        , 'default-image'          => get_stylesheet_directory_uri() . '/images/headers/wp3.jpg'
    );

    add_theme_support( 'custom-header', $boots_custom_header_args );
}


/**
 * Setup
 *
 */

 
if ( ! function_exists( 'raindrops_child_init' ) ) {

    function raindrops_child_init() {
        /* Insert Site Title and Description to Header Image */
		if ( file_exists( get_stylesheet_directory().'/header.php' ) ) {

		}
        /* broad color type setting */
        add_action( 'raindrops_include_after', 'boots_extend_styles' );
		
		add_filter( 'body_class', 'boots_body_classes' );
		add_action( 'wp_enqueue_scripts', 'boots_enqueue' );
		
		if ( ! has_nav_menu( 'primary' ) ) {
			$boots_sticky_menu = false;
		}
		
    }

}
add_action( 'after_setup_theme', 'raindrops_child_init' );

/**
 * Page width for style
 * @return string
 *
 */
if ( ! function_exists( 'boots_page_width' ) ) {

    function boots_page_width() {

        $id = raindrops_warehouse_clone( 'raindrops_page_width' );

        switch ( $id ) {
            case('doc'):
                return '750px';
                break;
            case('doc2'):
                return '950px';
                break;
            case('doc4'):
                return '974px';
                break;
            default:
                $boots_content_max_width = raindrops_warehouse_clone( 'raindrops_fluid_max_width' );

                if ( ! empty( $boots_content_max_width )  && $id == 'doc3') {
                    return '100%; max-width:' . $boots_content_max_width . 'px;';
                } else {
                    return '100%';
                }
                break;
        }
    }

}

if ( ! function_exists( 'boots_hash_link_change' ) ) {

    function boots_hash_link_change( $html ) {

        return str_replace( 'href="#doc3"', 'href="#"', $html );
    }

}
add_filter( 'raindrops_nav_menu_primary_html', 'boots_hash_link_change' );
//add_action( 'after_setup_theme', 'boots_init' );
add_action( 'raindrops_extend_style_type', 'boots_extend_style' );
/*
if ( ! function_exists( 'boots_init' ) ) {
	
	function boots_init() {

		add_filter( 'body_class', 'boots_body_classes' );
		add_action( 'wp_enqueue_scripts', 'boots_enqueue' );
		
		
		if ( ! has_nav_menu( 'primary' ) ) {
			$boots_sticky_menu = false;
		}
	}
}*/



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
 * Color Type for boots theme.
 * 
 * @return style_rules
 * 
 * %c_5% == class color-5
 * %c_4% == class color-4
 * %c_3% == class color-3
 * %c_2% == class color-2
 * %c_1% == class color-1
 * %c1% == class color1
 * %c2% == class color2 
 * %c3% == class color3 
 * %c4% == class color4 
 * %c5% == class color5
 * @see post-new.php help tab
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
			%c4%;
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
		#nav-below .nav-next a,
		#nav-below .nav-previous a{
			%c_1%;
		}
		
		#ft .footer-widget .widgettitle{
			%c_1%;
		}
		.rd-type-boots .rsidebar .widget .widgettitle,
		.rd-type-boots .lsidebar .widget .widgettitle{
			%c_1%;
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
		.rd-type-boots .entry-meta a:hover{
			background: {$rgba_border_3}!important;
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
		.current-menu-item a,
		.current_page_item a,
		.current-menu-item,
		.current_page_item{
			border-bottom:6px solid {$rgba_border_3};
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
		.rd-type-boots .rsidebar > ul > li > ul > li:hover:after,
		.rd-type-boots .lsidebar > ul > li > ul > li:hover:after{
			content: "";
			position:absolute;
			top: 0;
			right: 0;
			height: 0;
			width: 0;
			border: 21px solid transparent;
			border-right-color: #fff;
		}
		/*.rd-type-boots .yui-t2 .lsidebar > ul > li > ul > li:hover:before{
			content: "";
			position:absolute;
			top: 0;
			left: 0;
			height: 0;
			width: 0;
			border: 21px solid transparent;
			border-left-color: #fff;
		}	*/
		#nav-below .nav-previous:hover:after{
			content: "";
			position:absolute;
			top: 1em;
			left: -2.4em;
			height: 0;
			width: 0;
			border: 1.6em solid transparent;
			border-right-color: {$base_color};
		}
		#nav-below .nav-next a:hover:before{
			content: "";
			position:absolute;
			top: 1em;
			right: -2.4em;
			height: 0;
			width: 0;
			border: 1.6em solid transparent;
			border-left-color: {$base_color};
		}
		figure[id^=attachment]{
			background:{$rgba_border_3};
			border:1px solid {$base_color};
		}
		figure[id^=attachment] figcaption{

			background:#fff;
		}
		#date_list tr:nth-child(odd) .time,
		#raindrops_year_list tr:nth-child(odd) .month-name,
		#month_list tr:nth-child(odd) .month-date{
			%c3%;
		}
		#date_list tr:nth-child(even) .time,
		#raindrops_year_list tr:nth-child(even) .month-name,
		#month_list tr:nth-child(even) .month-date{
			%c4%;
		}
		#raindrops_year_list tr .month-name + td,
		#month_list tr .month-date + td{
			border:none;
		}

		#raindrops_year_list tr .month-name + td{
			border-bottom:1px solid {$base_color};
		}
		.entry-content .pagenate a span,
		.entry-content .pagenate span{
				background: #fff;	
				border:1px solid {$base_color};
		}
		.entry-content .pagenate a:hover span{
				%c_2%;
		}
		.entry-content .pagenate > span{
				background: {$rgba_border_3};	
				border:1px solid {$base_color};
		}
	@media screen and (min-width : 641px){
		.child-boots #access .children,
		.child-boots #access .sub-menu,
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
		.rd-type-boots .rsidebar > ul > li > ul > li:hover:after,
		.rd-type-boots .lsidebar > ul > li > ul > li:hover:after{
			
			border: 28px solid transparent;
			border-right-color: #fff;
		}
		.child-boots #top{
			z-index:9999;
			display:block!important;
		}
		#access .menu > li > a,
		#access .children li,
		#access .sub-menu li,
		#top #access > div.menu > ul > li > a, 
		#top #access .menu > li > a,
		#top #access .menu-header,
		#access ul,
		#access a + ul,
		#top #access .children,
		#top #access .sub-menu,
		#access .children a,
		#access .sub-menu a{
			%c_5%;
			position:static!important;
			display:block!important;
			width:100%;
			min-width:100%;
			visibility:visible;
			float:none!important;
			overflow:visible!important;
			z-index:999!important;
			height:auto;
			text-align:left;
		}
		
		.page_item_has_children > a:after, 
		#access .menu-item-has-children > a:after,
		#access .sub-menu .page_item_has_children > a:after, 
		#access .children .menu-item-has-children > a:after, 
		#access .sub-menu .menu-item-has-children > a:after {
			content: '';
			display:none;
		}
		
	}
		.rd-type-boots .entry-title:hover span:first-letter,
		.rd-type-boots .entry-title a:focus span:first-letter,
		#ft .widget_tag_cloud .tagcloud a:hover,
		#ft .eco-archive .year a:hover, 			
		#ft .eco-archive .month a:hover,			
		#ft a:hover{
			color:{$complementary_base_color};
		}
		.rd-type-boots .entry-title:hover span,
		.rd-type-boots .entry-title a:focus span,
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
		.rd-type-boots .rsidebar > ul > li > ul li, 
		.rd-type-boots .lsidebar > ul > li > ul li {
			position:relative;
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

		$classes[] = 'page-width-' . $boots_page_width;
		$classes[] = 'child-' . $raindrops_current_theme_slug;

		return apply_filters( 'boots_body_classes', $classes );
	}
}
if ( ! function_exists('boots_enqueue') ) {
	/**
	 * 
	 * @global type $raindrops_current_data_version
	 * @global boolean $boots_sticky_menu
	 * @return boolean
	 */
	function boots_enqueue() {

		global $raindrops_current_data_version, $boots_sticky_menu, $post;

		if ( false === $boots_sticky_menu ) {
			return false;
		}
		$color_type							 = raindrops_warehouse_clone( 'raindrops_style_type' );
		$raindrops_has_indivisual_notation	 = raindrops_has_indivisual_notation();

		if ( 'boots' == $color_type && false == $raindrops_has_indivisual_notation ) {

			wp_register_script( 'boots-extend-script', get_stylesheet_directory_uri() . '/boots.js', array( 'jquery' ), $raindrops_current_data_version, true );
			wp_enqueue_script( 'boots-extend-script' );
		}
		if ( false !== $raindrops_has_indivisual_notation && 'boots' == $raindrops_has_indivisual_notation[ 'color_type' ] ) {

			wp_register_script( 'boots-extend-script', get_stylesheet_directory_uri() . '/boots.js', array( 'jquery' ), $raindrops_current_data_version, true );
			wp_enqueue_script( 'boots-extend-script' );
		}
	}
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

			echo '<li>';
			the_widget( 'raindrops_recent_post_group_by_category_widget' );
			echo '</li>';
			echo '<li>';
			the_widget( 'raindrops_extend_archive_Widget' );
			echo '</li>';
		} else {

			wp_list_categories( 'show_count=1&title_li=<h2 class="h2 widget-title">' . esc_html__( 'Categories', 'boots' ) . '</h2>&echo=1' );
		}
		wp_reset_postdata();
	}
}
if ( ! function_exists('boots_options_field_owner_check') ) {
	/**
	 * 
	 * @global type $raindrops_child_base_setting_args
	 */
	
	function boots_options_field_owner_check() {

		global $raindrops_child_base_setting_args;

		foreach ( $raindrops_child_base_setting_args as $add ) {

			$option_name = $add[ 'option_name' ];
			$boots_theme_settings[ $option_name ] = $add[ 'option_value' ];
		}

		update_option( 'raindrops_theme_settings', $boots_theme_settings );

		$raindrops_site_image = '';
		
		set_theme_mod( 'default-image', $raindrops_site_image );
	}
}
if ( ! function_exists('boots_extend_style') ) {
	/**
	 * 
	 */
	function boots_extend_style() {

		raindrops_register_styles( "boots" );
		
		/**
		 * Set boots efault value for Customizer
		 */	
		add_filter('raindrops_fallback_footer_color_default', 'raindrops_child_fallback_footer_color_default');
		add_filter( 'raindrops_fallback_hyperlink_color_default', 'raindrops_child_fallback_hyperlink_color_default' );
		add_filter( 'raindrops_fallback_fonts_color_default', 'raindrops_child_fallback_fonts_color_default' );
		add_filter( 'raindrops_fallback_footer_link_color', 'raindrops_child_fallback_footer_link_color');
		add_filter( 'raindrops_fallback_header_textcolor', 'raindrops_child_fallback_header_textcolor' );

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