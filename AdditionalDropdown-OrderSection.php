// Add the custom dropdown field to the checkout page
add_action( 'woocommerce_before_checkout_billing_form', 'add_urgent_order_field_to_checkout' );
function add_urgent_order_field_to_checkout( $checkout ){
    echo '<div id="urgent_order_field"><h2>' . __("Order Type") . '</h2>
    <select name="urgent_order" id="urgent_order">
        <option value="normal">' . __("Normal Order") . '</option>
        <option value="urgent">' . __("Urgent Order") . '</option>
    </select>
    </div>';
}

// Save the custom dropdown field value in the order meta
add_action( 'woocommerce_checkout_create_order', 'save_urgent_order_field_from_checkout' );
function save_urgent_order_field_from_checkout( $order ){
    $urgent_order = isset( $_POST['urgent_order'] ) ? sanitize_text_field( $_POST['urgent_order'] ) : '';
    $order->update_meta_data( '_urgent_order', $urgent_order );
}

// Add the custom dropdown field to the order create/edit screen
add_action( 'woocommerce_admin_order_data_after_order_details', 'add_urgent_order_field_to_admin_order' );
function add_urgent_order_field_to_admin_order( $order ){
    $urgent_order = get_post_meta( $order->get_id(), '_urgent_order', true );
    echo '<p class="form-field form-field-wide"><label for="urgent_order">' . __("Order Type") . '</label>
        <select name="urgent_order" id="urgent_order">
            <option value="normal"' . ( $urgent_order == 'normal' ? ' selected' : '' ) . '>' . __("Normal Order") . '</option>
            <option value="urgent"' . ( $urgent_order == 'urgent' ? ' selected' : '' ) . '>' . __("Urgent Order") . '</option>
        </select>
    </p>';
}

// Save the custom dropdown field value in the order meta
add_action( 'woocommerce_process_shop_order_meta', 'save_urgent_order_field_from_admin_order', 10, 2 );
function save_urgent_order_field_from_admin_order( $order_id, $post_data ){
    $urgent_order = isset( $_POST['urgent_order'] ) ? sanitize_text_field( $_POST['urgent_order'] ) : '';
    update_post_meta( $order_id, '_urgent_order', $urgent_order );
}

// Show the custom dropdown field value in the order admin list table
add_filter( 'manage_edit-shop_order_columns', 'add_urgent_order_column_to_admin_order_list' );
function add_urgent_order_column_to_admin_order_list( $columns ){
    $new_columns = array();
    foreach ( $columns as $key => $value ) {
        $new_columns[$key] = $value;
        if ( $key == 'order_status' ) {
            $new_columns['urgent_order'] = __("Order Type");
        }
    }
    return $new_columns;
}

add_action( 'manage_shop_order_posts_custom_column', 'show_urgent_order_column_in_admin_order_list', 2 );
function show_urgent_order_column_in_admin_order_list( $column ){
    global $post;
    if ( $column == 'urgent_order' ) {
        $urgent_order = get_post_meta( $post->ID, '_urgent_order', true );
        echo ucfirst( $urgent_order );
    }
}




// This code will aid us how to add dropdown in order section. This field will also be saved when order will be saved.