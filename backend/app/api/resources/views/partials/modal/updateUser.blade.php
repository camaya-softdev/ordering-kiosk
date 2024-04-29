<div class="modal fade" id="updateUserModal{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="updateUserModalLabel{{$user->id}}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="updateOutletModalLabel{{$user->id}}">Update User</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form method="POST" action="{{ route('users.update', $user->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="modal-body">
            <div class="form-group">
                <label for="first_name">First Name:</label>
                <input type="text" class="form-control" id="first_name" name="first_name" value="{{ $user->first_name }}">
            </div>

            <div class="form-group">
                <label for="last_name">Last Name:</label>
                <input type="text" class="form-control" id="last_name" name="last_name" value="{{ $user->last_name }}">
            </div>

            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" class="form-control" id="username" name="username" value="{{ $user->username }}">
            </div>

            <div class="form-group">
                <label for="assign_to_outlet">Outlet:</label>
                <select class="form-control" id="assign_to_outlet" name="assign_to_outlet">
                    @foreach($outlets as $outlet)
                        <option value="{{ $outlet->id }}" {{ $outlet->id == $user->assign_to_outlet ? 'selected' : '' }}>
                            {{ $outlet->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="status">Status:</label>
                <select class="form-control" id="status" name="status">
                <option value="1" {{ $user->status == 1 ? 'selected' : '' }}>Active</option>
                <option value="0" {{ $user->status == 0 ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>

            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
        </div>
    </div>
</div>
