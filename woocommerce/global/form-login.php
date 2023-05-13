<?php

/**
 * Login form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/global/form-login.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     3.6.0
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

if (is_user_logged_in()) {
	return;
}

?>
<form class="woocommerce-form woocommerce-form-login login" method="post">
	<div class="col-lg-6 mx-auto">
		<div class="ealain-login-form-wrapper">
			<?php do_action('woocommerce_login_form_start'); ?>

			<?php echo esc_html($message) ? wpautop(wptexturize($message)) : ''; // @codingStandardsIgnoreLine 
			?>
			<div class="row">
				<div class="col-lg-12">
					<p class="clearfix">
						<label for="username" class="mb-3"><?php esc_html_e('Username or email', 'ealain'); ?>&nbsp;<span class="required">*</span></label>
						<input type="text" class="input-text" name="username" id="username" autocomplete="username" />
					</p>
				</div>

				<div class="col-lg-12">
					<p class="clearfix">
						<label for="password" class="mb-3"><?php esc_html_e('Password', 'ealain'); ?>&nbsp;<span class="required">*</span></label>
						<input class="input-text" type="password" name="password" id="password" autocomplete="current-password" />
					</p>
				</div>

				<div class="clear"></div>

				<?php do_action('woocommerce_login_form'); ?>

				<div class="ealain-form-remember-wrapper">
					<div class="ealain-check">
						<label class="woocommerce-form__label woocommerce-form__label-for-checkbox woocommerce-form-login__rememberme">
							<input class="woocommerce-form__input woocommerce-form__input-checkbox" name="rememberme" type="checkbox" id="rememberme" value="forever" /><span class="checkmark"></span><span><span class="text-check"><?php esc_html_e('Remember me', 'ealain'); ?></span>
						</label>
					</div>
					<p class="lost_password">
						<a href="<?php echo esc_url(wp_lostpassword_url()); ?>"><?php esc_html_e('Lost your password?', 'ealain'); ?></a>
					</p>



				</div>
				<div class="clear"></div>
				<?php wp_nonce_field('woocommerce-login', 'woocommerce-login-nonce'); ?>
				<input type="hidden" name="redirect" value="<?php echo esc_url($redirect); ?>" />
                <?php $bgurl = get_template_directory_uri() . '/assets/images/redux/fish.webp'; ?>
				<div class="ealain-btn-container">
					<button type="submit" class="woocommerce-button ealain-button btn btn-hover woocommerce-form-login__submit" name="login" value="<?php esc_attr_e('Login', 'ealain'); ?>">
						<span class="wrap-btn">
							<span class="text-btn"><?php esc_html_e('Login', 'ealain'); ?></span>
							<span class="btn-img">
								<img src="<?php echo esc_url($bgurl); ?>" class="btn-icon" alt="<?php esc_attr_e('image','ealain'); ?>">
								<svg class="btn-shadow" width="23" height="3" viewBox="0 0 23 3" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M23 1.28564C19.2859 1.96041 15.5718 2.33997 11.7896 2.33997C7.8711 2.33997 3.91852 2.63518 0 2.38214C1.87407 1.20129 14.2089 0.273467 21.7393 0.526506C22.1482 0.526506 22.5911 0.695188 23 0.779535C23 0.9904 23 1.11695 23 1.28564Z" fill="#312660" fill-opacity="0.3"></path></svg>
							</span> 
						</span>
					</button>
				</div>

				<?php do_action('woocommerce_login_form_end'); ?>
			</div>
		</div>
	</div>
</form>