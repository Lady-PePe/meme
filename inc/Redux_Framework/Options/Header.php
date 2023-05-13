<?php

/**
 * Ealain\Ealain\Redux_Framework\Options\General class
 *
 * @package ealain
 */

namespace Ealain\Ealain\Redux_Framework\Options;

use Redux;
use Ealain\Ealain\Redux_Framework\Component;

class Header extends Component
{

	public function __construct()
	{
		$this->set_widget_option();
	}

	protected function set_widget_option()
	{
		Redux::set_section($this->opt_name, array(
			'title' => esc_html__('Header', 'ealain'),
			'id' => 'header',
			'icon' => 'el el-arrow-up',
			'customizer_width' => '500px',
		));

		Redux::set_section($this->opt_name, array(
			'title' => esc_html__('Header Layout', 'ealain'),
			'id' => 'header_variation',
			'subsection' => true,
			'desc' => esc_html__('This section contains options for Menu .', 'ealain'),
			'fields' => array(

				array(
					'id' => 'header_layout',
					'type' => 'button_set',
					'title' => esc_html__('Header Layout', 'ealain'),
					'options' => array(
						'default' => esc_html__('Default', 'ealain'),
						'custom' => esc_html__('Custom', 'ealain'),
					),
					'default' => 'default'
				),

				array(
					'id'        	=> 'menu_style',
					'type'      	=> 'select',
					'title' 		=> esc_html__('Header Layout', 'ealain'),
					'subtitle' 		=> esc_html__('Select the layout variation that you want to use for header layout.', 'ealain'),
					'options'		=> (function_exists('iqonic_addons_get_list_layouts')) ? iqonic_addons_get_list_layouts(false, 'header') : '',
					'desc'			=> (function_exists('iqonic_addons_get_list_layouts')) ? esc_html__("Create", 'ealain') . " <a target='_blank' href='" . admin_url('edit.php?post_type=iqonic_hf_layout') . "'>" . esc_html__("New Layout", 'ealain') . "</a>" : "",
					'required' 		=> array('header_layout', '=', 'custom'),
				),

				array(
					'id' => 'header_layout_position',
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
					'id'        =>  'vertical_header_width',
					'type'      =>  'dimensions',
					'units'     =>  array('em', 'px', '%'),
					'height'    =>  false,
					'width'     =>  true,
					'desc'     =>  esc_html__('Vertical header width', 'ealain'),
					'default'   =>  array(
						'width'   => '300px',
					),
					'required' 	=> array('header_layout_position', '=', 'vertical'),
				),

				array(
					'id' => 'header_container',
					'type' => 'button_set',
					'title' => esc_html__('Header container', 'ealain'),
					'options' => array(
						'container-fluid' 	=> esc_html__('Full width', 'ealain'),
						'container' 		=> esc_html__('Container', 'ealain'),
					),
					'required' 	=> array('header_layout', '=', 'default'),
					'default' => 'container-fluid'
				),

				array(
					'id' => 'header_postion',
					'type' => 'button_set',
					'title' => esc_html__('Header Position', 'ealain'),
					'options' => array(
						'static' => esc_html__('Default', 'ealain'),
						'over' => esc_html__('Over', 'ealain'),
					),
					'default' => 'static',
				),

				// --------main header background options start----------//

				array(
					'id'	 	=> 'ealain_header_background_type',
					'type' 		=> 'button_set',
					'title' 	=> esc_html__('Background', 'ealain'),
					'subtitle' 	=> esc_html__('Select the variation for header background', 'ealain'),
					'options' 	=> array(
						'default' 		=> esc_html__('Default', 'ealain'),
						'color' 		=> esc_html__('Color', 'ealain'),
						'image' 		=> esc_html__('Image', 'ealain'),
						'transparent' 	=> esc_html__('Transparent', 'ealain')
					),
					'required' 	=> array('header_layout', '=', 'default'),
					'default' 	=> esc_html__('default', 'ealain')
				),

				array(
					'id' 		=> 'ealain_header_background_color',
					'type' 		=> 'color',
					'desc' 		=> esc_html__('Set Background Color', 'ealain'),
					'required' 	=> array('ealain_header_background_type', '=', 'color'),
					'mode' 		=> 'background',
					'transparent' => false
				),

				array(
					'id' 		=> 'ealain_header_background_image',
					'type' 		=> 'media',
					'url' 		=> false,
					'desc' 		=> esc_html__('Upload Image', 'ealain'),
					'required' 	=> array('ealain_header_background_type', '=', 'image'),
					'read-only' => false,
					'subtitle' 	=> esc_html__('Upload background image for header.', 'ealain'),
				),

				// --------main header Background options end----------//

			)
		));

		//-----Sticky Header Options Start---//
		Redux::set_section($this->opt_name, array(
			'title' => esc_html__('Sticky Header', 'ealain'),
			'id' => 'ealain_sticky-header-variation',
			'subsection' => true,
			'desc' => esc_html__('This section contains options for sticky header menu and background color.', 'ealain'),
			'fields' => array(

				array(
					'id'    => 'info_custom_header_sitcky_options',
					'type'  => 'info',
					'required' 	=> array('header_layout', '=', 'custom'),
					'title' => esc_html__('Note:', 'ealain'),
					'style' => 'warning',
					'desc'  => esc_html__('This options only works with Default Header Layout', 'ealain')
				),

				array(
					'id' => 'display_sticky_header',
					'type' => 'button_set',
					'title' => esc_html__('Sticky Header', 'ealain'),
					'subtitle' => esc_html__('Enable to make header sticky.', 'ealain'),
					'options' => array(
						'yes' => esc_html__('Enable', 'ealain'),
						'no' => esc_html__('Disable', 'ealain')
					),
					'required' 	=> array('header_layout', '=', 'default'),
					'default' => esc_html__('yes', 'ealain')
				),
				// --------sticky header background options start----------//
				array(
					'id' => 'sticky_header_bg',
					'type' => 'button_set',
					'required' => array('display_sticky_header', '=', 'yes'),
					'title' => esc_html__('Background', 'ealain'),
					'subtitle' => esc_html__('Select the variation for sticky header background', 'ealain'),
					'options' => array(
						'default' => esc_html__('Default', 'ealain'),
						'color' => esc_html__('Color', 'ealain'),
						'image' => esc_html__('Image', 'ealain'),
						'transparent' => esc_html__('Transparent', 'ealain')
					),
					'default' => esc_html__('default', 'ealain')
				),

				array(
					'id' => 'sticky_header_bg_color',
					'type' => 'color',
					'desc' => esc_html__('Set Background Color', 'ealain'),
					'required' => array('sticky_header_bg', '=', 'color'),
					'mode' => 'background',
					'transparent' => false
				),

				array(
					'id' => 'sticky_header_bg_img',
					'type' => 'media',
					'url' => false,
					'desc' => esc_html__('Upload Image', 'ealain'),
					'required' => array('sticky_header_bg', '=', 'image'),
					'read-only' => false,
					'subtitle' => esc_html__('Upload background image for sticky header.', 'ealain'),
				),
				// --------sticky header Background options end----------//
				// --------sticky header Menu options start----------//

				array(
					'id'        => 'sticky_menu_color_type',
					'type'      => 'button_set',
					'required'  => array('display_sticky_header', '=', 'yes'),
					'title'     => esc_html__('Menu Color Options', 'ealain'),
					'subtitle' => esc_html__('Select Menu color for sticky.', 'ealain'),
					'options'   => array(
						'default' => esc_html__('Default', 'ealain'),
						'custom' => esc_html__('Custom', 'ealain'),
					),
					'default'   => esc_html__('default', 'ealain')
				),
				array(
					'id'            => 'sticky_menu_color',
					'type'          => 'color',
					'required'  => array('sticky_menu_color_type', '=', 'custom'),
					'desc'     => esc_html__('Menu color', 'ealain'),
					'mode'          => 'background',
					'transparent'   => false
				),

				array(
					'id'            => 'sticky_menu_hover_color',
					'type'          => 'color',
					'required'  => array('sticky_menu_color_type', '=', 'custom'),
					'desc'     => esc_html__('Menu hover color', 'ealain'),
					'mode'          => 'background',
					'transparent'   => false
				),

				//----sticky sub menu options start---//
				array(
					'id'        => 'sticky_header_submenu_color_type',
					'type'      => 'button_set',
					'title'     => esc_html__('Submenu Color Options', 'ealain'),
					'subtitle' => esc_html__('Select submenu color for sticky.', 'ealain'),
					'required'  => array('display_sticky_header', '=', 'yes'),
					'options'   => array(
						'default' => esc_html__('Default', 'ealain'),
						'custom' => esc_html__('Custom', 'ealain'),
					),
					'default'   => esc_html__('default', 'ealain')
				),

				array(
					'id'            => 'sticky_ealain_header_submenu_color',
					'type'          => 'color',
					'desc'     => esc_html__('Submenu Color', 'ealain'),
					'required'  => array('sticky_header_submenu_color_type', '=', 'custom'),
					'mode'          => 'background',
					'transparent'   => false
				),


				array(
					'id'            => 'sticky_ealain_header_submenu_hover_color',
					'type'          => 'color',
					'desc'     => esc_html__('Submenu Hover Color', 'ealain'),
					'required'  => array('sticky_header_submenu_color_type', '=', 'custom'),
					'mode'          => 'background',
					'transparent'   => false
				),

				array(
					'id'            => 'sticky_ealain_header_submenu_background_color',
					'type'          => 'color',
					'desc'     => esc_html__('Submenu Background Color', 'ealain'),
					'required'  => array('sticky_header_submenu_color_type', '=', 'custom'),
					'mode'          => 'background',
					'transparent'   => false
				),

				array(
					'id'            => 'sticky_header_submenu_background_hover_color',
					'type'          => 'color',
					'desc'     => esc_html__('Submenu Background Hover Color', 'ealain'),
					'required'  => array('sticky_header_submenu_color_type', '=', 'custom'),
					'mode'          => 'background',
					'transparent'   => false
				),
				// --------sticky header Menu options start----------//
			)
		));
	}
}
