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
        <tr>
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




@include('partials.modal.restaurant.orderDetails')
