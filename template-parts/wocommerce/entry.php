<?php

global $product;
global $post;
$ealain_option = get_option('ealain-options');


$product = isset($args['id']) ? wc_get_product($args['id']) :  wc_get_product($post->ID); // condition fro Load Template from Plugin 
if (!$product) {
	return '';
}
$is_quickview = isset($ealain_option['ealain_display_product_quickview_icon']) && $ealain_option['ealain_display_product_quickview_icon'] == "yes";
$is_wishlist = isset($ealain_option['ealain_display_product_wishlist_icon']) && $ealain_option['ealain_display_product_wishlist_icon'] == "yes";
$is_addtocart = isset($ealain_option['ealain_display_product_addtocart_icon']) && $ealain_option['ealain_display_product_addtocart_icon'] == "yes";
?>
<div <?php wc_product_class('ealain-sub-product ', $product->get_id()); ?>>
	<div class="ealain-inner-box ">
		<a href="<?php the_permalink(); ?>"></a>
		<div class="ealain-product-block">
			<?php
			$newness_days = 30;
			$created = strtotime($product->get_date_created());
			if (!$product->is_in_stock()) {
			?>
				<span class="onsale ealain-sold-out"><?php echo esc_html__('Sold!', 'ealain') ?></span>
			<?php } else if ($product->is_on_sale()) { ?>
				<span class="onsale ealain-on-sale"><?php echo esc_html__('Sale!', 'ealain') ?></span>
			<?php } else if ((time() - (60 * 60 * 24 * $newness_days)) < $created) { ?>
				<span class="onsale ealain-new"><?php echo esc_html__('New!', 'ealain'); ?></span>
			<?php } ?>

			<div class="ealain-image-wrapper">
				<?php
				if ($product->get_image_id()) {
					$product->get_image('shop_catalog');
					$image = wp_get_attachment_image_src($product->get_image_id(), 'ealain-product'); ?>
					<a href="<?php echo the_permalink($product->get_id()); ?>" class="ealain-product-title-link ">
						<?php echo '<div class="ealain-product-image">' . woocommerce_get_product_thumbnail() . '</div>'; ?>
					</a><?php
					} else { ?>
					<a href="<?php echo the_permalink($product->get_id()); ?>" class="ealain-product-title-link ">
						<?php
						echo sprintf('<div class="ealain-product-image"><img src="%s" alt="%s" class="wp-post-image" /></div>', esc_url(wc_placeholder_img_src()), esc_html__('Awaiting product image', 'ealain')); ?>
					</a><?php
					}
						?>
				<?php
				if ($is_quickview || $is_wishlist || $is_addtocart) {

					if($product->get_id() && $product->get_type() != 'external' ){
				?>
					<div class="ealain-woo-buttons-holder">
						<ul>
							<?php
							if ($is_quickview) {  ?>
								<?php if (class_exists('WPCleverWoosq')) { ?>
									<li><?php echo do_shortcode('[woosq id="' . $product->get_id() . '"]') ?></li>
								<?php
								}
							}
							if ($is_wishlist) {
								if (class_exists('YITH_WCWL')) {
								?>
									<li>
										<?php echo do_shortcode('[yith_wcwl_add_to_wishlist]'); ?>
									</li>
								<?php }
							}
							?>
						</ul>
					</div>
				<?php
					}
				}
				?>
			</div>
		</div>
		<div class="product-caption">
			<?php if (isset($ealain_option['ealain_display_product_name']) && $ealain_option['ealain_display_product_name'] == "yes") {?>
				<h5 class="woocommerce-loop-product__title th13">
					<a href="<?php echo the_permalink($product->get_id()); ?>" class="ealain-product-title-link ">
						<?php echo esc_html($product->get_name()); ?>
					</a>
				</h5>
			<?php
			} ?>

            <?php
			$terms = get_the_terms( $post->ID, 'product_cat' );
			foreach ($terms as $term) {
				?>
				<a class="product-category" href="<?php echo esc_url( get_category_link( $term->term_id ) ); ?>">
					<?php echo esc_html( $term->name ); ?>
				</a>
				<?php
				break;
			} ?>

            <?php if (isset($ealain_option['ealain_display_product_rating']) && $ealain_option['ealain_display_product_rating'] == "yes") {
			?>
				<div class="container-rating">
					<?php
					$rating_count = $product->get_rating_count();
					if ($rating_count >= 0) {
						$average      = $product->get_average_rating();
					?>
						<div class="star-rating">
							<?php echo wc_get_rating_html($average, $rating_count); ?>
						</div>
					<?php }
					?>
				</div>
			<?php } ?>

			<?php if (isset($ealain_option['ealain_display_price']) && $ealain_option['ealain_display_price'] == "yes") {
			?>
                <?php if ($product->get_id() && $product->is_type('external') ) { ?>
					<div class="price-detail">
						<span class="price">
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
					</div>
				<?php } else { ?>

					<div class="price-detail">
						<span class="price">
							<?php echo wp_kses($product->get_price_html(), 'ealain'); ?>
						</span>
					</div>
				<?php } ?>

			<?php } ?>

			<?php if ($product->get_id() && $product->is_type('external') ) {
				$bgurl = get_template_directory_uri() . '/assets/images/redux/fish.webp';  ?>

				<div class="ealain-btn-container">
					<a rel="nofollow" href="<?php echo esc_url( $product->add_to_cart_url() ); ?>" class="ealain-button" data-quantity="<?php echo esc_attr( isset( $quantity ) ? $quantity : 1 ); ?>'" data-product_id="<?php echo get_the_ID(); ?>" data-product_sku="<?php echo esc_attr( $product->get_sku() ); ?>" target="_blank" >
						<span class="wrap-btn">
							<span class="text-btn"><?php echo esc_html( $product->add_to_cart_text() ) ?></span>
							<span class="btn-img">
								<img src="<?php echo esc_url($bgurl); ?>" class="btn-icon" alt="<?php esc_attr_e('image','ealain'); ?>">
								<svg class="btn-shadow" width="23" height="3" viewBox="0 0 23 3" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M23 1.28564C19.2859 1.96041 15.5718 2.33997 11.7896 2.33997C7.8711 2.33997 3.91852 2.63518 0 2.38214C1.87407 1.20129 14.2089 0.273467 21.7393 0.526506C22.1482 0.526506 22.5911 0.695188 23 0.779535C23 0.9904 23 1.11695 23 1.28564Z" fill="#312660" fill-opacity="0.3"></path></svg>
							</span> 
						</span>
					</a>
				</div>
			<?php } elseif ($is_addtocart) { 
				$bgurl = get_template_directory_uri() . '/assets/images/redux/fish.webp';  ?>
					<?php if ($product->get_id() && !$product->is_type('external') || !$product->is_type('grouped')) { ?>
						<div class="ealain-btn-container">
							<a href="<?php echo esc_url($product->add_to_cart_url()); ?>" class="ajax_add_to_cart add_to_cart_button iq-button btn ealain-button ealain-add-to-cart btn btn-hover  " data-product_id="<?php echo get_the_ID(); ?>" data-product_sku="<?php echo esc_attr($product->get_sku()); ?>" data-product_name="<?php the_title(); ?>">
								<span class="wrap-btn">	
									<span class="text-btn"><?php echo esc_html__('Add to Cart', 'ealain'); ?></span>
									<span class="btn-img">
										<img src="<?php echo esc_url($bgurl); ?>" class="btn-icon" alt="<?php esc_attr_e('image','ealain'); ?>">
										<svg class="btn-shadow" width="23" height="3" viewBox="0 0 23 3" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M23 1.28564C19.2859 1.96041 15.5718 2.33997 11.7896 2.33997C7.8711 2.33997 3.91852 2.63518 0 2.38214C1.87407 1.20129 14.2089 0.273467 21.7393 0.526506C22.1482 0.526506 22.5911 0.695188 23 0.779535C23 0.9904 23 1.11695 23 1.28564Z" fill="#312660" fill-opacity="0.3"></path></svg>
									</span>
								</span>
							</a>
						</div>
					<?php }  ?>
			<?php } ?>

		</div>
	</div>
</div>