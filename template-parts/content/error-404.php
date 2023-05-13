<?php

/**
 * Template part for displaying the page content when a 404 error has occurred
 *
 * @package ealain
 */

namespace Ealain\Ealain;

global $ealain_options ;
$is_default_404 = true;
if (isset($ealain_options['four_zero_four_layout']) && $ealain_options['four_zero_four_layout'] == 'custom') {
	if (!empty($ealain_options['404_layout'])) {
		$is_default_404 = false;
		$layout_404 = $ealain_options['404_layout'];
		$has_sticky = '';
		$my_layout = get_page_by_path($layout_404, '', 'iqonic_hf_layout');
		$f04_response =  ealain()->ealain_get_layout_content($my_layout->ID);
	}
}
?>
<?php if (!$is_default_404) : ?>
	<?php echo function_exists('iqonic_return_elementor_res') ? iqonic_return_elementor_res($f04_response) : $f04_response; ?>
<?php else : ?>
	<div class="<?php echo apply_filters('content_container_class', 'container'); ?>">
		<div class="content-area">
			<main class="site-main">
				<div class="error-404 not-found">
					<div class="page-content">
						<div class="row">
							<div class="col-sm-12 text-center">
								<?php
								if (!empty($ealain_options['404_banner_image']['url'])) { ?>
									<div class="fourzero-image mb-5">
										<img src="<?php echo esc_url($ealain_options['404_banner_image']['url']); ?>" alt="<?php esc_attr_e('404', 'ealain'); ?>" />
									</div>
								<?php
								} else {
									$ealain_bgurl = get_template_directory_uri() . '/assets/images/redux/404.png';
								?>
									<div class="fourzero-image mb-5">
										<img src="<?php echo esc_url($ealain_bgurl); ?>" alt="<?php esc_attr_e('404', 'ealain'); ?>" />
									</div>
								<?php
								}

								if (!empty($ealain_options['404_title'])) { ?>
									<h4> <?php
											$four_title = $ealain_options['404_title'];
											echo esc_html($four_title); ?>
									</h4>
								<?php } else { ?>
									<h4><?php esc_html_e('Oops! This Page is Not Found.', 'ealain'); ?></h4>
								<?php
								}

								if (!empty($ealain_options['404_description'])) { ?>
									<p class="mb-5">
										<?php $four_des = $ealain_options['404_description'];
										echo esc_html($four_des); ?>
									</p>
								<?php } else { ?>
									<p class="mb-5">
										<?php esc_html_e('The requested page does not exist.', 'ealain'); ?>
									</p>
								<?php } ?>

								<div class="d-block">
									<?php
									if (!empty($ealain_options['404_backtohome_title'])) {
										$btn_text  = esc_html($ealain_options['404_backtohome_title']);
									} else {
										$btn_text  = esc_html__('Back to Home','ealain');
									} ?>
									<?php ealain()->ealain_get_blog_readmore_link(home_url(), $btn_text); ?>
								</div>
							</div>
						</div>
					</div><!-- .page-content -->
				</div><!-- .error-404 -->
			</main><!-- #main -->
		</div><!-- #primary -->
	</div><!-- .container -->
<?php endif; ?>