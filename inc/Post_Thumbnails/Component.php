<?php
/**
 * Ealain\Ealain\Post_Thumbnails\Component class
 *
 * @package ealain
 */

namespace Ealain\Ealain\Post_Thumbnails;

use Ealain\Ealain\Component_Interface;
use function add_action;
use function add_theme_support;
use function add_image_size;

/**
 * Class for managing post thumbnail support.
 *
 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
 */
class Component implements Component_Interface {

	/**
	 * Gets the unique identifier for the theme component.
	 *
	 * @return string Component slug.
	 */
	public function get_slug() : string {
		return 'post_thumbnails';
	}

	/**
	 * Adds the action and filter hooks to integrate with WordPress.
	 */
	public function initialize() {
		add_action( 'after_setup_theme', array( $this, 'action_add_post_thumbnail_support' ) );
		add_action( 'after_setup_theme', array( $this, 'action_add_image_sizes' ) );
	}

	/**
	 * Adds support for post thumbnails.
	 */
	public function action_add_post_thumbnail_support() {
		add_theme_support( 'post-thumbnails' );
	}

	/**
	 * Adds custom image sizes.
	 */
	public function action_add_image_sizes() {
		add_image_size( 'ealain-featured', 720, 480, true );
		add_image_size( 'ealain-size-verticle', 316, 443, true );
		add_image_size( 'ealain-size-portrait-one', 316, 245, true );
		add_image_size( 'ealain-size-portrait-two', 665, 429, true );
		add_image_size( 'ealain-size-size-landscape', 665, 259, true );

		add_image_size( 'ealain-horizontal-portait', 634, 927, true );
		add_image_size( 'ealain-horizontal-landscape', 1300, 910, true );

	}
}
