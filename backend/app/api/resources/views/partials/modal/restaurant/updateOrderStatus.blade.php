<!-- Modal for Changing Status -->
<div class="modal fade" id="changeStatusModal{{ $order_details->id }}" tabindex="-1" role="dialog" aria-labelledby="changeStatusModalLabel{{ $order_details->id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="changeStatusModalLabel">Change Status</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Form inside the modal -->
                    <form method="POST" action="{{ route('order.update', $order_details->id) }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="orderId" id="orderId{{ $order_details->id }}" value="{{ $order_details->id }}">
                    <div class="form-group">
                        <label for="statusSelect">Select Status:</label>
                        <select class="form-control" id="statusSelect" name="status">
                            <option value="pending">Pending</option>
                            <option value="confirmed">Confirmed</option>
                            <option value="cancelled">Cancelled</option>
                            <option value="voided">Voided</option>
                            <option value="completed">Completed</option>
                            <option value="no_show">No Show</option>
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


