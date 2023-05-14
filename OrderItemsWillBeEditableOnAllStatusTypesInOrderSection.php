function allow_order_edit_any_status( $statuses ) {
    return array_keys( wc_get_order_statuses() );
}
add_filter( 'wc_order_is_editable', 'allow_order_edit_any_status', 999, 1 );
