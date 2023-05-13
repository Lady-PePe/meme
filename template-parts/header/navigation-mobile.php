<?php

/**
 * Template part for displaying the header navigation menu
 *
 * @package ealain
 */

namespace Ealain\Ealain;

global $ealain_options ;
?>
<div class="container-fluid">
	<div class="row align-items-center">
		<div class="col-sm-12">
			<nav class="ealain-menu-wrapper mobile-menu">
				<div class="navbar">

					<a class="navbar-brand" href="<?php echo esc_url(home_url('/')); ?>">
						<?php
						if (function_exists('get_field') || class_exists('ReduxFramework')) {
							$key = function_exists('get_field') ? get_field('key_header') : '';
							if (!empty($key['header_logo']['url'])) {
								$options = $key['header_logo']['url'];
							} else if (isset($ealain_options['header_radio'])) {
								if ($ealain_options['header_radio'] == 1) {
									$logo_text = $ealain_options['header_text'];
									echo esc_html($logo_text);
								}
								if ($ealain_options['header_radio'] == 2) {
									$options = $ealain_options['ealain_mobile_logo']['url'];
								}
							}
						}
						if (isset($options) && !empty($options)) {
							echo '<img class="img-fluid logo" src="' . esc_url($options) . '" alt="ealain">';
						} elseif (has_header_image()) {
							$image = wp_get_attachment_image_src(get_theme_mod('custom_logo'), 'full');
							if (has_custom_logo()) {
								echo '<img class="img-fluid logo" src="' . esc_url($image) . '" alt="ealain">';
							} else {
								bloginfo('name');
							}
						} else {
							$logo_url = get_template_directory_uri() . '/assets/images/logo-white.svg';
							echo '<img class="img-fluid logo" src="' . esc_url($logo_url) . '" alt="ealain">';
						}
						?>
					</a>

					<button class="navbar-toggler custom-toggler ham-toggle close-custom-toggler" type="button">
						<span class="menu-btn d-inline-block is-active">
							<span class="line one"></span>
							<span class="line two"></span>
							<span class="line three"></span>
						</span>
					</button>
				</div>

				<div class="c-collapse">
					<div class="menu-new-wrapper">
						<div class="menu-scrollbar verticle-mn yScroller">
							<div id="ealain-menu-main" class="ealain-full-menu">
								<?php
								if (ealain()->is_primary_nav_menu_active()) {
									ealain()->display_primary_nav_menu(array('menu_class' => 'navbar-nav top-menu'));
								}
								?>
							</div>
						</div>
					</div>
				</div>
			</nav><!-- #site-navigation -->
		</div>
	</div>
</div>