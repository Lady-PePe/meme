<?php

/**
 * Template part for displaying a post's content
 *
 * @package ealain
 */

namespace Ealain\Ealain;

if (is_single()) {
	the_content();
} else {
	the_excerpt();
}
?>
