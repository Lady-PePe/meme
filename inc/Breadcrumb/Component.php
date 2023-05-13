<?php

/**
 * Ealain\Ealain\Comments\Component class
 *
 * @package ealain
 */

namespace Ealain\Ealain\Breadcrumb;

use Ealain\Ealain\Component_Interface;
use Ealain\Ealain\Templating_Component_Interface;

/**
 * Class for managing breadcrumb UI.
 *
 * Exposes template tags:
 * * `ealain()->ealain_breadcrumb( )`
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
		return 'breadcrumb';
	}
	/**
	 * Adds the action and filter hooks to integrate with WordPress.
	 */
	public function initialize()
	{
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
		return [
			'ealain_breadcrumb' 	=> [$this, 'ealain_breadcrumb'],
		];
	}

	public function ealain_breadcrumb()
	{
		$ealain_style = '';
		if (class_exists('ReduxFramework')) {
		    global $ealain_options;
			$ealain_style = $ealain_options['breadcrumb_style'];
		}

		if (is_404()) {
			return;
		}
?>
		<div class="ealain-breadcrumb ealain-breadcrumb-style-<?php echo esc_attr($ealain_style) ?>">
			<div class="container">
				<?php
				if (class_exists('ReduxFramework')) {

					$breadcrumb_style = !empty($ealain_style) ? $ealain_style : '';
					if ($breadcrumb_style == '2') {
				?>
						<div class="row align-items-center">
							<div class="col-lg-8 col-md-8 text-start">
								<nav aria-label="breadcrumb">
									<?php $this->ealain_breadcrumb_title(); ?>
									<?php $this->ealain_breadcrumb_nav("breadcrumb main-bg"); ?>
								</nav>
							</div>
							<?php $this->ealain_breadcrumb_feature_image(); ?>
						</div>
					<?php } elseif ($breadcrumb_style == '3') { ?>

						<div class="row align-items-center">
							<?php $this->ealain_breadcrumb_feature_image(); ?>
							<div class="col">
								<nav aria-label="breadcrumb" class="text-end ealain-breadcrumb-nav">
									<?php $this->ealain_breadcrumb_title(); ?>
									<?php $this->ealain_breadcrumb_nav("breadcrumb main-bg justify-content-end"); ?>
								</nav>
							</div>
						</div>
					<?php } elseif ($breadcrumb_style == '4') { ?>

						<div class="row align-items-center">
							<div class="col-md-6 mb-3 mb-md-0 text-center text-md-start">
								<?php $this->ealain_breadcrumb_title(); ?>
							</div>
							<div class="col-md-6 text-md-end  text-sm-center">
								<nav aria-label="breadcrumb" class="ealain-breadcrumb-nav">
									<?php $this->ealain_breadcrumb_nav("breadcrumb main-bg justify-content-md-end"); ?>
								</nav>
							</div>
						</div>
					<?php } elseif ($breadcrumb_style == '5') { ?>

						<div class="row align-items-center ealain-breadcrumb-three">
							<div class="col-md-6 mb-3 mb-md-0">
								<nav aria-label="breadcrumb" class="text-md-start text-center ealain-breadcrumb-nav">
									<?php $this->ealain_breadcrumb_nav("breadcrumb main-bg justify-content-md-start"); ?>
								</nav>
							</div>
							<div class="col-md-6 text-md-end text-center">
								<?php $this->ealain_breadcrumb_title(); ?>
							</div>
						</div>
					<?php } else { ?>
						<div class="row align-items-center justify-content-center text-center">
							<div class="col-sm-12">
								<nav aria-label="breadcrumb" class="ealain-breadcrumb-nav">
									<?php $this->ealain_breadcrumb_title(); ?>
									<?php $this->ealain_breadcrumb_nav("breadcrumb main-bg"); ?>
								</nav>
							</div>
						</div>
					<?php }
				} else { ?>
					<div class="row align-items-center">
						<div class="col-sm-12">
							<nav aria-label="breadcrumb" class="text-center">
								<?php $this->ealain_breadcrumb_title(); ?>
								<?php $this->ealain_breadcrumb_nav("breadcrumb main-bg"); ?>
							</nav>
						</div>
					</div>
				<?php } ?>
			</div>
		</div>
		<?php
	}

	function ealain_breadcrumb_title()
	{

		$page_id = get_queried_object_id();
		global $ealain_options;

		//return if title option is not enable
		$page_option = get_post_meta($page_id, 'display_breadcrumb_title', true);
		if ($page_option == 'no') {
			return;
		} else if (isset($ealain_options['display_breadcrumb_title']) && $ealain_options['display_breadcrumb_title'] == 'no') {
			return;
		}

		$title = '';
		$title_tag = 'h2';

		if (isset($ealain_options['breadcum_title_tag'])) {
			$title_tag = $ealain_options['breadcum_title_tag'];
		}

		if (is_archive()) {
			$title = get_the_archive_title();
		} elseif (is_search()) {
			$title = esc_html__('Search', 'ealain');
		} elseif (is_404()) {
			$title = esc_html__('Oops! That page can not be found.', 'ealain');
			if (isset($ealain_options['404_title'])) {
				$title = !empty(trim($ealain_options['404_title'])) ? $ealain_options['404_title'] : '';
			}
		} elseif (is_home()) {
			$title = wp_title('', false);
		} else if (is_page_template('single-creative-post.php') || 'post' == get_post_type()) {
			$title = esc_html__('Our Blogs', 'ealain');
		} elseif ('iqonic_hf_layout' === get_post_type()) {
			$title = get_the_title($page_id);
		}elseif ('product' === get_post_type()) {
			$title = 'Shop';
		} else {
			$title = get_the_title();
		}
		if (!empty(trim($title))) :
		?>
			<span class="wave-pattern wow">
				<span class="ealain-wave-pattern-wrapper">
					<?php $ealain_imageurl = get_template_directory_uri() . '/assets/images/redux/wave-pattern-new.webp'; ?>
					<img src="<?php echo esc_url($ealain_imageurl); ?>" class="wave-effect" alt="<?php esc_attr_e('image','ealain'); ?>">
				</span>
			</span>
			<<?php echo esc_attr($title_tag); ?> class="title">
				<?php
				//unique color code here
				$ealain_span = '<span class="highlighted-text-wrap"';
				$ealain_span .= '>';
				$ealain_wrapped = preg_replace('/\s(\S*)$/', ' ' . $ealain_span . '$1', $title);
				$ealain_wrapped .= ' </span>';
				$ealain_span .= '</span>';
				?>
				<?php echo wp_kses($ealain_wrapped, 'post'); ?>
			</<?php echo esc_attr($title_tag); ?>>
		<?php
		endif;
	}

	function ealain_breadcrumb_feature_image()
	{
		$bnurl = '';
		$page_id = get_queried_object_id();
		global $ealain_options;
		if (has_post_thumbnail($page_id) && !is_single()) {
			$image_array = wp_get_attachment_image_src(get_post_thumbnail_id($page_id), 'full');
			$bnurl = $image_array[0];
		} elseif (is_404()) {
			if (!empty($ealain_options['404_banner_image']['url'])) {
				$bnurl = $ealain_options['404_banner_image']['url'];
			}
		} elseif (is_home()) {
			if (!empty($ealain_options['blog_default_banner_image']['url'])) {
				$bnurl = $ealain_options['blog_default_banner_image']['url'];
			}
		} else {
			if (!empty($ealain_options['page_default_breadcrumb_image']['url'])) {
				$bnurl = $ealain_options['page_default_breadcrumb_image']['url'];
			}
		}

		if (!empty($bnurl)) {
			$img_pos = "";
			if (!empty($ealain_options['bg_image']) && $ealain_options['bg_image'] != 1) {
				$img_pos = 'float-right';
			}
		?>
			<div class="col-lg-4 col-md-4 col-sm-12 align-breadcrumb-image">
				<img src="<?php echo esc_url($bnurl); ?>" class="img-fluid <?php echo esc_attr($img_pos) ?>" alt="<?php esc_attr_e('banner', 'ealain'); ?>">
			</div>
<?php
		}
	}
	function ealain_breadcrumb_nav($class = "")
	{
		//return if nav option is not enable
		$page_id = get_queried_object_id();
		global $ealain_options;
		$page_option = get_post_meta($page_id, 'display_breadcumb_nav', true);
		if ($page_option == 'no') {
			return;
		} else if (isset($ealain_options['display_breadcrumb_nav']) && $ealain_options['display_breadcrumb_nav'] == 'no') {
			return;
		}

		global $post;
		echo '<ol class="' . esc_attr($class) . '">';
		$show_on_home = 0; // 1 - show breadcrumbs on the homepage, 0 - don't show
		$home = esc_html__('Home', 'ealain'); // text for the 'Home' link
		$show_current = 1; // 1 - show current post/page title in breadcrumbs, 0 - don't show

		$home_link = esc_url(home_url());

		if (is_front_page()) {
			if ($show_on_home == 1) echo '<li class="breadcrumb-item"><a href="' . $home_link . '">' . $home . '</a></li>';
		} else {

			echo '<li class="breadcrumb-item"><a href="' . $home_link . '">' . $home . '</a></li> ';

			if (is_home()) {
				echo  '<li class="breadcrumb-item active"><span class="breadcrumbs-separator"></span>' . esc_html__('Blogs', 'ealain') . '</li>';
			} elseif (is_category()) {
				$this_cat = get_category(get_query_var('cat'), false);
				if ($this_cat->parent != 0) echo '<li class="breadcrumb-item"><span class="breadcrumbs-separator"></span>' . get_category_parents($this_cat->parent, TRUE, '  ') . '</li>';
				echo  '<li class="breadcrumb-item active"><span class="breadcrumbs-separator"></span>' . esc_html__('Archive by category : ', 'ealain') . ' "' . single_cat_title('', false) . '" </li>';
			} elseif (is_search()) {
				echo  '<li class="breadcrumb-item active"><span class="breadcrumbs-separator"></span>' . esc_html__('Search results for : ', 'ealain') . ' "' . get_search_query() . '"</li>';
			} elseif (is_day()) {
				echo '<li class="breadcrumb-item"><span class="breadcrumbs-separator"></span><a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a></li> ';
				echo '<li class="breadcrumb-item"><span class="breadcrumbs-separator"></span><a href="' . get_month_link(get_the_time('Y'), get_the_time('m')) . '">' . get_the_time('F') . '</a></li>  ';
				echo  '<li class="breadcrumb-item active"><span class="breadcrumbs-separator"></span>' . get_the_time('d') . '</li>';
			} elseif (is_month()) {
				echo '<li class="breadcrumb-item"><span class="breadcrumbs-separator"></span><a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a></li> ';
				echo  '<li class="breadcrumb-item active"><span class="breadcrumbs-separator"></span>' . get_the_time('F') . '</li>';
			} elseif (is_year()) {
				echo  '<li class="breadcrumb-item active"><span class="breadcrumbs-separator"></span>' . get_the_time('Y') . '</li>';
			} elseif (is_single() && !is_attachment()) {
				if (get_post_type() != 'post') {
					$post_type = get_post_type_object(get_post_type());
					$slug = $post_type->rewrite;
					if (!empty($slug)) {
						echo '<li class="breadcrumb-item"><span class="breadcrumbs-separator"></span><a href="' . $home_link . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a></li>';
					}
					if ($show_current == 1) echo '<li class="breadcrumb-item"><span class="breadcrumbs-separator"></span>' . get_the_title() . '</li>';
				} else {
					$cat = get_the_category();
					if (!empty($cat)) {
						$cat = $cat[0];

						if ($show_current == 0) $cat = preg_replace("#^(.+)\s\s$#", "$1", $cat);
						echo '<li class="breadcrumb-item"><span class="breadcrumbs-separator"></span>' . get_category_parents($cat, TRUE, '  ') . '</li>';
						if (!empty(get_the_title())) {
							if ($show_current == 1) echo  '<li class="breadcrumb-item active"><span class="breadcrumbs-separator"></span>' . get_the_title() . '</li>';
						}
					}
				}
			} elseif (!is_single() && !is_page() && get_post_type() != 'post' && !is_404()) {
				$post_type = get_post_type_object(get_post_type());
				if ($post_type) {
					echo  '<li class="breadcrumb-item active"><span class="breadcrumbs-separator"></span>' . $post_type->labels->singular_name . '</li>';
				}
			} elseif (!is_single() && is_attachment()) {
				$parent = get_post($post->post_parent);
				$cat = get_the_category($parent->ID);
				$cat = $cat[0];
				echo '<li class="breadcrumb-item"><span class="breadcrumbs-separator"></span>' . get_category_parents($cat, TRUE, '  ') . '</li>';
				echo '<li class="breadcrumb-item"><span class="breadcrumbs-separator"></span><a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a></li>';
				if ($show_current == 1) echo '<li class="breadcrumb-item active"> <span class="breadcrumbs-separator"></span>' .  get_the_title() . '</li>';
			} elseif (is_page() && !$post->post_parent) {
				if ($show_current == 1) echo  '<li class="breadcrumb-item active"><span class="breadcrumbs-separator"></span>' . get_the_title() . '</li>';
			} elseif (is_page() && $post->post_parent) {
				$trail = '';
				if ($post->post_parent) {
					$parent_id = $post->post_parent;
					$breadcrumbs = array();
					while ($parent_id) {
						$page = get_post($parent_id);
						$breadcrumbs[] = '<li class="breadcrumb-item"><span class="breadcrumbs-separator"></span><a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a></li>';
						$parent_id  = $page->post_parent;
					}
					$breadcrumbs = array_reverse($breadcrumbs);
					foreach ($breadcrumbs as $crumb) $trail .= $crumb;
				}

				echo wp_kses($trail, ["li" => ["class" => true], "a" => ["href" => true], "span" => ["class" => true],"i" => ["class" => true]]);
				if ($show_current == 1) echo '<li class="breadcrumb-item active"> <span class="breadcrumbs-separator"></span>' .  get_the_title() . '</li>';
			} elseif (is_tag()) {
				echo  '<li class="breadcrumb-item active"><span class="breadcrumbs-separator"></span>' . esc_html__('Posts tagged', 'ealain') . ' "' . single_tag_title('', false) . '"</li>';
			} elseif (is_author()) {
				global $author;
				$userdata = get_userdata($author);
				echo  '<li class="breadcrumb-item active"><span class="breadcrumbs-separator"></span>' . esc_html__('Articles posted by : ', 'ealain') . ' ' . $userdata->display_name . '</li>';
			} elseif (is_404()) {
				echo  '<li class="breadcrumb-item active"><span class="breadcrumbs-separator"></span>' . esc_html__('Error 404', 'ealain') . '</li>';
			}

			if (get_query_var('paged')) {
				echo '<li class="breadcrumb-item active"><span class="breadcrumbs-separator"></span>' . esc_html__('Page', 'ealain') . ' ' . get_query_var('paged') . '</li>';
			}
		}
		echo '</ol>';
	}
}
