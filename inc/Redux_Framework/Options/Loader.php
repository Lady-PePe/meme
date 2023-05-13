<?php
/**
 * Ealain\Ealain\Redux_Framework\Options\Loader class
 *
 * @package ealain
 */

namespace Ealain\Ealain\Redux_Framework\Options;
use Redux;
use Ealain\Ealain\Redux_Framework\Component;

class Loader extends Component {

	public function __construct() {
		$this->set_widget_option();
	}

	protected function set_widget_option() {
		Redux::set_section($this->opt_name, array(
			'title' => esc_html__('Loader', 'ealain'),
			'id' => 'loader',
			'icon' => 'el el-refresh',
			'fields' => array(

				array(
					'id' => 'display_loader',
					'type' => 'button_set',
					'title' => esc_html__('ealain Loader', 'ealain'),
					'subtitle' => wp_kses('Turn on to show the icon/images loading animation while your site loads', 'ealain'),
					'options' => array(
						'yes' => esc_html__('Yes', 'ealain'),
						'no' => esc_html__('No', 'ealain')
					),
					'default' => esc_html__('yes', 'ealain')
				),

				array(
					'id' => 'loader_bg_color',
					'type' => 'color',
					'title' => esc_html__('Loader Background Color', 'ealain'),
					'required' => array('display_loader', '=', 'yes'),
					'subtitle' => esc_html__('Choose Loader Background Color', 'ealain'),
					'default' => '#0a0a0a',
					'transparent' => false
				),

				array(
					'id' => 'loader_gif',
					'type' => 'media',
					'url' => true,
					'title' => esc_html__('Add GIF image for loader', 'ealain'),
					'read-only' => false,
					'required' => array('display_loader', '=', 'yes'),
					'default' => array('url' => get_template_directory_uri() . '/assets/images/redux/loader.gif'),
					'subtitle' => esc_html__('Upload Loader GIF image for your Website.', 'ealain'),
				),

				array(
					'id' => 'loader-dimensions',
					'type' => 'dimensions',
					'units' => array('em', 'px', '%'),
					'units_extended' => 'true',
					'required' => array('display_loader', '=', 'yes'),
					'title' => esc_html__('Loader (Width/Height) Option', 'ealain'),
					'subtitle' => esc_html__('Allows you to choose width, height, and/or unit.', 'ealain'),
					'desc' => esc_html__('You can enable or disable any piece of this field. Width, Height, or Units.', 'ealain'),
				),
			)
		));
	}
}
