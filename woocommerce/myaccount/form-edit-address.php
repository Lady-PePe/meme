<?php
/**
 * Edit address form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-edit-address.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

$page_title = ( 'billing' === $load_address ) ? esc_html__( 'Billing address', 'ealain' ) : esc_html__( 'Shipping address', 'ealain' );

do_action( 'woocommerce_before_edit_account_address_form' ); ?>

<?php if ( ! $load_address ) : ?>
<?php wc_get_template( 'myaccount/my-address.php' ); ?>
<?php else : ?>

<form method="post">

    <h3><?php echo apply_filters( 'woocommerce_my_account_edit_address_title', $page_title, $load_address ); ?></h3>
    <?php // @codingStandardsIgnoreLine ?>

    <div class="woocommerce-address-fields">
        <?php do_action( "woocommerce_before_edit_address_form_{$load_address}" ); ?>

        <div class="woocommerce-address-fields__field-wrapper">
            <?php
				foreach ( $address as $key => $field ) {
					woocommerce_form_field( $key, $field, wc_get_post_data_by_key( $key, $field['value'] ) );
				}
				?>
        </div>

        <?php 
        do_action( "woocommerce_after_edit_address_form_{$load_address}" ); 
        $bgurl = get_template_directory_uri() . '/assets/images/redux/fish.webp';  ?>

        <p>
            <div class="ealain-btn-container">
                <button type="submit" class="ealain-button btn btn-hover" name="save_address"
                    value="<?php esc_attr_e( 'Save Address', 'ealain' ); ?>">
                    <span class="wrap-btn">
                        <span class="text-btn"><?php esc_html_e( 'Save Address', 'ealain' ); ?></span>
                        <span class="btn-img">
                            <img src="<?php echo esc_url($bgurl); ?>" class="btn-icon" alt="<?php esc_attr_e('image','ealain'); ?>">
                            <svg class="btn-shadow" width="23" height="3" viewBox="0 0 23 3" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M23 1.28564C19.2859 1.96041 15.5718 2.33997 11.7896 2.33997C7.8711 2.33997 3.91852 2.63518 0 2.38214C1.87407 1.20129 14.2089 0.273467 21.7393 0.526506C22.1482 0.526506 22.5911 0.695188 23 0.779535C23 0.9904 23 1.11695 23 1.28564Z" fill="#312660" fill-opacity="0.3"></path></svg>
                        </span> 
                    </span>
                </button>
            </div>
            <?php wp_nonce_field( 'woocommerce-edit_address', 'woocommerce-edit-address-nonce' ); ?>
            <input type="hidden" name="action" value="edit_address" />
        </p>
    </div>

</form>

<?php endif; ?>

<?php do_action( 'woocommerce_after_edit_account_address_form' ); ?>