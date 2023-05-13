<?php

/**
 * Ealain\Ealain\Dynamic_Style\Styles\Logo class
 *
 * @package ealain
 */

namespace Ealain\Ealain\Dynamic_Style\Styles;

use Ealain\Ealain\Dynamic_Style\Component;
use function add_action;

class Logo extends Component
{

    public function __construct()
    {
        add_action('wp_enqueue_scripts', array($this, 'ealain_logo_options'), 20);
    }

    public function ealain_logo_options()
    {
        global $ealain_options ;
        $logo_var = "";
        
        if ($ealain_options['header_radio'] == 1) {
            if (!empty($ealain_options['header_color'])) {
                $logo = $ealain_options['header_color'];
                $logo_var = ".navbar-light .navbar-brand {
                    color : $logo !important;
                }";
            }
        }

        if (!empty($ealain_options["logo-dimensions"]["width"]) && $ealain_options["logo-dimensions"]["width"] != "px") {
            $logo_width = $ealain_options["logo-dimensions"]["width"];
            $logo_var .= 'header.header-default a.navbar-brand img, .vertical-navbar-brand img { width: ' . $logo_width . ' !important; }';
        }

        if (!empty($ealain_options["logo-dimensions"]["height"]) && $ealain_options["logo-dimensions"]["height"] != "px") {
            $logo_height = $ealain_options["logo-dimensions"]["height"];
            $logo_var .= 'header.header-default a.navbar-brand img, .vertical-navbar-brand img { height: ' . $logo_height . ' !important; }';
        }


        if (!empty($ealain_options["mobile-logo-dimensions"]["width"]) && $ealain_options["mobile-logo-dimensions"]["width"] != "px") {
            $logo_width = $ealain_options["mobile-logo-dimensions"]["width"];
            $logo_var .= '.mobile-menu a.navbar-brand img { width: ' . $logo_width . ' !important; }';
        }

        if (!empty($ealain_options["mobile-logo-dimensions"]["height"]) && $ealain_options["mobile-logo-dimensions"]["height"] != "px") {
            $logo_height = $ealain_options["mobile-logo-dimensions"]["height"];
            $logo_var .= '.mobile-menu a.navbar-brand img { height: ' . $logo_height . ' !important; }';
        }
        
        if (!empty($logo_var)) {
            wp_add_inline_style('ealain-global', $logo_var);
        }
    }
}
