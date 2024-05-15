<div class="modal fade" id="orderDetailsModal" tabindex="-1" role="dialog" aria-labelledby="orderDetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $('.view-order-details').click(function() {
            var orderDetails = $(this).data('order');
            var modalContent = '';

            // Extracting necessary information from the orderDetails object
            var diningOption = orderDetails.dining_option;
            var location = orderDetails.location + ' - ' + orderDetails.number;
            var customerName = orderDetails.customer ? orderDetails.customer.name : 'No Name';

            // Add customer name, dining option, and location above the table
            modalContent += '<p><strong>Customer Name:</strong> ' + customerName + '</p>';
            modalContent += '<p><strong>Dining Option:</strong> ' + diningOption + '</p>';
            modalContent += '<p><strong>Location:</strong> ' + location + '</p>';

            // Generate the table for order details
            modalContent += '<table class="table">';
            modalContent += '<thead><tr><th>Image</th><th>Quantity</th><th>Product</th><th>Price</th><th>Total</th></tr></thead>';
            modalContent += '<tbody>';

            // Loop through each order and display its details
            orderDetails.orders.forEach(function(order) {
                modalContent += '<tr>';
                modalContent += '<td><img src="' + order.product.image + '" alt="' + order.product.name + '" style="max-width: 100px;"></td>';
                modalContent += '<td>' + order.quantity + '</td>';
                modalContent += '<td>' + order.product.name + '</td>';
                modalContent += '<td>₱' + parseFloat(order.product.price).toFixed(2) + '</td>';
                modalContent += '<td>₱' + parseFloat(order.product.price * order.quantity).toFixed(2) + '</td>';
                modalContent += '</tr>';
            });

            modalContent += '</tbody></table>';

            // Set the modal content
            $('#orderDetailsContent').html(modalContent);
        });
    });
</script>
