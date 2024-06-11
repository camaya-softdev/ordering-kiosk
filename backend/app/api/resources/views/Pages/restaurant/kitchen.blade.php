{{-- <input type="hidden" id="latestOrderId" value="{{ $latestOrderId }}"> --}}
<style>
    .orderTable th {
           font-weight: lighter !important;
       }
   .csm-ribbon {
       background-color: #F97066;
       width: 100px;
       height: 8px;
       display: inline-block;
       margin: 0;
       padding: 0;
       position: absolute;
       top: 0;
       left: 0;
       border-radius: 2px;
   }
   @keyframes flicker {
       0% { opacity: 1; }
       50% { opacity: 0.5; }
       100% { opacity: 1; }
   }

   .flicker {
       animation: flicker 1s infinite;
   }
   </style>
   <table id="orderTable" class="orderTable table table-bordered table-hover custom-table">
       <thead>
           <tr>
               <th>Time</th>
               <th>Order Number</th>
               <th>Reference Number</th>
               <th>Customer Details</th>
               <th>Payment Method</th>
               <th>Status</th>
               <th>Total</th>
               <th>Order Detail</th>
               <th>{{ $loginData['user']['username'] === 'it_department' ? 'Outlets' : 'Action' }}</th>
       </thead>
       <tbody>
           @foreach($orders as $order_details)
           <tr data-order-id="{{ $order_details->id }}" style="{{ ($order_details->payment_method === 'GCash' && $order_details->status === 'pending') ? 'background-color: #FEF2DE;' : '' }}"
               >
               <td style="position: relative;">
                   @if($order_details->payment_method === 'GCash' && $order_details->status === 'pending')
                   <span class="csm-ribbon"></span>
                       <span class="order-timer" id="timer-{{ $order_details->id }}" data-created-at="{{ $order_details->created_at }}"></span>
                   @else
                        {{ $order_details->created_at->format('F jS, \a\t h:i A') }}
                   @endif
               </td>

               <td style="position: relative; font-weight: bold;">
                   #{{ $order_details->id }}
               </td>

               <td style="font-weight: bold">
                   {{ $order_details->reference_number ?? 'N/A' }} <br>
               </td>

               <td>
                   {{ $order_details->customer->name ?? 'N/A' }} <br>
                   {{ $order_details->customer->mobile_number ?? '' }}
               </td>

               <td>
                   {{ $order_details->payment_method }}
               </td>

               <td>
                   {{ $order_details->status }}
               </td>

               <td>
                @php
                    $total = $order_details->orders->where('outlet_id', $loginData['user']['assign_to_outlet'])->sum(function ($order) {
                        return $order->product->price * $order->quantity;
                    });
                @endphp
                ₱{{ $total }}
            </td>

               <td>
                   <button class="btn btn-warning text-light view-order-details" data-toggle="modal" data-target="#orderDetailsModal" data-order="{{ $order_details }}">View Order Details</button>
               </td>

               @if($loginData['user']['username'] === "it_department")
               <td>
                   <img src="{{ asset($order_details->outlet->image) }}" alt="Outlet Image" height="50px">
               </td>
               @else
               <td>
                   <button id="changeStatusButton-{{ $order_details->id }}" class="btn btn-secondary text-light" data-toggle="modal" data-target="#changeStatusModal{{ $order_details->id }}"
                    @if($order_details->status == 'cancelled' || $order_details->status == 'delivered')
                    disabled
                @endif>Change Status</button>
                   @include('partials.modal.restaurant.updateOrderStatus')
               </td>
               @endif




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
                       <h1>testing</h1>
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

   <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
   <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


   <script>

    document.addEventListener('DOMContentLoaded', (event) => {
        // Function to start the timers
        function startOrderTimers() {
            const orderTimers = document.querySelectorAll('.order-timer');

            orderTimers.forEach(timer => {
                const createdAt = new Date(timer.getAttribute('data-created-at'));
                const orderId = timer.getAttribute('id').split('-')[1];
                const changeStatusButton = document.querySelector(`#changeStatusButton-${orderId}`);

                setInterval(() => {
                    const now = new Date();
                    const timeDiff = now - createdAt;
                    const minutesDiff = Math.floor(timeDiff / 1000 / 60);

                    if (minutesDiff > 10) {
                        // Add flicker class if more than 10 minutes
                        changeStatusButton.classList.add('flicker');
                    }
                }, 1000);
            });
        }

        startOrderTimers();
    });

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
                    <tr data-order-id="${orderDetails.id}" style="${orderDetails.payment_method === 'GCash' && orderDetails.status === 'pending' ? 'background-color: #FEF2DE;' : ''}">
                        <td style="position: relative;">

                            ${orderDetails.payment_method === 'GCash' && orderDetails.status === 'pending'
                                ? `
                                <span class="csm-ribbon"></span>
                                <span class="order-timer" id="timer-${orderDetails.id}" data-created-at="${orderDetails.created_at}"></span>`
                                : orderDetails.created_at}
                        </td>
                        <td style="font-weight: bold;">
                            #${orderDetails.id}
                        </td>
                        <td style="font-weight: bold">${orderDetails.reference_number ?? 'N/A'}</td>
                        <td>
                            ${orderDetails.customer ? orderDetails.customer.name : 'N/A'} <br>
                            ${orderDetails.mobile_number ? orderDetails.customer.mobile_number : ''} <br>

                        </td>

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
        var outlet_id = {{ $loginData['user']['assign_to_outlet'] }};
        var fnb = "{{ $loginData['user']['username'] }}";

        var filteredOrders = orderDetails.orders.filter(order => order.outlet_id === outlet_id);

        const modalTemplate = $('#orderDetailsModalTemplate').clone();
        const modalId = `orderDetailsModal${orderDetails.id}`;
        modalTemplate.attr('id', modalId);
        modalTemplate.find('.view-order-details').data('order', orderDetails);
        modalTemplate.find('.modal-title').text(`Order Details #${orderDetails.id}`);

        // Populate the modal with order details
        let modalContent = '';

    if (filteredOrders.length > 0)
    {
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
        filteredOrders.forEach(function(order) {
            modalContent += '<tr>';
            modalContent += '<td><img src="' + order.product.image + '" alt="' + order.product.name + '" style="max-width: 100px;"></td>';
            modalContent += '<td>' + order.quantity + '</td>';
            modalContent += '<td>' + order.product.name + '</td>';
            modalContent += '<td>₱' + parseFloat(order.product.price).toFixed(2) + '</td>';
            modalContent += '<td>₱' + parseFloat(order.product.price * order.quantity).toFixed(2) + '</td>';
            modalContent += '</tr>';
        });

        modalContent += '</tbody></table>';
    }
    else if(filteredOrders.length == 0)
    {
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
            modalContent += '<td><img src="' + order.product.image + '" alt="' + order.product.name + '" style="max-width: 100px;"></td>';
            modalContent += '<td>' + order.quantity + '</td>';
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

    document.addEventListener('DOMContentLoaded', function() {
        function updateTimers() {
            document.querySelectorAll('.order-timer').forEach(function(timerElement) {
                var createdAt = moment(timerElement.getAttribute('data-created-at'));
                var now = moment();
                var duration = moment.duration(now.diff(createdAt));

                var hours = Math.floor(duration.asHours());
                var minutes = duration.minutes();
                var seconds = duration.seconds();

                timerElement.textContent = hours + 'h ' + minutes + 'm ' + seconds + 's';
            });
        }

        // Update the timers every second
        setInterval(updateTimers, 1000);

        // Initial update
        updateTimers();
    });




        $(document).ready(function() {
        let existingOrderIds = new Set($('tr[data-order-id]').map(function() { return $(this).data('order-id'); }).get());

        // Fetch latest order data initially and set up polling
        const outletId = '{{ $loginData["user"]["assign_to_outlet"] ?? 0 }}';
        console.log(outletId, "GG");
        fetchLatestOrderData(outletId);
        setInterval(function() {
            fetchLatestOrderData(outletId);
        }, 5000);
    });

</script>



   @include('partials.modal.restaurant.orderDetails')
