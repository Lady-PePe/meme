<?php
/**
 * External product add to cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/add-to-cart/external.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_add_to_cart_form' );
$bgurl = get_template_directory_uri() . '/assets/images/redux/fish.webp';
global $product; ?>

<span class="price d-inline-block">
    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path d="M11.9984 2.66667L11.8787 3.09877V15.6373L11.9984 15.7642L17.4782 12.3239L11.9984 2.66667Z" fill="#99299E"/>
    <path d="M11.9984 2.66667L6.51849 12.3239L11.9984 15.7643V9.67844V2.66667Z" fill="#8F8BFC"/>
    <path d="M11.9983 16.8665L11.9308 16.9538V21.4203L11.9983 21.6296L17.4815 13.4279L11.9983 16.8665Z" fill="#E5A6E8"/>
    <path d="M11.9984 21.6296V16.8665L6.51849 13.4279L11.9984 21.6296Z" fill="#8F8BFC"/>
    <path d="M11.9985 15.7645L17.4783 12.3242L11.9985 9.67875V15.7645Z" fill="#8F8BFC"/>
    <path d="M6.51849 12.3242L11.9983 15.7645V9.67872L6.51849 12.3242Z" fill="#E5A6E8"/>
    </svg>
	<?php echo esc_html($product->get_price()); ?>
</span> 

<form class="ealain-single-product" action="<?php echo esc_url( $product_url ); ?>" method="get">
    <?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>
    <!-- add to cart button -->
    <div class="ealain-btn-container">
        <a rel="nofollow" href="<?php echo esc_url( $product->add_to_cart_url() ); ?>" class="ealain-button" data-quantity="<?php echo esc_attr( isset( $quantity ) ? $quantity : 1 ); ?>'" data-product_id="<?php echo get_the_ID(); ?>" data-product_sku="<?php echo esc_attr( $product->get_sku() ); ?>" target="_blank" >
            <span class="wrap-btn">
                <span class="text-btn"><?php echo esc_html( $button_text ); ?></span>
                <span class="btn-img">
                    <img src="<?php echo esc_url($bgurl); ?>" class="btn-icon" alt="<?php esc_attr_e('image','ealain'); ?>">
                    <svg class="btn-shadow" width="23" height="3" viewBox="0 0 23 3" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M23 1.28564C19.2859 1.96041 15.5718 2.33997 11.7896 2.33997C7.8711 2.33997 3.91852 2.63518 0 2.38214C1.87407 1.20129 14.2089 0.273467 21.7393 0.526506C22.1482 0.526506 22.5911 0.695188 23 0.779535C23 0.9904 23 1.11695 23 1.28564Z" fill="#312660" fill-opacity="0.3"></path></svg>
                </span> 
            </span>
        </a>
    </div>

    <?php wc_query_string_form_fields( $product_url ); ?>

    <?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>
</form>

<?php do_action( 'woocommerce_after_add_to_cart_form' ); ?>