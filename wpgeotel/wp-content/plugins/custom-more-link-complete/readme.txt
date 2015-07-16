=== Custom More Link Complete ===

Contributors: Florin Arjocu
Donate link:https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=WCAGK4N8G8RBC&lc=GB&item_name=Help%20me%20by%20supporting%20the%20Custom%20More%20Link%20Complete%20WordPress%20Plugin&currency_code=EUR&bn=PP%2dDonationsBF%3abtn_donateCC_LG_global%2egif%3aNonHosted
Tags: more,read-more,link,more-link-complete,edit-more-link,customize-more-link, customize-read-more,edit-read-more,nofollow,template,customize,excerpt,continue-reading
Requires at least: 2.9.1
Tested up to: 3.3.1
Stable tag: 1.4.1
License: GPLv2 or later

Customize your `&lt;!-- more -->` read more link, remove anchor, customize CSS class, add title to the link, add markup or nofollow...
 
== Description ==

This plugin helps you customize the read more link (`<!-- more -->`) provided by WordPress 'insert more link' feature
without changing template files. Just activate the plugin, change the link structure
in the options panel, save. With this plugin you can

1. remove the #more-number anchor tag from the read-more/continue-reading link.
1. remove or modify the CSS class.
1. add a nofollow attribute.
1. customize the markup adding additional tags.
1. add the title to read more link. you can customize the title to your necessities.
1. remove the filters that TwentyTen/TwentyEleven applies to excerpts.
1. customize the excerpt Read More link or [...] text.
1. everything you want to do.

== Update 14 February 2012 ==
I've released version 1.4.1 which introduces a completely new way to attach the scripts to the Wordpress actions. As I could test and from the first feedback, the compatibility is much higher that previous method inherited from other plugins. Enjoy Custom More Link Complete!

== Update February 2012 ==
Considering the received feedback, now you cand also customize the "Continue reading" link and  "[...]" text on excerpts (for instance you see them on category pages in TwentyTen/TwentyEleven themes). On the configuration page you MUST first activate the removal of the default filters from TwentyTen, TwentyEleven. Otherwise, the TT, TE filters will conflict with CMLC and your links will not work.

Updated on January 2012: I made a change in the regex according to Gerobe's feedback. Thanks!


CMLC (Custom More Link Complete) combines the power and flexibility of 2 of the best plugins existing for this purpose, with some personal bug fixes and improvements.

In the custom link structure you an use the following tags:

1. %permalink% - the permalink provided by WordPress
1. %anchor% - the anchortext provided by WordPress (default '#more-number')
1. %class% - the CSS class provided by WordPress (default 'more-link')
1. %linktext% - the linktext as delivered by WordPress
1. %title% - the article title (customizable)

== Installation ==

This section describes how to install the plugin and get it working.

1. Upload directory `custom-more-link-complete` to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Edit more-link ("Read more"/"Continue reading"/etc.) structure according to your needs in Settings -> Custom More Link Complete

== Localization ==
You will find in the <b>languages</b> folder the English localization files (.po and .mo), the German translation files (dl_custom_more_link_complete-de_DE.po, dl_custom_more_link_complete-de_DE.mo) and the Romanian translation files (dl_custom_more_link_complete-ro_RO.po, dl_custom_more_link_complete-ro_RO.mo). Using Poedit you can easily create more translations if you open the .po file. If you have more translations to include in the following releases, please send them on my email: florin@drumliber.ro
Thanks!

== Changelog ==
= 1.4.1 =
* Fixed the bug that appeared on some themes, making it not to run our filters on category pages.
* Changed the internal filters we attach our actions to. It should prevent future problems with theme incompatibility.
* Small code revision


= 1.4 =
* Now you cand also customize the "Continue reading" link and  "[...]" text on excerpts. For this to work on the default Wordpress themes (TwentyTen, TwentyEleven), you MUST activate the checkbox to remove the original filters of TT, TE themes!
* Added option (active by default) to remove the default filters for excerpts on TwentyTen and TwentyEleven themes.
* Added German translation, thanks to A. Mitucă
* Now CMLC filter for main page does not run on pages that echo excerpts (archive, category, etc. - this depends on theme), but a special filter is built for excerpts, as it anyway wouldn't work with main page's filter.
* Small code clean-up
* Set plugin_textdomain to relative path

= 1.3.1 =
* Removed CHANGELOG file

= 1.3 =
* Now the default pattern for more-link is optimized to contain the title attibute.
* Added the default pattern as plain text to make it easy to compare with the original pattern (just in case it is needed).
* Updated language files (English and Romanian) to include the updated labels.

= 1.2 =
* Updated minor texts and updated regex of Gerobe's feedback. Thanks!

= 1.1 =
* Update for latest Wordpress release (3.3.1)

= 1.0 =
* First version release


== Screenshots ==

1. Custom More Link Complete options page (v1.4x)

== Thanks to ==
Although it was completely rewritten and has new features, originally the plugin was based on the plugin Custom More Link by Michael Weingaertner (http://cywhale.de) and has elements of More Link Modifier by Peggy Kuo (http://psychopyko.com). Thanks to Gerobe for all the feedback he provided. I thank to J. Hammock & Associates, LLC (http://hammock.net) for the donation they made, it was a pleasant reminder to keep updating and testing this great plugin.
