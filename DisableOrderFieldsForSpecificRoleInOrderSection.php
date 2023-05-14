function disable_fields_and_items_for_dispatcher_role($order) {
    // Check if the current user has the "dispatcher" role
    if (in_array('dispatcher', wp_get_current_user()->roles)) {
        ?>
        <script>
        jQuery(document).ready(function($) {
            // Disable all fields except the status dropdown
            $('#order_data .widefat .input-text, #order_data select').not('#order_status').prop('disabled', true);
            
            // Hide the order line items section with important
          
  $('#woocommerce-order-items .wc-order-data-row ').css('visibility', 'hidden');
  $('#woocommerce-order-items .woocommerce_order_items_wrapper table.woocommerce_order_items tbody .item_cost').css('visibility', 'hidden');
 $('#woocommerce-order-items .woocommerce_order_items_wrapper table.woocommerce_order_items tbody .line_cost').css('visibility', 'hidden');
        });
        </script>
        <?php
    }
}
add_action('woocommerce_admin_order_data_after_order_details', 'disable_fields_and_items_for_dispatcher_role');
