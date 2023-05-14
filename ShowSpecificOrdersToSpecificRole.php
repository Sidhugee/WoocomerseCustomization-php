add_action( 'pre_get_posts', 'show_waiting_orders_to_sales_users' );

function show_waiting_orders_to_sales_users( $query ) {

    // Check if current user has sales role and is on the orders page
    if ( current_user_can( 'sales' ) && $query->get( 'post_type' ) == 'shop_order' ) {

        // Show only orders with status 'pending payment'
        $query->set( 'post_status', 'wc-pending' );
    }
}
