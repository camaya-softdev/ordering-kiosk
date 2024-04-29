<div class="modal fade" id="updateOutletModal{{$outlet->id}}" tabindex="-1" role="dialog" aria-labelledby="updateOutletModalLabel{{$outlet->id}}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="updateOutletModalLabel{{$outlet->id}}">Update Outlet</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form method="POST" action="{{ route('outlet.update', $outlet->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="modal-body">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $outlet->name }}" required>
            </div>
            <div class="form-group">
                <label for="status">Status:</label>
                <select class="form-control" id="status" name="status">
                <option value="1" {{ $outlet->status == 1 ? 'selected' : '' }}>Active</option>
                <option value="0" {{ $outlet->status == 0 ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>
            <div class="form-group">
                <label for="image">Image:</label>
                <input type="file" class="form-control-file" id="image" name="image">
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





