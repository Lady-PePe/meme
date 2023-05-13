<?php

/**
 * Simple product add to cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/add-to-cart/simple.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.0
 */
namespace Ealain\Ealain;

defined('ABSPATH') || exit;


global $product;
$ealain_option = get_option('ealain-options');

if (!$product->is_purchasable()) {
	return;
}

echo wc_get_stock_html($product); // WPCS: XSS ok.
$bgurl = get_template_directory_uri() . '/assets/images/redux/fish.webp';
?>
<?php

if ($product->is_in_stock()) : ?>

	<?php do_action('woocommerce_before_add_to_cart_form'); ?>

	<form class="cart" action="<?php echo esc_url(apply_filters('woocommerce_add_to_cart_form_action', $product->get_permalink())); ?>" method="post" enctype='multipart/form-data'>

		<?php do_action('woocommerce_before_add_to_cart_button'); ?>
		<div class="ealain-cart-btn-wrapper <?php echo class_exists('ReduxFramework') && isset($ealain_option['ealain_display_product_wishlist_icon']) && $ealain_option['ealain_display_product_wishlist_icon'] == "no" ? esc_attr('has-no-wishlist'): '' ?>">
			<?php
			do_action('woocommerce_before_add_to_cart_quantity');

			woocommerce_quantity_input(
				array(
					'min_value'   => apply_filters('woocommerce_quantity_input_min', $product->get_min_purchase_quantity(), $product),
					'max_value'   => apply_filters('woocommerce_quantity_input_max', $product->get_max_purchase_quantity(), $product),
					'input_value' => isset($_POST['quantity']) ? wc_stock_amount(wp_unslash($_POST['quantity'])) : $product->get_min_purchase_quantity(), // WPCS: CSRF ok, input var ok.
				)
			);

			do_action('woocommerce_after_add_to_cart_quantity');

			if (class_exists('YITH_WCWL') && is_singular()) {
			?>
				<div class="wishlist">
				<?php echo do_shortcode('[yith_wcwl_add_to_wishlist]'); ?>
			</div>												
			<?php
			}
			?>

		    <div class="ealain-btn-container">
		
				<button type="submit" name="add-to-cart" value="<?php echo esc_attr( $product->get_id() ); ?>"
					class="single_add_to_cart_button alt ealain-button">
					<span class="wrap-btn">
					    <span class="text-btn"><?php echo esc_html( $product->single_add_to_cart_text() ); ?></span>
						<span class="btn-img">
							<img src="<?php echo esc_url($bgurl); ?>" class="btn-icon" alt="<?php esc_attr_e('image','ealain'); ?>">
							<svg class="btn-shadow" width="23" height="3" viewBox="0 0 23 3" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M23 1.28564C19.2859 1.96041 15.5718 2.33997 11.7896 2.33997C7.8711 2.33997 3.91852 2.63518 0 2.38214C1.87407 1.20129 14.2089 0.273467 21.7393 0.526506C22.1482 0.526506 22.5911 0.695188 23 0.779535C23 0.9904 23 1.11695 23 1.28564Z" fill="#312660" fill-opacity="0.3"></path></svg>
						</span> 
					</span>
				</button>

		    </div>

		</div>

		<?php do_action('woocommerce_after_add_to_cart_button'); ?>

	</form>

	<?php do_action('woocommerce_after_add_to_cart_form'); ?>

<?php endif;
