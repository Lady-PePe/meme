<?php

/**
 * Order tracking form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/order/form-tracking.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 6.5.0
 */

defined('ABSPATH') || exit;

global $post;

?>

<div class="track-form-wrapper">
    <form action="<?php echo esc_url(get_permalink($post->ID)); ?>" method="post" class="woocommerce-form woocommerce-form-track-order track_order">

        <p>
            <?php echo esc_html('To track your order please enter your Order ID in the box below and press the "Track" button. This was given to you on your receipt and in the confirmation email you should have received.', 'ealain');?>
        </p>
        <p class="form-row form-row-first">
            <input class="input-text" type="text" name="orderid" id="orderid" value="<?php echo isset($_REQUEST['orderid']) ? esc_attr(wp_unslash($_REQUEST['orderid'])) : ''; ?>" placeholder="<?php esc_attr_e('Enter your order id.', 'ealain'); ?>" />

        </p>
        <p class="form-row form-row-last">
            <input class="input-text" type="text" name="order_email" id="order_email" value="<?php echo isset($_REQUEST['order_email']) ? esc_attr(wp_unslash($_REQUEST['order_email'])) : ''; ?>" placeholder="<?php esc_attr_e('Enter your email id.', 'ealain'); ?>" />
        </p>

        <div class="clear"></div>

        <p class="form-row track-btn mb-0">
        <?php $bgurl = get_template_directory_uri() . '/assets/images/redux/fish.webp'; ?>
            <button type="submit" class=" ealain-button btn btn-hover" name="track" value="<?php esc_attr_e('Track', 'ealain'); ?>">                
                <span class="wrap-btn">
                    <span class="text-btn"><?php esc_html_e('Track Order', 'ealain'); ?></span>
                    <span class="btn-img">
                        <img src="<?php echo esc_url($bgurl); ?>" class="btn-icon" alt="<?php esc_attr_e('image','ealain'); ?>">
                        <svg class="btn-shadow" width="23" height="3" viewBox="0 0 23 3" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M23 1.28564C19.2859 1.96041 15.5718 2.33997 11.7896 2.33997C7.8711 2.33997 3.91852 2.63518 0 2.38214C1.87407 1.20129 14.2089 0.273467 21.7393 0.526506C22.1482 0.526506 22.5911 0.695188 23 0.779535C23 0.9904 23 1.11695 23 1.28564Z" fill="#312660" fill-opacity="0.3"></path></svg>
                    </span> 
                </span>
            </button>
        </p>
        <?php wp_nonce_field('woocommerce-order_tracking', 'woocommerce-order-tracking-nonce'); ?>
    </form>
</div>