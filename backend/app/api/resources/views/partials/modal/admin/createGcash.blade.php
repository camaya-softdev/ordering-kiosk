<div class="modal fade" id="createGcashModal" tabindex="-1" role="dialog" aria-labelledby="createGcashModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" >

        <form method="POST" action="{{ route('gcash.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">


              <h5>Create GCash Details</h5><br>

              <label for="image">Display QR:</label>
              <div class="form-group resto-upload">
                  <div class="row">
                      <div class="col">
                          <label for="image">Upload Image (Max Size: 2MB):</label>
                          <input class="btn btn-secondary" type="file" class="form-control-file" id="image" name="image" onchange="checkFileSizeAndTypeGcash(this)" accept=".jpeg,.jpg,.png">
                          <small id="fileSizeErrorGcash" class="text-danger" style="display:none;">File size exceeds the limit (Max Size: 2MB)</small>
                          <small id="fileTypeErrorGcash" class="text-danger" style="display:none;">Only JPEG and PNG files are allowed</small>
                      </div>
                      <div class="col">
                          <div id="imagePreviewGcash" style="display:none;">
                              <img id="previewGcash" src="#" alt="Image Preview" height="100">
                          </div>
                      </div>
                  </div>
              </div>


            <div class="form-group">
                <label for="number">Number:</label>
                <input type="text" class="form-control" id="number" name="number" value="">
            </div>

            <div class="form-group">
                <label for="outlet_id">Select Outlet:</label>
                <select class="form-control" id="outlet_id" name="outlet_id">
                    <option value="0">No Selected </option>
                    @foreach($outlets as $outlet)
                        <option value="{{ $outlet->id }}">{{ $outlet->name }}</option>
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
                    <button type="submit" class="btn create-btn" style="padding: 10px; width:100%">Create GCash</button>
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
    function checkFileSizeAndTypeGcash(input) {
        const maxSizeGcash = 2 * 1024 * 1024; // 2MB in bytes
        const validTypesGcash = ['image/jpeg', 'image/png'];
        const fileSizeErrorGcash = document.getElementById("fileSizeErrorGcash");
        const fileTypeErrorGcash = document.getElementById("fileTypeErrorGcash");

        if (input.files && input.files[0]) {
            const fileSize = input.files[0].size;
            const fileType = input.files[0].type;

            if (fileSize > maxSizeGcash) {
                fileSizeErrorGcash.style.display = "block";
                fileTypeErrorGcash.style.display = "none";
                input.value = ""; // Clear the file input
            } else if (!validTypesGcash.includes(fileType)) {
                fileSizeErrorGcash.style.display = "none";
                fileTypeErrorGcash.style.display = "block";
                input.value = ""; // Clear the file input
            } else {
                fileSizeErrorGcash.style.display = "none";
                fileTypeErrorGcash.style.display = "none";
                previewImageGcash(input); // Call the previewImage function
            }
        }
    }



    function previewImageGcash(input)
    {
        var previewGcash = document.getElementById('previewGcash');
        var imagepreviewGcash = document.getElementById('imagepreviewGcash');
        var fileSizeErrorGcash = document.getElementById('fileSizeErrorGcash');

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                previewGcash.src = e.target.result;
                imagepreviewGcash.style.display = 'block';
                fileSizeErrorGcash.style.display = 'none';
            }

            reader.readAsDataURL(input.files[0]);
        }
    }



</script>



