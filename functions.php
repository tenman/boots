<?php
/*       Child Theme Functions Start      */

add_action( 'after_setup_theme','boots_init');

function boots_init(){
/**
 * If you want to use the functions defined in Raindrops, please describe in this function 
 * 
 * 
 **/
    
    
/*
 * Add a CSS class to the body element in order to Page Width basis, and to style their own rules
 * 
 */    
    add_filter('body_class', 'boots_body_classes');
}

function boots_body_classes( $classes ) {
        
        $boots_page_width = raindrops_warehouse_clone( "raindrops_page_width" );
        
        if( empty( $boots_page_width ) ) {
            
            $boots_page_width = 'doc3';
        }
            
        $classes[] = 'page-width-'. $boots_page_width;
        
        $boots_child_theme_name = wp_get_theme()->get('Name');
        $boots_child_theme_name = str_replace( array( ' ', '_'),'-', $boots_child_theme_name );
        $boots_child_theme_name = strtolower($boots_child_theme_name);
        
         if( ! empty( $boots_page_width ) ) {      
             $classes[] = 'child-'. $boots_child_theme_name;
         }
       
        return apply_filters( 'boots_body_classes', $classes );
}

/*       Child Theme Functions End      */

////////////////////////////////////////////////////////////////////////////////
include_once( get_theme_root() . '/raindrops/childs/boots/inc.php');

include_once( get_theme_root() . '/raindrops/childs/boots/functions.php');

include_once( get_stylesheet_directory() . '/config.php');

if ( isset( $raindrops_child_base_setting_args ) && !empty( $raindrops_child_base_setting_args ) ) {

    $raindrops_base_setting = $raindrops_child_base_setting_args;
}

