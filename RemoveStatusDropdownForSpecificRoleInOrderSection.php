add_action( 'admin_footer', 'hide_order_status_dropdown' );

function hide_order_status_dropdown() {
    // Check if user has the "sales" role and is creating an order
    if ( in_array( 'sales', (array) wp_get_current_user()->roles ) && isset( $_GET['post_type'] ) && $_GET['post_type'] === 'shop_order' && !isset( $_GET['post'] ) ) {
        ?>
        <script>
            jQuery( document ).ready( function() {
                jQuery( '#order_status' ).closest( 'p' ).hide();
            } );
        </script>
        <?php
    }
}

add_action( 'woocommerce_admin_order_data_after_order_details', 'my_custom_order_status_dropdown' );

function my_custom_order_status_dropdown() {
    $user = wp_get_current_user();
    
    // Check if user has the "sales" role and is editing an order
    if ( in_array( 'sales', (array) $user->roles ) && isset( $_GET['post'] ) && get_post_type( $_GET['post'] ) === 'shop_order' ) {
        ?>
        <script>
            jQuery( document ).ready( function() {
                jQuery( '#order_status' ).closest( 'p' ).hide();
            } );
        </script>
        <?php
    }
}
