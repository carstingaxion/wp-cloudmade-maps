=== WP Cloudmade Maps ===
Contributors: carstenbach
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=XHR4SXESC9RJ6
Tags: geo, geocoding, location, cloudmade, map, osm, openstreetmap, shortcode, tinymce-button, user-friendly GUI, widget
Requires at least: 3.1
Tested up to: 3.2.1
Stable tag: 0.0.5

Add static and interactive cloudmade maps to your website, using a widget, different shortcodes and a tinymce GUI for user-friendly map-embedding.



== Description ==

With WP Cloudmade Maps you are able to add static and interactive maps to your website using Cloudmades designable OpenStreetMaps-Data.
This way you can add maps that fits your webdesign. Choose from over 50.000 [ready-to-use map styles](http://maps.cloudmade.com/editor "Have a look at the style editor and find your style by color or tag") or create your own with the CloudMade Style Editor.

The Plugin brings

* a widget to show your last geotagged posts with static maps,
* a shortcode for static maps
* two shortcodes for interactive maps

and countless attributes, to fit the maps your ideas.

All shortcodes are accessible via an user-friendly tinymce button and a lightweight configuration interface for editors.
As Administrator you're able to set everything as defaults, so your editor just have to 'click & drop' a new map inside a post, page or a custom_post_type at all.

= General Features =

* works with **posts, pages and custom posttypes**
* adds **microformat geo-markup** to your located content, to make your geo-content machine-readable
* adds **meta-tags with location information** to your html output, to make your website readable to geo-DBs
* ability to **enable or disable unused parts** of this plugin, to keep it editor-friendly
* upload **custom marker images** into the WordPress media-library and use it on your maps
* check all your default settings with **example-maps inside the settings pages** directly
* **inline documentation** inside the WordPress help-tabs
* complete **deactivation and uninstalling routines** to keep your options-table clean
* **JS- and CSS files are loaded conditionally** only when they are needed


= Static Maps Features =

* easy embed **static map images** into your content using GUI or shortcode
* align maps with the default **WordPress alignment CSS-classes**
* add maps as **background-images** to the *body*-tag or as *header-images*
* show posts addresses as caption of the maps with WordPress default caption markup

= Active Maps Features =

* easy embed **static map images** into your content using GUI or shortcode
* align maps with the default **WordPress alignment CSS-classes**
* add zoom controls
* show map scale
* navigate within a small overview-map
* add descriptive labels to your map-markers

= Languages =
* English
* German

== Installation ==

1.  Extract the zip file
2.  Drop the contents in the wp-content/plugins/ directory of your WordPress installation
3.  Activate the Plugin from Plugins page
4.  Enter your personal [cloudmade API key](http://developers.cloudmade.com/projects/show/web-maps-studio "Get your personal cloudmade API key here for free")
5.  and a [flickr.places API key](http://www.flickr.com/services/apps/create/apply/ "Get your flickr.places API key here for free") (optionally, but useful to have reverse-geocoding features enabled)
6.  Add maps to your content via the tinyMCE GUI or place
  	* `<?php do_shortcode('[cmm_static]'); ?>`,
  	* `<?php do_shortcode('[cmm_active_single]'); ?>` or
  	* `<?php do_shortcode('[cmm_active_group]'); ?>` in your templates



== Upgrade Notice ==
There a no upgrade issues at the moment ;)



== Frequently Asked Questions ==





== Screenshots ==
1. General Settings Screen
2. Settings Screen for Static maps options
3. Settings Screen for Active maps options
4. Edit Screen for new or existing posts, where to locate your current post


== Changelog ==

= 0.0.5 ( December 2011 ) =

*   first public release



== Arbitrary section ==
All shortcodes and its attributes are described and documented inside the WordPress "help"-tab on the upper right corner of each settings page. Have a look over there if you want to use the shortcodes in your theme files.

If you are having a feature request for this plugin, drop me a line at wp-cloudmade-maps@carsten-bach.de.
If there is nothing from you, I'll go on doing one of the following:

= roadmap =
* update the help-section inside the help-tab
* give the ability to define horizontal- and vertical-anchor for larger Marker Icons
* add an option to decide, whether to output xhtml or html markup
* add geo:RSS markup to feeds
* optimizing the usability of the GUI for mutual dependence of some options
* add an error message for non-existing default latitude and longitude
* add the ability to show the active maps with a caption of the address
* add a "show on map link", to jump directly to a specific point
* upload an "out of range" tile image
* upload an own loading image
* enable / disable Marker clustering for active-group-maps
* upload own cluster images