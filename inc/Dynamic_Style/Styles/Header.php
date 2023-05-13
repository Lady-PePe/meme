<?php

/**
 * Ealain\Ealain\Dynamic_Style\Styles\Header class
 *
 * @package ealain
 */

namespace Ealain\Ealain\Dynamic_Style\Styles;

use Ealain\Ealain\Dynamic_Style\Component;
use function add_action;


class Header extends Component
{

	public function __construct()
	{
		add_action('wp_enqueue_scripts', array($this, 'ealain_header_background_style'), 20);
		add_action('wp_enqueue_scripts', array($this, 'ealain_vertical_header_option'), 20);
		add_filter('body_class', array($this, 'ealain_add_body_classes'));
	}

	public function is_ealain_header()
	{
		$is_header = true;
		$page_id = get_queried_object_id();
		$header_page_option = get_post_meta($page_id, "display_header", true);
		$header_page_option = !empty($header_page_option) ? $header_page_option : "default";
		global $ealain_options ;

		if ($header_page_option != 'default') {
			$is_header =  ($header_page_option == 'no') ? false : true;
		}
		if (is_404() && !$ealain_options['header_on_404']) {
			$is_header = false;
		}
		return $is_header;
	}

	public function ealain_vertical_header_option()
	{

		if(!$this->is_ealain_header()) return;
		
		$id = get_queried_object_id();
		global $ealain_options ;
		$header_css = '';
		$is_vertical = false;
		$header_display = !empty($id) ? get_post_meta($id, 'display_header', true) : '';
		$header_layout = !empty($id) ? get_post_meta($id, 'header_layout_type', true) : '';
		$h_layout_position = !empty($id) ? get_post_meta($id, 'header_layout_position', true) : '';
		if ($header_display === 'yes' && $header_layout === 'custom' && $h_layout_position === 'vertical') {
			$is_vertical = true;
			$vertical_width = get_post_meta($id, '_vertical_header_width', true);
			if (!empty($vertical_width)) {
				$header_css .= '--sidebar-width: ' . $vertical_width . ' !important';
			}
		} else {
			if (isset($ealain_options['header_layout_position']) && $ealain_options['header_layout_position'] == 'vertical') {
				$is_vertical = true;
				if (!empty($ealain_options['vertical_header_width'])) {
					$header_css .= '--sidebar-width: ' . $ealain_options['vertical_header_width']['width'] . ' !important';
				}
			}
		}
		if ($is_vertical) {
			add_filter('body_class', function ($classes) {
				return array_merge($classes, array('ealain-has--vertical'));
			});
		}
		if (!empty($header_css)) {
			$header_css = ':root { ' . $header_css . '}';
			wp_add_inline_style('ealain-global', $header_css);
		}
	}

	public function ealain_add_body_classes($classes)
	{
		if (!$this->is_ealain_header()) return;
		
		$page_id = get_queried_object_id();
		global $ealain_options ;
		$header_page_option = get_post_meta($page_id, 'header_position', true);
		$header_page_option = !empty($header_page_option) ? $header_page_option : "default";

		if ($header_page_option != "default") {
			$body_class = "ealain-header-" . $header_page_option;
		} elseif (isset($ealain_options['header_postion'])) {
			$body_class = "ealain-header-" . $ealain_options['header_postion'];
		} else {
			$body_class = "ealain-header-static";
		}

		return array_merge($classes, [$body_class]);
	}
	public function ealain_header_background_style()
	{
		if (!$this->is_ealain_header()) return;
	
		$dynamic_css = '';
		global $ealain_options ;
	
		if ($ealain_options['ealain_header_background_type'] != 'default') {
			$type = $ealain_options['ealain_header_background_type'];
			if ($type == 'color') {
				if (!empty($ealain_options['ealain_header_background_color'])) {
					$dynamic_css = 'header#default-header{
							background : ' . $ealain_options['ealain_header_background_color'] . '!important;
						}';
				}
			}
			if ($type == 'image') {
				if (!empty($ealain_options['ealain_header_background_image']['url'])) {
					$dynamic_css = 'header#default-header{
							background : url(' . $ealain_options['ealain_header_background_image']['url'] . ') !important;
						}';
				}
			}
			if ($type == 'transparent') {
				$dynamic_css = 'header#default-header{
						background : transparent !important;
					}';
			}
		}
		if (!empty($dynamic_css)) {
			wp_add_inline_style('ealain-global', $dynamic_css);
		}
	}
}
