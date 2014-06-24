<?php
include_once( get_theme_root() . '/raindrops/childs/boots/inc.php');

include_once( get_theme_root() . '/raindrops/childs/boots/functions.php');

include_once( get_stylesheet_directory() . '/config.php');

if ( isset( $raindrops_child_base_setting_args ) && !empty( $raindrops_child_base_setting_args ) ) {

    $raindrops_base_setting = $raindrops_child_base_setting_args;
}