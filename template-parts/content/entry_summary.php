<?php

/**
 * Template part for displaying a post's summary
 *
 * @package ealain
 */

namespace Ealain\Ealain;
?>

<div class="entry-summary">
	<?php
	if (!empty(get_the_excerpt()) && ord(get_the_excerpt()) !== 38) {
		the_excerpt();
	}
	?>
</div><!-- .entry-summary -->