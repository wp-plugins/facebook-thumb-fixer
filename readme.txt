=== Facebook Thumb Fixer ===
Contributors: mikeyott
Tags: facebook, thumb, fixer, default, thumbnail, thumbnails, thumbs, og:image, og:description, og:title, open, graph, open graph
Requires at least: 2.9.2
Tested up to: 3.8
Stable tag: trunk

Fixes the problem of the missing (or wrong) thumbnail when a post is shared on Facebook or Google+.

== Description ==

This plugin is for those who have the problem where sharing a post on Facebook or Google+ shows the wrong (or no) thumbnail image.

It works by making sure the thumbnail is derived from the featured image of your post. If your post doesn't have a featured image then it will use a fall-back image that you can specify in Settings -> General.

The plugin forces the open graph meta properties into the head of each page and post: og:image, og:title, og:description, og:site_name, og:type and og:url, all of which both Facebook and Google+ (and other services that use open graph) scan for when someone shares your web page.


== Installation ==

Install, activate, done.

== Uninstall ==

Deactivate the plugin, delete if desired.

== Official Web Site (and support) ==

<a href="http://www.thatwebguyblog.com/post/facebook-thumb-fixer-for-wordpress">That Web Guy Blog</a>

Go to Settings -> Facebook Thumb Fixer for detailed information how it works and what it does.

== How to set a fall-back image ==

Go to Settings -> General and scroll down until you find 'Default Facebook Thumb'. Put the path to your fall-back image there. Make sure it's at least 200x200.

== Changelog ==

= 1.3.4 =

'Tested up to' compatibility with Wordpress 3.8.
Wordpress 3.8 notification UI.
Updated documentation to reflect current Facebook requirements, removed document redundancy.
Typo corrections.

= 1.3.3 =

* Minor update: Added strip_tags in more places to prevent potential conflict issue.

= 1.3.2 =

* Changed function name to something less generic to avoid potential conflict with other plugins.

= 1.3.1 =

* Updated recommended og:image dimensions.

= 1.3 =

* Included new open graph properties for og:description, og:site_name and og:type.
* Added visual indication of the field on the settings page.
* Fixed width on preview image (for when someone accidentally uses a massive image).
* Updated help guide.

= 1.2.3 =

* Changed comment output in head to 'Open Graph' instead of 'Facebook Open Graph'.
* Clarification on how the plugin works.

= 1.2.2 =

* Added og:url meta property (according to Facebook debugger, now required).

= 1.2.1 =

* Updated documentation page, suggesting default thumbnail to be 155x155 (because thumbs are that size on Facebook brand pages).

= 1.2 =

* Minor edits, nothing important.

= 1.1 =

* Updated tags.
* Fixed typos.

= 1.0 =

* Release candidate finished.
* Added support information under admin Settings -> Facebook Thumb Fixer
* Updated support information.

= 0.9 =

* Swapped out deprecated Wordpress variables.