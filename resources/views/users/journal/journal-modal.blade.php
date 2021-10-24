<div class="modal fade" id="journalModal" tabindex="-1" role="dialog" aria-labelledby="journalModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="journalModalLabel">Create Journal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" id="title">
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Author</label>
                            <input type="text" class="form-control" id="inputEmail4" >
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputPassword4">Year</label>
                            <input type="text" class="form-control" id="inputPassword4" >
                        </div>
                    </div>
                    <div class="card-body">
                      <div id="drag-drop-area"></div>
                    </div>
                    <div class="form-group">
                        <label for="title">Caption</label>
                        <input type="text" class="form-control" id="title">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn mb-2 btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn mb-2 btn-primary">Post</button>
            </div>
        </div>
    </div>
</div>