
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<style>

     .add-user-style {
        display: flex;
        border-radius: 28px;
        border: 8px solid var(--Primary-50, #FEF2DE);
        background: var(--Primary-100, #FFE0B2);
        width: 40px;
        justify-content: center;
        align-items: center;
    }

    #userModal label {
    font-weight: lighter !important;
    }

</style>

<div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="userModallLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content" style=" border-radius: 12px;">

        <div class="modal-body">
          <!-- Form inside the modal -->
          <form method="POST" action="{{ route('users.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="add-user-style">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path d="M20 21V19C20 17.9391 19.5786 16.9217 18.8284 16.1716C18.0783 15.4214 17.0609 15 16 15H8C6.93913 15 5.92172 15.4214 5.17157 16.1716C4.42143 16.9217 4 17.9391 4 19V21M16 7C16 9.20914 14.2091 11 12 11C9.79086 11 8 9.20914 8 7C8 4.79086 9.79086 3 12 3C14.2091 3 16 4.79086 16 7Z" stroke="#FF8C00" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                  </svg>
            </div> <br>

            <h5>Add a User</h5><br>

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
                <input type="password" class="form-control" id="password" minlength="6" name="password" required>
            </div>

            <div class="form-group">
                <label for="assign_to_outlet">Restaurant Assigned:</label>
                <select class="form-control" id="assign_to_outlet" name="assign_to_outlet">
                    @foreach($outlets as $outlet)
                        <option value="{{ $outlet->id }}">{{ $outlet->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Status:</label><br>
                <div class="row">
                    <div class="col-lg-6">
                        <label class="btn btn-block btn-custom-unselected update-status-active-label">
                            <div class="row">
                                <div class="col">
                                    Active
                                </div>
                                <div class="col">

                                    <input type="radio" name="status" id="update_status_active" value="1" autocomplete="off">

                                </div>
                            </div>
                        </label>
                    </div>
                    <div class="col-lg-6">
                        <label class="btn btn-block btn-custom-unselected update-status-inactive-label">
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
                    <button type="submit" class="btn create-btn" style="padding: 10px; width:100%">Create User</button>
                  </div>
                </div>
            </div>
          </form>
        </div>
      </div>
    </div>
</div>

<script>

</script>
