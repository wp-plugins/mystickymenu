<?php     
   /*
    Plugin Name: myStickymenu 
    Plugin URI: http://wordpress.transformnews.com/plugins/mystickymenu-simple-sticky-fixed-on-top-menu-implementation-for-twentythirteen-menu-269
    Description: Simple sticky (fixed on top) menu implementation for default Twentythirteen navigation menu. For other themes, if navigation class is different than .navbar change it to .your_navbar_class on the beggining of mystickymenu.js script  ('.navbar') and inside mystickymenu.css.
    Version: 1.0
    Author: m.r.d.a
    License: GPLv2 or later
    */

//remove default option for more link that jumps at the midle of page and its covered by menu

function remove_more_jump_link($link) { 
	$offset = strpos($link, '#more-');
	if ($offset) {
		$end = strpos($link, '"',$offset);
	}
	if ($end) {
		$link = substr_replace($link, '', $offset, $end-$offset);
	}
	return $link;
}
add_filter('the_content_more_link', 'remove_more_jump_link');

function mystickymenu_script() {

wp_enqueue_style('mystickymenu',WP_PLUGIN_URL.'/mystickymenu/mystickymenu.css', false,'1.0.0');
wp_register_script('mystickymenu', WP_PLUGIN_URL. '/mystickymenu/mystickymenu.js', false,'1.0.0', true);
wp_enqueue_script( 'mystickymenu' );

}
add_action( 'wp_enqueue_scripts', 'mystickymenu_script' );
?>