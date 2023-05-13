<?php

/**
 * Ealain\Ealain\Dynamic_Style\Styles\BodyContainer class
 *
 * @package ealain
 */

namespace Ealain\Ealain\Dynamic_Style\Styles;

use Ealain\Ealain\Dynamic_Style\Component;
use function add_action;

class BodyContainer extends Component
{

	public function __construct()
	{
		if (class_exists('ReduxFramework')) {
			add_action('wp_enqueue_scripts', array($this, 'ealain_container_width'), 21);
		}
	}

	public function ealain_container_width()
	{
		global $ealain_options ;

		if (isset($ealain_options['opt-slider-label']) && !empty($ealain_options['opt-slider-label'])) {
			$container_width = $ealain_options['opt-slider-label'];
			$box_container_width = "body.iq-container-width .container,
        							body.iq-container-width .elementor-section.elementor-section-boxed>
        							.elementor-container { max-width: " . $container_width . "px; } ";
			wp_add_inline_style('ealain-style', $box_container_width);
		}
	}
}
