=== Easy ===
Plugin name: Easy
Contributors: 2046
Plugin URI: http://wordpress.org/extend/easy
Donate Link: http://2046.cz/
Tags: admin, widget, loop, page, post, custom, type, taxonomy, tag, category, comments, content, drag, drop, gallery, image
Requires at least: 3.4.1
Tested up to: 3.4.1
Stable tag: 0.5.1

Easy, but complex GUI website builder.

== Description ==

Though teh widget is still in progress, it's worth to be tested.

This widget is a new much better version then its ancestor <a href="http://wordpress.org/extend/plugins/2046s-widget-loops/">2046's loop widget</a> which serves as a the testing platform, before the real thing comes.
"Easy" will have all it's ancestors functions plus many more and ofcourse your own! 

"Easy" is done in extensible way. So that anybody can plug in their own object with its own function and use the Drag&Drop power of this widget to his own needs. As for now there is no closer explanation how, but wait, it has been just born!

The widget scafolding structure is based on the <a href="http://twitter.github.com/">Bootstrap</a> logic. If you do not know Bootstrap, then don't miss the train!

= What is to be done = 
 * Core - DONE
 * Multi selector for each item - DONE
 * Finish the input builder - IN PROGRESS
 * Create all view items for.. taxonomies, categories, author, meta values, etc. - IN PROGRESS
 * Create items covering all native Wordpress WP_Query possibilities. - IN PROGRESS
 * Multiple controls of the same type - IN CONSIDERATION
 * Localization
 * Write nice Documentation
 * Create an well documented example extension in form of WP plugin.
 * Listen to you guys.

more on: <a href="http://2046.cz/freestuff/easy.html">Project homapage</a>

== Installation ==

As usual. If you don't know how, check out the <a href="http://codex.wordpress.org/Managing_Plugins">official how-to</a>.

== Frequently Asked Questions ==

= Why I cannot use more then one instance of control brick of the same type? =

Yep, you cannot, at least for now.
It make sense in some cases, and make no sense in others.. (in case of IDs for categories you can still use minus sings... like 1, 2, -6, 7..)

= Why did you make such a thing for free? =

Why not?

= Known bugs =


== Upgrade Notice ==

Remember, it is not in production state! Many things are changing on the way.

== Screenshots ==
 
1. Screenshot of the version 0.5

== Change log ==

= 0.5.1 = 
 * NEW - the full size of the image was misisng in the list of available image sizes, Now the list is complete. btw.. it reads all the registred image sizes :)

= 0.5 = 
 * NEW - Many new view blocks (shortcode, text, meta, comments number, comments)
 * NEW - All blocks have class input (if "necessary")
 * NEW - new control blocks (offset, category, post_status)
 * FIX - Control are not rewriting the query args, but adds new, as it supposed to
 * FIX - Values from checkboxes do not causes problem anymore
 * ...
	
= 0.4 = 
 * NEW - all bricks can have multi input (select box, texarea, check box) -- hidden input, and radio in next release
 * the EasyItem array structure changed a bit
 * there are some more bricks generally
 * the brain fu.. is behind me, from now on.. everything will be just fun to add :)
 * more in next release..
 
