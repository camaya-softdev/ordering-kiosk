<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<style>
    .btn-custom-selected {
        background-color: #FEF2DE;
        border-color: #EF6C02;
        color: #EF6C02;
        padding: 10px;
        font-weight: lighter !important;
    }

    .btn-custom-unselected {
        background-color: #ffffff;
        border-color: #D0D5DD;
        color: black;
        padding: 10px;
        font-weight: lighter !important;
    }

    /* Hide the default radio button */
    input[type="radio"] {
    appearance: none;
    -webkit-appearance: none;
    -moz-appearance: none;
    width: 0;
    height: 0;
    position: relative;
    }

    input[type="radio"]::before {
    content: "\f111";
    font-family: "Font Awesome 5 Free";
    color: #D0D5DD;
    width: 20px;
    height: 20px;
    border-radius: 50%;
    }

    input[type="radio"]:checked::before {
    content: "\f058";
    font-family: "Font Awesome 5 Free";
    background-color: #FF8C00;
    width: 20px;
    height: 20px;
    border: solid 2px #FF8C00;
    color: white;
    }

    .resto-upload {
        border-radius: 8px;
        border: 1px solid #FF9700;
        padding: 5%;
        }

    #exampleModal label {
    font-weight: lighter !important;
    }


    .add-resto-style {
        display: flex;
        border-radius: 28px;
        border: 8px solid var(--Primary-50, #FEF2DE);
        background: var(--Primary-100, #FFE0B2);
        width: 48px;
        justify-content: center;
        align-items: center;
    }

    .create-btn {
        background-color: #FF8C00;
        border-radius: 8px;
        color: white;
        border: 1px solid #FF9700;
    }
    .create-btn:hover {
        background-color: #FFCB80;
        color: white;
    }
    .cancel-btn {
        background-color: #FFFFFF;
        border-radius: 8px;
        color: #FF8C00;
        border: 1px solid #FF9700;
    }
    .cancel-btn:hover {
        background-color: #FF8C00;
        color: white;
    }

</style>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content" style=" border-radius: 12px;">

        <div class="modal-body">
          <!-- Form inside the modal -->
          <form method="POST" action="{{ secure_url('outlet.store') }}" enctype="multipart/form-data">
            @csrf


                <div class="add-resto-style">
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
                </div> <br>

              <h5>Add Restaurant</h5><br>

              <label for="image">Display Image:</label>
              <div class="form-group resto-upload">
                  <div class="row">
                      <div class="col">
                          <label for="image">Upload Image (Max Size: 2MB):</label>
                          <input class="btn btn-secondary" type="file" class="form-control-file" id="image" name="image" onchange="checkFileSizeAndType(this)" accept=".jpeg,.jpg,.png">
                          <small id="fileSizeError" class="text-danger" style="display:none;">File size exceeds the limit (Max Size: 2MB)</small>
                          <small id="fileTypeError" class="text-danger" style="display:none;">Only JPEG and PNG files are allowed</small>
                      </div>
                      <div class="col">
                          <div id="imagePreview" style="display:none;">
                              <img id="preview" src="#" alt="Image Preview" height="100">
                          </div>
                      </div>
                  </div>
              </div>



            <div class="form-group">
              <label for="name">Outlet Name:</label>
              <input type="text" class="form-control" id="name" name="name" required>
            </div>


            <div class="form-group">
                <label for="outlet_classification">Classification:</label>
                <select class="form-control" name="outlet_classification">
                    <option value="Restaurant" id="restuarant_classification">Restaurant</option>
                    <option value="Coffee" id="coffee_classification">Coffee</option>
                </select>
            </div>

            <div class="form-group">
                <label>Status:</label><br>
                <div class="row">
                    <div class="col-lg-6">
                        <label class="btn btn-block btn-custom-unselected" id="create_status_active_label">
                            <div class="row">
                                <div class="col">
                                    Active
                                </div>
                                <div class="col">
                                    <input type="radio" name="create_status" id="create_status_active" value="1" autocomplete="off">
                                </div>
                            </div>
                        </label>
                    </div>
                    <div class="col-lg-6">
                        <label class="btn btn-block btn-custom-unselected" id="create_status_inactive_label">
                            <div class="row">
                                <div class="col">
                                    Inactive
                                </div>
                                <div class="col">
                                    <input type="radio" name="create_status" id="create_status_inactive" value="0" autocomplete="off">
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
                    <button type="submit" class="btn create-btn" style="padding: 10px; width:100%">Create Outlet</button>
                  </div>
                </div>
            </div>
          </form>
        </div>
      </div>
    </div>
</div>


<script>
    var createStatusActive = document.getElementById("create_status_active");
    var createStatusInactive = document.getElementById("create_status_inactive");
    // var updateStatusActive = document.getElementById("update_status_active");
    // var updateStatusInactive = document.getElementById("update_status_inactive");

    // Add event listeners for create form
    createStatusActive.addEventListener("change", function() {
        if (createStatusActive.checked) {
            document.getElementById("create_status_active_label").classList.remove("btn-custom-unselected");
            document.getElementById("create_status_active_label").classList.add("btn-custom-selected");
            document.getElementById("create_status_inactive_label").classList.remove("btn-custom-selected");
            document.getElementById("create_status_inactive_label").classList.add("btn-custom-unselected");
        }
    });

    createStatusInactive.addEventListener("change", function() {
        if (createStatusInactive.checked) {
            document.getElementById("create_status_inactive_label").classList.remove("btn-custom-unselected");
            document.getElementById("create_status_inactive_label").classList.add("btn-custom-selected");
            document.getElementById("create_status_active_label").classList.remove("btn-custom-selected");
            document.getElementById("create_status_active_label").classList.add("btn-custom-unselected");
        }
    });



    function checkFileSizeAndType(input) {
        const maxSize = 2 * 1024 * 1024; // 2MB in bytes
        const validTypes = ['image/jpeg', 'image/png'];
        const fileSizeError = document.getElementById("fileSizeError");
        const fileTypeError = document.getElementById("fileTypeError");

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
                previewImage(input); // Call the previewImage function
            }
        }
    }



    function previewImage(input)
    {
        var preview = document.getElementById('preview');
        var imagePreview = document.getElementById('imagePreview');
        var fileSizeError = document.getElementById('fileSizeError');

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                preview.src = e.target.result;
                imagePreview.style.display = 'block'; // Show preview and buttons
                fileSizeError.style.display = 'none'; // Hide file size error if any
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

</script>


