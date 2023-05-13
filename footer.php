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

use Ealain\Ealain\Dynamic_Style\Styles\Footer;

$footer_class = '';
global $ealain_options ;
$is_default = $is_footer = true;

if (function_exists("get_field")) {
	$breadcrumb = new Footer();
	$is_footer = $breadcrumb->is_ealain_footer();
}

if ($is_footer) {

	if (function_exists('get_field') && class_exists('ReduxFramework') && class_exists("Elementor\Plugin")) {
		$id = (get_queried_object_id()) ? get_queried_object_id() : '';
		$footer_layout = !empty($id) ? get_post_meta($id, 'footer_layout_type', true) : '';
		$footer_name = !empty($id) ? get_post_meta($id, 'footer_layout_name', true) : '';

		if ($footer_layout !== 'default' && !empty($footer_name)) {
			$is_default = false;
			$my_layout = get_page_by_path($footer_name, '', 'iqonic_hf_layout');
			echo ealain()->ealain_get_layout_content($my_layout->ID);
		} else if (isset($ealain_options['footer_layout']) && $ealain_options['footer_layout'] == 'custom') {
			$is_default = false;
			$my_layout = get_page_by_path($ealain_options['footer_style'], '', 'iqonic_hf_layout');
			echo ealain()->ealain_get_layout_content($my_layout->ID);
		}
	}

	do_action('ealain_add_extra_footer');

	if ($is_default) {
?>
		<footer class="footer ealain-footer">
			<?php
			get_template_part('template-parts/footer/widget');
			get_template_part('template-parts/footer/copyright');
			?>
		</footer><!-- #colophon -->
       <?php
	}
}
?>
<!--- === back-to-top === --->
<div id="back-to-top" class="css-prefix-top">
	<a class="top" id="top" href="#top">
		<?php 
		if(class_exists('ReduxFramework')){
			if(!empty($ealain_options['php_back_to_top']['url'])){
				?>
				<img src="<?php echo esc_url($ealain_options['php_back_to_top']['url']); ?>" alt="<?php esc_attr_e('404', 'ealain'); ?>" />
				<?php
			}
			if(!empty($ealain_options['php_back_to_top_text'])){
				?>
				<div class="text-btp"><?php echo esc_html($ealain_options['php_back_to_top_text']); ?></div>
				<?php
			}
		} else {
		    $bgurl = get_template_directory_uri() . '/assets/images/redux/back-to-top.webp'; ?>
		    <img src="<?php echo esc_url($bgurl); ?>" alt="<?php esc_attr_e('404', 'ealain'); ?>" />
	        <div class="text-btp"><?php esc_html_e('back to top','ealain'); ?></div>
		<?php } ?>
	</a>
</div>
<!-- === back-to-top End === -->
</div><!-- #page -->
</div>
<?php wp_footer(); ?>
</body>

</html>