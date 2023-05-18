add_action( 'admin_head', 'hide_non_pending_orders' );

function hide_non_pending_orders() {
    global $pagenow, $post_type;
    
    if ( $pagenow === 'edit.php' && $post_type === 'shop_order' ) {
        $args = array(
            'post_type'      => 'shop_order',
            'post_status'    => array( 'wc-pending' ),
            'posts_per_page' => -1,
            'fields'         => 'ids',
        );
        
        $pending_orders = get_posts( $args );
        
        $args = array(
            'post_type'      => 'shop_order',
            'post_status'    => array( 'wc-approved', 'wc-delivered', 'wc-out-for-delivery', 'wc-completed', 'wc-processing','wc-refunded', ),
            'posts_per_page' => -1,
            'fields'         => 'ids',
        );
        
        $non_pending_orders = get_posts( $args );
        
        if ( $pending_orders && $non_pending_orders ) {
            ?>
            <style>
                /* Add custom CSS to hide rows of non-pending orders */
                <?php foreach ( $non_pending_orders as $order_id ) : ?>
                    tr#post-<?php echo $order_id; ?> {
                      pointer-events: none !important;
                    }
                <?php endforeach; ?>
            </style>
            <?php
        }
    }
}
