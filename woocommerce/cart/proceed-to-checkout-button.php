<?php

/**
 * Proceed to checkout button
 *
 * Contains the markup for the proceed to checkout button on the cart.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/proceed-to-checkout-button.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 2.4.0
 */
namespace Ealain\Ealain;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}
?>

<?php $bgurl = get_template_directory_uri() . '/assets/images/redux/fish.webp'; ?>
<div class="ealain-btn-container">
    <a class="ealain-button" href="<?php echo esc_url( wc_get_checkout_url() ); ?>">
        <span class="wrap-btn">
            <span class="text-btn"><?php esc_html_e( 'Proceed to checkout', 'ealain' ); ?></span>
            <span class="btn-img">
                <img src="<?php echo esc_url($bgurl) ?>" class="btn-icon" alt="<?php esc_attr_e('image','ealain') ?>">
                <svg class="btn-shadow" width="23" class="btn-shadow" height="3" viewBox="0 0 23 3" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M2.98023e-08 1.30102C3.71407 1.9758 7.42816 2.35535 11.2104 2.35535C15.1289 2.35535 19.0815 2.65056 23 2.39752C21.1259 1.21667 8.79109 0.288847 1.26072 0.541887C0.851835 0.541887 0.408889 0.710569 2.98023e-08 0.794915C2.98023e-08 1.00578 2.98023e-08 1.13233 2.98023e-08 1.30102Z" fill="#312660" fill-opacity="0.3"/></svg>
            </span>
        </span>
    </a>
</div>