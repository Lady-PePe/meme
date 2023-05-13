<?php

/**
 * Ealain\Ealain\Redux_Framework\Options\General class
 *
 * @package ealain
 */

namespace Ealain\Ealain\Redux_Framework\Options;

use Redux;
use Ealain\Ealain\Redux_Framework\Component;

class General extends Component
{

	public function __construct()
	{
		$this->set_widget_option();
	}

	protected function set_widget_option()
	{
		Redux::set_section($this->opt_name, array(
			'title' => esc_html__('General', 'ealain'),
			'id' => 'general',
			'icon' => 'el el-dashboard',
			'customizer_width' => '500px',
		));

		Redux::set_section($this->opt_name, array(
			'title' => esc_html__('Body Layout', 'ealain'),
			'id' => 'body_layout',
			'icon' => 'el el-website',
			'subsection' => true,
			'fields' => array(

				array(
					'id'        =>  'grid_container',
					'type'      =>  'dimensions',
					'units'     =>  array('em', 'px', '%'),
					'height'    =>  false,
					'width'     =>  true,
					'title'     =>  esc_html__('Container Width', 'ealain'),
					'desc'      =>  esc_html__('Adjust Your Site Container Width With Help Of Above Option.', 'ealain'),
					'default'   =>  array(
						'width'   => '1400px',
					),
				),

				array(
					'id' => 'body_back_option',
					'type' => 'button_set',
					'title' => esc_html__('Body Background', 'ealain'),
					'desc' => esc_html__('Select this option for body background.', 'ealain'),
					'options' => array(
						'1' => 'Color',
						'2' => 'Default',
						'3' => 'Image'
					),
					'default' => '2'
				),

				array(
					'id' => 'body_color',
					'type' => 'color',
					'desc' => esc_html__('Choose body background color', 'ealain'),
					'required' => array('body_back_option', '=', '1'),
					'default' => '',
					'mode' => 'background',
					'transparent' => false
				),

				array(
					'id' => 'body_image',
					'type' => 'media',
					'url' => false,
					'read-only' => false,
					'required' => array('body_back_option', '=', '3'),
					'desc' => esc_html__('Choose body background image.', 'ealain'),
				),

				array(
					'id' => 'is_page_spacing',
					'type' => 'button_set',
					'title' => esc_html__('Page Spacing', 'ealain'),
					'desc'  =>  esc_html__('Adjust top / bottom spacing of your site pages.', 'ealain'),
					'options' => array(
						'default' => 'Default',
						'custom' => 'Custom',
					),
					'default' => 'default'
				),

				// page top spacing
				array(
					'id' => 'page_spacing',
					'type' => 'spacing',
					'mode' => 'absolute',
					'units' => array('em', 'px', '%'),
					'all' => false,
					'top' => true,
					'right' => false,
					'bottom' => true,
					'left' => false,
					'default' => array(
						'top' => '11',
						'bottom' => '11',
						'units' => 'em'
					),
					'desc'     =>  esc_html__('Top / Bottom spacing.', 'ealain'),
					'required' 	=> array('is_page_spacing', '=', 'custom'),
				),
				array(
					'id' => 'tablet_page_spacing',
					'type' => 'spacing',
					'mode' => 'absolute',
					'units' => array('em', 'px', '%'),
					'all' => false,
					'top' => true,
					'right' => false,
					'bottom' => true,
					'left' => false,
					'default' => array(
						'top' => '5',
						'bottom' => '5',
						'units' => 'em'
					),
					'desc'     =>  esc_html__('Top / Bottom spacing for tablet.', 'ealain'),
					'required' 	=> array('is_page_spacing', '=', 'custom'),
				),
				array(
					'id' => 'mobile_page_spacing',
					'type' => 'spacing',
					'mode' => 'absolute',
					'units' => array('em', 'px', '%'),
					'all' => false,
					'top' => true,
					'right' => false,
					'bottom' => true,
					'left' => false,
					'default' => array(
						'top' => '3.125',
						'bottom' => '3.125',
						'units' => 'em'
					),
					'desc'     =>  esc_html__('Top / Bottom spacing for mobile.', 'ealain'),
					'required' 	=> array('is_page_spacing', '=', 'custom'),
				),
				
				/* back to top */
				
				array(
					'id' => 'back_to_top_btn',
					'type' => 'button_set',
					'title' => esc_html__('Display back to top button', 'ealain'),
					'options' => array(
						'yes' => esc_html__('Yes', 'ealain'),
						'no' => esc_html__('No', 'ealain')
					),
					'default' => esc_html__('yes', 'ealain')
				),

				array(
					'id'       => 'php_back_to_top',
					'type'     => 'media',
					'url'      => false,
					'title'    => esc_html__('Back to Top Image', 'ealain'),
					'required'  => array('back_to_top_btn', '=', 'yes'),
					'read-only' => false,
					'default'  => array('url' => get_template_directory_uri() . '/assets/images/redux/back-to-top.webp'),
					'subtitle' => esc_html__('Upload Logo image for your Website. Otherwise site title will be displayed in place of Logo.', 'ealain'),
				),
				
				array(
					'id'       => 'php_back_to_top_text',
					'type'     => 'text',
					'title'    => esc_html__('Back to Top Text', 'ealain'),
					'default'  => 'Back to Top' 
				),

				/* magic cursor */
				
				array(
					'id' => 'magic_cursor_btn',
					'type' => 'button_set',
					'title' => esc_html__('show Magic Cursor?', 'ealain'),
					'options' => array(
						'yes' => esc_html__('Yes', 'ealain'),
						'no' => esc_html__('No', 'ealain')
					),
					'default' => esc_html__('no', 'ealain')
				),

			)
		));


	}
}
