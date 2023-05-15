function hide_columns_for_dispatcher($columns) {
    $current_user = wp_get_current_user();
    if ( in_array('dispatcher', $current_user->roles) ) {
        unset($columns['order_total']);
        unset($columns['wcchpo_previous_orders']);
    }
    return $columns;
}
add_filter('manage_edit-shop_order_columns', 'hide_columns_for_dispatcher', 999);
