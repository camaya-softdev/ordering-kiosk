{{-- <input type="hidden" id="latestOrderId" value="{{ $latestOrderId }}"> --}}
<style>
 .orderTable th {
        font-weight: lighter !important;
    }
</style>
<table id="orderTable" class="orderTable table table-bordered table-hover custom-table">
    <thead>
        <tr>
            <th style="width: 15%">Order Number</th>
            <th style="width: 15%">Payment Method</th>
            <th style="width: 15%">Status</th>
            <th style="width: 10%">Total</th>
            <th style="width: 20%">Order Detail</th>
            <th style="width: 20%">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($orders as $order_details)
        <tr data-order-id="{{ $order_details->id }}">
            <td style="font-weight: bold">
               #{{ $order_details->id }} <br>
            </td>
            <td>
                {{ $order_details->payment_method }}
            </td>
            <td>
                {{ $order_details->status }}
            </td>
            <td>
                @php
                    $total = $order_details->orders->sum(function ($order) {
                        return $order->product->price * $order->quantity;
                    });
                @endphp
                ₱{{ $total }}
            </td>
            <td>
                <button class="btn btn-warning text-light view-order-details" data-toggle="modal" data-target="#orderDetailsModal" data-order="{{ $order_details }}">View Order Details</button>
            </td>
            <td>
                <button class="btn btn-secondary text-light" data-toggle="modal" data-target="#changeStatusModal{{ $order_details->id }}">Change Status</button>
                @include('partials.modal.restaurant.updateOrderStatus')
            </td>



        </tr>
        @endforeach
    </tbody>
</table>


{{-- Order Details Modal Template --}}
<div class="modal fade order-details-modal-template" id="orderDetailsModalTemplate" tabindex="-1" role="dialog" aria-labelledby="orderDetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="orderDetailsModalLabel">Order Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="order-details-content">
                    <!-- Order details will be displayed here -->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Change Status Modal Template -->
<div class="modal fade change-status-modal-template" id="changeStatusModalTemplate" tabindex="-1" role="dialog" aria-labelledby="changeStatusModalLabelTemplate" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="changeStatusModalLabelTemplate">Change Status</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Form inside the modal -->
                <form method="POST" action="#" class="change-status-form">
                    @csrf
                    <input type="hidden" name="orderId" class="order-id-input">
                    <div class="form-group">
                        <label for="statusSelect">Select Status:</label>
                        <select class="form-control" name="status">
                            <option value="pending">Pending</option>
                            <option value="confirmed">Confirmed</option>
                            <option value="cancelled">Cancelled</option>
                            <option value="voided">Voided</option>
                            <option value="completed">Completed</option>
                            <option value="No Show">No Show</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


<script>

    let existingOrderIds = new Set($('tr[data-order-id]').map(function() { return $(this).data('order-id'); }).get());


    function fetchLatestOrderData(outletId) {
        $.ajax({
            url: '/api/latest-order-data',
            method: 'GET',
            data: {
                outlet_id: outletId
            },
            success: function(response) {
                // Update the table with the latest order data
                updateTable(response.latestOrderId);
            },
            error: function(xhr, status, error) {
                console.error('Error fetching latest order data:', error);
            }
        });
    }

    function calculateTotal(orders) {
        let total = 0;
        orders.forEach(order => {
            total += order.product.price * order.quantity;
        });
        return total.toFixed(2);
    }

    function updateTable(latestOrders) {
    latestOrders.forEach(orderDetails => {
        // Check if the order already exists
        if (!existingOrderIds.has(orderDetails.id)) {
            const total = calculateTotal(orderDetails.orders);
            const newRow = `
                <tr data-order-id="${orderDetails.id}">
                    <td style="font-weight: bold">#${orderDetails.id}</td>
                    <td>${orderDetails.payment_method}</td>
                    <td>${orderDetails.status}</td>
                    <td>₱${total}</td>
                    <td>
                        <button class="btn btn-warning text-light view-order-details" data-toggle="modal" data-target="#orderDetailsModal${orderDetails.id}" data-order='${JSON.stringify(orderDetails)}'>View Order Details</button>
                    </td>
                    <td>
                        <button class="btn btn-secondary text-light" data-toggle="modal" data-target="#changeStatusModal${orderDetails.id}">Change Status</button>
                    </td>
                </tr>
            `;

            $('#orderTable tbody').prepend(newRow);

            // Create a new modal for the new order
            createOrderDetailsModal(orderDetails);
            createChangeStatusModal(orderDetails);

            // Add the new order ID to the set of existing order IDs
            existingOrderIds.add(orderDetails.id);
        }
    });
}



    function createOrderDetailsModal(orderDetails) {
        // Clone the template
        const modalTemplate = $('#orderDetailsModalTemplate').clone();
        const modalId = `orderDetailsModal${orderDetails.id}`;
        modalTemplate.attr('id', modalId);
        modalTemplate.find('.view-order-details').data('order', orderDetails);
        modalTemplate.find('.modal-title').text(`Order Details #${orderDetails.id}`);

        // Populate the modal with order details
        let modalContent = '';

        const diningOption = orderDetails.dining_option;
        const location = `${orderDetails.location} - ${orderDetails.number}`;
        const customerName = orderDetails.customer ? orderDetails.customer.name : 'No Name';

        // Add customer name, dining option, and location above the table
        modalContent += `<p><strong>Customer Name:</strong> ${customerName}</p>`;
        modalContent += `<p><strong>Dining Option:</strong> ${diningOption}</p>`;
        modalContent += `<p><strong>Location:</strong> ${location}</p>`;

        // Generate the table for order details
        modalContent += '<table class="table">';
        modalContent += '<thead><tr><th>Image</th><th>Quantity</th><th>Product</th><th>Price</th><th>Total</th></thead>';
        modalContent += '<tbody>';

        // Loop through each order and display its details
        orderDetails.orders.forEach(function(order) {
            modalContent += '<tr>';
            modalContent += `<td><img src="${order.product.image}" alt="${order.product.name}" style="max-width: 100px;"></td>`;
            modalContent += `<td>${order.quantity}</td>`;
            modalContent += `<td>${order.product.name}</td>`;
            modalContent += `<td>₱${parseFloat(order.product.price).toFixed(2)}</td>`;
            modalContent += `<td>₱${parseFloat(order.product.price * order.quantity).toFixed(2)}</td>`;
            modalContent += '</tr>';
        });

        modalContent += '</tbody></table>';

        // Set the modal content
        modalTemplate.find('.order-details-content').html(modalContent);

        // Append the new modal to the body
        $('body').append(modalTemplate);
    }

    function createChangeStatusModal(orderDetails) {
        // Clone the template
        const modalTemplate = $('#changeStatusModalTemplate').clone();
        const modalId = `changeStatusModal${orderDetails.id}`;
        modalTemplate.attr('id', modalId);
        modalTemplate.find('.change-status-form').attr('action', `/order/update/${orderDetails.id}`);
        modalTemplate.find('.order-id-input').val(orderDetails.id);
        modalTemplate.find('.modal-title').text(`Change Status for Order #${orderDetails.id}`);

        // Append the modal to the body
        $('body').append(modalTemplate);
    }


    $(document).ready(function() {
    let existingOrderIds = new Set($('tr[data-order-id]').map(function() { return $(this).data('order-id'); }).get());

    // Fetch latest order data initially and set up polling
    const outletId = '{{ $orders->first()->outlet_id }}';
    fetchLatestOrderData(outletId);
    setInterval(function() {
        fetchLatestOrderData(outletId);
    }, 5000);
});

</script>



@include('partials.modal.restaurant.orderDetails')
