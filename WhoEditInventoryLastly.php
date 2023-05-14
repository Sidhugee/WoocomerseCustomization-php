// Hide "Date" column
function hide_product_date_column( $columns ) {
    unset( $columns['date'] );
    return $columns;
}
add_filter( 'manage_edit-product_columns', 'hide_product_date_column' );

// Display "Last Update" column
function display_last_update_column( $columns ) {
    $columns['last-edit'] = 'Last Update';
    return $columns;
}
add_filter( 'manage_product_posts_columns', 'display_last_update_column' );

// Populate "Last Update" column with last updated date
function populate_last_update_column( $column, $post_id ) {
    if ( $column === 'last-edit' ) {
        $last_updated = get_the_modified_time( 'Y-m-d H:i:s', $post_id );
        echo $last_updated;
    }
}
add_action( 'manage_product_posts_custom_column', 'populate_last_update_column', 10, 2 );

// Make "Last Update" column sortable
function make_last_update_column_sortable( $columns ) {
    $columns['last-edit'] = 'post_modified';
    return $columns;
}
add_filter( 'manage_edit-product_sortable_columns', 'make_last_update_column_sortable' );
