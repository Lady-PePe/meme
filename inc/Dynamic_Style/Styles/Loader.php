<?php

/**
 * Ealain\Ealain\Dynamic_Style\Styles\Loader class
 *
 * @package ealain
 */

namespace Ealain\Ealain\Dynamic_Style\Styles;

use Ealain\Ealain\Dynamic_Style\Component;
use function add_action;

class Loader extends Component
{

    public function __construct()
    {
        add_action('wp_enqueue_scripts', array($this, 'ealain_loader_options'), 20);
    }

    public function ealain_loader_options()
    {
        global $ealain_options ;
        $loader_var = "";
        if (isset($ealain_options['loader_bg_color'])) {
            $loader_var = $ealain_options['loader_bg_color'];
            if (!empty($loader_var)) {
                $loader_css = "
                    #loading {
                        background : $loader_var !important;
                    }";
            }
        }
        if (!empty($ealain_options["loader-dimensions"]["width"]) && $ealain_options["loader-dimensions"]["width"] != "px") {
            $loader_width = $ealain_options["loader-dimensions"]["width"];
            $loader_css .= '#loading img { width: ' . $loader_width . ' !important; }';
        }

        if (!empty($ealain_options["loader-dimensions"]["height"]) && $ealain_options["loader-dimensions"]["height"] != "px") {
            $loader_height = $ealain_options["loader-dimensions"]["height"];
            $loader_css .= '#loading img { height: ' . $loader_height . ' !important; }';
        }
        if (!empty($loader_css)) {
            wp_add_inline_style('ealain-global', $loader_css);
        }
    }
}
