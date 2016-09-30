boots WordPress Child Theme
Theme URL: http://www.tenman.info/wp3/boots
Author URL: http://www.tenman.info/
Parent Theme: raindrops
Parent Theme url: http://www.tenman.info/wp3/raindrops/

boots/images/headers/wp3.jpg
boots/images/footer.png
boots/images/h2.png
boots/images/h2b.png
boots/images/h2c.png
boots/images/example1.jpg
boots/images/example2.jpg
boots/images/example3.jpg
Above images License

copyright   Copyright (c) 2014, Tenman
License: GNU General Public License v2.0
License URI: http://www.gnu.org/licenses/gpl-2.0.html

This themes contents is especially the thing without clear statement of a license
supply under below license.

copyright   Copyright (c) 2010-2012, Tenman
License: GNU General Public License v2.0
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Note: About boots version.
The version of the boots theme, version of Raindrops theme check the operation of this child theme is used

Changelog
var:1.431
	Remove Theme tags
var:1.430
	Data store change from option to theme_mod. needs parent theme Raindrops 1.430
	Style renewal
var:1.400.1
	Fixed when database has raindrops_theme_settings field ( wp_options table )
	The default setting for child theme is not applied correctly.
Note:If a child theme has been uninstalled, child theme, does not continue to hold the option value
var:1.400
	Raindrops Theme 1.400 relate change
	$raindrops_base_setting_args array structure change. to associative array
var:1.356.1
        Parent Raindrops 1.356 relate changes
        Change default. default sidebar, extra sidebar
var:1.316.2
	Fixed Fatal Error with Raindrops 1.319
var:1.316
	It was made a major improvement. All things are changed.
var:1.285.2
	Fixed for Security issue.
		https://make.wordpress.org/plugins/2015/04/20/fixing-add_query_arg-and-remove_query_arg-usage/
	Add
		raindrops_register_styles( "boots" )
		change parent theme config
var:1.283.0

	Require, This Child Theme  needs Raindrops 1.283

	Google font support
	Change import css file name ../raindrops/childs/boots/style.css to ../raindrops/childs/boots/base.css
	Modify style.css
	Default Setting values change
		RAINDROPS_USE_LIST_EXCERPT from false to true
		footer.php add closed elements </div>
		header.php add skiplinks
		Change header-image conditional
		Change default header image
		Change CSS Class name from description to tagline
ver:1.269.1
	CSS modify remove overflow:hidden from .gallery
ver:1.259.0
	header.php remove check header image empty conditional
	CSS modify
ver:1.244.0
	Change Theme URI	from http://www.tenman.info/wp3/broad
						to http://www.tenman.info/wp3/boots
		note:typo
ver:1.225.2
	remove  tag Accessibility-ready
