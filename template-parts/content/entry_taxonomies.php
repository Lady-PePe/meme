<?php

/**
 * Template part for displaying a post's taxonomy terms
 *
 * @package ealain
 */

namespace Ealain\Ealain;

$taxonomies = wp_list_filter(
	get_object_taxonomies($post, 'objects'),
	array(
		'public' => true,
	)
);
$post_tag = get_the_tags();
if ($post_tag) {
?>
	<ul class="ealain-blogtag list-inline">
		<li class="ealain-label"><?php esc_html_e("Tags:", "ealain") ?></li>
		<?php foreach ($post_tag as $tag) { ?>
			<li>
				<a href="<?php echo get_tag_link($tag->term_id) ?>"><?php echo esc_html($tag->name); ?></a>
			</li>
		<?php } ?>
	</ul>
<?php } ?>