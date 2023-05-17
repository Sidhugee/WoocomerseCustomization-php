function display_custom_orders_page() {
    echo '<div class="wrap">';
    echo '<h1>All Orders</h1>';

    // Retrieve all orders
    $orders = wc_get_orders( array(
        'status' => array( 'wc-pending', 'wc-processing', 'wc-on-hold', 'wc-completed', 'wc-cancelled', 'wc-refunded' ),
        'limit' => -1,
    ) );

    // Output the order data
    if ( $orders ) {
        echo '<ul>';
        foreach ( $orders as $order ) {
            $order_id = $order->get_id();
            $order_status = $order->get_status();
            $order_total = $order->get_formatted_order_total();
            $order_date = $order->get_date_created()->format( 'Y-m-d H:i:s' );

            echo "<li>Order ID: $order_id | Status: $order_status | Total: $order_total | Date: $order_date</li>";
        }
        echo '</ul>';
    } else {
        echo 'No orders found.';
    }

    echo '</div>';
}

add_action( 'admin_menu', 'register_custom_orders_page' );
function register_custom_orders_page() {
    add_menu_page(
        'Custom Orders', // Page title
        'Custom Orders', // Menu title
        'manage_options', // Capability required
        'custom-orders', // Menu slug
        'display_custom_orders_page', // Callback function
        'dashicons-clipboard', // Icon
        26 // Position
    );
}
