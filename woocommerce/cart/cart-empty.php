<?php

/**
 * Empty cart page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart-empty.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.0
 */

defined('ABSPATH') || exit;

/*
 * @hooked wc_empty_cart_message - 10
 */
?>
<div class="ealain-empty">

    <?php
    do_action('woocommerce_cart_is_empty');

    if (wc_get_page_id('shop') > 0) : ?>
        <?php $bgurl = get_template_directory_uri() . '/assets/images/redux/fish.webp'; ?>
        <p class="return-to-shop">
            <div class="ealain-btn-container">
                <a class="ealain-button btn btn-hover wc-backward" href="<?php echo esc_url(apply_filters('woocommerce_return_to_shop_redirect', wc_get_page_permalink('shop'))); ?>">
                    <span class="wrap-btn">
                        <span class="text-btn"><?php echo esc_html(apply_filters('woocommerce_return_to_shop_text', esc_html__('Return to shop', 'ealain'))); ?></span>
                        <span class="btn-img">
                            <img src="<?php echo esc_url($bgurl); ?>" class="btn-icon" alt="<?php esc_attr_e('image','ealain'); ?>">
                            <svg class="btn-shadow" width="23" height="3" viewBox="0 0 23 3" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M23 1.28564C19.2859 1.96041 15.5718 2.33997 11.7896 2.33997C7.8711 2.33997 3.91852 2.63518 0 2.38214C1.87407 1.20129 14.2089 0.273467 21.7393 0.526506C22.1482 0.526506 22.5911 0.695188 23 0.779535C23 0.9904 23 1.11695 23 1.28564Z" fill="#312660" fill-opacity="0.3"></path></svg>
                        </span>
                    </span>
                </a>
            </div>
        </p>
    <?php endif; ?>
</div>