<?php

/**
 * Ealain\Ealain\Dynamic_Style\Styles\Banner class
 *
 * @package ealain
 */

namespace Ealain\Ealain\Dynamic_Style\Styles;

use Ealain\Ealain\Dynamic_Style\Component;
use function add_action;

class Color extends Component
{

	public function __construct()
	{
		add_action('wp_enqueue_scripts', array($this, 'ealain_color_options'), 20);
	}

	public function ealain_color_options()
	{

		global $ealain_options ;
		$color_var = "";
		if (function_exists('get_field') && class_exists('ReduxFramework')) {
			if (isset(get_field('key_color_pallete')['primary_color']) && !empty(get_field('key_color_pallete')['primary_color']) && get_field('key_color_switch') === "yes") {
				$color = get_field('key_color_pallete')['primary_color'];
				$color_var .= '--color-theme-primary: ' . $color . ' !important;';
			} else {
				if ($ealain_options['custom_color_switch'] == 'yes' && isset($ealain_options['primary_color']) && !empty($ealain_options['primary_color'])) {
					$color = $ealain_options['primary_color'];
					$color_var .= '--color-theme-primary: ' . $color . ' !important;';
				}
			}

			if (isset(get_field('key_color_pallete')['secondary_color']) && !empty(get_field('key_color_pallete')['secondary_color']) && get_field('key_color_switch') === "yes") {
				$color = get_field('key_color_pallete')['secondary_color'];
				$color_var .= '--color-theme-secondary: ' . $color . ' !important;';
			} else {
				if ($ealain_options['custom_color_switch'] == 'yes' && isset($ealain_options['secondary_color']) && !empty($ealain_options['secondary_color'])) {
					$color = $ealain_options['secondary_color'];
					$color_var .= '--color-theme-secondary: ' . $color . ' !important;';
				}
			}

			if (isset(get_field('key_color_pallete')['text_color']) && !empty(get_field('key_color_pallete')['text_color']) && get_field('key_color_switch') === "yes") {
				$color = get_field('key_color_pallete')['text_color'];
				$color_var .= '--global-font-color: ' . $color . ' !important;';
			} else {
				if ($ealain_options['custom_color_switch'] == 'yes' && isset($ealain_options['text_color']) && !empty($ealain_options['text_color'])) {
					$color = $ealain_options['text_color'];
					$color_var .= '--global-font-color: ' . $color . ' !important;';
				}
			}

			if (isset(get_field('key_color_pallete')['title_color']) && !empty(get_field('key_color_pallete')['title_color']) && get_field('key_color_switch') === "yes") {
				$color = get_field('key_color_pallete')['title_color'];
				$color_var .= ' --global-font-title: ' . $color . ' !important;';
			} else {
				if ($ealain_options['custom_color_switch'] == 'yes' && isset($ealain_options['title_color']) && !empty($ealain_options['title_color'])) {
					$color = $ealain_options['title_color'];
					$color_var .= ' --global-font-title: ' . $color . ' !important;';
				}
			}
			if (!empty($color_var)) {
				$color_attrs = ':root { ' . $color_var . '}';
				wp_add_inline_style('ealain-global', $color_attrs);
			}
		}
	}
}
