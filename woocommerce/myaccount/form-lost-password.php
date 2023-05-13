<?php
/**
 * Lost password form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-lost-password.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.2
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_lost_password_form' );
?>

<form method="post" class="woocommerce-ResetPassword lost_reset_password">

    <p><?php echo apply_filters( 'woocommerce_lost_password_message', esc_html__( 'Lost your password? Please enter your username or email address. You will receive a link to create a new password via email.', 'ealain' ) ); ?>
    </p><?php // @codingStandardsIgnoreLine ?>

    <p class="woocommerce-form-row woocommerce-form-row--first form-row form-row-first">
        <input class="woocommerce-Input woocommerce-Input--text input-text"  type="text" name="user_login"
            id="user_login" placeholder="<?php echo esc_attr('Enter Username or Email*','ealain'); ?>" autocomplete="username" />
    </p>

    <div class="clear"></div>

    <?php do_action( 'woocommerce_lostpassword_form' ); ?>

    <p class="woocommerce-form-row form-row">
        <input type="hidden" name="wc_reset_password" value="true" />
        <!-- reset password button -->
        <?php $bgurl = get_template_directory_uri() . '/assets/images/redux/fish.webp'; ?>
        <div class="ealain-btn-container">
            <button type="submit" class="ealain-button btn btn-hover woocommerce-Button" value="<?php esc_attr_e( 'Reset password', 'ealain' ); ?>">
                <span class="wrap-btn">
                    <span class="text-btn"><?php esc_html_e( 'Reset password', 'ealain' ); ?></span>
                    <span class="btn-img">
                        <img src="<?php echo esc_url($bgurl); ?>" class="btn-icon" alt="<?php esc_attr_e('image','ealain'); ?>">
                        <svg class="btn-shadow" width="23" height="3" viewBox="0 0 23 3" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M23 1.28564C19.2859 1.96041 15.5718 2.33997 11.7896 2.33997C7.8711 2.33997 3.91852 2.63518 0 2.38214C1.87407 1.20129 14.2089 0.273467 21.7393 0.526506C22.1482 0.526506 22.5911 0.695188 23 0.779535C23 0.9904 23 1.11695 23 1.28564Z" fill="#312660" fill-opacity="0.3"></path></svg>
                    </span> 
                </span>
            </button>
        </div>
    </p>

    <?php wp_nonce_field( 'lost_password', 'woocommerce-lost-password-nonce' ); ?>

</form>
<?php
do_action( 'woocommerce_after_lost_password_form' );