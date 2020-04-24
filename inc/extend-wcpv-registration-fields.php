<?php 
/**
 * Vendor Extended Registration Form Template
 *
 * @version 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
/**
* Register term fields
*/
add_action( 'init', 'register_vendor_custom_fields' );
function register_vendor_custom_fields() {
add_action( WC_PRODUCT_VENDORS_TAXONOMY . '_add_form_fields', 'add_vendor_custom_fields' );
add_action( WC_PRODUCT_VENDORS_TAXONOMY . '_edit_form_fields', 'edit_vendor_custom_fields', 10 );
add_action( 'edited_' . WC_PRODUCT_VENDORS_TAXONOMY, 'save_vendor_custom_fields' );
add_action( 'created_' . WC_PRODUCT_VENDORS_TAXONOMY, 'save_vendor_custom_fields' );
}

/**
* Add term fields form
*/
function add_vendor_custom_fields() {
    wp_nonce_field( basename( __FILE__ ), 'vendor_custom_fields_nonce' );
    ?>
<div class="form-field">
    <label for="companyname"><?php _e( 'Legal name of your company', 'domain' ); ?></label>
    <input type="text" name="companyname" id="companyname" value="" />
    </div>

    <div class="form-field">
    <label for="taxid"><?php _e( 'Tax ID', 'domain' ); ?> <span class="required">*</span></label>
    <input type="text" name="taxid" id="taxid" value="" />
    </div>

    <div class="form-field">
    <label for="facebook"><?php _e( 'Facebook', 'domain' ); ?></label>
    <input type="url" name="facebook" id="facebook" value="" />
    </div>

    <div class="form-field">
    <label for="twitter"><?php _e( 'Twitter', 'domain' ); ?></label>
    <input type="url" name="twitter" id="twitter" value="" />
    </div>

    <div class="form-field">
    <label for="vendoraddress"><?php _e( 'Address', 'domain' ); ?></label>
    <input type="text" name="vendoraddress" id="vendoraddress" value="" />
    </div>

    <div class="form-field">
		<label for="termsandconditions"><?php _e( 'I HAVE READ AND AGREE TO THE TERMS AND CONDITIONS', 'domain' ); ?><span class="required">*</span></label>
		<input type="checkbox" name="termsandconditions" id="termsandconditions" value="" />
	</div>

    <?php
}

/**
* Edit term fields form
*/
function edit_vendor_custom_fields( $term ) {
    wp_nonce_field( basename( __FILE__ ), 'vendor_custom_fields_nonce' );
    ?>
    <tr class="form-field">
    <th scope="row" valign="top"><label for="companyname"><?php _e( 'Company name', 'domain' ); ?></label></th>
    <td>
    <input type="text" name="companyname" id="companyname" 
        value="<?php echo esc_attr( get_term_meta( $term->term_id, 'companyname', true ) ); ?>" />
    </td>
    </tr>

    <tr class="form-field">
    <th scope="row" valign="top"><label for="taxid"><?php _e( 'Tax id', 'domain' ); ?></label></th>
    <td>
    <input type="text" name="taxid" id="taxid" 
        value="<?php echo esc_attr( get_term_meta( $term->term_id, 'taxid', true ) ); ?>" />
    </td>
    </tr>

    <tr class="form-field">
    <th scope="row" valign="top"><label for="facebook"><?php _e( 'Facebook', 'domain' ); ?></label></th>
    <td>
    <input type="url" name="facebook" id="facebook" 
        value="<?php echo esc_url( get_term_meta( $term->term_id, 'facebook', true ) ); ?>" />
    </td>
    </tr>
    <tr class="form-field">
    <th scope="row" valign="top"><label for="twitter"><?php _e( 'Twitter', 'domain' ); ?></label></th>
    <td>
    <input type="url" name="twitter" id="twitter" 
        value="<?php echo esc_url( get_term_meta( $term->term_id, 'twitter', true ) ); ?>" />
    </td>
    </tr>

    <tr class="form-field">
    <th scope="row" valign="top"><label for="vendoraddress"><?php _e( 'Vendor address', 'domain' ); ?></label></th>
    <td>
    <input type="text" name="vendoraddress" id="vendoraddress" 
        value="<?php echo esc_attr( get_term_meta( $term->term_id, 'vendoraddress', true ) ); ?>" />
    </td>
    </tr>
    <?php
}

/**
* Save term fields
*/
function save_vendor_custom_fields( $term_id ) {
if ( ! wp_verify_nonce( $_POST['vendor_custom_fields_nonce'], basename( __FILE__ ) ) ) {
return;
}
$old_cn = get_term_meta( $term_id, 'companyname', true );
$old_ti = get_term_meta( $term_id, 'taxid', true );
$new_cn = esc_attr( $_POST['companyname'] );
$new_ti = esc_attr( $_POST['taxid'] );

$old_fb = get_term_meta( $term_id, 'facebook', true );
$old_tw = get_term_meta( $term_id, 'twitter', true );
$new_fb = esc_url( $_POST['facebook'] );
$new_tw = esc_url( $_POST['twitter'] );

$old_va = get_term_meta( $term_id, 'vendoraddress', true );
$new_va = esc_attr( $_POST['vendoraddress'] );

if ( ! empty( $old_cn ) && $new_cn === '' ) {
    delete_term_meta( $term_id, 'companyname' );
    } else if ( $old_cn !== $new_cn ) {
    update_term_meta( $term_id, 'companyname', $new_cn, $old_cn );
}
if ( ! empty( $old_ti ) && $new_ti === '' ) {
    delete_term_meta( $term_id, 'taxid' );
    } else if ( $old_ti !== $new_ti ) {
    update_term_meta( $term_id, 'taxid', $new_ti, $old_ti );
}

if ( ! empty( $old_fb ) && $new_fb === '' ) {
    delete_term_meta( $term_id, 'facebook' );
    } else if ( $old_fb !== $new_fb ) {
    update_term_meta( $term_id, 'facebook', $new_fb, $old_fb );
}
if ( ! empty( $old_tw ) && $new_tw === '' ) {
    delete_term_meta( $term_id, 'twitter' );
    } else if ( $old_tw !== $new_tw ) {
    update_term_meta( $term_id, 'twitter', $new_tw, $old_tw );
}
if ( ! empty( $old_va ) && $new_va === '' ) {
    delete_term_meta( $term_id, 'vendoraddress' );
    } else if ( $old_va !== $new_va ) {
    update_term_meta( $term_id, 'vendoraddress', $new_va, $old_va );
}
}
/**
 * Registration form fields
 * 
 */
add_action( 'wcpv_registration_form', 'vendors_reg_custom_fields' );
function vendors_reg_custom_fields() {
?>
<p class="form-row form-row-first">
<label for="wcpv-companyname"><?php esc_html_e( 'Company name', 'domain' ); ?></label>
<input type="text" class="input-text" name="companyname" id="wcpv-companyname" 
    value="<?php if ( ! empty( $_POST['companyname'] ) ) 
                        echo esc_attr( trim( $_POST['companyname'] ) ); ?>" />
</p>
<p class="form-row form-row-last">
<label for="wcpv-taxid"><?php esc_html_e( 'Tax id', 'domain' ); ?></label>
<input type="text" class="input-text" name="taxid" id="wcpv-taxid" 
    value="<?php if ( ! empty( $_POST['taxid'] ) ) 
                        echo esc_attr( trim( $_POST['taxid'] ) ); ?>" />
</p>

<p class="form-row form-row-first">
<label for="wcpv-facebook"><?php esc_html_e( 'Facebook', 'domain' ); ?></label>
<input type="text" class="input-text" name="facebook" id="wcpv-facebook" 
    value="<?php if ( ! empty( $_POST['facebook'] ) ) 
                        echo esc_url( trim( $_POST['facebook'] ) ); ?>" />
</p>
<p class="form-row form-row-last">
<label for="wcpv-twitter"><?php esc_html_e( 'Twitter', 'woocommerce-product-vendors' ); ?></label>
<input type="text" class="input-text" name="twitter" id="wcpv-twitter" 
    value="<?php if ( ! empty( $_POST['twitter'] ) ) 
                        echo esc_url( trim( $_POST['twitter'] ) ); ?>" />
</p>

<p class="form-row">
<label for="wcpv-vendoraddress"><?php esc_html_e( 'Vendor address', 'domain' ); ?></label>
<input type="text" class="input-text" name="vendoraddress" id="wcpv-vendoraddress" 
    value="<?php if ( ! empty( $_POST['vendoraddress'] ) ) 
                        echo esc_attr( trim( $_POST['vendoraddress'] ) ); ?>" />
</p>

<p class="form-row">
		<label for="wcpv-termsandconditions"></label>
		<input type="checkbox" name="termsandconditions" id="wcpv-termsandconditions" 
        value="1" <?php if($_POST['termsandconditions'] == 1): ?> 
        checked <?php endif; ?> /> By signing up, you agree to Nilusfit.com <a href="/vendor-agreement/" 
        target="__blank">Terms of Use</a>
	</p>
    <p class="form-row form-row-last"><?php // captcha shortcode ?></p>
<?php
}

add_action( 'wcpv_shortcode_registration_form_process', 'vendors_reg_custom_fields_save', 10, 2 );
function vendors_reg_custom_fields_save( $args, $items ) {
    $term = get_term_by( 'name', $items['vendor_name'], WC_PRODUCT_VENDORS_TAXONOMY );

    if ( isset( $items['companyname'] ) && ! empty( $items['companyname'] ) ) {
        $cn = esc_attr( $items['companyname'] );
        update_term_meta( $term->term_id, 'companyname', $cn );
    }
    if ( isset( $items['taxid'] ) && ! empty( $items['taxid'] ) ) {
        $ti = esc_attr( $items['taxid'] );
        update_term_meta( $term->term_id, 'taxid', $ti );
    }
    if ( isset( $items['facebook'] ) && ! empty( $items['facebook'] ) ) {
        $fb = esc_url( $items['facebook'] );
        update_term_meta( $term->term_id, 'facebook', $fb );
    }
    if ( isset( $items['twitter'] ) && ! empty( $items['twitter'] ) ) {
        $tw = esc_url( $items['twitter'] );
        update_term_meta( $term->term_id, 'twitter', $tw );
    }
    if ( isset( $items['vendoraddress'] ) && ! empty( $items['vendoraddress'] ) ) {
        $vendoraddress = esc_attr( $items['vendoraddress'] );
        update_term_meta( $term->term_id, 'vendoraddress', $vendoraddress );
    }
}
add_action( 'wcpv_shortcode_registration_form_validation', 'custom_vendors_validation', 10, 2);
function custom_vendors_validation( $errors, $form_items ) {
	if ( empty( $form_items['termsandconditions'] ) ) {
        $errors[] = __( 'Terms of Use is a required checkbox.' );
        wp_send_json( array( 'errors' => $errors ) );
    } else {
    	return true;
    }
}
/**
 * register_new_user() function inserts new user into WordPress database.
 * user_register can be fired anytime a new user is created
 * from <form class="wcpv-shortcode-registration-form" wcpv-email
 * to term.php?taxonomy=wcpv_product_vendors&tag_ID= 
*/
//A6 extend_wcpv_custom_populate_vendor_field
//maybe use add_action( 'wcpv_registration_form_end', '...' );
add_action( 'wcpv_registration_form_end', 'extend_wcpv_custom_populate_vendor_field' );
function extend_wcpv_custom_populate_vendor_field($term_id)
{
    $user_info   = get_userdata($user_id);
    $data   = $user_info->facebook;
    $user_id       = $user_info->ID;
    $vendor_data    = get_terms( $user_id, 'wcpv_product_vendors' );
    $old_vendor_data = $vendor_data['facebook'];
    $new_vendor_data  = wp_kses_post( stripslashes( $data ) );
    //update terms
    if( ! empty( $old_vendor_data ) && $new_vendor_data === '' ) {
        delete_term_meta( $term_id, 'facebook' );
    } else if ( $old_vendor_data !== $new_vendor_data ) {
        update_term_meta( $term_id, 'vendor_data', 
                          $new_vendor_data, $old_vendor_data );
    }
}