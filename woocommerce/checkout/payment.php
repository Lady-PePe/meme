<?php
/**
 * Checkout Payment Section
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/payment.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.3
 */

defined( 'ABSPATH' ) || exit;

if ( ! is_ajax() ) {
	do_action( 'woocommerce_review_order_before_payment' );
}
?>
<div id="payment" class="woocommerce-checkout-payment">
    <?php if ( WC()->cart->needs_payment() ) : ?>
    <ul class="wc_payment_methods payment_methods methods">
        <?php
			if ( ! empty( $available_gateways ) ) {
				foreach ( $available_gateways as $gateway ) {
					wc_get_template( 'checkout/payment-method.php', array( 'gateway' => $gateway ) );
				}
			} else {
				echo '<li class="woocommerce-notice woocommerce-notice--info woocommerce-info">' . apply_filters( 'woocommerce_no_available_payment_methods_message', WC()->customer->get_billing_country() ? esc_html__( 'Sorry, it seems that there are no available payment methods for your state. Please contact us if you require assistance or wish to make alternate arrangements.', 'ealain' ) : esc_html__( 'Please fill in your details above to see available payment methods.', 'ealain' ) ) . '</li>'; // @codingStandardsIgnoreLine
			}
			?>
    </ul>
    <?php endif; ?>
    <div class="place-order">
        <noscript>
            <?php
			/* translators: $1 and $2 opening and closing emphasis tags respectively */
			printf( esc_html__( 'Since your browser does not support JavaScript, or it is disabled, please ensure you click the %1$sUpdate Totals%2$s button before placing your order. You may be charged more than the amount stated above if you fail to do so.', 'ealain' ), '<em>', '</em>' );
			?>
            <br />
            <button type="submit" class="button alt ealain-box-shadow ealain-morden-btn" name="woocommerce_checkout_update_totals" value="<?php esc_attr_e( 'Update totals', 'ealain' ); ?>">
                <?php esc_html_e( 'Update totals', 'ealain' ); ?>
            </button>

        </noscript>

        <?php wc_get_template( 'checkout/terms.php' ); ?>

        <?php do_action('woocommerce_review_order_before_submit'); ?>

        <?php 
        $bgurl = get_template_directory_uri() . '/assets/images/redux/fish.webp';
        echo apply_filters('woocommerce_order_button_html', '<div class="ealain-btn-container"><button type="submit" class="ealain-button btn btn-hover woocommerce-button" name="woocommerce_checkout_place_order" id="place_order" value="' . esc_attr($order_button_text) . '"><span class="wrap-btn"><span class="text-btn">
        '. esc_html__( 'Place Order','ealain' ).'</span> <span class="btn-img"><img src="'.$bgurl.'" class="btn-icon" alt="'.esc_attr__('image','ealain').'"><svg class="btn-shadow" width="23" class="btn-shadow" height="3" viewBox="0 0 23 3" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M2.98023e-08 1.30102C3.71407 1.9758 7.42816 2.35535 11.2104 2.35535C15.1289 2.35535 19.0815 2.65056 23 2.39752C21.1259 1.21667 8.79109 0.288847 1.26072 0.541887C0.851835 0.541887 0.408889 0.710569 2.98023e-08 0.794915C2.98023e-08 1.00578 2.98023e-08 1.13233 2.98023e-08 1.30102Z" fill="#312660" fill-opacity="0.3"/></svg></span></span></div>' );
        ?>

        <?php do_action('woocommerce_review_order_after_submit'); ?>

        <?php wp_nonce_field( 'woocommerce-process_checkout', 'woocommerce-process-checkout-nonce' ); ?>
    </div>
</div>
<?php
if ( ! is_ajax() ) {
	do_action( 'woocommerce_review_order_after_payment' );
}