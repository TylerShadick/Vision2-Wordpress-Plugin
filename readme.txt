=== Vision2 for Wordpress ===
Contributors: Tyler Shadick
Author Website: www.tylershadick.com
Tags: V2, Integration, API
Requires at least: 3.5
Tested up to: 3.6.1
Stable tag: 0.0
License: GPL2
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Extends Wordpress to work with Vision2 Giving Platform

== Description ==

[Vision2 for Wordpress](https://github.com/TylerShadick/ "Tyler Shadick on GitHub")&trade; allows Vision2 code to be displayed on Wordpress.

Installation Instructions
*   Download ZIP file from GitHub (should include V2_for_Wordpress.php and V2_Options.php in the root of the folder)
*   In your Wordpress Backend, go to Plugins > Add New and Upload the Zip File
*   Activate the Plugin
*   Follow prompts to include your V2 API subdomain, you can also find this in Settings > Vision2 Settings
Plugin will not operate without a valid, alphanumeric subdomain
    
Useage Examples
**<div class="v2 v2Module" data-module="profile"></div>**

* Use the shortocde [Vision2 module="profile"] in any WYSIWQIG or Text field in Wordpress 

**<div class="v2 v2Module" data-module="profile" data-opts="{'showPaymentPermissions': true}"></div>**
*  Use the shortcode [Vision2 module="profile" opts="'showPaymentPermissions': true"] in any WYSIWQIG or Text field in Wordpress. Be sure to include the single quotations for the data-opts field, wrapping the data-opts field in parenthesis is optional

Features of Vision2 for Wordpress:

**Output Vision 2 HTML**

*   Allows for the [Vision2 module="" opts=""] shortcode that accepts module data-opts values and outputs unstripped HTML
*   Includes Vision2 Javascript when shortcode is present
