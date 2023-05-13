<?php

/**
 * Ealain\Ealain\Sidebars\Component class
 *
 * @package ealain
 */

namespace Ealain\Ealain\Sidebars;

use Ealain\Ealain\Component_Interface;
use Ealain\Ealain\Templating_Component_Interface;
use function add_action;
use function add_filter;
use function register_sidebar;
use function is_active_sidebar;
use function dynamic_sidebar;

/**
 * Class for managing sidebars.
 *
 * Exposes template tags:
 * * `ealain()->is_primary_sidebar_active()`
 * * `ealain()->display_primary_sidebar()`
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/
 */
class Component implements Component_Interface, Templating_Component_Interface
{

	const PRIMARY_SIDEBAR_SLUG = 'sidebar-1';
	public $get_option = '';

	/**
	 * Gets the unique identifier for the theme component.
	 *
	 * @return string Component slug.
	 */
	public function get_slug(): string
	{
		return 'sidebars';
	}

	/**
	 * Adds the action and filter hooks to integrate with WordPress.
	 */
	public function initialize()
	{
		add_action('widgets_init', array($this, 'action_register_sidebars'));
		add_filter('body_class', array($this, 'filter_body_classes'));
		$this->get_option =  get_option('ealain-options');
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
			'is_primary_sidebar_active' => array($this, 'is_primary_sidebar_active'),
			'display_primary_sidebar' => array($this, 'display_primary_sidebar'),
			'post_style' => array($this, 'post_style'),
		);
	}

	/**
	 * Registers the sidebars.
	 */
	public function action_register_sidebars()
	{
		register_sidebar(
			array(
				'name' => esc_html__('Blog Sidebar', 'ealain'),
				'id' => static::PRIMARY_SIDEBAR_SLUG,
				'description' => esc_html__('Add widgets here.', 'ealain'),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title' => '<h5 class="widget-title"> <span>  ',
				'after_title' => ' </span></h5>',
			)
		);

		if (class_exists('WooCommerce')) {
			register_sidebar(array(
				'name'          => esc_html__('Product Sidebar', 'ealain'),
				'class'         => 'nav-list',
				'id'            => 'product_sidebar',
				'before_widget' => '<div class="sidebar_widget widget-woof %2$s">',
				'after_widget'  => '</div>',
				'before_title' => '<h5 class="widget-title">',
				'after_title' => '<span class="line_"></span></h5>',
			));
		}
	}

	/**
	 * Adds custom classes to indicate whether a sidebar is present to the array of body classes.
	 *
	 * @param array $classes Classes for the body element.
	 * @return array Filtered body classes.
	 */
	public function filter_body_classes(array $classes): array
	{
		if ($this->is_primary_sidebar_active()) {
			global $template;

			if (!in_array(basename($template), array('front-page.php', 'FourZeroFour.php', 'offline.php'))) {
				$classes[] = 'has-sidebar';
			}
		}

		return $classes;
	}

	/**
	 * Checks whether the primary sidebar is active.
	 *
	 * @return bool True if the primary sidebar is active, false otherwise.
	 */
	public function is_primary_sidebar_active(): bool
	{
		if (class_exists('ReduxFramework') && $this->get_option != '') {
			if (class_exists('WooCommerce') && is_shop() && isset($this->get_option['woocommerce_shop']) && $this->get_option['woocommerce_shop'] == 2) {
				return !in_array($this->get_option['woocommerce_shop_grid'], [3, 4, 5]);
			}elseif(isset($this->get_option['woocommerce_shop']) && $this->get_option['woocommerce_shop'] == 1) return true;
			$option = is_single() ? $this->get_option['blog_single_page_setting'] : $this->get_option['blog_setting'];
			return in_array($option,[2,5]);
		}
		return (bool)is_active_sidebar(static::PRIMARY_SIDEBAR_SLUG);
	}

	/**
	 * Displays the primary sidebar.
	 */
	public function display_primary_sidebar()
	{
		if (class_exists('WooCommerce') && is_shop() || is_tax()) {
			dynamic_sidebar('product_sidebar');
		} else {
			dynamic_sidebar(static::PRIMARY_SIDEBAR_SLUG);
		}
	}

	public function post_style(): array
	{
		$option = 'blog_setting';
		if (class_exists('WooCommerce') && (is_shop() || is_archive())) {
			if (isset($this->get_option['woocommerce_shop']) && $this->get_option['woocommerce_shop'] == '1') {
				$option = 'woocommerce_shop_list';
			} else {
				$option = 'woocommerce_shop_grid';
			}
		}
		$section['row_reverse'] = '';
		$section['post'] = 'col-lg-12 col-sm-12 p-0';

		if (is_single()) {
			$options = !empty($this->get_option['blog_single_page_setting']) ? $this->get_option['blog_single_page_setting'] : '';
		} else {
			$options = !empty($this->get_option[$option]) ? $this->get_option[$option] : '';
		}

		switch ($options) {
			case 4:
				$section['post'] = 'col-lg-6 col-sm-12';
				break;
			case 5:
				$section['post'] = 'col-lg-4 col-sm-12';
				break;
			case 2:
				$section['row_reverse'] = ' flex-row-reverse';
				break;
		}


		return $section;
	}
}
