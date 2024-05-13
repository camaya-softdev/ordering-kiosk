<div class="modal fade" id="updateUserModal{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="updateUserModalLabel{{$user->id}}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="border-radius: 12px;">
            <div class="modal-header">
                <h5 class="modal-title" id="updateOutletModalLabel{{$user->id}}">Update User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ secure_url('users.update', $user->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="add-user-style">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path d="M20 21V19C20 17.9391 19.5786 16.9217 18.8284 16.1716C18.0783 15.4214 17.0609 15 16 15H8C6.93913 15 5.92172 15.4214 5.17157 16.1716C4.42143 16.9217 4 17.9391 4 19V21M16 7C16 9.20914 14.2091 11 12 11C9.79086 11 8 9.20914 8 7C8 4.79086 9.79086 3 12 3C14.2091 3 16 4.79086 16 7Z" stroke="#FF8C00" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div> <br>
                    <h5>Update User</h5><br>
                    <div class="form-group">
                        <label for="update_first_name">First Name:</label>
                        <input type="text" class="form-control" id="update_first_name" name="first_name" value="{{ $user->first_name }}">
                    </div>
                    <div class="form-group">
                        <label for="update_last_name">Last Name:</label>
                        <input type="text" class="form-control" id="update_last_name" name="last_name" value="{{ $user->last_name }}">
                    </div>
                    <div class="form-group">
                        <label for="update_username">Username:</label>
                        <input type="text" class="form-control" id="update_username" name="username" value="{{ $user->username }}">
                    </div>
                    <div class="form-group">
                        <label for="assign_to_outlet">Outlet:</label>
                        <select class="form-control" id="assign_to_outlet" name="assign_to_outlet">
                            @foreach($outlets as $outlet)
                                <option id{{ $outlet->name }} value="{{ $outlet->id }}" {{ $outlet->id == $user->assign_to_outlet ? 'selected' : '' }}>
                                    {{ $outlet->name }}
                                </option>
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
                                            <input type="radio" name="status" id="update_status_active" value="1" {{ $user->status == 1 ? 'checked' : '' }} autocomplete="off">
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
                                            <input type="radio" name="status" id="update_status_inactive" value="0" {{ $user->status == 0 ? 'checked' : '' }} autocomplete="off">
                                        </div>
                                    </div>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn cancel-btn" data-dismiss="modal" style="padding: 10px; width:100%">Cancel</button>
                    <button type="submit" class="btn create-btn" style="padding: 10px; width:100%">Update User</button>
                </div>
            </form>
        </div>
    </div>
</div>
