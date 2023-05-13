<?php

/**
 * Ealain\Ealain\Dynamic_Style\Styles\Footer class
 *
 * @package ealain
 */

namespace Ealain\Ealain\Dynamic_Style\Styles;

use Ealain\Ealain\Dynamic_Style\Component;
use function add_action;

class Footer extends Component
{

	public function __construct()
	{
		add_action('wp_enqueue_scripts', array($this, 'ealain_footer_dynamic_style'), 20);
	}

	public function is_ealain_footer()
	{
		$is_footer = true;
		$page_id = get_queried_object_id();
		$footer_page_option = get_post_meta($page_id, "display_footer", true);
		$footer_page_option = !empty($footer_page_option) ? $footer_page_option : "default";
		global $ealain_options ;

		if ($footer_page_option != 'default') {
			$is_footer = ($footer_page_option == 'no') ? false : true;
		}
		if (is_404() && !$ealain_options['footer_on_404']) {
			$is_footer = false;
		}
		
		return $is_footer;
	}
	
	public function ealain_footer_dynamic_style()
	{
		if (!$this->is_ealain_footer()) {
			return;
		}

		$footer_css = '';
		global $ealain_options ;

		if (function_exists('get_field') && get_field('field_footer_bg_color') && !empty(get_field('field_footer_bg_color'))) {
			$footer_bg_color = get_field('field_footer_bg_color');
			$footer_css .= ".footer {
								background-color: $footer_bg_color !important;
							}";
		} else {
			if ($ealain_options['change_footer_background'] == 'color' && !empty($ealain_options['footer_bg_color'])) {
				$footer_bg_color = $ealain_options['footer_bg_color'];
				$footer_css .= ".footer {
										background-color: $footer_bg_color !important;
									}";
			}
			if ($ealain_options['change_footer_background'] == 'image' && !empty($ealain_options['footer_bg_image']['url'])) {
				$footer_bg_image = $ealain_options['footer_bg_image'];
				$footer_css .= ".footer {
										background: url(" . $footer_bg_image['url'] . ") no-repeat !important;
										backgrouns-size: cover !important ;
									}";
			}
		}

		if (!empty($footer_css)) {
			wp_add_inline_style('ealain-global', $footer_css);
		}
	}
}
