<?php
/**
 * Ealain\Ealain\Import\Component class
 *
 * @package ealain
 */

namespace Ealain\Ealain\Import;

use Ealain\Ealain\Component_Interface;
use function add_action;
use RevSlider;
use WooCommerce;


class Component implements Component_Interface
{
	/**
	 * Gets the unique identifier for the theme component.
	 *
	 * @return string Component slug.
	 */
	public function get_slug(): string
	{
		return 'import';
	}

	/**
	 * Adds the action and filter hooks to integrate with WordPress.
	 */
	public function initialize()
	{
		add_filter('pt-ocdi/import_files', array($this, 'ealain_import_files'));
		add_action('pt-ocdi/after_import', array($this, 'ealain_after_import_setup'));
	}

	public function ealain_import_files(): array
	{
		return array(
			array(
				'import_file_name' => esc_html__('All Content', 'ealain'),
				'local_import_file' => trailingslashit(get_template_directory()) . 'inc/Import/Demo/ealain-content.xml',
				'local_import_widget_file' => trailingslashit(get_template_directory()) . 'inc/Import/Demo/ealain-widget.wie',
				'local_import_customizer_file' => trailingslashit(get_template_directory()) . 'inc/Import/Demo/ealain-export.dat',
				'local_import_redux' => array(
					array(
						'file_path' => trailingslashit(get_template_directory()) . 'inc/Import/Demo/ealain_redux.json',
						'option_name' => 'ealain-options',
					),
				),
				'import_preview_image_url' => get_template_directory_uri() . '/screenshot.png',
				'import_notice' => esc_html__('DEMO IMPORT REQUIREMENTS: Memory Limit of 128 MB and max execution time (php time limit) of 300 seconds. ', 'ealain') . '
									</br></br>' . esc_html__('Based on your INTERNET SPEED it could take 5 to 25 minutes. ', 'ealain'),
				'preview_url' => 'https://wordpress.iqonic.design/product/wp/ealain/',
			),
		);
	}

	public function ealain_after_import_setup($selected_import)
	{
		//get file
		global $wp_filesystem;
		require_once(ABSPATH . '/wp-admin/includes/file.php');
		WP_Filesystem();
		$content    =   '';
		$import_file =  trailingslashit(get_template_directory()) . 'inc/Import/Demo/elementor-site-settings.json';

		// Assign menus to their locations.
		$locations = get_theme_mod('nav_menu_locations'); // registered menu locations in theme
		$menus = wp_get_nav_menus(); // registered menus

		if ($menus) {
			foreach ($menus as $menu) { // assign menus to theme locations

				if ($menu->name == 'main menu') {
					$locations['primary'] = $menu->term_id;
				}

			}
		}
		set_theme_mod('nav_menu_locations', $locations); // set menus to locations

		if ('All Content' === $selected_import['import_file_name']) {
			$front_page_id = get_page_by_title('Home');
			$blog_page_id = get_page_by_title('Blog');

			update_option('show_on_front', 'page');
			update_option('page_on_front', $front_page_id->ID);
			update_option('page_for_posts', $blog_page_id->ID);
		}

		//post-types selection for edit with elementor option
		$enable_edit_with_elementor = [
			"post",
			"page",
			"team",
			"portfolio",
			"service",
			"iqonic_hf_layout"
		];
		update_option('elementor_cpt_support', $enable_edit_with_elementor);

		//elementor global settings
		if (file_exists($import_file)) {
			$content = $wp_filesystem->get_contents($import_file);
			if (!empty($content)) {
				$default_post_id = get_option('elementor_active_kit');
				update_post_meta($default_post_id, '_elementor_page_settings', json_decode($content, true));
			}
		}

		//Import Revolution Slider
		if (class_exists('RevSlider')) {
			$slider_array = array(
				//	Slider Paths
				get_template_directory() . "/inc/Import/Slider/agency.zip",
				get_template_directory() . "/inc/Import/Slider/main-home.zip",
				get_template_directory() . "/inc/Import/Slider/nft.zip",
			);

			$slider = new RevSlider();

			foreach ($slider_array as $filepath) {
				$slider->importSliderFromPost(true, true, $filepath);
			}
		}

		$menu_item = get_posts([
            'post_type' => 'nav_menu_item',
            'post_status' => 'publish',
            'numberposts' => -1,
        ]);
        foreach ($menu_item as $key => $value) {
            wp_update_post(
                array(
                    'ID' => $value->ID,
                    'post_content' => $value->post_content,
                )
            );
        } 

		// Set Quick View Default value 
		update_option('woosq_button_type','link');
		update_option('woosq_button_position','0');
		update_option('yith_wcwl_button_position','shortcode');

		if( class_exists( 'WooCommerce' )){
			// save woof setting
			$ealain_woof_options = get_option('woof_settings', array());
			$ealain_woof_options['by_price']['show'] = '1';
			$ealain_woof_options['by_text']['show'] = '1';
			$ealain_woof_options['by_onsales']['show'] = '1';
			$ealain_woof_options['tax_type']['product_cat'] = 'checkbox';
			$ealain_woof_options['tax_type']['product_tag'] = 'checkbox';
			$ealain_woof_options['icheck_skin'] = 'flat_grey';
			update_option('woof_set_automatically', 0);
			update_option('woof_settings', $ealain_woof_options );
		}

		// remove default post
		wp_delete_post(1, true);
	}
	
}

