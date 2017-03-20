<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! class_exists( 'WC_International_SKU_Admin' ) ) {
    class WC_International_SKU_Admin {

        public function __construct() {
            /**
             * Simple Products
             */
            add_action( 'woocommerce_product_options_sku', array( $this, 'simple_meta_field' ) );
            add_action( 'woocommerce_process_product_meta_simple', array( $this, 'simple_data_tab_save' ) );

            /**
             * Variable Products
             */
            add_action( 'woocommerce_product_after_variable_attributes', array( $this, 'variation_meta_field' ), 10, 3 );
            add_action( 'woocommerce_save_product_variation', array( $this, 'variation_data_tab_save' ), 10, 2 );
        }

        /**
         * Simple Product Meta Field
         */
        public function simple_meta_field() {
            global $thepostid;

            // International SKU
            if ( wc_product_sku_enabled() ) {
                woocommerce_wp_text_input( array( 'id' => '_isku', 'label' => '<abbr title="' . __( 'International Stock Keeping Unit', 'wc-international-sku' ) . '">' . __( 'International SKU', 'wc-international-sku' ) . '</abbr>', 'desc_tip' => 'true', 'description' => __( 'Orders of this product shipping to countries other than the base country of WooCommerce will be filtered to use the international SKU.', 'wc-international-sku' ) ) );
            } else {
                echo '<input type="hidden" name="_isku" value="' . esc_attr( get_post_meta( $thepostid, '_isku', true ) ) . '" />';
            }
        }

        /**
         * Save Simple Product Meta
         *
         * @param $post_id
         */
        public function simple_data_tab_save( $post_id ) {
            update_post_meta( $post_id, '_isku', esc_attr( $_POST['_isku'] ) );
        }

        /**
         * Variation Product Meta Field
         *
         * @param $loop
         * @param $variation_data
         * @param $variation
         */
        public function variation_meta_field( $loop, $variation_data, $variation ) { ?>
            <p class="form-row form-row-first">
                <label><?php _e( 'International Stock Keeping Unit', 'wc-international-sku' ); ?> <?php echo wc_help_tip( __( 'Orders of this product shipping to countries other than the base country of WooCommerce will be filtered to use the international SKU.', 'wc-international-sku' ) ); ?></a></label>
                <input type="text" size="5" name="variable_isku[<?php echo $loop; ?>]" value="<?php echo esc_attr( get_post_meta( $variation->ID, '_isku', true ) ); ?>" placeholder="<?php echo esc_attr( $variation_data['_sku'] ); ?>" />
            </p>
        <?php }

        /**
         * Save Variation Product Meta
         *
         * @param $variation_id
         * @param $i
         */
        public function variation_data_tab_save( $variation_id, $i ) {
            if( ! isset( $_POST['variable_post_id'] ) ) {
                return;
            }

            $variation_ids = array();

            foreach( $_POST['variable_post_id'] as $key => $id ) {
                $variation_ids[ $key ] = $id;
            }

            foreach( $_POST['variable_post_id'] as $key => $id ) {
                if( isset( $_POST['variable_isku'][ $key ] ) && ! empty( isset( $_POST['variable_isku'][ $key ] ) ) ) {
                    update_post_meta( $variation_ids[ $key ], '_isku', esc_attr( $_POST['variable_isku'][ $key ] ) );
                } else {
                    delete_post_meta( $variation_ids[ $key ], '_isku' );
                }
            }
        }
    }
}
