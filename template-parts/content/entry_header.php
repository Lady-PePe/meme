<?php

/**
 * Template part for displaying a post's header
 *
 * @package ealain
 */

namespace Ealain\Ealain;

global $ealain_options ;
?>


<?php
if (!is_search()) {
	get_template_part('template-parts/content/entry_thumbnail', get_post_type());
}
?>
<div class="ealain-blog-detail">
	<?php
	get_template_part('template-parts/content/entry_meta', get_post_type());
	if (!is_single()) {
		get_template_part('template-parts/content/entry_title', get_post_type());
	}
	?>
	<!-- .entry-header -->