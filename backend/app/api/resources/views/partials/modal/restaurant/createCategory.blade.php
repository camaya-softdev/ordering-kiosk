<style>
.add-category-layout {
    display: flex;
    width: 48px;
    height: 48px;
    padding: 12px;
    justify-content: center;
    align-items: center;
}
.add-category-style {
    border-radius: 28px;
    border: 8px solid var(--Primary-50, #FEF2DE);
    background: var(--Primary-100, #FFE0B2);
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
<!-- Add Category Modal -->
<div class="modal fade" id="AddCategoryModal" tabindex="-1" role="dialog" aria-labelledby="AddCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style=" border-radius: 12px;">
            <div class="modal-body">
                <!-- Form inside the modal -->


                <form method="POST" action="{{ secure_url('category.store') }}" enctype="multipart/form-data">
                    @csrf

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

                    <h5>Add Category</h5><br>

                    <div class="form-group">
                      <label for="name">Category Name:</label>
                      <input type="text" class="form-control" id="name" name="name" placeholder="Enter a category" required>
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
