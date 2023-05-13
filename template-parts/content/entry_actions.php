<?php

/**
 * Template part for displaying a post's comment and edit links
 *
 * @package ealain
 */

namespace Ealain\Ealain;

?>
<div class="entry-actions">
	<?php
	$btn_txt = esc_html__('Read More', 'ealain');
	ealain()->ealain_get_blog_readmore_link(get_the_permalink(), $btn_txt);
	?>
</div><!-- .entry-actions -->