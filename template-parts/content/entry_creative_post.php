<?php

/**
 * Template part for displaying a post
 *
 * @package ealain
 */

namespace Ealain\Ealain;

global $ealain_options ;
$is_sidebar = ealain()->is_primary_sidebar_active();
$ealain_layout = '';
if (isset($ealain_options['blog_setting'])) {
	$ealain_layout = $ealain_options['blog_setting'];
}

if ($ealain_layout == '2' || $ealain_layout == '3') { ?>
	<div class="<?php echo esc_attr($args); ?>">
	<?php
} ?>
	<div class="col-lg-12">
		<article id="post-<?php the_ID(); ?>" <?php post_class('entry'); ?>>

			<!-- meta -->
			<div class="ealain-blog-box creative-image">
				<?php
			    if (!is_search()) {
					if (isset($ealain_options['display_featured_image'])) {
						$options = $ealain_options['display_featured_image'];
						if ($options == "yes") {
							get_template_part('template-parts/content/entry_thumbnail', get_post_type());
						}
					} else {
						get_template_part('template-parts/content/entry_thumbnail', get_post_type());
					}
				} ?>
				
			</div>

			<div class="row">
				<?php
				if ($is_sidebar) {
					echo '<div class="col-xl-8 col-sm-12 ealain-blog-main-list">';
				} else if ($ealain_layout != '2' && $ealain_layout != '3') {
					echo '<div class="col-lg-12 col-sm-12 ealain-blog-main-list">';
				} ?>

                <div class="ealain-blog-meta">
					<ul class="list-inline">
						<li class="list-inline-item blog-date">
							<?php echo function_exists('iqonic_blog_time_link') ? sprintf("%s", iqonic_blog_time_link()) : get_the_date(); ?>
						</li>
					</ul>
				</div>

				<a href="<?php echo esc_url(get_permalink()); ?>" rel="bookmark" class="creative-post-link">
					<h3 class="entry-title">
						<?php
						$ealain_title = get_the_title();
						//unique color code here
						$ealain_span = '<span class="highlighted-text-wrap"';
						$ealain_span .= '>';
						$ealain_wrapped = preg_replace('/\s(\S*)$/', ' ' . $ealain_span . '$1', $ealain_title);
						$ealain_wrapped .= ' </span>';
						$ealain_span .= '</span>';
						?>
						<?php echo wp_kses($ealain_wrapped, 'post'); ?>
					</h3>
				</a>

				<?php
				//title

				//content
				the_content();
				?>
				
					<?php
					$post_tag = get_the_tags();
					?>
					<div class="wp-block-tag-cloud"> <?php
					if ($post_tag) { ?>
						<?php foreach ($post_tag as $tag) { ?>
							<a class="tag-cloud-link" href="<?php echo get_category_link($tag->term_id) ?>"><?php echo esc_html($tag->name); ?></a>
						<?php } ?>
					<?php }
					?>
					</div>
				<?php
				wp_link_pages(array(
					'before'      => '<div class="page-links">' . esc_html__('Pages:', 'ealain'),
					'after'       => '</div>',
					'link_before' => '<span class="page-number">',
					'link_after'  => '</span>',
				));
				if (is_singular(get_post_type())) {
					if (class_exists('ReduxFramework')) {
						$ealain_option = get_option('ealain-options');
						if ($ealain_option['display_comment'] == 'yes') {
							// Show comments only when the post type supports it and when comments are open or at least one comment exists.
							if (post_type_supports(get_post_type(), 'comments') && (comments_open() || get_comments_number())) {
								comments_template();
							}
						}
					} else {
						// Show comments only when the post type supports it and when comments are open or at least one comment exists.
						if (post_type_supports(get_post_type(), 'comments') && (comments_open() || get_comments_number())) {
							comments_template();
						}
					}
				}
				if ($is_sidebar || $ealain_layout != '2' && $ealain_layout != '3') {
				?>
			</div>
			<div class=" col-xl-4 col-sm-12 mt-5 mt-xl-0 sidebar-service-right">
				<aside id="secondary" class="primary-sidebar widget-area">
					<h2 class="screen-reader-text"><?php esc_html_e('Asides', 'ealain'); ?></h2>
					<div class="widget ealain-widget-author ">
						<h5 class="widget-title mb-4">
							<?php echo esc_html__("About Author", "ealain") ?>
						</h5>
						<div class="author-box">
							<div class="author-img">
								<?php
								if (get_avatar(get_the_author_meta('ID')) == 0) {
									$author_avtar_url = get_template_directory_uri() . '/assets/images/redux/admin.webp';
								} else {
									$author_avtar_url = get_avatar_url(get_the_author_meta('ID'));
								}
								?>
								<img src="<?php echo esc_url($author_avtar_url); ?>" alt="<?php esc_attr_e('Author', 'ealain'); ?>" />
							</div>
							<div class="author-content">

								<a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>" class="ealain-user">
									<h5 class="ealain-admin"><?php echo esc_html(get_the_author()); ?></h5>
								</a>
								<p class="mb-0">
									<?php
									echo get_the_author_meta('description');
									?>
								</p>
								<div class="ealain-share">
									<ul class="info-share list-inline">
										<?php
										 if (get_the_author_meta('name_facebook') && !empty(get_the_author_meta('name_facebook'))) : ?>
											<li>
												<a class="icon-text" target="_blank" href="<?php echo esc_url(get_the_author_meta('name_facebook')); ?>">
													<?php esc_html_e('Fb','ealain'); ?>
												</a>
											</li>
										<?php endif; ?>
										<?php if (get_the_author_meta('name_instagram') && !empty(get_the_author_meta('name_instagram'))) : ?>
											<li>
												<a  class="icon-text" target="_blank" href="<?php echo esc_url(get_the_author_meta('name_instagram')); ?>">
												    <?php esc_html_e('In','ealain'); ?>
												</a>
											</li>
										<?php endif; ?>
										<?php if (get_the_author_meta('name_twitter') && !empty(get_the_author_meta('name_twitter'))) : ?>
											<li>
												<a class="icon-text" target="_blank" href="<?php echo esc_url(get_the_author_meta('name_twitter')); ?>">
												    <?php esc_html_e('Tw','ealain'); ?>
												</a>
											</li>
										<?php endif; ?>
										
										<?php if (get_the_author_meta('name_pinterest') && !empty(get_the_author_meta('name_pinterest'))) : ?>
											<li>
												<a  class="icon-text" target="_blank" href="<?php echo esc_url(get_the_author_meta('name_pinterest')); ?>">
												    <?php esc_html_e('Pi','ealain'); ?>
												</a>
											</li>
										<?php endif; ?>
										<?php if (get_the_author_meta('name_dribbble') && !empty(get_the_author_meta('name_dribbble'))) : ?>
											<li>
												<a  class="icon-text" target="_blank" href="<?php echo esc_url(get_the_author_meta('name_dribbble')); ?>">
												    <?php esc_html_e('Dr','ealain'); ?>
												</a>
											</li>
										<?php endif; ?>
										<?php if (get_the_author_meta('name_behance') && !empty(get_the_author_meta('name_behance'))) : ?>
											<li>
												<a  class="icon-text" target="_blank" href="<?php echo esc_url(get_the_author_meta('name_behance')); ?>">
												    <?php esc_html_e('Be','ealain'); ?>
												</a>
											</li>
										<?php endif; ?>
									</ul>
								</div>
							</div>
						</div>
					</div>
					<?php
					if (ealain()->is_primary_sidebar_active()) {
						ealain()->display_primary_sidebar();
					}
					?>
				</aside><!-- #secondary -->
			</div>
		<?php
				}
		?>
	</div>
	</article>
	</div><!-- #post-<?php the_ID(); ?> -->