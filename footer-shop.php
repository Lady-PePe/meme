<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package ealain
 */

namespace Ealain\Ealain;

use Elementor\Plugin;
ealain()->ealain_load_woocomerce_script();

$footer_class = '';
$ealain_options = get_option('ealain-options');
$is_default = true;

if (isset($ealain_options['display_footer'])) {
	$options = $ealain_options['display_footer'];
	if ($options == "yes") {
		if (isset($ealain_options['footer_image']['url'])) {
			$bgurl = $ealain_options['footer_image']['url'];
		}
	}
}

$is_default = true;
if (class_exists('ReduxFramework') && class_exists('\\Iqonic_Layouts\\Classes\\Iqonic_Layouts_Extension')) {

	if (isset($ealain_options['woo_footer_layout']) && $ealain_options['woo_footer_layout'] == 'custom') {
		$is_default = false;
		$footer = $ealain_options['woo_footer_style'];
		$my_layout = get_page_by_path($footer, '', 'iqonic_hf_layout');
		$footer_response =  Plugin::instance()->frontend->get_builder_content_for_display($my_layout->ID);
		wp_reset_postdata();
	}
}

do_action('ealain_add_extra_footer');
if ($is_default) {
?>
	<footer id="colophon" class="footer ealain-uniq footer-one iq-bg-dark" <?php if (!empty($bgurl)) { ?> style="background-image: url(<?php echo esc_url($bgurl); ?> ) !important;" <?php } ?>>
		<?php
		get_template_part('template-parts/footer/widget');
		get_template_part('template-parts/footer/info');
		?>
	</footer><!-- #colophon -->
<?php
} else {
?>
	<footer class="footer" id="colophon">
		<?php echo function_exists('iqonic_return_elementor_res') ? iqonic_return_elementor_res($footer_response) : $footer_response; ?>
	</footer>
<?php
}
?>
</div><!-- .site-content-contain -->
</div><!-- #page -->

<!-- === back-to-top === -->
<div id="back-to-top">
	<a class="top" id="top" href="#top">
		<i class="ion-ios-arrow-up"></i>
	</a>
</div>
<!-- === back-to-top End === -->
</div><!-- #page -->
<?php wp_footer(); ?>
</body>

</html>