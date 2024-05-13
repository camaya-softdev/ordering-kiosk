<div class="modal fade" id="deleteLocationNumber{{$locationNumber->id}}" tabindex="-1" role="dialog" aria-labelledby="deleteLocationNumber{{$locationNumber->id}}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteLocationNumber{{$locationNumber->id}}">Confirm Deletion</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this outlet?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <!-- Actual delete form -->
                <form method="POST" action="{{ secure_url('locationNumber.destroy', $locationNumber->id) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
