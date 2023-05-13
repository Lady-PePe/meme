<?php
/**
 * Ealain\Ealain\Redux_Framework\Options\Page class
 *
 * @package ealain
 */

namespace Ealain\Ealain\Redux_Framework\Options;
use Redux;
use Ealain\Ealain\Redux_Framework\Component;

class Page extends Component {

	public function __construct() {
		$this->set_widget_option();
	}

	protected function set_widget_option() {
		Redux::set_section( $this->opt_name, array(
			'title' => esc_html__('Page Settings','ealain'),
			'id'    => 'page',
			'icon'  => 'el el-file-edit',
			'fields'=> array(

				array(
					'id'        => 'search_page',
					'type'      => 'image_select',
					'title'     => esc_html__( 'Search page Setting','ealain' ),
					'subtitle'  => esc_html__('Choose among these structures (Right Sidebar, Left Sidebar and 1column) for your Search page.<br />To filling these column sections you should go to appearance > widget. And put every widget that you want in these sections.','ealain' ),
					'options'   => array(
						'1' => array( 'title' => esc_html__( 'Full Width','ealain' ), 'img' => get_template_directory_uri() . '/assets/images/redux/single-column.jpg' ),
						'4' => array( 'title' => esc_html__( 'Right Sidebar','ealain' ), 'img' => get_template_directory_uri() . '/assets/images/redux/right-side.jpg' ),
						'5' => array( 'title' => esc_html__( 'Left Sidebar','ealain' ), 'img' => get_template_directory_uri() . '/assets/images/redux/left-side.jpg' ),
					),
					'default'   => '1',
				),
			)
		));
	}
}
