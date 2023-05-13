<?php

/**
 * Cart Page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.8.0
 */
namespace Ealain\Ealain;
defined('ABSPATH') || exit;


do_action('woocommerce_before_cart');
?>
<div class="row">
	<div class="col-xl-8">

		<form class="woocommerce-cart-form" action="<?php echo esc_url(wc_get_cart_url()); ?>" method="post">
			<?php do_action('woocommerce_before_cart_table'); ?>

			<table class="shop_table shop_table_responsive cart woocommerce-cart-form__contents" cellspacing="0">
				<thead>
					<tr>
						<th class="product-name"><?php esc_html_e('Product', 'ealain'); ?></th>
						<th class="product-price"><?php esc_html_e('Price', 'ealain'); ?></th>
						<th class="product-quantity"><?php esc_html_e('Quantity', 'ealain'); ?></th>
						<th class="product-subtotal"><?php esc_html_e('Subtotal', 'ealain'); ?></th>
						<th class="product-remove">&nbsp;</th>
					</tr>
				</thead>
				<tbody>
					<?php do_action('woocommerce_before_cart_contents'); ?>

					<?php
					foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
						$_product   = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
						$product_id = apply_filters('woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key);

						if ($_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters('woocommerce_cart_item_visible', true, $cart_item, $cart_item_key)) {
							$product_permalink = apply_filters('woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink($cart_item) : '', $cart_item, $cart_item_key);
					?>
							<tr class="woocommerce-cart-form__cart-item <?php echo esc_attr(apply_filters('woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key)); ?>">





								<td class="product-name" data-title="<?php esc_attr_e('Product', 'ealain'); ?>">

									<div class="product-thumbnail">
										<?php
										$thumbnail = apply_filters('woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key);

										if (!$product_permalink) {
											echo esc_html($thumbnail); // PHPCS: XSS ok.
										} else {
											printf('<a href="%s" class="wishlist-pro-image">%s</a>', esc_url($product_permalink), $thumbnail); // PHPCS: XSS ok.
										}
										?>
									</div>
									<?php
									if (!$product_permalink) {
										echo wp_kses_post(apply_filters('woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key) . '&nbsp;');
									} else {
										echo wp_kses_post(apply_filters('woocommerce_cart_item_name', sprintf('<a href="%s" class="cart_item_name">%s</a>', esc_url($product_permalink), $_product->get_name()), $cart_item, $cart_item_key));
									}

									do_action('woocommerce_after_cart_item_name', $cart_item, $cart_item_key);

									// Meta data.
									echo wc_get_formatted_cart_item_data($cart_item); // PHPCS: XSS ok.

									// Backorder notification.
									if ($_product->backorders_require_notification() && $_product->is_on_backorder($cart_item['quantity'])) {
										echo wp_kses_post(apply_filters('woocommerce_cart_item_backorder_notification', '<p class="backorder_notification">' . esc_html__('Available on backorder', 'ealain') . '</p>', $product_id));
									}
									?>
								</td>

								<td class="product-price" data-title="<?php esc_attr_e('Price', 'ealain'); ?>">
									<?php
									echo apply_filters('woocommerce_cart_item_price', WC()->cart->get_product_price($_product), $cart_item, $cart_item_key); // PHPCS: XSS ok.
									?>
								</td>

								<td class="product-quantity" data-title="<?php esc_attr_e('Quantity', 'ealain'); ?>">
									<?php
									if ($_product->is_sold_individually()) {
										$product_quantity = sprintf('1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key);
									} else {
										$product_quantity = woocommerce_quantity_input(
											array(
												'input_name'   => "cart[{$cart_item_key}][qty]",
												'input_value'  => $cart_item['quantity'],
												'max_value'    => $_product->get_max_purchase_quantity(),
												'min_value'    => '0',
												'product_name' => $_product->get_name(),
											),
											$_product,
											false
										);
									}

									echo apply_filters('woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item); // PHPCS: XSS ok.
									?>
								</td>

								<td class="product-subtotal" data-title="<?php esc_attr_e('Subtotal', 'ealain'); ?>">
									<?php
									echo apply_filters('woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal($_product, $cart_item['quantity']), $cart_item, $cart_item_key); // PHPCS: XSS ok.
									?>
								</td>
								<td class="product-remove">
									<?php
									echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
										'woocommerce_cart_item_remove_link',
										sprintf(
											'<a href="%s" class="remove" aria-label="%s" data-product_id="%s" data-product_sku="%s"><i class="far fa-trash-alt"></i></a>',
											esc_url(wc_get_cart_remove_url($cart_item_key)),
											esc_html__('Remove this item', 'ealain'),
											esc_attr($product_id),
											esc_attr($_product->get_sku())
										),
										$cart_item_key
									);
									?>
								</td>
							</tr>
					<?php
						}
					}
					?>

					<?php do_action('woocommerce_cart_contents'); ?>

					    <?php $bgurl = get_template_directory_uri() . '/assets/images/redux/fish.webp'; ?>

					<tr>
						<td colspan="6" class="actions">

							<?php if (wc_coupons_enabled()) { ?>
								<div class="coupon">
									<label for="coupon_code"><?php esc_html_e('Coupon:', 'ealain'); ?></label> <input type="text" name="coupon_code" class="input-text" id="coupon_code" value="" placeholder="<?php esc_attr_e('Coupon Code', 'ealain'); ?>" />
									<!-- apply coupon button start -->
									
									<div class="ealain-btn-container">
									    <button type="submit" class="button ealain-button" name="apply_coupon" value="<?php esc_attr_e( 'Apply coupon', 'woocommerce' ); ?>">
										    <span class="wrap-btn">
												<span class="text-btn"><?php esc_html_e( 'Apply coupon', 'ealain' ); ?></span>
												<span class="btn-img">
													<img src="<?php echo esc_url($bgurl) ?>" class="btn-icon" alt="<?php esc_attr_e('image','ealain') ?>">
													<svg class="btn-shadow" width="23" class="btn-shadow" height="3" viewBox="0 0 23 3" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M2.98023e-08 1.30102C3.71407 1.9758 7.42816 2.35535 11.2104 2.35535C15.1289 2.35535 19.0815 2.65056 23 2.39752C21.1259 1.21667 8.79109 0.288847 1.26072 0.541887C0.851835 0.541887 0.408889 0.710569 2.98023e-08 0.794915C2.98023e-08 1.00578 2.98023e-08 1.13233 2.98023e-08 1.30102Z" fill="#312660" fill-opacity="0.3"/></svg>
												</span>
											</span>
										</button>
									</div>

									<?php do_action('woocommerce_cart_coupon'); ?>
								</div>
							<?php } ?>

							<!-- update cart button -->
							<div class="ealain-btn-container">
								<button type="submit" class="button button ealain-button" name="update_cart" value="<?php esc_attr_e( 'Update cart', 'woocommerce' ); ?>">
								    <span class="wrap-btn">
										<span class="text-btn"><?php esc_html_e( 'Update cart', 'woocommerce' ); ?></span>
										<span class="btn-img">
											<img src="<?php echo esc_url($bgurl) ?>" class="btn-icon" alt="<?php esc_attr_e('image','ealain') ?>">
											<svg class="btn-shadow" width="23" class="btn-shadow" height="3" viewBox="0 0 23 3" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M2.98023e-08 1.30102C3.71407 1.9758 7.42816 2.35535 11.2104 2.35535C15.1289 2.35535 19.0815 2.65056 23 2.39752C21.1259 1.21667 8.79109 0.288847 1.26072 0.541887C0.851835 0.541887 0.408889 0.710569 2.98023e-08 0.794915C2.98023e-08 1.00578 2.98023e-08 1.13233 2.98023e-08 1.30102Z" fill="#312660" fill-opacity="0.3"/></svg>
										</span>
								    </span>
								</button>
							</div>

							<?php do_action('woocommerce_cart_actions'); ?>

							<?php wp_nonce_field('woocommerce-cart', 'woocommerce-cart-nonce'); ?>
						</td>
					</tr>

					<?php do_action('woocommerce_after_cart_contents'); ?>
				</tbody>
			</table>
			<?php do_action('woocommerce_after_cart_table'); ?>
		</form>

	</div>
	<div class="col-xl-4">
		<?php do_action('woocommerce_before_cart_collaterals'); ?>

		<div class="cart-collaterals">
			<?php
			/**
			 * Cart collaterals hook.
			 *
			 * @hooked woocommerce_cross_sell_display
			 * @hooked woocommerce_cart_totals - 10
			 */
			do_action('woocommerce_cart_collaterals');
			?>
		</div>
	</div>
</div>




<?php do_action('woocommerce_after_cart'); ?>