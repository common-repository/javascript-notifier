=== JavaScript Notifier ===
Contributors: freemp
Tags: javascript, disabled, notification, warning, test, alert
Requires at least: 3.8
Tested up to: 6.6
Stable tag: trunk
License: GPL v2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

JavaScript Notifier allows you to inform visitors that your website requires JavaScript.

== Description ==

A simple, lightweight WordPress plugin for displaying a notification bar at the top of the webpage if 1st-party JavaScript is disabled. If appropriate, the entire website may as well be blocked by a full-page overlay instead of just a small bar.

The plugin offers configuration of background and foreground color, opacity, notification message text and font size. Individual customization by means of CSS snippets is also supported.

== Installation ==

1. Upload the plugin files to the `/wp-content/plugins/javascript-notifier` directory, or install the plugin through the WordPress plugins screen directly.
2. Activate the plugin through the 'Plugins' screen in WordPress
3. Use the Settings->JavaScript Notifier screen to configure the plugin

== Frequently Asked Questions ==

= Does JavaScript Notifier support multilingual sites? =

Yes, it does. A corresponding `wpml-config.xml` language configuration file can be found in the plugin's home directory.

= Instead at the top, I would like to have the notification bar being displayed at the bottom of the page. Would that be possible? =

Sure. Just enter the following CSS code into the Custom CSS input field: `top:inherit;bottom:0`

= Does JavaScript Notifier cope with optimization plugins? =

In order to work flicker-free, JavaScript Notifier requires one short piece of inline JavaScript code to remain in its exact place. Therefore, it should be excluded from all kind of optimization. Since the code piece is labelled `hide-javascript-notifier-js`, the easiest way would be to add that label to the optimization plugin's JavaScript exclusion list, or the like.  

== Screenshots ==

1. Notification Bar
2. Blocking Mode Enabled
3. Plugin Settings

== Changelog ==

= 1.2.8 =
* Fixed undefined array key warning. Suggested by @hoeczek. Thanks!
* Adapted admin script enqueue handle for actual file name.

= 1.2.7 =
* Minor optimization.
* Adapted screenshots for latest version.

= 1.2.6 =
* Increased callback priority.
* Resorted plugin settings.

= 1.2.5 =
* Opened plugin for translations.
* Removed translations from plugin directory.

= 1.2.4 =
* Updated translations.

= 1.2.3 =
* Replaced outdated JavaScript mime type.

= 1.2.2 =
* Fixed WPML translations configuration.
* Optimized options conversion.

= 1.2.1 =
* Fixed options conversion failure after upgrading.

= 1.2.0 =
* Detached admin code from main plugin functionality.
* Moved settings into single option array entry.
* Changed font size unit from 'em' to percent.

= 1.1.1 =
* Moved JavaScript and CSS into page footer.

= 1.1.0 =
* Added input field for custom CSS.

= 1.0.1 =
* Added translation for initial notification message.
* Added ID for inline JavaScript, e.g. if required for excluding from optimization.

= 1.0.0 =
* Initial release

== Upgrade Notice ==

= 1.2.2 =
* Fixes broken WPML translations configuration.  Upgrade required for multilingual sites.

= 1.2.1 =
* Fixes an option conversion issue.  Upgrade immediately.

= 1.1.1 =
* Fixes a stability issue.  Upgrade immediately.
