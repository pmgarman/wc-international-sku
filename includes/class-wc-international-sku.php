<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! class_exists( 'WC_International_SKU' ) ) {
    class WC_International_SKU {

        public $admin;

        public function __construct() {
            $this->admin = new WC_International_SKU_Admin();

            add_filter( 'woocommerce_get_sku', array( $this, 'filter_sku' ), 10, 2 );
            add_filter( 'woocommerce_order_item_product', array( $this, 'filter_product_from_item' ), 10, 2 );
        }

        public function filter_sku( $sku, $product ) {
            if( true === $product->is_international ) {

                switch( $product->product_type ) {
                    case 'simple':
                        if( ! empty( $product->isku ) ) {
                            $sku = $product->isku;
                        }
                        break;
                    case 'variation':
                        if( 0 < strlen( $product->isku ) ) {
                            $sku = $product->isku;
                        }
                        break;
                }
            }

            return $sku;
        }

        public function filter_product_from_item( $product, $order_item ) {
            $product->is_international = method_exists( $order_item, 'get_order_id' ) && $this->is_order_international( $order_item->get_order_id() );

            return $product;
        }

        public function is_order_international( $order ) {
            $order = wc_get_order( $order );

            return method_exists( $order, 'get_billing_country' ) && $order->get_billing_country() != WC()->countries->get_base_country();
        }

    }
}