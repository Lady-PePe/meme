<?php

/**
 * Ealain\Ealain\Comments\Component class
 *
 * @package ealain
 */

namespace Ealain\Ealain\Common;

use Exception;
use Ealain\Ealain\Component_Interface;
use Ealain\Ealain\Templating_Component_Interface;
use function add_action;

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
		return 'common';
	}

	/**
	 * Adds the action and filter hooks to integrate with WordPress.
	 */
	public function initialize()
	{
		add_filter('widget_tag_cloud_args', array($this, 'ealain_widget_tag_cloud_args'), 100);
		add_filter('wp_list_categories', array($this, 'ealain_categories_postcount_filter'), 100);
		add_filter('get_archives_link', array($this, 'ealain_style_the_archive_count'), 100);
		add_filter('upload_mimes', array($this, 'ealain_mime_types'), 100);
		add_action('wp_enqueue_scripts', array($this, 'ealain_remove_wp_block_library_css'), 100);
		add_filter('pre_get_posts', array($this, 'ealain_searchfilter'), 100);
		add_filter('elementor/fonts/groups', array($this, 'ealain_elementor_font_group'));
		add_filter('elementor/fonts/additional_fonts', array($this, 'ealain_add_elementor_fonts'));
		add_theme_support('post-formats', array(
			'aside',
			'image',
			'video',
			'quote',
			'link',
			'gallery',
			'audio',
		));

		add_action('wp_ajax_load_skeleton', array($this, 'ealain_load_skeleton_ajax_handler'));
		add_action('wp_ajax_nopriv_load_skeleton', array($this, 'ealain_load_skeleton_ajax_handler'));

		// ** Product load more *//
		if (!function_exists('ealain_loadmore_product_ajax_handler')) {
			add_action('wp_ajax_loadmore_product', array($this, 'ealain_loadmore_product_ajax_handler'));
			add_action('wp_ajax_nopriv_loadmore_product', array($this, 'ealain_loadmore_product_ajax_handler'));
		}

		add_action('wp_ajax_qty_cart', array($this, 'ealain_ajax_qty_cart'));
		add_action('wp_ajax_nopriv_qty_cart', array($this, 'ealain_ajax_qty_cart'));

		// Get Woof Ajax Filter Product Query 
		if (!function_exists('ealain_fetch_woof_filter_ajax_query')) {
			add_action('wp_ajax_fetch_woof_filter_ajax_query', array($this, 'ealain_fetch_woof_filter_ajax_query'));
			add_action('wp_ajax_nopriv_fetch_woof_filter_ajax_query', array($this, 'ealain_fetch_woof_filter_ajax_query'));
		}
	}

	public function __construct()
	{
		add_filter('the_content', array($this, 'ealain_remove_empty_p'));
		add_filter('get_the_content', array($this, 'ealain_remove_empty_p'));
		add_filter('get_the_excerpt', array($this, 'ealain_remove_empty_p'));
		add_filter('the_excerpt', array($this, 'ealain_remove_empty_p'));
		add_filter('body_class', array($this, 'ealain_add_body_classes'));
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
			'ealain_pagination' 		=> array($this, 'ealain_pagination'),
			'ealain_get_embed_video' 	=> array($this, 'ealain_get_embed_video'),
		);
	}


	/* function change_js_view_cart_button( $params, $handle )  {
    if( 'wc-add-to-cart' !== $handle ) return $params;

    // Changing "view_cart" button text and URL
    $params['i18n_view_cart'] = esc_attr__("Checkout", "ealain"); // Text
    $params['cart_url']      = esc_url( wc_get_checkout_url() ); // URL

    return $params;
}
 */
	function ealain_add_body_classes($classes)
	{
		if (class_exists('ReduxFramework')) {
			global $ealain_options;
			$id = get_queried_object_id();
			$page_header_layout = (function_exists('get_field') && !empty($id)) ? get_post_meta($id, 'header_layout_type', true) : '';
			if ($ealain_options['header_layout'] == 'custom' || $page_header_layout == 'custom') {
				$classes = array_merge($classes, array('ealain-custom-header'));
			} else {
				$classes = array_merge($classes, array('ealain-default-header'));
			}
		} else {
			$classes = array_merge($classes, array('ealain-default-header'));
		}

		return $classes;
	}

	public function ealain_load_skeleton_ajax_handler()
	{
		$skeleton_path = get_template_directory() . '/template-parts/skeleton/';
		try {
			$data = array(
				'skeleton-grid' => file_get_contents($skeleton_path . 'skeleton-grid.php'),
				'skeleton-list' => file_get_contents($skeleton_path . 'skeleton-list.php'),
			);
			if ($data['skeleton-grid'] == false || $data['skeleton-list'] == false) {
				throw new Exception("File not Found");
			}
			wp_send_json_success($data);
		} catch (Exception $e) {
			wp_send_json_error($e->getMessage(), 404);
		}
	}


	public function ealain_loadmore_product_ajax_handler()
	{
		$args = json_decode(stripslashes($_POST['query']), true);
		$args['paged'] = $_POST['page'] + 1; // we need next page to be loaded
		$args['post_status'] = 'publish';
		$is_grid = $_POST['is_grid'] != 'true' ? 'listing' : 'grid';
		$is_switch = isset($_POST['is_switch']) && $_POST['is_switch'] == 'true' ? true : false;

		if ($is_switch) {
			for ($args['paged'] = 1; $args['paged'] <= $_POST['page']; $args['paged']++) {

				query_posts($args);
				if (have_posts()) :
					while (have_posts()) : the_post();

						get_template_part('template-parts/wocommerce/entry', $is_grid);

					endwhile;

				endif;
			}
		} else {

			query_posts($args);
			if (have_posts()) :
				while (have_posts()) : the_post();

					get_template_part('template-parts/wocommerce/entry', $is_grid);

				endwhile;

			endif;
		}

		die;
	}


	function ealain_get_embed_video($post_id)
	{
		$post = get_post($post_id);
		$content = do_shortcode(apply_filters('the_content', $post->post_content));
		$embeds = get_media_embedded_in_content($content);
		if (!empty($embeds)) {
			foreach ($embeds as $embed) {
				if (strpos($embed, 'video') || strpos($embed, 'youtube') || strpos($embed, 'vimeo') || strpos($embed, 'dailymotion') || strpos($embed, 'vine') || strpos($embed, 'wordPress.tv') || strpos($embed, 'embed') || strpos($embed, 'audio') || strpos($embed, 'iframe') || strpos($embed, 'object')) {
					return $embed;
				}
			}
		} else {
			return;
		}
	}

	function ealain_remove_empty_p($string)
	{
		return preg_replace('/<p>(?:\s|&nbsp;)*?<\/p>/i', '', $string);
	}

	function ealain_remove_wp_block_library_css()
	{
		wp_dequeue_style('wp-block-library-theme');
	}

	public function ealain_widget_tag_cloud_args($args)
	{
		$args['largest'] = 1;
		$args['smallest'] = 1;
		$args['unit'] = 'em';
		$args['format'] = 'list';

		return $args;
	}
	function ealain_mime_types($mimes)
	{
		$mimes['svg'] = 'image/svg+xml';
		return $mimes;
	}
	function ealain_categories_postcount_filter($variable)
	{
		$variable = str_replace('(', '<span class="archiveCount"> (', $variable);
		$variable = str_replace(')', ') </span>', $variable);
		return $variable;
	}

	function ealain_style_the_archive_count($links)
	{
		$links = str_replace('</a>&nbsp;(', '</a> <span class="archiveCount"> (', $links);
		$links = str_replace('&nbsp;)</li>', ' </li></span>', $links);
		return $links;
	}

	public function ealain_pagination($numpages = '', $pagerange = '', $paged = '')
	{
		if (empty($pagerange)) {
			$pagerange = 2;
		}
		global $paged;
		if (empty($paged)) {
			$paged = 1;
		}
		if ($numpages == '') {
			global $wp_query;
			$numpages = $wp_query->max_num_pages;
			if (!$numpages) {
				$numpages = 1;
			}
		}
		/**
		 * We construct the pagination arguments to enter into our paginate_links
		 * function.
		 */
		$pagination_args = array(
			'format' => '?paged=%#%',
			'total' => $numpages,
			'current' => $paged,
			'show_all' => false,
			'end_size' => 1,
			'mid_size' => $pagerange,
			'prev_next' => true,
			'prev_text'       => '<i class="fas fa-chevron-left"></i>',
			'next_text'       => '<i class="fas fa-chevron-right"></i>',
			'type' => 'list',
			'add_args' => false,
			'add_fragment' => ''
		);

		$paginate_links = paginate_links($pagination_args);
		if ($paginate_links) {
			echo '<div class="col-lg-12 col-md-12 col-sm-12">
					<div class="pagination justify-content-center">
								<nav aria-label="Page navigation">';
			printf(esc_html__('%s', 'ealain'), $paginate_links);
			echo '</nav>
					</div>
				</div>';
		}
	}

	function ealain_searchfilter($query)
	{
		if (!is_admin()) {
			if ($query->is_search) {
				$query->set('post_type', 'post');
			}
			return $query;
		}
	}

	function ealain_elementor_font_group($font_groups)
	{
		$new_group['ealain-custom'] = esc_html__('Custom', 'ealain');
		$font_groups = $new_group + $font_groups;
		return $font_groups;
	}

	function ealain_add_elementor_fonts($fonts)
	{
		$fonts['Espera'] = 'ealain-custom';
		return $fonts;
	}
	public function ealain_ajax_qty_cart()
	{
		// Set item key as the hash found in input.qty's name
		$cart_item_key = $_POST['hash'];

		// Get the array of values owned by the product we're updating
		$threeball_product_values = WC()->cart->get_cart_item($cart_item_key);

		// Get the quantity of the item in the cart
		$threeball_product_quantity = apply_filters('woocommerce_stock_amount_cart_item', apply_filters('woocommerce_stock_amount', preg_replace("/[^0-9\.]/", '', filter_var($_POST['quantity'], FILTER_SANITIZE_NUMBER_INT))), $cart_item_key);

		// Update cart validation
		$passed_validation  = apply_filters('woocommerce_update_cart_validation', true, $cart_item_key, $threeball_product_values, $threeball_product_quantity);

		// Update the quantity of the item in the cart
		if ($passed_validation) {
			WC()->cart->set_quantity($cart_item_key, $threeball_product_quantity, true);

			wp_send_json_success(array('quantity' => WC()->cart->get_cart_contents_count()));
		}

		// Refresh the page
		wp_send_json_error();
	}
	public function ealain_fetch_woof_filter_ajax_query()
	{

		session_start();
		$query = new \WP_Query($_SESSION['ealain_woof_query_ajax']);
		echo json_encode(array('query' => json_encode($_SESSION['ealain_woof_query_ajax']), 'max_page' => $query->max_num_pages));
		wp_reset_postdata();
		session_unset();
		die;
	}
}
