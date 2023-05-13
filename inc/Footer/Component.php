<?php

/**
 * Ealain\Ealain\Editor\Component class
 *
 * @package ealain
 */

namespace Ealain\Ealain\Footer;

use Ealain\Ealain\Component_Interface;
use Ealain\Ealain\Templating_Component_Interface;

/**
 * Class for managing sidebars.
 *
 * Exposes template tags:
 * * `ealain()->get_footer_option()`
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/
 */
class Component implements Component_Interface, Templating_Component_Interface
{

	/**
	 * Gets the unique identifier for the theme component.
	 *
	 * @return string Component slug.
	 */
	public function get_slug(): string
	{
		return 'footer';
	}

	/**
	 * Adds the action and filter hooks to integrate with WordPress.
	 */
	public function initialize()
	{
		add_action('widgets_init', array($this, 'action_register_footers'));
		add_action('after_setup_theme', array($this, 'action_register_redux_footers'));
	}

	/**
	 * Gets template tags to expose as methods on the Template_Tags class instance, accessible through `ealain()`.
	 *
	 * @return array Associative array of $method_name => $callback_info pairs. Each $callback_info must either be
	 *               a callable or an array with key 'callable'. This approach is used to reserve the possibility of
	 *               adding support for further arguments in the future.
	 */
	public function template_tags(): array
	{
		return array(
			'get_footer_option' => array($this, 'get_footer_option')
		);
	}

	/**
	 * Registers the footer.
	 */
	public function action_register_footers()
	{
		$footer_option = [
			1 => 'footer_one',
			2 => 'footer_two',
			3 => 'footer_three'
		];

		$this->register_footers($footer_option);
	}

	public function action_register_redux_footers()
	{
		if (class_exists('Redux')) {
			if (empty($theme_option['footer_four'])) {

				$footer_option = [
					4 => 'footer_four',
				];

				$this->register_footers($footer_option);
			}
		}
	}

	public function register_footers($footer_option)
	{

		$theme_option;

		$default = [
			'1' => esc_html__('text-left', 'ealain'),
			'2' => esc_html__('text-right', 'ealain'),
			'3' => esc_html__('text-center', 'ealain'),
		];

		foreach ($footer_option as $key => $item) {
			$footer = '';
			if (!empty($theme_option[$item])) {
				$footer = $default[$theme_option[$item]];
			}
			$footer_w = esc_html__('Footer Area ', 'ealain');
			register_sidebar(
				array(
					'name'          => esc_html($footer_w . $key),
					'class'         => 'nav-list',
					'id'            => 'footer_' . ($key) . '_sidebar',
					'before_widget' => '<div class="widget %2$s ' . esc_attr($footer) . '">',
					'after_widget'  => '</div>',
					'before_title'  => '<h5 class="footer-title wow mt-0"> <span> ',
					'after_title'   => '<svg class="wave-pattern" width="56" height="6" viewBox="0 0 56 6" fill="none" xmlns="http://www.w3.org/2000/svg" style="display:block;">
					<path class="path" d="M1 2.07028C1.51227 2.01388 2.99254 1.94337 4.39156 2.95871C6.14033 4.22789 9.95583 6.72393 14.9372 3.17024C17.6398 1.24217 20.8194 1.7814 23.0451 3.17024C24.7939 4.26147 28.5988 6.58856 33.0079 3.17024C34.4718 2.03523 37.8832 0.935281 41.2748 3.17024C42.9529 4.48172 47.2312 6.3178 50.9195 3.17024C51.3788 2.77538 52.8379 2.01106 55 2.11259" stroke="#FFD36A" stroke-width="2"></path>
				  </svg></span></h5>',
				)
			);
		}
	}

	public function get_footer_option(): array
	{
		$data = [];
		if (
			is_active_sidebar('footer_1_sidebar') || is_active_sidebar('footer_2_sidebar') ||
			is_active_sidebar('footer_3_sidebar') || is_active_sidebar('footer_4_sidebar')
		) {
			if (function_exists('get_field') && class_exists('ReduxFramework')) {

				global $ealain_options ;

				$page_id = get_queried_object_id();
				$acf_footer_option = get_field('acf_key_footer', $page_id);
				if (isset($acf_footer_option) && $acf_footer_option != "default") {
					$options = !empty($acf_footer_option) ? $acf_footer_option : '';
				} else {
					$options = !empty($ealain_options['ealain_footer_column_layout']) ? $ealain_options['ealain_footer_column_layout'] : '';
				}
				switch ($options) {
					case 1:
						$data['value'] = ['col-12'];
						break;
					case 2:
						$data['value'] = ['col-lg-6 col-sm-6', 'col-lg-6 col-sm-6'];
						break;
					case 3:
						$data['value'] = ['col-lg-4 col-sm-6', 'col-lg-4 col-sm-6 mt-4 mt-lg-0 mt-md-0', 'col-lg-4 col-sm-6 mt-lg-0 mt-md-5 mt-4'];
						break;
					case 4:
						$data['value'] = ['col-lg-4 col-sm-6 mt-4 mt-lg-0 mt-md-0', 'col-lg-2  col-sm-6 mt-lg-0 mt-4', 'col-lg-3 col-sm-6 mt-lg-0 mt-4', 'col-lg-3 col-sm-6 mt-lg-0 mt-4'];
						break;
					default:
						$data['value'] = ['col-lg-4 col-sm-6', 'col-lg-4 col-sm-6 mt-3 mt-lg-0', 'col-lg-4 col-sm-12 mt-3 mt-lg-0'];
				}
			} else {
				$data['value'] = ['col-lg-4 col-sm-6', 'col-lg-4 col-sm-6 mt-3 mt-lg-0', 'col-lg-4 col-sm-12 mt-3 mt-lg-0'];
			}
		}
		return $data;
	}
}
