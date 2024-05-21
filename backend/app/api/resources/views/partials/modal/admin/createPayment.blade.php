<div class="modal fade" id="createPaymentModal" tabindex="-1" role="dialog" aria-labelledby="createPaymentModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" >

        <form method="POST" action="{{ route('payment.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">


              <h5>Create Payment Method</h5><br>


            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" name="name" value="">
            </div>


            <div class="form-group">
                <label>Status:</label><br>
                <div class="row">
                    <div class="col-lg-6">
                        <label class="btn btn-block btn-custom-unselected payment-status-active">
                            <div class="row">
                                <div class="col">
                                    Active
                                </div>
                                <div class="col">

                                    <input type="radio" name="status" id="status_active" value="1" autocomplete="off">

                                </div>
                            </div>
                        </label>
                    </div>
                    <div class="col-lg-6">
                        <label class="btn btn-block btn-custom-uselected btn-custom-unselected payment-status-inactive">
                            <div class="row">
                                <div class="col">
                                    Inactive
                                </div>
                                <div class="col">

                                    <input type="radio" name="status" id="update_status_inactive" value="0" autocomplete="off">

                                </div>
                            </div>
                        </label>
                    </div>
                </div>
            </div>


            <div class="form-group">
                <div class="row">
                  <div class="col-lg-6">
                    <button type="button" class="btn cancel-btn" data-dismiss="modal" style="padding: 10px; width:100%">Cancel</button>
                  </div>
                  <div class="col-lg-6">
                    <button type="submit" class="btn create-btn" style="padding: 10px; width:100%">Create Payment</button>
                  </div>
                </div>
            </div>


            </div>
        </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>

$(document).ready(function() {



        // Rest of your existing script
        $('.status-active-label').click(function() {
            // Add selected class to the clicked Active element
            $(this).addClass('btn-custom-selected');
            // Remove selected class from Inactive element
            $('.status-inactive-label').removeClass('btn-custom-selected');
            // Add unselected class to Inactive element
            $('.status-inactive-label').addClass('btn-custom-unselected');
            // Remove unselected class from Active element
            $(this).removeClass('btn-custom-unselected');
        });

        $('.status-inactive-label').click(function() {
            // Add selected class to the clicked Inactive element
            $(this).addClass('btn-custom-selected');
            // Remove selected class from Active element
            $('.status-active-label').removeClass('btn-custom-selected');
            // Add unselected class to Active element
            $('.status-active-label').addClass('btn-custom-unselected');
            // Remove unselected class from Inactive element
            $(this).removeClass('btn-custom-unselected');
        });
    });



</script>



