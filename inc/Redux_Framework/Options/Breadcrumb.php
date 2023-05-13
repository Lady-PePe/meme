<?php

/**
 * Ealain\Ealain\Redux_Framework\Options\breadcrumb class
 *
 * @package ealain
 */

namespace Ealain\Ealain\Redux_Framework\Options;

use Redux;
use Ealain\Ealain\Redux_Framework\Component;

class Breadcrumb extends Component
{

    public function __construct()
    {
        $this->set_widget_option();
    }

    protected function set_widget_option()
    {
        Redux::set_section($this->opt_name, array(
            'title' => esc_html__('Breadcrumb Settings', 'ealain'),
            'id'    => 'breadcrumb',
            'icon'  => 'el el-cog',
            'desc'  => esc_html__('This section contains options for Page Breadcrumb.', 'ealain'),
            'fields' => array(

                array(
                    'id' => 'display_breadcrumb',
                    'type' => 'button_set',
                    'title' => esc_html__('Display breadcrumb', 'ealain'),
                    'options' => array(
                        'yes' => esc_html__('Yes', 'ealain'),
                        'no' => esc_html__('No', 'ealain')
                    ),
                    'default' => esc_html__('yes', 'ealain')
                ),

                array(
                    'id'        => 'page_default_breadcrumb_image',
                    'type'      => 'media',
                    'url'       => true,
                    'title'     => esc_html__('Default breadcrumb Image', 'ealain'),
                    'read-only' => false,
                    'subtitle'  => esc_html__('Upload default breadcrumb image for your Website.', 'ealain'),
                    'desc'      => esc_html__("This breadcrumb image displays only with style - 2, 3.", "ealain"),
                    'required'  => array('display_breadcrumb', '=', 'yes'),
                ),

                array(
                    'id'        => 'breadcrumb_style',
                    'type'      => 'image_select',
                    'title'     => esc_html__('Select breadcrumb Style', 'ealain'),
                    'subtitle'  => esc_html__('Select the style that best fits your needs.', 'ealain'),
                    'options'   => array(
                        '1'      => array(
                            'alt' => esc_attr__('Style1', 'ealain'),
                            'img' => get_template_directory_uri() . '/assets/images/redux/bg-1.jpg',
                        ),
                        '2'      => array(
                            'alt' => esc_attr__('Style2', 'ealain'),
                            'img' => get_template_directory_uri() . '/assets/images/redux/bg-2.jpg',
                        ),
                        '3'      => array(
                            'alt' => esc_attr__('Style3', 'ealain'),
                            'img' => get_template_directory_uri() . '/assets/images/redux/bg-3.jpg',
                        ),
                        '4'      => array(
                            'alt' => esc_attr__('Style4', 'ealain'),
                            'img' => get_template_directory_uri() . '/assets/images/redux/bg-4.jpg',
                        ),
                        '5'      => array(
                            'alt' => esc_attr__('Style5', 'ealain'),
                            'img' => get_template_directory_uri() . '/assets/images/redux/bg-5.jpg',
                        ),
                    ),
                    'default'   => '1',
                    'required'  => array('display_breadcrumb', '=', 'yes'),
                ),

                array(
                    'id' => 'display_breadcrumb_title',
                    'type' => 'button_set',
                    'title' => esc_html__('Display title on breadcrumb', 'ealain'),
                    'options' => array(
                        'yes' => esc_html__('Yes', 'ealain'),
                        'no' => esc_html__('No', 'ealain')
                    ),
                    'required' => array('display_breadcrumb', '=', 'yes'),
                    'default' => esc_html__('yes', 'ealain')
                ),


                array(
                    'id' => 'breadcrumb_title_tag',
                    'type' => 'select',
                    'desc' => esc_html__('Select title tag', 'ealain'),
                    'options' => array(
                        'h1' => 'h1',
                        'h2' => 'h2',
                        'h3' => 'h3',
                        'h5' => 'h4',
                        'h5' => 'h5',
                        'h6' => 'h6'
                    ),
                    'required' => array('display_breadcrumb_title', '=', 'yes'),
                    'default' => 'h2'
                ),

                array(
                    'id' => 'breadcrumb_title_color',
                    'type' => 'color',
                    'desc' => esc_html__('Set title color', 'ealain'),
                    'default'       => '',
                    'mode' => 'background',
                    'required' => array('display_breadcrumb_title', '=', 'yes'),
                    'transparent' => false
                ),

                array(
                    'id' => 'display_breadcrumb_nav',
                    'type' => 'button_set',
                    'title' => esc_html__('Display navigation on breadcrumb', 'ealain'),
                    'options' => array(
                        'yes' => esc_html__('Yes', 'ealain'),
                        'no' => esc_html__('No', 'ealain')
                    ),
                    'required' => array('display_breadcrumb', '=', 'yes'),
                    'default' => esc_html__('yes', 'ealain')
                ),

                array(
                    'id'       => 'breadcrumb_back_type',
                    'type'     => 'button_set',
                    'title'    => esc_html__('breadcrumb Background', 'ealain'),
                    'options'  => array(
                        '1' => 'Color',
                        '2' => 'Image'
                    ),
                    'required' => array('display_breadcrumb', '=', 'yes'),
                    'default'  => '1'
                ),

                array(
                    'id'            => 'breadcrumb_back_color',
                    'type'          => 'color',
                    'desc'         => esc_html__('Set breadcrumb background color', 'ealain'),
                    'required'  => array('breadcrumb_back_type', '=', '1'),
                    'mode'          => 'background',
                    'transparent'   => false
                ),

                array(
                    'id'       => 'breadcrumb_back_image',
                    'type'     => 'media',
                    'url'      => false,
                    'desc'    => esc_html__('Set breadcrumb background image', 'ealain'),
                    'read-only' => false,
                    'required'  => array('breadcrumb_back_type', '=', '2'),
                    'default'  => array('url' => get_template_directory_uri() . '/assets/images/redux/banner.webp'),
                ),
            )
        ));
    }
}
