<?php

/**
 * Ealain\Ealain\Dynamic_Style\Styles\Banner class
 *
 * @package ealain
 */

namespace Ealain\Ealain\Dynamic_Style\Styles;

use Ealain\Ealain\Dynamic_Style\Component;
use function add_action;

class Breadcrumb extends Component
{

    public function __construct()
    {
        add_action('wp_enqueue_scripts', array($this, 'ealain_breadcrumb_dynamic_style'), 20);
        add_action('wp_enqueue_scripts', array($this, 'ealain_featured_hide'), 20);
    }
   
    public function is_ealain_breadcrumb()
    {
        $is_bredcrumb = true;
        $page_id = get_queried_object_id();
        global $ealain_options;
        $breadcrumb_page_option = get_post_meta($page_id, 'display_breadcrumb', true);
        $breadcrumb_page_option = (!empty($breadcrumb_page_option)) ? $breadcrumb_page_option : "default";

        if ($breadcrumb_page_option != "default") {
            $is_bredcrumb = ($breadcrumb_page_option == 'no') ? false : true;
        } elseif (isset($ealain_options['display_breadcrumb']) && $ealain_options['display_breadcrumb'] == "no") {
            $is_bredcrumb = false;
        }

        return $is_bredcrumb;
    }
    public function ealain_breadcrumb_dynamic_style()
    {
        if (!$this->is_ealain_breadcrumb()) {
            return;
        }
        $dynamic_css = '';
        global $ealain_options ;

        if (isset($ealain_options['display_breadcrumb_title'])) {
            if ($ealain_options['display_breadcrumb_title'] == 'yes') {
                $dynamic = $ealain_options['breadcrumb_title_color'];
                $dynamic_css .= !empty($dynamic) ? '.ealain-breadcrumb .title { color: ' . $dynamic . ' !important; }' : '';
            }
        }
        if (isset($ealain_options['breadcrumb_back_type'])) {
            if ($ealain_options['breadcrumb_back_type'] == '1') {
                if (isset($ealain_options['breadcrumb_back_color']) && !empty($ealain_options['breadcrumb_back_color'])) {
                    $dynamic = $ealain_options['breadcrumb_back_color'];
                    $dynamic_css .= !empty($dynamic) ? '.ealain-breadcrumb { background: ' . $dynamic . ' !important; }' : '';
                }
            }
        }
        if (isset($ealain_options['breadcrumb_back_image']['url'])) {
            $dynamic = $ealain_options['breadcrumb_back_image']['url'];
            $dynamic_css .= !empty($dynamic) ? '.ealain-breadcrumb { background-image: url(' . $dynamic . ') !important; }' : '';
        }
        if (!empty($dynamic_css)) {
            wp_add_inline_style('ealain-global', $dynamic_css);
        }
    }

    /* hide featured image for post formate */
    public function ealain_featured_hide()
    {
        /*
        * Get Post Formate and set featured image display none
        */
        $ealain_options = get_option('ealain-options');
        $featured_hide = '';
        $post_format = "";

        if (isset($ealain_options['posts_select'])) {

            $posts_format = $ealain_options['posts_select'];

            $post_format = get_post_format();

            if (in_array(get_post_format(), $posts_format)) {
                $featured_hide .= '
                .ealain-blog-main-list .post_format-post-format-' . $post_format . ' .ealain-blog-box .ealain-blog-image img { 
                    display: none !important; 
                }';
            }
            wp_add_inline_style('ealain-global', $featured_hide);
        }
    }
    
}
