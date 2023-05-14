// Remove email field from billing address in WooCommerce
add_filter( 'woocommerce_checkout_fields' , 'remove_billing_email_field' );
function remove_billing_email_field( $fields ) {
    unset($fields['billing']['billing_email']);
    return $fields;
}


// This code will remove email fields from checkout section in woocommerse