<?php

/**
 * Ealain\Ealain\Redux_Framework\Options\Footer class
 *
 * @package ealain
 */

namespace Ealain\Ealain\Redux_Framework\Options;

use Redux;
use Ealain\Ealain\Redux_Framework\Component;

class Footer extends Component
{

	public function __construct()
	{
		$this->set_widget_option();
	}

	protected function set_widget_option()
	{
		Redux::set_section($this->opt_name, array(
			'title' => esc_html__('Footer', 'ealain'),
			'id' => 'footer',
			'icon' => 'el el-arrow-down',
			'customizer_width' => '500px',
		));

		Redux::set_section($this->opt_name, array(
			'title' => esc_html__('Footer Layout', 'ealain'),
			'id' => 'footer-logo',
			'subsection' => true,
			'desc' => esc_html__('This section contains options for footer.', 'ealain'),
			'fields' => array(
				array(
					'id' => 'footer_layout',
					'type' => 'button_set',
					'title' => esc_html__('Footer Layout', 'ealain'),
					'options' => array(
						'default' => esc_html__('Default', 'ealain'),
						'custom' => esc_html__('Custom', 'ealain'),
					),
					'default' => 'default'
				),
				array(
					'id'        => 'footer_style',
					'type'      => 'select',
					'title' 	=> esc_html__('Footer Layout', 'ealain'),
					'subtitle' 	=> esc_html__('Select the layout variation that you want to use for Footer.', 'ealain'),
					'options'	=> (function_exists('iqonic_addons_get_list_layouts')) ? iqonic_addons_get_list_layouts(false, 'footer') : '',
					'description'	=> (function_exists('iqonic_addons_get_list_layouts')) ? esc_html__("Create custom footer layout from here - ", 'ealain') . " <a target='_blank' href='" . admin_url('edit.php?post_type=iqonic_hf_layout') . "'>" . esc_html__("New Layout", 'ealain') . "</a>" : "",
					'required' 	=> array('footer_layout', '=', 'custom'),
				),

				array(
					'id'       => 'logo_footer',
					'type'     => 'media',
					'url'      => false,
					'title'    => esc_html__('Footer Logo', 'ealain'),
					'read-only' => false,
					'subtitle' => esc_html__('Upload Footer Logo for your Website.', 'ealain'),
					'default'  => array('url' => get_template_directory_uri() . '/assets/images/logo.svg'),
				),

				array(
					'id' => 'change_footer_background',
					'type' => 'button_set',
					'title' => esc_html__('Change footer color', 'ealain'),
					'subtitle' => esc_html__('Select option for the footer background', 'ealain'),
					'options' => array(
						'default' 	=> esc_html__('Default', 'ealain'),
						'color' 	=> esc_html__('Color', 'ealain'),
						'image' 	=> esc_html__('Image', 'ealain')
					),
					'required' 	=> array('footer_layout', '=', 'default'),
					'default' => 'default'
				),

				array(
					'id' => 'footer_bg_color',
					'type' => 'color',
					'desc' => esc_html__('Choose background color', 'ealain'),
					'required' => array('change_footer_background', '=', 'color'),
					'mode' => 'background',
					'transparent' => false
				),

				array(
					'id' => 'footer_bg_image',
					'type' => 'media',
					'url' => false,
					'desc' => esc_html__('Choose background image', 'ealain'),
					'required' => array('change_footer_background', '=', 'image'),
					'read-only' => false,
					'subtitle' => esc_html__('Upload Footer image for your Website.', 'ealain'),
					'default' => array('url' => get_template_directory_uri() . '/assets/images/redux/footer-img.jpg'),
				),

			)
		));

		Redux::set_section($this->opt_name, array(
			'title' => esc_html__('Footer Option', 'ealain'),
			'id' => 'footer_section',
			'subsection' => true,
			'desc' => esc_html__('This section contains options for footer.', 'ealain'),
			'fields' => array(

				array(
					'id'    => 'info_custom_footer_options',
					'type'  => 'info',
					'required' 	=> array('footer_layout', '=', 'custom'),
					'title' => esc_html__('Note:', 'ealain'),
					'style' => 'warning',
					'desc'  => esc_html__('This options only works with Default Footer Layout', 'ealain')
				),

				array(
					'id' => 'footer_top',
					'type' => 'button_set',
					'title' => esc_html__('Display footer columns', 'ealain'),
					'subtitle' => esc_html__('Display Footer Top On All page', 'ealain'),
					'options' => array(
						'yes' => esc_html__('Yes', 'ealain'),
						'no' => esc_html__('No', 'ealain')
					),
					'required' 	=> array('footer_layout', '=', 'default'),
					'default' => esc_html__('yes', 'ealain')
				),

				array(
					'id' => 'ealain_footer_column_layout',
					'type' => 'image_select',
					'title' => esc_html__('Footer Layout Type', 'ealain'),
					'required' => array('footer_top', '=', 'yes'),
					'subtitle' => wp_kses(__('<br />Choose among these structures (1-column, 2-column, 3-column and 4-column) for your footer section.<br />To fill these column sections you should go to appearance > widget.<br />And add widgets as per your needs.', 'ealain'), array('br' => array())),
					'options' => array(
						'1' => array('title' => esc_html__('Footer Layout 1', 'ealain'), 'img' => get_template_directory_uri() . '/assets/images/redux/footer_first.png'),
						'2' => array('title' => esc_html__('Footer Layout 2', 'ealain'), 'img' => get_template_directory_uri() . '/assets/images/redux/footer_second.png'),
						'3' => array('title' => esc_html__('Footer Layout 3', 'ealain'), 'img' => get_template_directory_uri() . '/assets/images/redux/footer_third.png'),
						'4' => array('title' => esc_html__('Footer Layout 4', 'ealain'), 'img' => get_template_directory_uri() . '/assets/images/redux/footer_four.png'),
					),
					'default' => '3',
				),

				array(
					'id' => 'footer_one',
					'type' => 'select',
					'desc' => esc_html__('Select alignment for footer 1', 'ealain'),
					'required' => array('footer_top', '=', 'yes'),
					'options' => array(
						'1' => 'Left',
						'2' => 'Right',
						'3' => 'Center',
					),
					'default' => '1',
				),

				array(
					'id' => 'footer_two',
					'type' => 'select',
					'desc' => esc_html__('Select alignment for footer 2', 'ealain'),
					'required' => array('footer_top', '=', 'yes'),
					'options' => array(
						'1' => 'Left',
						'2' => 'Right',
						'3' => 'Center'
					),
					'default' => '1',
				),

				array(
					'id' => 'footer_three',
					'type' => 'select',
					'desc' => esc_html__('Select alignment for footer 3', 'ealain'),
					'required' => array('footer_top', '=', 'yes'),
					'options' => array(
						'1' => 'Left',
						'2' => 'Right',
						'3' => 'Center',
					),
					'default' => '1',
				),

				array(
					'id' => 'footer_four',
					'type' => 'select',
					'desc' => esc_html__('Select alignment for footer 4', 'ealain'),
					'required' => array('footer_top', '=', 'yes'),
					'options' => array(
						'1' => 'Left',
						'2' => 'Right',
						'3' => 'Center',
					),
					'default' => '1',
				),
			)
		));

		Redux::set_section($this->opt_name, array(
			'title' => esc_html__('Footer Copyright', 'ealain'),
			'id' => 'footer_copyright',
			'subsection' => true,
			'fields' => array(
				array(
					'id'    => 'info_custom_footer_copyrights',
					'type'  => 'info',
					'required' 	=> array('footer_layout', '=', 'custom'),
					'title' => esc_html__('Note:', 'ealain'),
					'style' => 'warning',
					'desc'  => esc_html__('This options only works with Default Footer Layout', 'ealain')
				),

				array(
					'id' => 'display_copyright',
					'type' => 'button_set',
					'title' => esc_html__('Display Copyrights', 'ealain'),
					'options' => array(
						'yes' => esc_html__('Yes', 'ealain'),
						'no' => esc_html__('No', 'ealain')
					),
					'required' 	=> array('footer_layout', '=', 'default'),
					'default' => esc_html__('yes', 'ealain')
				),
				array(
					'id' => 'footer_copyright_align',
					'type' => 'select',
					'title' => esc_html__('Copyrights text alignment', 'ealain'),
					'required' => array('display_copyright', '=', 'yes'),
					'options' => array(
						'start' => 'Left',
						'end' => 'Right',
						'center' => 'Center',
					),
					'default' => 'center',
				),

				array(
					'id' => 'footer_copyright',
					'type' => 'editor',
					'required' => array('display_copyright', '=', 'yes'),
					'title' => esc_html__('Copyrights Text', 'ealain'),
					'default' => esc_html__('© 2022 Ealain. All Rights Reserved.', 'ealain'),
				),
			)
		));
	}
}
