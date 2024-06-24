<!-- editCategoryModal -->
<div class="modal fade" id="editCategoryModal" tabindex="-1" role="dialog" aria-labelledby="editCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="border-radius: 12px;">
            <div class="modal-body">
                <!-- Form inside the modal -->
                <div class="add-category-layout">
                    <div class="add-category-style">
                        <svg style="margin:7" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path d="M10 3H3V10H10V3Z" stroke="#FF8C00" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M21 3H14V10H21V3Z" stroke="#FF8C00" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M21 14H14V21H21V14Z" stroke="#FF8C00" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M10 14H3V21H10V14Z" stroke="#FF8C00" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                </div> <br>

                <h5>Select a category to edit</h5><br>

                <div class="form-group">
                    <label for="category">Category:</label>
                    <select class="form-control" id="category" name="category">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
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
                            <button type="button" class="btn create-btn" style="padding: 10px; width:100%" data-toggle="modal" data-target="#updateCategoryModal" data-dismiss="modal">Edit</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- updateCategoryModal -->
<div class="modal fade" id="updateCategoryModal" tabindex="-1" role="dialog" aria-labelledby="updateCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="border-radius: 12px;">
            <div class="modal-body">
                <!-- Form inside the modal -->
                <form method="POST" action="{{ route('category.update', ['id' => $category->id ?? '0']) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Hidden input for category ID -->
                    <input type="hidden" id="update_category_id" name="update_category_id" value="{{ $category->id ?? '0' }}">

                    <div class="add-category-layout">
                        <div class="add-category-style">
                            <svg style="margin:7" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path d="M10 3H3V10H10V3Z" stroke="#FF8C00" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M21 3H14V10H21V3Z" stroke="#FF8C00" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M21 14H14V21H21V14Z" stroke="#FF8C00" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M10 14H3V21H10V14Z" stroke="#FF8C00" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                    </div> <br>

                    <h5>Update Category</h5><br>

                    <div class="form-group">
                        <label for="update_category_name">Category Name:</label>
                        <input type="text" class="form-control" id="update_category_name" name="update_category_name" placeholder="Enter a category" required>
                    </div>

                    <br>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-lg-6">
                                <button type="button" class="btn cancel-btn" data-dismiss="modal" style="padding: 10px; width:100%">Cancel</button>
                            </div>
                            <div class="col-lg-6">
                                <button type="submit" class="btn create-btn" style="padding: 10px; width:100%">Edit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript/jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {
        $('#editCategoryModal .create-btn').click(function() {
            var selectedOption = $('#category option:selected');
            var categoryName = selectedOption.text();
            var categoryId = selectedOption.val();

            if (categoryName.trim() === "") {
                // If no category is selected, prevent opening the next modal
                return false;
            }

            $('#update_category_name').val(categoryName);
            $('#update_category_id').val(categoryId);
        });
    });
</script>
