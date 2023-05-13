<?php

/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package ealain
 */

namespace Ealain\Ealain;

get_header();
$ealain_layout = '';
global $ealain_options ;
$is_sidebar = ealain()->is_primary_sidebar_active();
$post_section = ealain()->post_style();
if (isset($ealain_options['blog_setting'])) {
	$ealain_layout = $ealain_options['blog_setting'];
}
if(is_single() && isset($ealain_options['blog_single_page_setting']) && $ealain_options['blog_single_page_setting']  == 1){
	$is_sidebar= false;
}
?>
<div class="site-content-contain">
	<div id="content" class="site-content">
		<div id="primary" class="content-area">
			<main id="main" class="site-main">
				<div class="<?php echo apply_filters('content_container_class', 'container'); ?>">
					<div class="row <?php echo esc_attr($post_section['row_reverse']); ?>">
						<?php
						if ($is_sidebar) {
							echo '<div class="col-xl-8 col-sm-12 ealain-blog-main-list">';
						} else if ($ealain_layout != '4' && $ealain_layout != '5') {
							echo '<div class="col-lg-12 col-sm-12 ealain-blog-main-list">';
						}

						if (have_posts()) {
							while (have_posts()) {
								the_post();
								get_template_part('template-parts/content/entry', get_post_type(), $post_section['post']);
							}

							if (!is_singular()) {
								if (isset($ealain_options['display_pagination'])) {
									if ($ealain_options['display_pagination'] == "yes") {
										get_template_part('template-parts/content/pagination');
									}
								} else {
									get_template_part('template-parts/content/pagination');
								}
							}
						} else {
							get_template_part('template-parts/content/error');
						}

						if ($is_sidebar || $ealain_layout != '4' && $ealain_layout != '5') {
							echo '</div>';
						}
						if($is_sidebar){
							get_sidebar();
						}
						?>
					</div>
				</div>
			</main><!-- #primary -->
		</div>
	</div>
</div>
<?php
get_footer();
