<?php

/**
 * Template part for displaying the header navigation menu
 *
 * @package ealain
 */

namespace Ealain\Ealain;

global $ealain_options;
?>

<nav id="site-navigation" class="navbar deafult-header navbar-expand-xl navbar-light p-0" aria-label="<?php esc_attr_e('Main menu', 'ealain'); ?>" <?php if (ealain()->is_amp()) { ?> [class]=" siteNavigationMenu.expanded ? 'main-navigation nav--toggle-sub nav--toggle-small nav--toggled-on' : 'main-navigation nav--toggle-sub nav--toggle-small' " <?php } ?>>

	<a class="navbar-brand" href="<?php echo esc_url(home_url('/')); ?>">
		<?php

		$ID =  get_queried_object_id();
		$isTest=true;
		if (class_exists('ReduxFramework')) {
			$is_yes = get_post_meta($ID, 'acf_key_header_switch', true);
			$acf_logo =	get_post_meta($ID, 'header_logo', true);
			if ($is_yes === 'yes' && !empty($acf_logo['url'])) {
				$options = $acf_logo['url'];
			} else if (isset($ealain_options['header_radio'])) {
				if ($ealain_options['header_radio'] == 1) {
					$logo_text = $ealain_options['header_text'];
					echo esc_html($logo_text);
					$isTest=false;
				}
				if ($ealain_options['header_radio'] == 2) {
					$options = $ealain_options['ealain_logo']['url'];
				}
			}
		}

		if ($isTest) {

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
				$logo_url = get_template_directory_uri() . '/assets/images/logo.svg';
				echo '<img class="img-fluid logo" src="' . esc_url($logo_url) . '" alt="ealain">';
			}
		} ?>
	</a>

	<div id="navbarSupportedContent" class="collapse navbar-collapse new-collapse justify-content-end">
		<div id="ealain-menu-container" class="menu-all-pages-container">
			<?php
			if (ealain()->is_primary_nav_menu_active()) {
				ealain()->display_primary_nav_menu(array(
					'menu_class' => 'sf-menu top-menu navbar-nav ml-auto',
					'menu_id' => 'ealain-arrow',
					'link_before' => '<span class="menu-line">',
                    'link_after' => '</span>',
					'item_spacing' => 'discard'
				));
			}
			?>
		</div>
	</div>
	<div class="ealain-header-right">
		<?php if (ealain()->is_primary_nav_menu_active()) { ?>
			<button class="navbar-toggler custom-toggler ham-toggle" type="button">
				<span class="menu-btn d-inline-block" id="menu-btn">
					<span class="line one"></span>
					<span class="line two"></span>
					<span class="line three"></span>
				</span>
			</button>
		<?php } ?>
	</div>
</nav><!-- #site-navigation -->