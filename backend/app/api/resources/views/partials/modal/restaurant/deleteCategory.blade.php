<style>
.delete-category-layout {
    display: flex;
    width: 48px;
    height: 48px;
    padding: 12px;
    justify-content: center;
    align-items: center;
}
.delete-category-style {
    border-radius: 28px;
    border: 8px solid var(--Error-50, #FEF3F2);
    background: var(--Error-100, #FEE4E2);
}
</style>
<!-- deleteCategoryModal -->
<div class="modal fade" id="deleteCategoryModal" tabindex="-1" role="dialog" aria-labelledby="deleteCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="border-radius: 12px;">
            <div class="modal-body">
                <!-- Form inside the modal -->
                <form id="deleteCategoryForm" method="POST" action="{{ route('category.destroy') }}">
                    @csrf

                    <h5>Select a category to delete</h5><br>

                    <div class="form-group">
                        <label for="delete_category">Category:</label>
                        <select class="form-control" id="delete_category" name="delete_category">
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <br>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-lg-6">
                                <button type="button" class="btn btn-block btn-outline-secondary" data-dismiss="modal" style="padding: 10px; width:100%">Cancel</button>
                            </div>
                            <div class="col-lg-6">
                                <button type="button" class="btn btn-danger delete-btn" style="padding: 10px; width:100%" data-toggle="modal" data-target="#confirmDeleteCategoryModal" data-dismiss="modal">Select</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- confirmDeleteCategoryModal -->
<div class="modal fade" id="confirmDeleteCategoryModal" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="border-radius: 12px;">
            <div class="modal-body">
                <!-- Confirmation message inside the modal -->
                <div class="delete-category-layout">
                    <div class="delete-category-style">
                        <svg style="margin:7" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path d="M12 8V12M12 16H12.01M22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12Z" stroke="#D92D20" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                          </svg>
                    </div>
                </div> <br>

                <h6 class="text-bold" id="deleteConfirmationMessage">Are you sure you want to permanently delete the category "<span class="text-primary" id="selectedCategoryName"></span>"?</h6>
                <p style="color:#667085">Changes will be applied right away.</p>

                <!-- Hidden input for category ID -->
                <input type="hidden" id="delete_category_id" name="delete_category_id">

                <br>

                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-6">
                            <button type="button" class="btn btn-block btn-outline-secondary" data-dismiss="modal" style="padding: 10px; width:100%">Cancel</button>
                        </div>
                        <div class="col-lg-6">
                            <button type="submit" class="btn btn-danger" style="padding: 10px; width:100%" id="confirmDeleteBtn">Delete</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript/jQuery -->
<script>
    $(document).ready(function() {
        // Store the selected category ID and name when the delete button is clicked
        $('#deleteCategoryModal .delete-btn').click(function() {
            var categoryId = $('#delete_category').val();
            var categoryName = $('#delete_category option:selected').text();

            if (categoryName.trim() === "") {
                // If no category is selected, prevent opening the next modal
                return false;
            }

            $('#delete_category_id').val(categoryId);
            $('#selectedCategoryName').text(categoryName);

        });

        // Handle the confirmation of deletion
        $('#confirmDeleteBtn').click(function() {
            $('#deleteCategoryForm').submit();
        });
    });
</script>

