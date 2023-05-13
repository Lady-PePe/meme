<?php

/**
 * Ealain\Ealain\Redux_Framework\Options\Color class
 *
 * @package ealain
 */

namespace Ealain\Ealain\Redux_Framework\Options;

use Redux;
use Ealain\Ealain\Redux_Framework\Component;

class Color extends Component
{

	public function __construct()
	{
		$this->set_widget_option();
	}

	protected function set_widget_option()
	{
		Redux::set_section($this->opt_name, array(
			'title' => esc_html__('Color Attributes', 'ealain'),
			'id'    => 'color',
			'icon'  => 'el el-brush',
			'desc'  => esc_html__('Change default colors of the site.', 'ealain'),
			'fields' => array(
				array(
					'id'      => 'custom_color_switch',
					'type'    => 'button_set',
					'title'   => esc_html__('Set custom colors', 'ealain'),
					'options' => array(
						'yes' 	=> 'Yes',
						'no' 	=> 'No',
					),
					'default' => 'no'
				),

				array(
					'id'            => 'primary_color',
					'type'          => 'color',
					'title'         => esc_html__('Primary color', 'ealain'),
					'desc'      	=> esc_html__('Select primary accent color.', 'ealain'),
					'mode'          => 'background',
					'transparent'   => false,
					'required'      => array('custom_color_switch', '=', 'yes')
				),

				array(
					'id'            => 'secondary_color',
					'type'          => 'color',
					'title'         => esc_html__('Secondary color', 'ealain'),
					'desc'      	=> esc_html__('Select secondary complementing color.', 'ealain'),
					'mode'          => 'background',
					'transparent'   => false,
					'required'      => array('custom_color_switch', '=', 'yes')
				),

				array(
					'id'            => 'title_color',
					'type'          => 'color',
					'title'         => esc_html__('Title Color', 'ealain'),
					'desc'      => esc_html__('Select default Title(Headings) color', 'ealain'),
					'mode'          => 'background',
					'transparent'   => false,
					'required'      => array('custom_color_switch', '=', 'yes')
				),


				array(
					'id'            => 'text_color',
					'type'          => 'color',
					'title'         => esc_html__('Body text color', 'ealain'),
					'desc'      	=> esc_html__('Select default body text color', 'ealain'),
					'mode'          => 'background',
					'transparent'   => false,
					'required'      => array('custom_color_switch', '=', 'yes')
				)

			)
		));
	}
}
