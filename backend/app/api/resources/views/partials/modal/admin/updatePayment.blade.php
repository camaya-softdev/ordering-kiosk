<div class="modal fade" id="updatePaymentModal{{$payment->id}}" tabindex="-1" role="dialog" aria-labelledby="updatePaymentModalLabel{{$payment->id}}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" >

        <form method="POST" action="{{ route('payment.update', $payment->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="modal-body">

                {{-- <div class="add-resto-style">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <g clip-path="url(#clip0_516_10055)">
                        <path d="M2 22H22" stroke="#FF8C00" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M2 6V7C2 7.79565 2.35119 8.55871 2.97631 9.12132C3.60143 9.68393 4.44928 10 5.33333 10C6.21739 10 7.06524 9.68393 7.69036 9.12132C8.31548 8.55871 8.66667 7.79565 8.66667 7M2 6H22M2 6L4.22222 2H19.7778L22 6M8.66667 7V6M8.66667 7C8.66667 7.79565 9.01786 8.55871 9.64298 9.12132C10.2681 9.68393 11.1159 10 12 10C12.8841 10 13.7319 9.68393 14.357 9.12132C14.9821 8.55871 15.3333 7.79565 15.3333 7M15.3333 7V6M15.3333 7C15.3333 7.79565 15.6845 8.55871 16.3096 9.12132C16.9348 9.68393 17.7826 10 18.6667 10C19.5507 10 20.3986 9.68393 21.0237 9.12132C21.6488 8.55871 22 7.79565 22 7V6" stroke="#FF8C00" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M4 22V10" stroke="#FF8C00" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M20 22V10" stroke="#FF8C00" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M8 22V18C8 17.4696 8.28095 16.9609 8.78105 16.5858C9.28115 16.2107 9.95942 16 10.6667 16H13.3333C14.0406 16 14.7189 16.2107 15.219 16.5858C15.719 16.9609 16 17.4696 16 18V22" stroke="#FF8C00" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </g>
                        <defs>
                        <clipPath id="clip0_516_10055">
                            <rect width="24" height="24" fill="white"/>
                        </clipPath>
                        </defs>
                    </svg>
                </div> <br> --}}

              <h5>Update Payment Method</h5><br>


            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $payment->name }}">
            </div>


            <div class="form-group">
                <label>Status:</label><br>
                <div class="row">
                    <div class="col-lg-6">
                        <label class="btn btn-block {{ $payment->status == 1 ? 'btn-custom-selected' : 'btn-custom-unselected'}} payment-status-active">
                            <div class="row">
                                <div class="col">
                                    Active
                                </div>
                                <div class="col">

                                    <input type="radio" name="update_status" id="update_status_active" value="1" autocomplete="off" {{ $payment->status == 1 ? 'checked' : '' }}>

                                </div>
                            </div>
                        </label>
                    </div>
                    <div class="col-lg-6">
                        <label class="btn btn-block btn-custom-uselected {{ $payment->status == 1 ? 'btn-custom-unselected' : 'btn-custom-selected'}} payment-status-inactive">
                            <div class="row">
                                <div class="col">
                                    Inactive
                                </div>
                                <div class="col">

                                    <input type="radio" name="update_status" id="update_status_inactive" value="0" autocomplete="off" {{ $payment->status == 0 ? 'checked' : '' }}>

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
                    <button type="submit" class="btn create-btn" style="padding: 10px; width:100%">Update Payment</button>
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
        $('.update-status-active-label').click(function() {
            // Add selected class to the clicked Active element
            $(this).addClass('btn-custom-selected');
            // Remove selected class from Inactive element
            $('.update-status-inactive-label').removeClass('btn-custom-selected');
            // Add unselected class to Inactive element
            $('.update-status-inactive-label').addClass('btn-custom-unselected');
            // Remove unselected class from Active element
            $(this).removeClass('btn-custom-unselected');
        });

        $('.update-status-inactive-label').click(function() {
            // Add selected class to the clicked Inactive element
            $(this).addClass('btn-custom-selected');
            // Remove selected class from Active element
            $('.update-status-active-label').removeClass('btn-custom-selected');
            // Add unselected class to Active element
            $('.update-status-active-label').addClass('btn-custom-unselected');
            // Remove unselected class from Inactive element
            $(this).removeClass('btn-custom-unselected');
        });
    });



</script>



