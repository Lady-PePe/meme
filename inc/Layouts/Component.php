<?php

/**
 * Ealain\Ealain\Actions\Component class
 *
 * @package ealain
 */

namespace Ealain\Ealain\Layouts;

use Elementor\Plugin;
use Ealain\Ealain\Component_Interface;
use Ealain\Ealain\Templating_Component_Interface;

/**
 * Class for managing comments UI.
 *
 * Exposes template tags:
 * * `ealain()->the_comments( array $args = array() )`
 *
 * @link https://wordpress.org/plugins/amp/
 */
class Component implements Component_Interface, Templating_Component_Interface
{
	/**
	 * Gets the unique identifier for the theme component.
	 *
	 * @return string Component slug.
	 */
	public function get_slug(): string
	{
		return 'layouts';
	}
	public function initialize()
	{
		add_action('manage_posts_extra_tablenav', array($this, 'add_layout_navigation'));
	}
	/**
	 * Gets template tags to expose as methods on the Template_Tags class instance, accessible through `ealain()`.
	 *
	 * @return array Associative array of $method_name => $callback_info pairs. Each $callback_info must either be
	 *               a callable or an array with key 'callable'. This approach is used to reserve the possibility of
	 *               adding support for further arguments in the future.
	 */
	public function template_tags(): array
	{
		return array(
			'ealain_get_layout_content' => array($this, 'ealain_get_layout_content'),
		);
	}
	public function ealain_get_layout_content($id)
	{
		$content = Plugin::instance()->frontend->get_builder_content_for_display($id);
		return $content;
	}
	//layout admin navigation
	function add_layout_navigation($where)
	{
		global $post_type_object;
		global $post;
		if ($post_type_object->name === 'iqonic_hf_layout' && $where == "top" && $post) {
?>
			<div class="alignleft action">
				<a target="_blank" href="<?php echo esc_url(admin_url("admin.php?page=_ealain_options&tab=6")); ?> " class="button">
					<?php echo esc_html__("Setup header layout", "ealain"); ?>
				</a>
				<a target="_blank" href="<?php echo esc_url(admin_url("admin.php?page=_ealain_options&tab=17")); ?> " class="button">
					<?php echo esc_html__("Setup footer layout", "ealain"); ?>
				</a>
				<a target="_blank" href="<?php echo esc_url(admin_url('nav-menus.php')); ?>'" class="button">
					<?php echo esc_html__("Setup menu layout", "ealain"); ?>
				</a>
				<a target="_blank" href="<?php echo esc_url(admin_url("admin.php?page=_ealain_options&tab=15")); ?> " class="button">
					<?php echo esc_html__("Setup 404 page layout", "ealain"); ?>
				</a>
			</div>
<?php
		}
	}
}
