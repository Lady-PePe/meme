<?php

/**
 * Ealain\Ealain\Redux_Framework\Options\FourZeroFour class
 *
 * @package ealain
 */

namespace Ealain\Ealain\Redux_Framework\Options;

use Redux;
use Ealain\Ealain\Redux_Framework\Component;

class FourZeroFour extends Component
{

	public function __construct()
	{
		$this->set_widget_option();
	}

	protected function set_widget_option()
	{
		Redux::set_section($this->opt_name, array(
			'title' => esc_html__('404', 'ealain'),
			'id'    => 'fourzerofour',
			'icon'  => 'el-icon-error',
			'desc'  => esc_html__('This section contains options for 404.', 'ealain'),
			'fields' => array(

				array(
					'id' 		=> 'four_zero_four_layout',
					'type' 		=> 'button_set',
					'title' 	=> esc_html__('Page Layout', 'ealain'),
					'options' 	=> array(
						'default' 	=> esc_html__('Default', 'ealain'),
						'custom' 	=> esc_html__('Custom', 'ealain'),
					),
					'default'	=> 'default'
				),

				array(
					'id'        => '404_layout',
					'type'      => 'select',
					'title' 	=> esc_html__('404 Layout', 'ealain'),
					'subtitle' 	=> esc_html__('Select the layout variation that you want to use for 404 page.', 'ealain'),
					'options'	=> (function_exists('iqonic_addons_get_list_layouts')) ? iqonic_addons_get_list_layouts(false, 'four_zero_four') : '',
					'description'	=> (function_exists('iqonic_addons_get_list_layouts')) ? esc_html__("Create", 'ealain') . " <a target='_blank' href='" . admin_url('edit.php?post_type=iqonic_hf_layout') . "'>" . esc_html__("New Layout", 'ealain') . "</a>" : "",
					'required' 	=> array('four_zero_four_layout', '=', 'custom'),
				),

				array(
					'id'       	=> '404_banner_image',
					'type'     	=> 'media',
					'url'      	=> true,
					'title'    	=> esc_html__('Image', 'ealain'),
					'read-only' => false,
					'default'  	=> array('url' => get_template_directory_uri() . '/assets/images/redux/404.png'),
					'subtitle' 	=> esc_html__('Upload 404 image for your Website.', 'ealain'),
					'required' 	=> array('four_zero_four_layout', '=', 'default'),
				),

				array(
					'id'        => '404_title',
					'type'      => 'text',
					'title'     => esc_html__('Title', 'ealain'),
					'default'   => esc_html__('Oops! This Page is Not Found.', 'ealain'),
					'required' 	=> array('four_zero_four_layout', '=', 'default'),
				),

				array(
					'id'        => '404_description',
					'type'      => 'textarea',
					'title'     => esc_html__('Description', 'ealain'),
					'default'   => esc_html__('The requested page does not exist.', 'ealain'),
					'required' 	=> array('four_zero_four_layout', '=', 'default'),
				),

				array(
					'id'        => '404_backtohome_title',
					'type'      => 'text',
					'title'     => esc_html__('Button', 'ealain'),
					'default'   => esc_html__('Back to Home', 'ealain'),
					'required' 	=> array('four_zero_four_layout', '=', 'default'),
				),
				array(
					'id'       	=> 'header_on_404',
					'type'     	=> 'switch',
					'on'		=> esc_html__('Enable', 'ealain'),
					'off'		=> esc_html__('Disable', 'ealain'),
					'title'    	=> esc_html__('Header', 'ealain'),
					'subtitle' 	=> esc_html__('Enable / disable header on 404 page', 'ealain'),
					'default'  	=> true,
				),

				array(
					'id'       	=> 'footer_on_404',
					'type'     	=> 'switch',
					'on'		=> esc_html__('Enable', 'ealain'),
					'off'		=> esc_html__('Disable', 'ealain'),
					'title'    	=> esc_html__('Footer', 'ealain'),
					'subtitle' 	=> esc_html__('Enable / disable footer on 404 page', 'ealain'),
					'default'  	=> true,
				)
			)
		));
	}
}
