// Add custom fields to order create and edit screens

add_action( 'woocommerce_admin_order_data_after_billing_address', 'add_custom_order_fields' );
function add_custom_order_fields( $order ) {
    echo '<div class="order_additional_fields">';
   
    woocommerce_form_field( 'additional_details', array(
        'type'        => 'textarea',
        'class'       => array( 'form-row-wide' ),
        'label'       => __( 'Additional Details', 'woocommerce' ),
        'placeholder' => '',
    ), $order->get_meta( 'additional_details' ) );
    echo '</div>';
}

// Save custom fields when order is saved
add_action( 'woocommerce_process_shop_order_meta', 'save_custom_order_fields', 10, 2 );
function save_custom_order_fields( $post_id, $post ) {
    
    if ( isset( $_POST['additional_details'] ) ) {
        $additional_details = wc_clean( $_POST['additional_details'] );
        update_post_meta( $post_id, 'additional_details', $additional_details );
    }
}


// This code will aid us how to add additional fields in order section. This field will also be saved when order will be saved.