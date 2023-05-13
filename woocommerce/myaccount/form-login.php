<?php
/**
 * Login Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-login.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 4.1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

do_action( 'woocommerce_before_customer_login_form' ); ?>

<?php if ( get_option( 'woocommerce_enable_myaccount_registration' ) === 'yes' ) : ?>

<div class="u-columns col2-set row" id="customer_login">

    <div class="u-column1 col-lg-6">

        <?php endif; ?>
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <h5 class="ealain-wc-login-title"><?php esc_html_e( 'Login', 'ealain' ); ?></h5>

                <form class="woocommerce-form woocommerce-form-login login" method="post">

                    <?php do_action( 'woocommerce_login_form_start' ); ?>

                    <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                        <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username"
                            id="username" autocomplete="username"
                            placeholder="<?php echo esc_attr('Username or email address *','ealain'); ?>"
                            value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
                    </p>
                    <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                        <input class="woocommerce-Input woocommerce-Input--text input-text" type="password"
                            name="password" id="password" autocomplete="current-password"
                            placeholder="<?php echo esc_attr('Password *','ealain'); ?>" />
                    </p>

                    <?php do_action( 'woocommerce_login_form' ); ?>
                    <p class="woocommerce-form-row">
                        <div class="ealain-check">
                            <label class="woocommerce-form__label woocommerce-form__label-for-checkbox inline">
                                <input class="woocommerce-form__input woocommerce-form__input-checkbox" name="rememberme"
                                    type="checkbox" id="rememberme" value="forever" />
                                    <span class="checkmark"></span>
                                <span class="text-check"><?php esc_html_e( 'Remember me', 'ealain' ); ?></span>
                            </label>
                        </div>
                    </p>
                    <p class="form-row">
                        <?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>
                        <!-- login button -->
                        <?php $bgurl = get_template_directory_uri() . '/assets/images/redux/fish.webp'; ?>
                        <div class="ealain-btn-container">
                            <button type="submit" class="ealain-button btn btn-hover woocommerce-Button" name="login"
                                value="<?php esc_attr_e( 'Log in', 'ealain' ); ?>">
                                <span class="wrap-btn">
                                    <span class="text-btn"><?php esc_html_e( 'Log in', 'ealain' ); ?></span>
                                    <span class="btn-img">
                                        <img src="<?php echo esc_url($bgurl); ?>" class="btn-icon" alt="<?php esc_attr_e('image','ealain'); ?>">
                                        <svg class="btn-shadow" width="23" height="3" viewBox="0 0 23 3" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M23 1.28564C19.2859 1.96041 15.5718 2.33997 11.7896 2.33997C7.8711 2.33997 3.91852 2.63518 0 2.38214C1.87407 1.20129 14.2089 0.273467 21.7393 0.526506C22.1482 0.526506 22.5911 0.695188 23 0.779535C23 0.9904 23 1.11695 23 1.28564Z" fill="#312660" fill-opacity="0.3"></path></svg>
                                    </span> 
                                </span>
                            </button>
                        </div>
                    </p>
                    <p class="woocommerce-LostPassword lost_password">
                        <a
                            href="<?php echo esc_url( wp_lostpassword_url() ); ?>"><?php esc_html_e( 'Lost your password?', 'ealain' ); ?></a>
                    </p>

                    <?php do_action( 'woocommerce_login_form_end' ); ?>

                </form>
            </div>
        </div>
        <?php if ( get_option( 'woocommerce_enable_myaccount_registration' ) === 'yes' ) : ?>

    </div>

    <div class="u-column2 col-lg-6">

        <h5 class="ealain-wc-login-title"><?php esc_html_e( 'Register', 'ealain' ); ?></h5>

        <form method="post" class="woocommerce-form woocommerce-form-register register"
            <?php do_action( 'woocommerce_register_form_tag' ); ?>>

            <?php do_action( 'woocommerce_register_form_start' ); ?>

            <?php if ( 'no' === get_option( 'woocommerce_registration_generate_username' ) ) : ?>

            <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username"
                    id="reg_username" autocomplete="username"
                    placeholder="<?php echo esc_attr('Username *','ealain'); ?>"
                    value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
            </p>

            <?php endif; ?>

            <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                <input type="email" class="woocommerce-Input woocommerce-Input--text input-text" name="email"
                    id="reg_email" autocomplete="email"
                    placeholder="<?php echo esc_attr('Email address *','ealain'); ?>"
                    value="<?php echo ( ! empty( $_POST['email'] ) ) ? esc_attr( wp_unslash( $_POST['email'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
            </p>

            <?php if ( 'no' === get_option( 'woocommerce_registration_generate_password' ) ) : ?>

            <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                <input type="password" class="woocommerce-Input woocommerce-Input--text input-text" name="password"
                    id="reg_password" autocomplete="new-password"
                    placeholder="<?php echo esc_attr('Password *','ealain'); ?>" />
            </p>

            <?php endif; ?>

            <?php do_action( 'woocommerce_register_form' ); ?>

            <p class="woocommerce-FormRow form-row">
                <?php wp_nonce_field( 'woocommerce-register', 'woocommerce-register-nonce' ); ?>
                <!-- register button  -->
                <?php $bgurl = get_template_directory_uri() . '/assets/images/redux/fish.webp'; ?>
                <div class="ealain-btn-container">
                    <button type="submit" class="ealain-button btn btn-hover woocommerce-Button" name="register"
                        value="<?php esc_attr_e( 'Register', 'ealain' ); ?>">
                        <span class="wrap-btn">
                        <span class="text-btn"><?php esc_html_e( 'Register', 'ealain' ); ?></span>
                        <span class="btn-img">
                            <img src="<?php echo esc_url($bgurl); ?>" class="btn-icon" alt="<?php esc_attr_e('image','ealain'); ?>">
                            <svg class="btn-shadow" width="23" height="3" viewBox="0 0 23 3" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M23 1.28564C19.2859 1.96041 15.5718 2.33997 11.7896 2.33997C7.8711 2.33997 3.91852 2.63518 0 2.38214C1.87407 1.20129 14.2089 0.273467 21.7393 0.526506C22.1482 0.526506 22.5911 0.695188 23 0.779535C23 0.9904 23 1.11695 23 1.28564Z" fill="#312660" fill-opacity="0.3"></path></svg>
                        </span> 
                    </span>
                    </button>
                </div>
            </p>

            <?php do_action( 'woocommerce_register_form_end' ); ?>

        </form>

    </div>

</div>
<?php endif; ?>

<?php do_action( 'woocommerce_after_customer_login_form' );