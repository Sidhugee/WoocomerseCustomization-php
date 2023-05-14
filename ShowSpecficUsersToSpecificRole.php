function show_customers_to_sales_role( $query ) {
  global $pagenow, $post_type;

  // Check if we're on the Users page and the current user has the "sales" role
  if ( $pagenow == 'users.php' && current_user_can( 'sales' ) ) {

    // Set the role to "Customer" in the query to only show users with that role
    $query->set( 'role__in', array( 'customer' ) );
  }
}
add_action( 'pre_get_users', 'show_customers_to_sales_role' );
