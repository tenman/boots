<?php
/** Theme base font size 
 * 
 * default 15  means 15px
 */
$raindrops_base_font_size = 15;

/**
 * Enabling accessibility links when Setting value no at Raindrops options page Accessibility Settings
 * 
 * 
 * @since1.217
 */
$raindrops_accessibility_link       = true;
/**
 * Display Status Bar
 * 
 * 
 * @since1.217
 */
$raindrops_status_bar               = true;
/** Custom Page width for fluid ( responsive )
 *
 * fluid page  main column maximum width px
 *
 *
 *
 * $raindrops_fluid_maximum_width
 * default 1280
 *
 */
$raindrops_fluid_maximum_width      = '1280';
/** Custom Page width for Fixed Width
 * Original page width implementation by manual labor
 *
 * If you need original page width
 * you can specific pixel page width
 * e.g. '$raindrops_page_width = '776';' is  776px page width.
 *
 * default ''
 */
$raindrops_page_width               = '';
/**
 * Featured image size
 * 
 * full size or single-post-thumbnail 600x200 size
 * since 1.215
 */
$raindrops_featured_image_full_size = true;
/** Show Post Delete link 
 *
 *
 *
 * RAINDROPS_SHOW_DELETE_POST_LINK
 *
 */
define( "RAINDROPS_SHOW_DELETE_POST_LINK", false );
/** Excerpt Settings
 *
 * the_content(   ) or the_excerpt
 *
 * the_excerpt use where index,archive,other not single pages.
 * If RAINDROPS_USE_LIST_EXCERPT value false and use the_content .
 *
 * RAINDROPS_USE_LIST_EXCERPT
 * add ver 1.127
 * When use excerpt please set $raindrops_where_excerpts
 */
define( "RAINDROPS_USE_LIST_EXCERPT", false );

// values 'is_search', 'is_archive', 'is_category' ,'is_tax', 'is_tag' any conditional function name

$raindrops_where_excerpts = array( 'is_search' );

/** Shows Place holder for insert contents
 *
 * When WP_DEBUG value true and $raindrops_actions_hook_message value true
 * Show Raindrops action filter position and examples
 *
 * default false
 * @since 0.980
 */
$raindrops_actions_hook_message = false;
?>