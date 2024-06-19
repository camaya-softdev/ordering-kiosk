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

    /* .resto-upload {
        border-radius: 8px;
        border: 1px solid #FF9700;
        padding: 5%;
    } */

    #productModal label {
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

     .add-user-style {
        display: flex;
        border-radius: 28px;
        border: 8px solid var(--Primary-50, #FEF2DE);
        background: var(--Primary-100, #FFE0B2);
        width: 40px;
        justify-content: center;
        align-items: center;
    }

    .product-upload {
        border-radius: 8px;
        border: 1px solid #FF9700;
        padding: 5%;
        }


</style>

<div class="modal fade" id="productModal" tabindex="-1" role="dialog" aria-labelledby="productModallLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content" style=" border-radius: 12px;">

        <div class="modal-body">
          <!-- Form inside the modal -->
          <form method="POST" action="{{ route('product.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="add-user-style">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path d="M21 10H22H21ZM12 23L11.4453 23.8321C11.7812 24.056 12.2188 24.056 12.5547 23.8321L12 23ZM3 10H2H3ZM12 1V2V1ZM20 10C20 13.0981 17.9843 16.1042 15.774 18.4373C14.6894 19.5822 13.6013 20.5195 12.7833 21.1708C12.3751 21.4959 12.0362 21.7482 11.8012 21.9178C11.6838 22.0026 11.5925 22.0667 11.5317 22.1088C11.5013 22.1299 11.4785 22.1454 11.464 22.1553C11.4567 22.1603 11.4514 22.1638 11.4483 22.1659C11.4467 22.167 11.4457 22.1677 11.4452 22.168C11.4449 22.1682 11.4448 22.1683 11.4448 22.1683C11.4448 22.1683 11.445 22.1682 11.445 22.1682C11.4451 22.1681 11.4453 22.1679 12 23C12.5547 23.8321 12.555 23.8319 12.5552 23.8317C12.5554 23.8316 12.5557 23.8314 12.556 23.8312C12.5566 23.8308 12.5573 23.8303 12.5581 23.8298C12.5598 23.8287 12.562 23.8272 12.5648 23.8253C12.5703 23.8216 12.5779 23.8164 12.5877 23.8098C12.6072 23.7966 12.6349 23.7776 12.6704 23.753C12.7415 23.7038 12.8435 23.6321 12.9722 23.5392C13.2295 23.3534 13.5936 23.0822 14.0292 22.7354C14.8987 22.043 16.0606 21.0428 17.226 19.8127C19.5157 17.3958 22 13.9019 22 10H20ZM12 23C12.5547 22.1679 12.5549 22.1681 12.555 22.1682C12.555 22.1682 12.5552 22.1683 12.5552 22.1683C12.5552 22.1683 12.5551 22.1682 12.5548 22.168C12.5543 22.1677 12.5533 22.167 12.5517 22.1659C12.5486 22.1638 12.5433 22.1603 12.536 22.1553C12.5215 22.1454 12.4987 22.1299 12.4683 22.1088C12.4075 22.0667 12.3162 22.0026 12.1988 21.9178C11.9638 21.7482 11.6249 21.4959 11.2167 21.1708C10.3987 20.5195 9.31061 19.5822 8.22595 18.4373C6.01574 16.1042 4 13.0981 4 10H2C2 13.9019 4.48426 17.3958 6.77405 19.8127C7.93939 21.0428 9.10133 22.043 9.97082 22.7354C10.4064 23.0822 10.7705 23.3534 11.0278 23.5392C11.1565 23.6321 11.2585 23.7038 11.3296 23.753C11.3651 23.7776 11.3928 23.7966 11.4123 23.8098C11.4221 23.8164 11.4297 23.8216 11.4352 23.8253C11.438 23.8272 11.4402 23.8287 11.4419 23.8298C11.4427 23.8303 11.4434 23.8308 11.444 23.8312C11.4443 23.8314 11.4446 23.8316 11.4448 23.8317C11.445 23.8319 11.4453 23.8321 12 23ZM4 10C4 7.87827 4.84285 5.84344 6.34315 4.34315L4.92893 2.92893C3.05357 4.8043 2 7.34784 2 10H4ZM6.34315 4.34315C7.84344 2.84285 9.87827 2 12 2V0C9.34784 0 6.8043 1.05357 4.92893 2.92893L6.34315 4.34315ZM12 2C14.1217 2 16.1566 2.84285 17.6569 4.34315L19.0711 2.92893C17.1957 1.05357 14.6522 0 12 0V2ZM17.6569 4.34315C19.1571 5.84344 20 7.87827 20 10H22C22 7.34784 20.9464 4.8043 19.0711 2.92893L17.6569 4.34315ZM14 10C14 11.1046 13.1046 12 12 12V14C14.2091 14 16 12.2091 16 10H14ZM12 12C10.8954 12 10 11.1046 10 10H8C8 12.2091 9.79086 14 12 14V12ZM10 10C10 8.89543 10.8954 8 12 8V6C9.79086 6 8 7.79086 8 10H10ZM12 8C13.1046 8 14 8.89543 14 10H16C16 7.79086 14.2091 6 12 6V8Z" fill="#FF8C00"/>
                  </svg>
            </div> <br>

            <h5>Add a Product</h5><br>

            <label for="image">Display Image:</label>
            <div class="form-group product-upload">
                <div class="row">
                    <div class="col">
                        <label for="image">Upload Image (Max Size: 2MB):</label>
                        <input class="btn btn-secondary" type="file" class="form-control-file" id="image" name="image" onchange="checkFileSizeAndTypeProduct(this)" accept=".jpeg,.jpg,.png">
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
              <label for="name">Product Name:</label>
              <input type="text" class="form-control" id="name" name="name" required>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="price">Price:</label>
                    <input type="input" class="form-control" id="price" name="price" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="stock">Stock:</label>
                    <input type="number" class="form-control" id="stock" name="stock" required>
                </div>
            </div>

            <div class="form-group">
                <label for="category">Category:</label>
                <select class="form-control" id="category" name="category_id">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="description">Description:</label> <br>
                    <textarea  class="form-control" id="description" name="description">

                    </textarea>
            </div>



            <div class="form-group">
                <label>Status:</label><br>
                <div class="row">
                    <div class="col-lg-6">
                        <label class="btn btn-block btn-custom-unselected product-status-active">
                            <div class="row">
                                <div class="col">
                                    Active
                                </div>
                                <div class="col">

                                    <input type="radio" name="create_status" id="update_status_active" value="1" autocomplete="off">

                                </div>
                            </div>
                        </label>
                    </div>
                    <div class="col-lg-6">
                        <label class="btn btn-block btn-custom-unselected product-status-inactive">
                            <div class="row">
                                <div class="col">
                                    Inactive
                                </div>
                                <div class="col">

                                    <input type="radio" name="create_status" id="update_status_inactive" value="0" autocomplete="off">

                                </div>
                            </div>
                        </label>
                    </div>
                </div>
            </div>

            <br>


            <div class="form-group">
                <div class="row">
                  <div class="col-lg-6">
                    <button type="button" class="btn cancel-btn" data-dismiss="modal" style="padding: 10px; width:100%">Cancel</button>
                  </div>
                  <div class="col-lg-6">
                    <button type="submit" class="btn create-btn" style="padding: 10px; width:100%">Add</button>
                  </div>
                </div>
            </div>
          </form>
        </div>
      </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>

$(document).ready(function() {

    // Rest of your existing script
    $('.product-status-active').click(function() {
        // Add selected class to the clicked Active element
        $(this).addClass('btn-custom-selected');
        // Remove selected class from Inactive element
        $('.product-status-inactive').removeClass('btn-custom-selected');
        // Add unselected class to Inactive element
        $('.product-status-inactive').addClass('btn-custom-unselected');
        // Remove unselected class from Active element
        $(this).removeClass('btn-custom-unselected');
    });

    $('.product-status-inactive').click(function() {
        // Add selected class to the clicked Inactive element
        $(this).addClass('btn-custom-selected');
        // Remove selected class from Active element
        $('.product-status-active').removeClass('btn-custom-selected');
        // Add unselected class to Active element
        $('.product-status-active').addClass('btn-custom-unselected');
        // Remove unselected class from Inactive element
        $(this).removeClass('btn-custom-unselected');
    });


    function checkFileSizeAndTypeProduct(input) {
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
                previewImageTwo(input); // Call the previewImage function
            }
        }
    }

    function previewImageProduct(input) {
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
});



</script>
