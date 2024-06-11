<div class="modal fade" id="orderDetailsModal" tabindex="-1" role="dialog" aria-labelledby="orderDetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="orderDetailsModalLabel">Order Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="orderDetailsContent">
                    <!-- Order details will be displayed here -->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function() {
        // Assuming outlet_id is available globally or can be fetched
        var outlet_id = {{ $loginData['user']['assign_to_outlet'] }};
        // var fnb = "{{ $loginData['user']['username'] }}";


        $('.view-order-details').click(function() {
            var orderDetails = $(this).data('order');
            var filteredOrders = orderDetails.orders.filter(order => order.outlet_id === outlet_id);
            var modalContent = '';

            // Check if there are any orders for the current outlet
            if (filteredOrders.length > 0) {
                // Extracting necessary information from the orderDetails object
                var diningOption = orderDetails.dining_option;
                var location = orderDetails.number ? orderDetails.location + ' - ' + orderDetails.number : 'N/A';
                var customerName = orderDetails.customer ? orderDetails.customer.name : 'No Name';

                // Add customer name, dining option, and location above the table
                modalContent += '<p><strong>Customer Name:</strong> ' + customerName + '</p>';
                modalContent += '<p><strong>Dining Option:</strong> ' + diningOption + '</p>';
                modalContent += '<p><strong>Location:</strong> ' + location + '</p>';

                // Generate the table for order details
                modalContent += '<table class="table">';
                modalContent += '<thead><tr><th>Image</th><th>Quantity</th><th>Outlet</th><th>Product</th><th>Price</th><th>Total</th></tr></thead>';
                modalContent += '<tbody>';

                // Loop through each filtered order and display its details
                filteredOrders.forEach(function(order) {
                    modalContent += '<tr>';
                    modalContent += '<td><img src="' + order.product.image + '" alt="' + order.product.name + '" style="max-width: 100px;"></td>';
                    modalContent += '<td>' + order.quantity + '</td>';
                    modalContent += '<td><img src="' + order.outlet.image + '" alt="' + order.outlet.name + '" style="max-width: 60px;"></td>';
                    modalContent += '<td>' + order.product.name + '</td>';
                    modalContent += '<td>₱' + parseFloat(order.product.price).toFixed(2) + '</td>';
                    modalContent += '<td>₱' + parseFloat(order.product.price * order.quantity).toFixed(2) + '</td>';
                    modalContent += '</tr>';
                });

                modalContent += '</tbody></table>';
            }
            else if(filteredOrders.length == 0)
            {
                var diningOption = orderDetails.dining_option;
                var location = orderDetails.number ? orderDetails.location + ' - ' + orderDetails.number : 'N/A';
                var customerName = orderDetails.customer ? orderDetails.customer.name : 'No Name';

                // Add customer name, dining option, and location above the table
                modalContent += '<p><strong>Customer Name:</strong> ' + customerName + '</p>';
                modalContent += '<p><strong>Dining Option:</strong> ' + diningOption + '</p>';
                modalContent += '<p><strong>Location:</strong> ' + location + '</p>';

                // Generate the table for order details
                modalContent += '<table class="table">';
                modalContent += '<thead><tr><th>Image</th><th>Quantity</th><th>Outlet</th><th>Product</th><th>Price</th><th>Total</th></tr></thead>';
                modalContent += '<tbody>';

                // Loop through each filtered order and display its details
                orderDetails.orders.forEach(function(order) {
                    modalContent += '<tr>';
                    modalContent += '<td><img src="' + order.product.image + '" alt="' + order.product.name + '" style="max-width: 100px;"></td>';
                    modalContent += '<td>' + order.quantity + '</td>';
                    modalContent += '<td><img src="' + order.outlet.image + '" alt="' + order.outlet.name + '" style="max-width: 60px;"></td>';
                    modalContent += '<td>' + order.product.name + '</td>';
                    modalContent += '<td>₱' + parseFloat(order.product.price).toFixed(2) + '</td>';
                    modalContent += '<td>₱' + parseFloat(order.product.price * order.quantity).toFixed(2) + '</td>';
                    modalContent += '</tr>';
                });

                modalContent += '</tbody></table>';
            }
            else {
                modalContent += '<p>No orders available for this outlet.</p>';
            }

            // Set the modal content
            $('#orderDetailsContent').html(modalContent);
        });
    });
</script>
