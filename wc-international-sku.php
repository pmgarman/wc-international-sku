<?php
/**
 * Plugin Name: WooCommerce - International Product SKUs
 * Description: Add a secondary SKU for products sold outside of the base country.
 * Author: Patrick Garman
 * Author URI: http://pmgarman.me/
 * Version: 1.0.0
 * Text Domain: wc-international-sku
 * Domain Path: /languages
 *
 * Copyright (c) 2017 Patrick Garman
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 */

/**
 * Made with support from Gun.io, the Professional Freelancer network that nurtures the open source community.
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Setup the plugin constants
 */
define( 'WC_INTERNATIONAL_SKU_VERSION', '1.0.0' );
define( 'WC_INTERNATIONAL_SKU_SLUG', 'wc-international-sku' );
define( 'WC_INTERNATIONAL_SKU_FILE', __FILE__ );
define( 'WC_INTERNATIONAL_SKU_DIR', plugin_dir_path( WC_INTERNATIONAL_SKU_FILE ) );
define( 'WC_INTERNATIONAL_SKU_URL', untrailingslashit( plugins_url( basename( plugin_dir_path( WC_INTERNATIONAL_SKU_FILE ) ), basename( WC_INTERNATIONAL_SKU_FILE ) ) ) );

/**
 * Kick start the plugin
 */
function wc_international_sku_init() {
    /**
     * Require Plugin Files
     */
    require_once 'includes/class-wc-international-sku.php';
    require_once 'includes/class-wc-international-sku-admin.php';

    /**
     * Start the engines
     */
    wc_international_sku();
}
add_action( 'woocommerce_init', 'wc_international_sku_init' );

/**
 * Wrapper for getting global $wc_international_sku and ensuring it is an instance of WC_International_SKU
 *
 * @return WC_International_SKU
 */
function wc_international_sku() {
    global $wc_international_sku;

    if( ! $wc_international_sku instanceof WC_International_SKU ) {
        $wc_international_sku = new WC_International_SKU;
    }

    return $wc_international_sku;
}