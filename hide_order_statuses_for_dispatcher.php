function hide_order_statuses_for_dispatcher($statuses) {
    $current_user = wp_get_current_user();
    if (in_array('dispatcher', $current_user->roles)) {
        $allowed_statuses = array(
            'wc-approved',
            'wc-out-for-delivery',
        );
        $filtered_statuses = array();
        foreach ($statuses as $status => $label) {
            if (in_array($status, $allowed_statuses)) {
                $filtered_statuses[$status] = $label;
            }
        }
        return $filtered_statuses;
    }
    return $statuses;
}
add_filter('wc_order_statuses', 'hide_order_statuses_for_dispatcher');
