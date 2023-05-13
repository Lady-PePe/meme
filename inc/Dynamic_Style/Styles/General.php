<?php

/**
 * Ealain\Ealain\Dynamic_Style\Styles\General class
 *
 * @package ealain
 */

namespace Ealain\Ealain\Dynamic_Style\Styles;

use Ealain\Ealain\Dynamic_Style\Component;
use function add_action;

class General extends Component
{
	public function __construct()
	{
		add_action('wp_enqueue_scripts', array($this, 'ealain_general_root_var'), 20);
		add_action('wp_enqueue_scripts', array($this, 'ealain_create_general_style'), 20);
	}
	public function ealain_general_root_var()
	{
		global $ealain_options ;
		$id = get_queried_object_id();
		$general_var = '';
		if (!empty($ealain_options['grid_container']) && !empty(['grid_container']['width']) || !empty($ealain_options['grid_container']['unit']) ) {
			$general_var .= '--content-width: ' . $ealain_options['grid_container']['width']. $ealain_options['grid_container']['unit'] . ' !important;';
		}
		$spacings = [
			'page_spacing' 			=> ['--global-page-top-spacing', '--global-page-bottom-spacing'],
			'tablet_page_spacing'	=> ['--global-page-top-spacing-tablet', '--global-page-bottom-spacing-tablet'],
			'mobile_page_spacing'	=> ['--global-page-top-spacing-mobile', ' --global-page-bottom-spacing-mobile']
		];

		$is_page_spacing = get_post_meta($id, '_is_page_spacing', true);

		foreach ($spacings as $options_value => $vars) {
			$page_top_spacing = get_post_meta($id, '_' . $options_value, true);
			$page_bottom_spacing = get_post_meta($id, '_bottom_' . $options_value, true);
			if ($is_page_spacing == 'custom' && (!empty(trim($page_top_spacing)) ||  !empty(trim($page_bottom_spacing)))) {
				$general_var .= !empty($page_top_spacing) ? $vars[0] . ":" . $page_top_spacing . " !important;" : '';
				$general_var .= !empty($page_bottom_spacing) ? $vars[1] . ":" . $page_bottom_spacing . " !important;" : '';
			} else {
				if ($ealain_options['is_page_spacing'] == "custom") {
					$general_var .= !empty($ealain_options[$options_value]["top"]) ? $vars[0] . ":" . $ealain_options[$options_value]["top"] . " !important;" : "";
					$general_var .= !empty($ealain_options[$options_value]["bottom"]) ? $vars[1] . ":" . $ealain_options[$options_value]["bottom"] . " !important;" : "";
				}
			}
		}

		if (!empty($general_var)) {
			$general_var = ":root{" . $general_var . "}";
			wp_add_inline_style('ealain-global', $general_var);
		}
	}
	public function ealain_create_general_style()
	{

		global $ealain_options ;
		$general_var = '';

		if ($ealain_options['body_back_option'] == 1) {
			if (isset($ealain_options['body_color'])  && !empty($ealain_options['body_color'])) {
				$general = $ealain_options['body_color'];
				$general_var .= 'body { background : ' . $general . ' !important; }';
			}
		}
		if ($ealain_options['body_back_option'] == 3) {
			if (isset($ealain_options['body_image']['url']) && !empty($ealain_options['body_image']['url'])) {
				$general = $ealain_options['body_image']['url'];
				$general_var .= 'body { background-image: url(' . $general . ') !important; }';
			}
		}

		if (!empty($general_var)) {
			wp_add_inline_style('ealain-global', $general_var);
		}
	}
}
