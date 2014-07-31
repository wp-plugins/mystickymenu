=== myStickymenu ===
Contributors: damiroquai
Donate link: http://wordpress.transformnews.com
Tags: sticky menu, twentythirteen, twenty-thirteen, plugin, menu, jquery
Requires at least: 3.8
Tested up to: 3.9.1
Stable tag: 1.6
License: GPLv2 or later

This lightweight plugin will made your menu or header sticky on top of page, after desired number of pixels when scrolled.

== Description ==
Plugin is designed for Twenty Thirteen template but should work on any theme. By default, it uses Twenty Thirteen navigation css class ".navbar" under "Sticky Class" setting field   and that should be modified for other themes (if different) to make it work. Don’t forget this, it’s a mandatory fieldß. 

Plugin is  responsive as far as your theme is. Also there is possibility to add custom css code which make this plugin very flexible, customizable and user friendly.

Another advancement of this simple plugin is that increases usability and page views of your WordPress site since menu is available to the user all the time.  

Plugin Home + Demo URL: http://wordpress.transformnews.com/plugins/mystickymenu-simple-sticky-fixed-on-top-menu-implementation-for-twentythirteen-menu-269 

== Installation ==
Install like any other plugin. After install activate. If using template other than Twenty Thirteen go to Settings / myStickymenu and change Sticky Class to .your_navbar_class or #your_navbar_id..


== Frequently Asked Questions ==

= How to find Sticky Class, what should I enter here? =
So this depends on what you want to make sticky and what theme do you use, but for example if you want your menu to be sticky, than you can examine the code (in firefox right click and “View page source”) and find div in which your menu is situated. This div have some class or id, and that’s the Sticky Class we need. If using class than don’t forget to ad dot (.) in front of class name, or hash (#) in front of id name in Sticky Class field. Twenty Thirteen default working class is “.navbar” without of quotes.


== Screenshots ==

1.  screenshot-1.png shows administration settings.
2.  screenshot-2.png shows menu when page is scrolled towards the bottom.


== Changelog ==

= 1.6 =
* Added: “Make visible when scroled” after number of pixels option.
* Fixed opacity 100 bug.

= 1.5 =
* Added option to enter exact width in px when sticky menu should be disabled “Disable at Small Screen Sizes”.
* Added “.myfixed css class” setting field – edit .myfixed css style via plugin settings to create custom style.
* Fixed google adsense clash and undefined index notice.
* is_user_logged_in instead of old “Remove CSS Rules for Static Admin Bar while Sticky” option

= 1.4 =
* Added fade in or slide down effect settings field for sticky class.
* Added new wrapped div around selected sticky class with id mysticky_wrap which should make menu works smoother and extend theme support.

= 1.3 =
* Added “block direct access” to the mystickymenu plugin file (for security sake).
* Added Enable / Disable at small screen sizes and Remove not necessary css for all themes without admin bar on front page.
* Added “margin-top :0px” to .myfixed class in head which should extend theme support.

= 1.2 =
* Fixed mystickymenu.js for IE browsers, so myStickymenu is now compatible with IE 10, 11
  
= 1.1 =
* Added administration options, now available through Dashboard / Settings / myStickymenu. Options are as follows: Sticky Class, Sticky z-index, Sticky Width, Sticky Background Color, Sticky Opacity, Sticky Transition Time. 
* Old mystickymenu.css file is deprecated and not in use anymore.

= 1.0 =
* First release of myStickymenu plugin

== Upgrade Notice ==
= 1.6 =
* After plugin update go to mystickymenu plugin settings and save changes with desired value for a new parameters. Clear cache if some cache system used on your site.
* Added: “Make visible when scroled” after number of pixels option.
* Fixed opacity 100 bug.

= 1.5 =
* Added option to enter exact width in px when sticky menu should be disabled “Disable at Small Screen Sizes”.
* Added “.myfixed css class” setting field – edit .myfixed css style via plugin settings to create custom style.
* Fixed google adsense clash and undefined index notice.
* is_user_logged_in instead of old “Remove CSS Rules for Static Admin Bar while Sticky” option

= 1.4 =
* Added fade in or slide down effect settings field for sticky class.
* Added new wrapped div around selected sticky class with id mysticky_wrap.

= 1.3 =
* Added “block direct access” to the mystickymenu plugin file.
* Added Enable / Disable at small screen sizes and Remove not necessary css.
* Added “margin-top :0px” to .myfixed class in head which should extend theme support.

= 1.2 =
* Fixed mystickymenu.js for IE browsers, so myStickymenu is now compatible with IE 10, 11
  
= 1.1 =
* Added administration options, now available through Dashboard / Settings / myStickymenu. Options are as follows: Sticky Class, Sticky z-index, Sticky Width, Sticky Background Color, Sticky Opacity, Sticky Transition Time. 
* Old mystickymenu.css file is deprecated and not in use anymore.



