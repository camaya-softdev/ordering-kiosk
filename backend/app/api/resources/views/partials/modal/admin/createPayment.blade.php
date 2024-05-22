<div class="modal fade" id="createPaymentModal" tabindex="-1" role="dialog" aria-labelledby="createPaymentModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" >

        <form method="POST" action="{{ route('payment.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">


              <h5>Create Payment Method</h5><br>

              <label for="image">Display Image:</label>
              <div class="form-group resto-upload">
                  <div class="row">
                      <div class="col">
                          <label for="image">Upload Image (Max Size: 2MB):</label>
                          <input class="btn btn-secondary" type="file" class="form-control-file" id="image" name="image" onchange="checkFileSizeAndTypePayment(this)" accept=".jpeg,.jpg,.png">
                          <small id="fileSizeErrorPayment" class="text-danger" style="display:none;">File size exceeds the limit (Max Size: 2MB)</small>
                          <small id="fileTypeErrorPayment" class="text-danger" style="display:none;">Only JPEG and PNG files are allowed</small>
                      </div>
                      <div class="col">
                          <div id="imagePreviewPayment" style="display:none;">
                              <img id="previewPayment" src="#" alt="Image Preview" height="100">
                          </div>
                      </div>
                  </div>
              </div>



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

    function checkFileSizeAndTypePayment(input) {
        const maxSizePayment = 2 * 1024 * 1024; // 2MB in bytes
        const validTypesPayment = ['image/jpeg', 'image/png'];
        const fileSizeErrorPayment = document.getElementById("fileSizeErrorPayment");
        const fileTypeErrorPayment = document.getElementById("fileTypeErrorPayment");

        if (input.files && input.files[0]) {
            const fileSize = input.files[0].size;
            const fileType = input.files[0].type;

            if (fileSize > maxSizePayment) {
                fileSizeErrorPayment.style.display = "block";
                fileTypeErrorPayment.style.display = "none";
                input.value = ""; // Clear the file input
            } else if (!validTypesPayment.includes(fileType)) {
                fileSizeErrorPayment.style.display = "none";
                fileTypeErrorPayment.style.display = "block";
                input.value = ""; // Clear the file input
            } else {
                fileSizeErrorPayment.style.display = "none";
                fileTypeErrorPayment.style.display = "none";
                previewImagePayment(input); // Call the previewImage function
            }
        }
    }



    function previewImagePayment(input)
    {
        var previewPayment = document.getElementById('previewPayment');
        var imagePreviewPayment = document.getElementById('imagePreviewPayment');
        var fileSizeErrorPayment = document.getElementById('fileSizeErrorPayment');

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                previewPayment.src = e.target.result;
                imagePreviewPayment.style.display = 'block';
                fileSizeErrorPayment.style.display = 'none';
            }

            reader.readAsDataURL(input.files[0]);
        }
    }



</script>



