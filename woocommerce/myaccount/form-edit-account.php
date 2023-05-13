<?php
/**
 * Edit account form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-edit-account.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.0
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_edit_account_form' ); ?>

<form class="woocommerce-EditAccountForm edit-account" action="" method="post"
    <?php do_action( 'woocommerce_edit_account_form_tag' ); ?>>

    <?php do_action( 'woocommerce_edit_account_form_start' ); ?>

    <p class="woocommerce-form-row woocommerce-form-row--first form-row form-row-first">
        <label for="account_first_name"><?php esc_html_e( 'First name', 'ealain' ); ?>&nbsp;<span
                class="required">*</span></label>
        <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="account_first_name"
            id="account_first_name" autocomplete="given-name" value="<?php echo esc_attr( $user->first_name ); ?>" />
    </p>
    <p class="woocommerce-form-row woocommerce-form-row--last form-row form-row-last">
        <label for="account_last_name"><?php esc_html_e( 'Last name', 'ealain' ); ?>&nbsp;<span
                class="required">*</span></label>
        <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="account_last_name"
            id="account_last_name" autocomplete="family-name" value="<?php echo esc_attr( $user->last_name ); ?>" />
    </p>
    <div class="clear"></div>

    <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
        <label for="account_display_name"><?php esc_html_e( 'Display name', 'ealain' ); ?>&nbsp;<span
                class="required">*</span></label>
        <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="account_display_name"
            id="account_display_name" value="<?php echo esc_attr( $user->display_name ); ?>" />
        <span><em><?php esc_html_e( 'This will be how your name will be displayed in the account section and in reviews', 'ealain' ); ?></em></span>
    </p>
    <div class="clear"></div>

    <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
        <label for="account_email"><?php esc_html_e( 'Email address', 'ealain' ); ?>&nbsp;<span
                class="required">*</span></label>
        <input type="email" class="woocommerce-Input woocommerce-Input--email input-text" name="account_email"
            id="account_email" autocomplete="email" value="<?php echo esc_attr( $user->user_email ); ?>" />
    </p>

    <fieldset>
        <legend><?php esc_html_e( 'Password change', 'ealain' ); ?></legend>

        <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
            <label
                for="password_current"><?php esc_html_e( 'Current password (leave blank to leave unchanged)', 'ealain' ); ?></label>
            <input type="password" class="woocommerce-Input woocommerce-Input--password input-text"
                name="password_current" id="password_current" autocomplete="off" />
        </p>
        <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
            <label
                for="password_1"><?php esc_html_e( 'New password (leave blank to leave unchanged)', 'ealain' ); ?></label>
            <input type="password" class="woocommerce-Input woocommerce-Input--password input-text" name="password_1"
                id="password_1" autocomplete="off" />
        </p>
        <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
            <label for="password_2"><?php esc_html_e( 'Confirm new password', 'ealain' ); ?></label>
            <input type="password" class="woocommerce-Input woocommerce-Input--password input-text" name="password_2"
                id="password_2" autocomplete="off" />
        </p>
    </fieldset>
    <div class="clear"></div>

    <?php 
    do_action( 'woocommerce_edit_account_form' ); 
    $bgurl = get_template_directory_uri() . '/assets/images/redux/fish.webp'; ?>

    <p>
        <?php wp_nonce_field( 'save_account_details', 'save-account-details-nonce' ); ?>
		
        <!-- save changes button -->
        <div class="ealain-btn-container">
            <button type="submit" class="ealain-button btn btn-hover woocommerce-Button" name="save_account_details" value="<?php esc_attr_e( 'Save changes', 'ealain' ); ?>">
                <span class="wrap-btn">
                    <span class="text-btn"><?php esc_html_e( 'Save changes', 'ealain' ); ?></span>
                    <span class="btn-img">
                        <img src="<?php echo esc_url($bgurl); ?>" class="btn-icon" alt="<?php esc_attr_e('image','ealain'); ?>">
                        <svg class="btn-shadow" width="23" height="3" viewBox="0 0 23 3" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M23 1.28564C19.2859 1.96041 15.5718 2.33997 11.7896 2.33997C7.8711 2.33997 3.91852 2.63518 0 2.38214C1.87407 1.20129 14.2089 0.273467 21.7393 0.526506C22.1482 0.526506 22.5911 0.695188 23 0.779535C23 0.9904 23 1.11695 23 1.28564Z" fill="#312660" fill-opacity="0.3"></path></svg>
                    </span> 
                </span>
            </button>
        </div>

        <input type="hidden" name="action" value="save_account_details" />
    </p>
    <?php do_action( 'woocommerce_edit_account_form_end' ); ?>
</form>

<?php do_action( 'woocommerce_after_edit_account_form' ); ?>