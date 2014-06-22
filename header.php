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
        <title><?php wp_title( '|', true, 'right' ); ?></title>
        <?php wp_head(); ?>
    </head>
    <body <?php body_class(); ?>>
        <?php
        raindrops_prepend_doc();
        ?>
        <header id="top">
            <?php
            if ( true == $raindrops_link_unique_text ) {

                echo raindrops_header_image( 'elements' );
            } else {

                echo raindrops_header_image( 'home_url' );
            }
            ?>
            <?php
            $image = get_header_image();
            if ( empty( $image ) ) {
                echo boots_custom_header_image_content( '' );
            }
            ?>
            <div class="broad-nav-menu-wrapper" style="margin:auto;width:<?php echo boots_page_width(); ?>">     <?php
                /**
                 * horizontal menubar
                 *
                 *
                 *
                 *
                 */
                raindrops_nav_menu_primary();
                ?>   </div>  <?php
            raindrops_after_nav_menu();
            ?>
        </header>
        <div id="<?php echo esc_attr( raindrops_warehouse( 'raindrops_page_width' ) ); ?>" class="<?php echo esc_attr( 'yui-' . raindrops_warehouse( 'raindrops_col_width' ) ); ?> hfeed">
            <div id="bd" class="clearfix">
                <?php do_action( 'raindrops_after_part_' . basename( __FILE__, '.php' ) . '_' . basename( $template ) ); ?>

                <!--child theme header.php-->