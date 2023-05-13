<?php

/**
 * Pagination - Show numbered pagination for catalog pages
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/pagination.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.3.1
 */

namespace Ealain\Ealain;

if (!defined('ABSPATH')) {
	exit;
}
global $wp_query;


$ealain_options = get_option('ealain-options');

if (!is_singular()) {
	if (isset($ealain_options['ealain_woocommerce_display_pagination'])) {
		$options = $ealain_options['ealain_woocommerce_display_pagination'];
		if ($wp_query->max_num_pages > 1) {
			ealain()->ealain_ajax_product_load_scripts();
			if ($options == "load_more") {
				?>  <div class="load-btn text-center">
				<a href="javascript:void(0);" class="ealain-button ealain_loadmore_product" data-text="<?php esc_html_e('LoadMore','ealain')?>" data-loading-text="<?php esc_html_e('Loading..','ealain') ?>">
				<span class="wrap-btn">
					<span class="text-btn"><?php esc_html_e('LoadMore','ealain') ?></span>
					<span class="btn-img">
						<img src="http://10.8.0.2/wp_themes/latest/ealain/wp-content/themes/ealain-theme/assets/images/redux/fish.webp" class="btn-icon" alt="image">
						<svg class="btn-shadow" width="23" height="3" viewBox="0 0 23 3" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M23 1.28564C19.2859 1.96041 15.5718 2.33997 11.7896 2.33997C7.8711 2.33997 3.91852 2.63518 0 2.38214C1.87407 1.20129 14.2089 0.273467 21.7393 0.526506C22.1482 0.526506 22.5911 0.695188 23 0.779535C23 0.9904 23 1.11695 23 1.28564Z" fill="#312660" fill-opacity="0.3"></path>
						</svg>
					</span>
				</span>
			</a>
			</div>
			
		<?php
			} elseif ($options == "infinite_scroll") {
				echo '<div class="loader-wheel-container"></div>';
			} else {
				get_template_part('template-parts/wocommerce/pagination');
			}
		}
	} else {
		get_template_part('template-parts/wocommerce/pagination');
	}
}
