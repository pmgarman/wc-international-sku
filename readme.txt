=== WooCommerce - International SKU ===
Contributors: patrickgarman, gunio
Tags: woocommerce, product, sku, international
Requires at least: 4.4
Tested up to: 4.7
Stable tag: 1.0.0
License: GPLv3
License URI: https://www.gnu.org/licenses/gpl-3.0.html

Add a secondary SKU to products that is used for orders shipping outside of the base country of WooCommerce (international orders).

== Description ==

Sometimes orders being shipped internationally require shipping a slightly different variation of your product (for various legal/regulatory reasons). This plugin will allow for products to have two SKUs, one for domestic orders and one for international orders. The SKU returned on order items in orders via the API and dashboard will be filtered to return the international SKU when the shipping address varies from the shop base address.

Made with support from [Gun.io](http://gun.io), the Professional Freelancer network that nurtures the open source community.

== Installation ==

= Minimum Requirements =

* PHP version 5.2.4 or greater (PHP 5.6 or greater is recommended)
* WooCommerce 2.6+

= Automatic installation =

Automatic installation is the easiest option as WordPress handles the file transfers itself and you don’t need to leave your web browser. To do an automatic install of WC International SKU, log in to your WordPress dashboard, navigate to the Plugins menu and click Add New.

In the search field type "WC International SKU" and click Search Plugins. Once you’ve found our eCommerce plugin you can view details about it such as the point release, rating and description. Most importantly of course, you can install it by simply clicking “Install Now”.

= Manual installation =

The manual installation method involves downloading our plugin and uploading it to your webserver via your favorite FTP application. The WordPress codex contains [instructions on how to do this here](https://codex.wordpress.org/Managing_Plugins#Manual_Plugin_Installation).

== Changelog ==

= 1.0.0 - 2017-03-20 =
* Initial release; support for WC 2.6 & 3.0
