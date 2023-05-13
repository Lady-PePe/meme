<?php

/**
 * Ealain\Ealain\Redux_Framework\Options\User class
 *
 * @package ealain
 */

namespace Ealain\Ealain\Redux_Framework\Options;

use Redux;
use Ealain\Ealain\Redux_Framework\Component;

class Woocommerce extends Component
{

	public function __construct()
	{
		$this->set_widget_option();
	}

	protected function set_widget_option()
	{
		Redux::set_section($this->opt_name, array(
			'title' => esc_html__('WooCommerce ', 'ealain'),
			'icon'  => 'el el-shopping-cart',
			'customizer_width' => '500px',
		));


		Redux::set_section($this->opt_name, array(
			'title' => esc_html__('Shop Page', 'ealain'),
			'id'    => 'Woocommerce',
			'subsection' => true,
			'fields' => array(
				array(
					'id'        => 'woocommerce_shop',
					'type'      => 'image_select',
					'title'     => esc_html__('Shop page Setting', 'ealain'),
					'subtitle'  => wp_kses(__('Choose among these structures (Product Listing, Product Grid) for your shop section.<br />To filling these column sections you should go to appearance > widget.<br />And put every widget that you want in these sections.', 'ealain'), array('br' => array())),
					'options'   => array(
						'1' => array('title' => esc_html__('Product Listing', 'ealain'), 'img' => get_template_directory_uri() . '/assets/images/redux//single-column.jpg'),
						'2' => array('title' => esc_html__('Product Grid ', 'ealain'), 'img' => get_template_directory_uri() . '/assets/images/redux//three-column.jpg'),
					),
					'default'   => '2',
				),
				array(
					'id'        => 'woocommerce_shop_grid',
					'type'      => 'image_select',
					'title'     => esc_html__('Shop Grid page Setting', 'ealain'),
					'options'   => array(
						'1' => array('title' => esc_html__('Left Sidebar', 'ealain'), 'img' => get_template_directory_uri() . '/assets/images/redux//left-side.jpg'),
						'2' => array('title' => esc_html__('Right Sidebar', 'ealain'), 'img' => get_template_directory_uri() . '/assets/images/redux//right-side.jpg'),
						'3' => array('title' => esc_html__('Two Columns', 'ealain'), 'img' => get_template_directory_uri() . '/assets/images/redux//two-column.jpg'),
						'4' => array('title' => esc_html__('Three Columns', 'ealain'), 'img' => get_template_directory_uri() . '/assets/images/redux//three-column.jpg'),
						'5' => array('title' => esc_html__('Four Columns', 'ealain'), 'img' => get_template_directory_uri() . '/assets/images/redux//four-column.jpg'),
					),
					'default'   => '1',
					'required'  => array('woocommerce_shop', '=', '2'),
				),
				array(
					'id'        => 'woocommerce_shop_list',
					'type'      => 'image_select',
					'title'     => esc_html__('Shop List page Setting', 'ealain'),
					'options'   => array(
						'1' => array('title' => esc_html__('Left Sidebar', 'ealain'), 'img' => get_template_directory_uri() . '/assets/images/redux//left-side.jpg'),
						'2' => array('title' => esc_html__('Right Sidebar', 'ealain'), 'img' => get_template_directory_uri() . '/assets/images/redux//right-side.jpg'),
					),
					'default'   => '1',
					'required'  => array('woocommerce_shop', '=', '1'),
				),

				array(
					'id' => 'woocommerce_product_per_page',
					'type' => 'slider',
					'title' => esc_html__('Set Product Per Page', 'ealain'),
					'desc' => esc_html__('Here This option provide set post per paged item', 'ealain'),
					'min' => 1,
					'step' => 1,
					'max' => 99,
					'default' => 10
				),

				array(
					'id'        => 'ealain_woocommerce_display_pagination',
					'type'      => 'button_set',
					'title'     => esc_html__('Woocommerce Product Load Type', 'ealain'),
					'subtitle' => esc_html__('This Option Product The Shop page Product Load Type', 'ealain'),
					'options'   => array(
						'pagination' => esc_html__('Pagination', 'ealain'),
						'load_more' => esc_html__('Load More', 'ealain'),
						'infinite_scroll' => esc_html__('Infinite Scroll', 'ealain')
					),
					'default'   => 'pagination'
				),
				array(
					'id'        => 'ealain_show_cart_at_all',
					'type'      => 'button_set',
					'title'     => esc_html__('Show Cart', 'ealain'),
					'subtitle' => esc_html__('Turn on to Show Cart At All Page or Show Only In Woocommerce Pages', 'ealain'),
					'options'   => array(
						'yes' => esc_html__('On', 'ealain'),
						'no' => esc_html__('Off', 'ealain')
					),
					'required' 	=> array('display_header_cart_button', '=', 'yes'),
					'default'   => esc_html__('yes', 'ealain')
				),
			)
		));
		Redux::set_section($this->opt_name, array(
			'title' => esc_html__('Product Page', 'ealain'),
			'id'    => 'product_page',
			'subsection' => true,
			'fields' => array(

				array(
					'id' => 'product_display_banner',
					'type' => 'button_set',
					'title' => esc_html__('Display Banner on Product Page', 'ealain'),
					'subtitle' => esc_html__('This Option Display The Banner Of The Product', 'ealain'),
					'options' => array(
						'yes' => esc_html__('Yes', 'ealain'),
						'no' => esc_html__('No', 'ealain')
					),
					'default' => esc_html__('no', 'ealain')
				),
				array(
					'id' => 'ealain_show_related_product',
					'type' => 'button_set',
					'title' => esc_html__('Display Related Product On Single Page', 'ealain'),
					'subtitle' => esc_html__('This Option Display RElated Product On Single Page', 'ealain'),
					'options' => array(
						'yes' => esc_html__('Yes', 'ealain'),
						'no' => esc_html__('No', 'ealain')
					),
					'default' => esc_html__('yes', 'ealain')
				),

			)
		));
		Redux::set_section($this->opt_name, array(
			'title' => esc_html__('Products Setting', 'ealain'),
			'id'    => 'single_page',
			'subsection' => true,
			'fields' => array(


				array(
					'id'        => 'ealain_display_product_name',
					'type'      => 'button_set',
					'title'     => esc_html__('Display Name', 'ealain'),
					'subtitle' => esc_html__('Here This option provide Name Of The Product', 'ealain'),
					'options'   => array(
						'yes' => esc_html__('Yes', 'ealain'),
						'no' => esc_html__('No', 'ealain')
					),
					'default'   => 'yes'
				),

				array(
					'id'        => 'ealain_display_price',
					'type'      => 'button_set',
					'title'     => esc_html__('Display Price', 'ealain'),
					'subtitle' => esc_html__('Here This option Display The Price', 'ealain'),
					'options'   => array(
						'yes' => esc_html__('Yes', 'ealain'),
						'no' => esc_html__('No', 'ealain')
					),
					'default'   => 'yes'
				),

				array(
					'id'        => 'ealain_display_product_rating',
					'type'      => 'button_set',
					'title'     => esc_html__('Display Rating', 'ealain'),
					'subtitle' => esc_html__('Display The Ratings', 'ealain'),
					'options'   => array(
						'yes' => esc_html__('Yes', 'ealain'),
						'no' => esc_html__('No', 'ealain')
					),
					'default'   => 'yes'
				),


				array(
					'id'        => 'ealain_display_product_addtocart_icon',
					'type'      => 'button_set',
					'title'     => esc_html__('Display AddToCart Icon', 'ealain'),
					'subtitle' => esc_html__('Display AddToCart Icon', 'ealain'),
					'options'   => array(
						'yes' => esc_html__('Yes', 'ealain'),
						'no' => esc_html__('No', 'ealain')
					),
					'default'   => 'yes'
				),

				array(
					'id'        => 'ealain_display_product_wishlist_icon',
					'type'      => 'button_set',
					'title'     => esc_html__('Display Wishlist Icon', 'ealain'),
					'subtitle' => esc_html__('Display The Wishlist Icon', 'ealain'),
					'options'   => array(
						'yes' => esc_html__('Yes', 'ealain'),
						'no' => esc_html__('No', 'ealain')
					),
					'default'   => 'yes'
				),


				array(
					'id'        => 'ealain_display_product_quickview_icon',
					'type'      => 'button_set',
					'title'     => esc_html__('Display QuickView Icon', 'ealain'),
					'subtitle' => esc_html__('Display QuickView Icon', 'ealain'),
					'options'   => array(
						'yes' => esc_html__('Yes', 'ealain'),
						'no' => esc_html__('No', 'ealain')
					),
					'default'   => 'yes'
				),
			

				array(
					'id'            => 'ealain_display_sale_badge_color',
					'type'          => 'color',
					'title'         => esc_html__(' Sale Badge Color', 'ealain'),
					'subtitle'		=> esc_html__('Color Of The Sale Badge', 'ealain'),
					'mode'          => 'background',
					'transparent'   => false,
				),

				array(
					'id'            => 'ealain_display_new_badge_color',
					'type'          => 'color',
					'title'         => esc_html__(' New Badge Color', 'ealain'),
					'subtitle' 		=> esc_html__('Color Of The New Badge', 'ealain'),
					'mode'          => 'background',
					'transparent'   => false,
				),


				array(
					'id'            => 'ealain_display_sold_badge_color',
					'type'          => 'color',
					'title'         => esc_html__(' Sold Badge Color', 'ealain'),
					'subtitle'      => esc_html__('Color Of The Sold BAdge', 'ealain'),
					'mode'          => 'background',
					'transparent'   => false,
				),
				'default' => 'yes'
			),

		));
		Redux::set_section($this->opt_name, array(
			'title' => esc_html__('Header', 'ealain'),
			'id'    => 'woo_header',
			'subsection' => true,
			'fields' => array(
				array(
					'id' => 'woo_header_layout',
					'type' => 'button_set',
					'title' => esc_html__('Header Layout', 'ealain'),
					'subtitle' => esc_html__('Select the variation for header ', 'ealain'),
					'options' => array(
						'default' => esc_html__('Default', 'ealain'),
						'custom' => esc_html__('Custom', 'ealain'),
					),
					'default' => esc_html__('default', 'ealain')
				),
				array(
					'id'        	=> 'woo_menu_style',
					'type'      	=> 'select',
					'title' 		=> esc_html__('Header Layout', 'ealain'),
					'subtitle' 		=> esc_html__('Select the layout variation that you want to use for header layout.', 'ealain'),
					'options'		=> (function_exists('iqonic_addons_get_list_layouts')) ? iqonic_addons_get_list_layouts(false, 'header') : '',
					'description'	=> (function_exists('iqonic_addons_get_list_layouts')) ? esc_html__("Create", 'ealain') . " <a target='_blank' href='" . admin_url('edit.php?post_type=iqonic_hf_layout') . "'>" . esc_html__("New Layout", 'ealain') . "</a>" : "",
					'required' 		=> array('woo_header_layout', '=', 'custom'),
				),
				array(
					'id' => 'woo_header_layout_position',
					'type' => 'button_set',
					'title' => esc_html__('Header Layout Position', 'ealain'),
					'options' => array(
						'horizontal' 	=> esc_html__('Horizontal', 'ealain'),
						'vertical' 		=> esc_html__('Vertical', 'ealain'),
					),
					'default' => 'horizontal',
					'required' 	=> array('header_layout', '=', 'custom'),
				),

				array(
					'id'        =>  'woo_vertical_header_width',
					'type'      =>  'dimensions',
					'units'     =>  array('em', 'px', '%'),
					'height'    =>  false,
					'width'     =>  true,
					'title'     =>  __('Vertical header width', 'ealain'),
					'default'   =>  array(
						'width'   => '300px',
					),
					'required' 	=> array('woo_header_layout_position', '=', 'vertical'),
				),
				array(
					'id'        	=> 'ealain_woo_header_variation',
					'type'      	=> 'image_select',
					'title' 		=> esc_html__('Header Layout', 'ealain'),
					'subtitle' 		=> esc_html__('Select the layout variation that you want to use for header layout.', 'ealain'),
					'options' => array(
						'1'      => array(
							'alt' => 'Style1',
							'img' => get_template_directory_uri() . '/assets/images/redux/header.png',
						),
					),
					'required' 	=> array('woo_header_layout', '=', 'default'),
					'default' => '1'
				),

				array(
					'id' => 'woo_header_postion',
					'type' => 'button_set',
					'title' => esc_html__('Header Position', 'ealain'),
					'options' => array(
						'default' => esc_html__('Default', 'ealain'),
						'under' => esc_html__('Under', 'ealain'),
						'over' => esc_html__('Over', 'ealain'),
					),
					'default' => 'over',
				),

				array(
					'id' => 'woo_header_layout_position',
					'type' => 'button_set',
					'title' => esc_html__('Header Layout Position', 'ealain'),
					'options' => array(
						'horizontal' 	=> esc_html__('Horizontal', 'ealain'),
						'vertical' 		=> esc_html__('Vertical', 'ealain'),
					),
					'default' => 'horizontal',
					'required' 	=> array('woo_header_layout', '=', 'custom'),
				),

				array(
					'id'        =>  'woo_vertical_header_width',
					'type'      =>  'dimensions',
					'units'     =>  array('em', 'px', '%'),
					'height'    =>  false,
					'width'     =>  true,
					'title'     =>  esc_html__('Vertical header width', 'ealain'),
					'default'   =>  array(
						'width'   => '300px',
					),
					'required' 	=> array('woo_header_layout_position', '=', 'vertical'),
				),


			)
		));

		Redux::set_section($this->opt_name, array(
			'title' => esc_html__('Footer', 'ealain'),
			'id'    => 'woo_footer',
			'subsection' => true,
			'fields' => array(
				array(
					'id' => 'woo_footer_layout',
					'type' => 'button_set',
					'title' => esc_html__('Footer Layout', 'ealain'),
					'options' => array(
						'default' => esc_html__('Default', 'ealain'),
						'custom' => esc_html__('Custom', 'ealain'),
					),
					'default' => 'default'
				),
				array(
					'id'        => 'woo_footer_style',
					'type'      => 'select',
					'title' 	=> esc_html__('Footer Layout', 'ealain'),
					'subtitle' 	=> esc_html__('Select the layout variation that you want to use for Footer.', 'ealain'),
					'options'	=> (function_exists('iqonic_addons_get_list_layouts')) ? iqonic_addons_get_list_layouts(false, 'footer') : '',
					'description'	=> (function_exists('iqonic_addons_get_list_layouts')) ? esc_html__("Create", 'ealain') . " <a target='_blank' href='" . admin_url('edit.php?post_type=iqonic_hf_layout') . "'>" . esc_html__("New Layout", 'ealain') . "</a>" : "",
					'required' 	=> array('woo_footer_layout', '=', 'custom'),
				),
			)
		));
	}
}
