=== myStickymenu ===
Contributors: (Damiroquai)
Donate link: http://wordpress.transformnews.com
Tags: sticky menu, twentythirteen
Requires at least: 3.8
Tested up to: 3.8.1
Stable tag: trunk
License: GPLv2 or later

This lightweight plugin will made your Twentythirteen menu sticky on top of page after scroll hits upper border.

== Description ==
Plugin is designed for Twentythirteen template but should work on any theme, it's using default twentythirteen ".navbar" css class and that should be modified for other themes if different. Plugin Home + Demo URL: http://wordpress.transformnews.com/plugins/mystickymenu-simple-sticky-fixed-on-top-menu-implementation-for-twentythirteen-menu-269 


== Installation ==

Install like any other plugin. After install activate.

If using template other than Twentythirteen open wp-content/plugins/mystickymenu/mystickymenu.js and edit selector class based on your template navigation bar class.
"var navbar = document.querySelector('.navbar');"
"var navbar = document.querySelector('.your_navbar_class');"

Edit /mystickymenu/mystickymenu.css to edit menu style, width, color...
Original javascript used from http://jsbin.com/omanut/2/edit



== Screenshots ==
1.  screenshot-1.png in plugin folder shows menu when page is opened, and not scrolled.
2.  screenshot-2.png shows menu when page is scrolled towards the bottom.
