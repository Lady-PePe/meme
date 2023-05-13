<?php
/**
 * Ealain\Ealain\Jetpack\Component class
 *
 * @package ealain
 */

namespace Ealain\Ealain\Redux_Framework\Options;

use Redux;
use Ealain\Ealain\Redux_Framework\Component;

class AdditionalCode extends Component {

	public function __construct() {
		$this->set_widget_option();
	}

	protected function set_widget_option() {
		Redux::set_section( $this->opt_name, array(
			'title' => esc_html__( 'Additional Code', 'ealain' ),
			'id'    => 'additional-Code',
			'icon'  => 'el el-css',
			'desc'  => esc_html__('This section contains options for header.','ealain'),
			'fields'=> array(

				array(
					'id'       => 'css_code',
					'type'     => 'ace_editor',
					'title'    => esc_html__('CSS Code','ealain'),
					'subtitle' => esc_html__('Paste your css code here.','ealain'),
					'mode'     => 'css',
					'desc'     => esc_html__('Paste your custom CSS code here.','ealain'),
				),

				array(
					'id'       => 'js_code',
					'type'     => 'ace_editor',
					'title'    => esc_html__('JS Code','ealain'),
					'subtitle' => esc_html__('Paste your js code in footer.','ealain'),
					'mode'     => 'javascript',
					'theme'   => 'chrome',
					'desc'     => esc_html__('Paste your custom JS code here.','ealain'),
				),
			)
		));
	}
}
