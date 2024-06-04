<div class="modal fade" id="updateGcashModal{{$gcash_details->id}}" tabindex="-1" role="dialog" aria-labelledby="updateGcashModalLabel{{$gcash_details->id}}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" >

        <form method="POST" action="{{ route('gcash.update', $gcash_details->id) }}" enctype="multipart/form-data">
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

              <h5>Update Gcash Method</h5><br>

              <label for="updateImage">Update Image:</label>
              <div class="form-group resto-upload">
                  <div class="row">
                      <div class="col">
                          <label for="updateImage">Upload Image (Max Size: 2MB):</label>
                          <input class="btn btn-secondary" type="file" class="form-control-file" id="updateImage" name="updateImage" onchange="checkFileSizeAndTypeGcash2(this)" accept=".jpeg,.jpg,.png">
                          <small id="updateFileSizeError" class="text-danger" style="display:none;">File size exceeds the limit (Max Size: 2MB)</small>
                          <small id="updateFileTypeError" class="text-danger" style="display:none;">Only JPEG and PNG files are allowed</small>
                      </div>
                      <div class="col">
                          <div id="updateImagePreview" style="display:none;">
                              <img id="updatePreview" src="#" alt="Image Preview" height="100">
                          </div>
                      </div>
                  </div>
              </div>

            <div class="form-group">
                <label for="number">Number:</label>
                <input type="text" class="form-control" id="number" name="number" value="{{ $gcash_details->number }}">
            </div>

            <div class="form-group">
                <label for="outlet_id">Outlet:</label>
                <select class="form-control" id="outlet_id" name="outlet_id">
                    <option value="0">No Selected </option>
                    @foreach($outlets as $outlet)
                        <option value="{{ $outlet->id }}" {{ $outlet->id == $gcash_details->outlet_id  ? 'selected' : '' }}>
                            {{ $outlet->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <br>








            <div class="form-group">
                <div class="row">
                  <div class="col-lg-6">
                    <button type="button" class="btn cancel-btn" data-dismiss="modal" style="padding: 10px; width:100%">Cancel</button>
                  </div>
                  <div class="col-lg-6">
                    <button type="submit" class="btn create-btn" style="padding: 10px; width:100%">Update GCash</button>
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

    function checkFileSizeAndTypeGcash2(input) {
    const maxSize = 2 * 1024 * 1024; // 2MB in bytes
    const validTypes = ['image/jpeg', 'image/png'];
    const fileSizeError = document.getElementById("updateFileSizeError");
    const fileTypeError = document.getElementById("updateFileTypeError");

    if (input.files && input.files[0]) {
        const fileSize = input.files[0].size;
        const fileType = input.files[0].type;

        if (fileSize > maxSize) {
            fileSizeError.style.display = "block";
            fileTypeError.style.display = "none";
            input.value = ""; // Clear the file input
        } else if (!validTypes.includes(fileType)) {
            fileSizeError.style.display = "none";
            fileTypeError.style.display = "block";
            input.value = ""; // Clear the file input
        } else {
            fileSizeError.style.display = "none";
            fileTypeError.style.display = "none";
            previewImagePayment2(input); // Call the previewImage function
        }
    }
}

function previewImagePayment2(input) {
    var preview = document.getElementById('updatePreview');
    var imagePreview = document.getElementById('updateImagePreview');

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            preview.src = e.target.result;
            imagePreview.style.display = 'block'; // Show preview and buttons
        }

        reader.readAsDataURL(input.files[0]);
    }
}



</script>



