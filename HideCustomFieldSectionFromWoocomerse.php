add_action( 'admin_head', 'hide_custom_field_section' );

function hide_custom_field_section() {
    // Check if we are on the WooCommerce order edit screen
    $screen = get_current_screen();
    if ( $screen && 'shop_order' === $screen->post_type ) {
        ?>
        <style>
            #postcustom { display: none; }
        </style>
        <?php
    }
}
