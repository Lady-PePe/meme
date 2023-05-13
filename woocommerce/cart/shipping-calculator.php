<?php
/**
 * Shipping Calculator
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/shipping-calculator.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 4.0.0
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_shipping_calculator' ); ?>

<form class="woocommerce-shipping-calculator" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">

    <?php printf( '<a href="#" class="shipping-calculator-button">%s</a>', esc_html( ! empty( $button_text ) ? $button_text : esc_html__( 'Calculate shipping', 'ealain' ) ) ); ?>

    <section class="shipping-calculator-form" style="display:none;">

        <?php if ( apply_filters( 'woocommerce_shipping_calculator_enable_country', true ) ) : ?>
        <p class="form-row form-row-wide" id="calc_shipping_country_field">
            <select name="calc_shipping_country" id="calc_shipping_country" class="country_to_state country_select"
                rel="calc_shipping_state">
                <option value="default"><?php esc_html_e( 'Select a country / region&hellip;', 'ealain' ); ?>
                </option>
                <?php
					foreach ( WC()->countries->get_shipping_countries() as $key => $value ) {
						echo '<option value="' . esc_attr( $key ) . '"' . selected( WC()->customer->get_shipping_country(), esc_attr( $key ), false ) . '>' . esc_html( $value ) . '</option>';
					}
					?>
            </select>
        </p>
        <?php endif; ?>

        <?php if ( apply_filters( 'woocommerce_shipping_calculator_enable_state', true ) ) : ?>
        <p class="form-row form-row-wide" id="calc_shipping_state_field">
            <?php
				$current_cc = WC()->customer->get_shipping_country();
				$current_r  = WC()->customer->get_shipping_state();
				$states     = WC()->countries->get_states( $current_cc );

				if ( is_array( $states ) && empty( $states ) ) {
					?>
            <input type="hidden" name="calc_shipping_state" id="calc_shipping_state"
                placeholder="<?php esc_attr_e( 'State / County', 'ealain' ); ?>" />
            <?php
				} elseif ( is_array( $states ) ) {
					?>
            <span>
                <select name="calc_shipping_state" class="state_select" id="calc_shipping_state"
                    data-placeholder="<?php esc_attr_e( 'State / County', 'ealain' ); ?>">
                    <option value=""><?php esc_html_e( 'Select an option&hellip;', 'ealain' ); ?></option>
                    <?php
							foreach ( $states as $ckey => $cvalue ) {
								echo '<option value="' . esc_attr( $ckey ) . '" ' . selected( $current_r, $ckey, false ) . '>' . esc_html( $cvalue ) . '</option>';
							}
							?>
                </select>
            </span>
            <?php
				} else {
					?>
            <input type="text" class="input-text" value="<?php echo esc_attr( $current_r ); ?>"
                placeholder="<?php esc_attr_e( 'State / County', 'ealain' ); ?>" name="calc_shipping_state"
                id="calc_shipping_state" />
            <?php
				}
				?>
        </p>
        <?php endif; ?>

        <?php if ( apply_filters( 'woocommerce_shipping_calculator_enable_city', true ) ) : ?>
        <p class="form-row form-row-wide" id="calc_shipping_city_field">
            <input type="text" class="input-text" value="<?php echo esc_attr( WC()->customer->get_shipping_city() ); ?>"
                placeholder="<?php esc_attr_e( 'City', 'ealain' ); ?>" name="calc_shipping_city"
                id="calc_shipping_city" />
        </p>
        <?php endif; ?>

        <?php if ( apply_filters( 'woocommerce_shipping_calculator_enable_postcode', true ) ) : ?>
        <p class="form-row form-row-wide" id="calc_shipping_postcode_field">
            <input type="text" class="input-text"
                value="<?php echo esc_attr( WC()->customer->get_shipping_postcode() ); ?>"
                placeholder="<?php esc_attr_e( 'Postcode / ZIP', 'ealain' ); ?>" name="calc_shipping_postcode"
                id="calc_shipping_postcode" />
        </p>
        <?php endif; ?>
        <p>
            <?php $bgurl = get_template_directory_uri() . '/assets/images/redux/fish.webp'; ?>
            <!-- update button start -->
            <div class="ealain-btn-container">
                <button type="submit" name="calc_shipping" value="1" class="ealain-button btn btn-hover">
                    <span class="wrap-btn">
                        <span class="text-btn"><?php esc_html_e( 'Update', 'ealain' ); ?></span>
                        <span class="btn-img">
                            <img src="<?php echo esc_url($bgurl); ?>" class="btn-icon" alt="<?php esc_attr_e('image','ealain'); ?>">
                            <svg class="btn-shadow" width="23" height="3" viewBox="0 0 23 3" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M23 1.28564C19.2859 1.96041 15.5718 2.33997 11.7896 2.33997C7.8711 2.33997 3.91852 2.63518 0 2.38214C1.87407 1.20129 14.2089 0.273467 21.7393 0.526506C22.1482 0.526506 22.5911 0.695188 23 0.779535C23 0.9904 23 1.11695 23 1.28564Z" fill="#312660" fill-opacity="0.3"></path></svg>
                        </span> 
                    </span>
                </button>
            </div>
            <!-- update button end -->
        </p>
        <?php wp_nonce_field( 'woocommerce-shipping-calculator', 'woocommerce-shipping-calculator-nonce' ); ?>
    </section>
</form>

<?php do_action( 'woocommerce_after_shipping_calculator' ); ?>