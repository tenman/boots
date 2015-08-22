<?php
if ( !defined( 'ABSPATH' ) ) {
    exit;
}
global $template, $raindrops_link_unique_text;
do_action( 'raindrops_pre_part_' . basename( __FILE__, '.php' ) . '_' . basename( $template ) );
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <meta http-equiv="content-type" content="<?php bloginfo( 'html_type' ); ?>; charset=<?php bloginfo( 'charset' ); ?>" />

        <?php wp_head(); ?>
    </head>
    <body <?php body_class(); ?>>
		<?php if ( raindrops_warehouse( 'raindrops_disable_keyboard_focus' ) == 'enable' ) { ?>	
        <div class="skip-link"><a href="#container" class="screen-reader-text" title="<?php esc_attr_e( 'Skip to content', 'boots' ); ?>"><?php esc_html_e( 'Skip to content', 'boots' ); ?></a></div><?php echo raindrops_skip_links(); ?>
		<?php } // raindrops_disable_keyboard_focus ?>
        <?php
        raindrops_prepend_doc();
        ?>
        <header id="top">
            <?php

            $header_image = raindrops_header_image( 'elements' );
          
			if( empty( $header_image ) ) {
				echo raindrops_child_custom_header_image_content( '' );
			} else {
				echo $header_image;
			}
            ?>
            <div class="boots-nav-menu-wrapper" >
				<div style="margin:auto;width:<?php echo boots_page_width(); ?>">    <?php
                /**
                 * horizontal menubar
                 */
				if ( has_nav_menu( 'primary' ) ) {
					raindrops_nav_menu_primary( array('fallback_cb' => '',) );
				}
				?>   
				</div>
			</div>  <?php raindrops_after_nav_menu( ); ?>
        </header>
        <div id="<?php echo esc_attr( raindrops_warehouse( 'raindrops_page_width' ) ); ?>" class="<?php echo esc_attr( 'yui-' . raindrops_warehouse( 'raindrops_col_width' ) ); ?> hfeed">
            <div id="bd" class="clearfix">
                <?php do_action( 'raindrops_after_part_' . basename( __FILE__, '.php' ) . '_' . basename( $template ) ); ?>
		
		