<?php

/**
 * Single Product Up-Sells
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/up-sells.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     3.0.0
 */

use function Ealain\Ealain\ealain;

if (!defined('ABSPATH')) {
	exit;
}

if ($upsells) : ?>

	<section class="up-sells upsells products">
		<?php
		$heading = apply_filters('woocommerce_product_upsells_products_heading', __('You may also like', 'ealain'));

		if ($heading) :
		?>
			<div class=" ealain-title-box ealain-title-box-1 text-animation">

				<h4 class="ealain-title ealain-heading-title">
					<?php
					$ealain_words = explode(" ", $heading);
					$ealain_split = explode(' ', $heading);
					$ealain_lastword = array_pop($ealain_split);
					array_splice($ealain_words, -1);
					$ealain_string = implode(" ", $ealain_words);
					echo esc_html($ealain_string) . ' <span class="highlighted-text-wrap wow">' . $ealain_lastword . '</span>';
					?>
				</h4>
			</div>
		<?php endif;
		$upsells_count = count($upsells);
		if (class_exists('ReduxFramework') && $upsells_count > 4) {
			ealain()->get_single_product_dependent_script();
		?>
			<div class="swiper product-single-slider upsells-slider products ealain-main-product">
				<div class="swiper-wrapper ealain-upsells-product ealain-product-slider">
				<?php } else { ?>
					<div class="columns-4 products ealain-main-product product-grid-style">
					<?php
				}
				foreach ($upsells as $upsell) : ?>

						<?php
						$post_object = get_post($upsell->get_id());

						setup_postdata($GLOBALS['post'] = &$post_object); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited, Squiz.PHP.DisallowMultipleAssignments.Found

						if (class_exists('ReduxFramework') && $upsells_count > 4) {
						?>
							<div class="swiper-slide">
								<?php wc_get_template_part('content', 'product'); ?>
							</div>
						<?php
						} else {
							wc_get_template_part('content', 'product');
						}
						?>

					<?php
				endforeach;
				if (class_exists('ReduxFramework') && $upsells_count > 4) {
					?>
					</div>
				</div>
				<div class="iqonic-navigation">
					<div class="swiper-button-prev">
						<span class="text-btn">
							<span class="text-btn-line-holder">
								<span class="text-btn-line-top"></span>
								<span class="text-btn-line"></span>
								<span class="text-btn-line-bottom"></span>
							</span>
						</span>
					</div>
					<div class="swiper-button-next">
						<span class="text-btn">
							<span class="text-btn-line-holder">
								<span class="text-btn-line-top"></span>
								<span class="text-btn-line"></span>
								<span class="text-btn-line-bottom"></span>
							</span>
						</span>
					</div>
				</div>
			<?php } else { ?>
			</div>
		<?php } ?>

	</section>

<?php
endif;

wp_reset_postdata();
