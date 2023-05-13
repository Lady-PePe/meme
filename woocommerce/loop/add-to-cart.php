<?php

/**
 * Loop Add to Cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/add-to-cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     3.3.0
 */

namespace Ealain\Ealain;

if (!defined('ABSPATH')) {
	exit;
}

global $product;
$bgurl = get_template_directory_uri() . '/assets/images/redux/fish.webp';


echo apply_filters(
	'woocommerce_loop_add_to_cart_link', // WPCS: XSS ok.
	sprintf('<div class="ealain-btn-container"><a href="%s" data-quantity="%s" class="ealain-button" %s>
                    <span class="text-btn">'.esc_html__('View Product', 'ealain').'</span>
                    <span class="btn-img">
                        <img src="'.esc_url($bgurl).'" class="btn-icon" alt="'.esc_attr__('image','ealain').' ">
                        <svg class="btn-shadow" width="23" class="btn-shadow" height="3" viewBox="0 0 23 3" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M2.98023e-08 1.30102C3.71407 1.9758 7.42816 2.35535 11.2104 2.35535C15.1289 2.35535 19.0815 2.65056 23 2.39752C21.1259 1.21667 8.79109 0.288847 1.26072 0.541887C0.851835 0.541887 0.408889 0.710569 2.98023e-08 0.794915C2.98023e-08 1.00578 2.98023e-08 1.13233 2.98023e-08 1.30102Z" fill="#312660" fill-opacity="0.3"/>
</svg>
                    </span>
				</a></',
		esc_url( $product->add_to_cart_url() ),
		esc_attr( isset( $args['quantity'] ) ? $args['quantity'] : 1 ),
		esc_attr( isset( $args['class'] ) ? $args['class'] : 'button' ),
		isset( $args['attributes'] ) ? wc_implode_html_attributes( $args['attributes'] ) : '',
		esc_html( $product->add_to_cart_text() )
	),
	$product,
	$args
);

/* 
echo apply_filters(
	'woocommerce_loop_add_to_cart_link', // WPCS: XSS ok.

	ealain()->ealain_get_comment_btn($tag = "a",  $label = esc_html__('View Product', 'ealain'), $show_icon = false, $attr = array(
		'href' => esc_url($product->add_to_cart_url()),
		'data-quantity' => esc_attr(isset($args['quantity']) ? $args['quantity'] : 1),
		'class' => ' iq-btn-link',
	)),
	$product,
	$args,
); */
