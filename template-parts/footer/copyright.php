<?php

/**
 * Template part for displaying the footer info
 *
 * @package ealain
 */

namespace Ealain\Ealain;

$is_default_copyright = true;
if (class_exists("ReduxFramework")) {
	global $ealain_options ;
	if (isset($ealain_options['display_copyright']) && $ealain_options['display_copyright'] == 'no') {
		return;
	} else {
		$is_default_copyright = false;
	}
}
?>

<?php
if (!$is_default_copyright) {
?>
	<div class="copyright-footer">
		<div class="container">
			<div class="row">
				<div class="col-sm-12 m-0 text-<?php if(isset($ealain_options['footer_copyright_align'])){ echo esc_attr($ealain_options['footer_copyright_align']); } ?>">
					<div class="pt-3 pb-3">
						<?php if (!empty($ealain_options['footer_copyright'])) {  ?>
							<span class="copyright">
								<?php echo html_entity_decode($ealain_options['footer_copyright']); ?>
							</span>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</div><!-- .site-info -->
<?php } else { ?>
	<div class="copyright-footer">
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div class="pt-3 pb-3 text-center">
						<span class="copyright">
							<a target="_blank" href="<?php echo esc_url('https://themeforest.net/user/iqonicthemes/portfolio/'); ?>">
								<?php esc_html_e('© 2022', 'ealain'); ?>
								<strong><?php esc_html_e(' ealain ', 'ealain'); ?></strong>
								<?php esc_html_e('. All Rights Reserved.', 'ealain'); ?>
							</a>
						</span>
					</div>
				</div>
			</div>
		</div>
	</div><!-- .site-info -->
<?php } ?>