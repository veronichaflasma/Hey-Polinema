<div class="modal fade" id="varyModal" tabindex="-1" role="dialog" aria-labelledby="varyModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="varyModalLabel">Write Article</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="title" class="col-form-label">Title</label>
                        <input type="text" class="form-control" id="title">
                    </div>
                    <div class="form-group">
                    <label for="title" class="col-form-label">Content</label>
                      <!-- Create the editor container -->
                      <div id="editor" style="min-height:100px;">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc lobortis convallis efficitur. Cras nisi felis, luctus nec nibh quis, consequat maximus velit. Ut iaculis at lacus sed pellentesque.</p>
                        <p>Maecenas luctus nisl quis leo porta, quis elementum mi tempus. Morbi blandit metus ut nulla scelerisque, sed ornare purus elementum. Vivamus sed augue in tortor commodo malesuada sed et nulla. Nullam cursus erat eget tellus maximus, ut placerat lorem fringilla.</p>
                      </div>
                    </div>
                    <div class="form-group">
                        <select class="form-control select2" id="validationSelect2" required>
                                <option option value="">Select Category</option>
                                <option value="AZ">Arizona</option>
                                <option value="CO">Colorado</option>
                                <option value="ID">Idaho</option>
                                <option value="MT">Montana</option>
                                <option value="NE">Nebraska</option>
                                <option value="NM">New Mexico</option>
                                <option value="ND">North Dakota</option>
                                <option value="UT">Utah</option>
                            </select>
                       
                    </div>
                    <div class="form-group">
                    <label for="multi-select2">Tags</label>
                          <select class="form-control select2-multi" id="multi-select2">
                            <optgroup label="Mountain Time Zone">
                              <option value="AZ">Food</option>
                              <option value="CO">Colorado</option>
                              <option value="ID">Idaho</option>
                              <option value="MT">Montana</option>
                              <option value="NE">Nebraska</option>
                              <option value="NM">New Mexico</option>
                              <option value="ND">North Dakota</option>
                              <option value="UT">Utah</option>
                              <option value="WY">Wyoming</option>
                            </optgroup>
                            <optgroup label="Central Time Zone">
                              <option value="AL">Alabama</option>
                              <option value="AR">Arkansas</option>
                              <option value="IL">Illinois</option>
                              <option value="IA">Iowa</option>
                              <option value="KS">Kansas</option>
                              <option value="KY">Kentucky</option>
                              <option value="LA">Louisiana</option>
                              <option value="MN">Minnesota</option>
                              <option value="MS">Mississippi</option>
                              <option value="MO">Missouri</option>
                              <option value="OK">Oklahoma</option>
                              <option value="SD">South Dakota</option>
                              <option value="TX">Texas</option>
                              <option value="TN">Tennessee</option>
                              <option value="WI">Wisconsin</option>
                            </optgroup>
                          </select>
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