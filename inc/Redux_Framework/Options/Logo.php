<?php
/**
 * Ealain\Ealain\Redux_Framework\Options\Logo class
 *
 * @package ealain
 */

namespace Ealain\Ealain\Redux_Framework\Options;
use Redux;
use Ealain\Ealain\Redux_Framework\Component;

class Logo extends Component {

	public function __construct() {
		$this->set_widget_option();
	}

	protected function set_widget_option() {
		Redux::set_section($this->opt_name, array(
			'title' => esc_html__('Logo', 'ealain'),
			'id'    => 'header-logo',
			'icon'  => 'el el-flag',
			'fields' => array(

				array(
					'id'    => 'info_custom_header_logo_options',
					'type'  => 'info',
					'required' 	=> array('header_layout', '=', 'custom'),
					'title' => esc_html__('Note:', 'ealain'),
					'style' => 'warning',
					'desc'  => esc_html__('This options only works with Default Header Layout', 'ealain')
				),

				array(
					'id'       => 'header_radio',
					'type'     => 'button_set',
					'title'    => esc_html__('Select Logo Type', 'ealain'),
					'subtitle' => esc_html__('Select either Text or image for your Logo.', 'ealain'),
					'options'  => array(
						'1' => ' Logo as Text',
						'2' => ' Logo as Image',
					),
					'required' 	=> array('header_layout', '=', 'default'),
					'default'  => '2'
				),

				array(
					'id'       => 'header_text',
					'type'     => 'text',
					'desc'     => esc_html__('Enter the text to be used instead of the logo image', 'ealain'),
					'required' => array('header_radio', '=', '1'),
					'msg'      => esc_html__('Please enter correct value', 'ealain'),
					'default'  => esc_html__('Ealain', 'ealain'),
				),

				array(
					'id'            => 'header_color',
					'type'          => 'color',
					'desc'      => esc_html__('Choose text color', 'ealain'),
					'required'      => array('header_radio', '=', '1'),
					'default'       => '',
					'mode'          => 'background',
					'transparent'   => false
				),
				array(
					'id' => 'ealain_header_logo_section',
					'type' => 'section',
					'title' =>  esc_html__('Logo', 'ealain'),
					'indent' => true,
					'required'  => array('header_radio', '=', '2'),
				),

				array(
					'id'       => 'ealain_logo',
					'type'     => 'media',
					'url'      => false,
					'title'    => esc_html__('Logo', 'ealain'),
					'required'  => array('header_radio', '=', '2'),
					'read-only' => false,
					'default'  => array('url' => get_template_directory_uri() . '/assets/images/logo.svg'),
					'subtitle' => esc_html__('Upload Logo image for your Website. Otherwise site title will be displayed in place of Logo.', 'ealain'),
				),

				array(
					'id'             => 'logo-dimensions',
					'type'           => 'dimensions',
					'units'          => array('em', 'px', '%'),    // You can specify a unit value. Possible: px, em, %
					'units_extended' => 'true',  // Allow users to select any type of unit
					'title'          => esc_html__('Logo (Width/Height) Option', 'ealain'),
					'subtitle'       => esc_html__('Allows you to choose width, height, and/or unit.', 'ealain'),
					'desc'           => esc_html__('You can enable or disable any piece of this field. Width, Height, or Units.', 'ealain'),

				),

				array(
					'id' => 'ealain_header_mobile_logo_section',
					'type' => 'section',
					'title' =>  esc_html__('Mobile Logo', 'ealain'),
					'indent' => true,
					'required'  => array('header_radio', '=', '2'),
				),

				array(
					'id'       => 'ealain_mobile_logo',
					'type'     => 'media',
					'url'      => false,
					'title'    => esc_html__('Mobile Logo', 'ealain'),
					'required'  => array('header_radio', '=', '2'),
					'read-only' => false,
					'default'  => array('url' => get_template_directory_uri() . '/assets/images/logo-white.svg'),
					'subtitle' => esc_html__('Upload Logo image for your Website. Otherwise site title will be displayed in place of Logo.', 'ealain'),
				),

				array(
					'id'             => 'mobile-logo-dimensions',
					'type'           => 'dimensions',
					'units'          => array('em', 'px', '%'),    // You can specify a unit value. Possible: px, em, %
					'units_extended' => 'true',  // Allow users to select any type of unit
					'title'          => esc_html__('Mobile Logo (Width/Height) Option', 'ealain'),
					'required'  => array('header_radio', '=', '2'),
					'subtitle'       => esc_html__('Allows you to choose width, height, and/or unit.', 'ealain'),
					'desc'           => esc_html__('You can enable or disable any piece of this field. Width, Height, or Units.', 'ealain'),

				),

			)
		));
	}
}
