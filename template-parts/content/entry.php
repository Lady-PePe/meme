<?php

/**
 * Template part for displaying a post
 *
 * @package ealain
 */

namespace Ealain\Ealain;

global $ealain_options ;

$ealain_layout = '';
if (isset($ealain_options['blog_setting'])) {
	$ealain_layout = $ealain_options['blog_setting'];
}
if (in_array($ealain_layout,[1,2,4,5]) && !is_single()) {
?>
	<div class="<?php echo esc_attr($args); ?>">
	<?php } ?>
	<article id="post-<?php the_ID(); ?>" <?php post_class('entry'); ?>>
		<div class="ealain-blog-box">
			<?php
			get_template_part('template-parts/content/entry_header', get_post_type());
			if (is_single()) {
				get_template_part('template-parts/content/entry_content', get_post_type());
			} else {
				get_template_part('template-parts/content/entry_summary', get_post_type());
			}
			wp_link_pages(array(
				'before'      => '<div class="page-links">' . esc_html__('Pages:', 'ealain'),
				'after'       => '</div>',
				'link_before' => '<span class="page-number">',
				'link_after'  => '</span>',
			));
			get_template_part('template-parts/content/entry_footer', get_post_type());
			?>
		</div>
	</article><!-- #post-<?php the_ID(); ?> -->
	<?php
	if (is_singular(get_post_type())) {
		if (class_exists('ReduxFramework')) {
			global $ealain_options ;
			if ($ealain_options['display_comment'] == 'yes') {
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
	if (in_array($ealain_layout,[1,2,4,5])  && !is_single()) { ?>
	</div>
<?php
	}
