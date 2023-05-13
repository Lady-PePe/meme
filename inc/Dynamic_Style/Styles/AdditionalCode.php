<?php

/**
 * Ealain\Ealain\Dynamic_Style\Styles\AdditionalCode class
 *
 * @package ealain
 */

namespace Ealain\Ealain\Dynamic_Style\Styles;

use Ealain\Ealain\Dynamic_Style\Component;
use function add_action;

class AdditionalCode extends Component
{

    public function __construct()
    {
        add_action('wp_enqueue_scripts', array($this, 'ealain_inline_scripts'), 20);
    }

    public function ealain_inline_scripts()
    {
        global $ealain_options ;

        if (!empty($ealain_options['css_code'])) {
            $ealain_css_code = $ealain_options['css_code'];
            wp_add_inline_style('ealain-global', $ealain_css_code);
        }

        if (!empty($ealain_options['js_code'])) {
            $ealain_js_code = $ealain_options['js_code'];
            wp_register_script('ealain-custom-js', '', [], '', true);
            wp_enqueue_script('ealain-custom-js');
            wp_add_inline_script('ealain-custom-js', wp_specialchars_decode($ealain_js_code));
        }
    }
}
