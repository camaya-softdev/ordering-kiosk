<div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="userModallLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <!-- Form inside the modal -->
          <form method="POST" action="{{ route('users.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
              <label for="first_name">First Name:</label>
              <input type="text" class="form-control" id="first_name" name="first_name" required>
            </div>

            <div class="form-group">
                <label for="last_name">Last Name:</label>
                <input type="text" class="form-control" id="last_name" name="last_name" required>
            </div>


            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>

            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>

            <div class="form-group">
                <label for="assign_to_outlet">Outlet:</label>
                <select class="form-control" id="assign_to_outlet" name="assign_to_outlet">
                    @foreach($outlets as $outlet)
                        <option value="{{ $outlet->id }}">{{ $outlet->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
              <label for="status">Status:</label>
              <select class="form-control" id="status" name="status">
                <option value="1">Active</option>
                <option value="0">Inactive</option>
              </select>
            </div>

            <button type="submit" class="btn btn-primary">Create User</button>
          </form>
        </div>
      </div>
    </div>
</div>
