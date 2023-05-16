add_action('woocommerce_admin_order_totals_after_total', 'add_amount_received_field');
function add_amount_received_field() {
    $order_id = isset($_GET['post']) ? intval($_GET['post']) : 0;
    $amount_received = get_post_meta($order_id, 'amount_received', true);
    $order_total = wc_get_order($order_id)->get_total();
    ?>
    <tr class="amount_received">
        <td class="label">
            <label for="amount_received"><?php _e('Amount Received', 'text-domain'); ?></label>
        </td>
        <td class="total">
            <input type="number" step="0.01" min="0" id="amount_received" name="amount_received" value="<?php echo esc_attr($amount_received); ?>" class="input-text wc_input_price" placeholder="<?php _e('Amount received', 'text-domain'); ?>" onchange="calculateRemainingBalance(this.value, '<?php echo esc_js($order_total); ?>')">
        </td>
    </tr>
    <script>
    function calculateRemainingBalance(amountReceived, orderTotal) {
        const remainingBalance = parseInt(orderTotal) - parseInt(amountReceived);
        if (!isNaN(remainingBalance)) {
            const totalElement = document.querySelector('.wc-order-totals .total .amount bdi');
            totalElement.textContent = '₨ ' + remainingBalance;
        }
    }
    </script>
    <?php
}

add_action('woocommerce_process_shop_order_meta', 'save_amount_received_field');
function save_amount_received_field($order_id) {
    $amount_received = isset($_POST['amount_received']) ? wc_clean($_POST['amount_received']) : '';
    update_post_meta($order_id, 'amount_received', $amount_received);
}
