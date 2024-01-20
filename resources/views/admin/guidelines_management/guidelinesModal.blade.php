<div class="modal fade static-modal" id="addGuidelinesModal" tabindex="-1" aria-labelledby="addGuidelinesModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addGuidelinesModalLabel">Add New Guidelines</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addGuidelinesForm">
                    @csrf
                    <div class="mb-3">
                        <label for="guidelines_title" class="form-label">Guidelines Title</label>
                        <input type="text" class="form-control" id="guidelines_title" name="guidelines_title" placeholder="Write guidelines title">
                        <span class="text-danger"></span>
                    </div>

                    <div class="mb-3">
                        <label for="thumbnail" class="form-label">Thumbnail</label>
                        <input type="file" class="form-control" id="thumbnail" name="thumbnail">
                        <span class="text-danger"></span>
                    </div>

                    <div class="mb-3">
                        <label for="disaster_type" class="form-label">Disaster Type</label>
                        <input type="text" class="form-control" id="disaster_type" name="disaster_type" placeholder="Enter disaster type">
                        <span class="text-danger"></span>
                    </div>

                    <div class="mb-3">
                        <h3 class="text-center">Before</h3>

                        <div class="mb-3">
                            <label for="before_headings" class="form-label">Headings</label>
                            <input type="text" class="form-control" id="before_headings" name="before_headings" placeholder="Headings for Before Guidelines">
                            <span class="text-danger"></span>
                        </div>

                        <div class="mb-3">
                            <label for="before_file" class="form-label">File</label>
                            <input type="file" class="form-control" id="before_file" name="before_file">
                            <span class="text-danger"></span>
                        </div>

                        <div class="mb-3">
                            <label for="before_description" class="form-label">Description</label>
                            <textarea class="form-control" id="before_description" name="before_description" cols="40" rows="5"></textarea>
                            <span class="text-danger"></span>
                        </div>
                    </div>

                    <div class="mb-3">
                        <h3 class="text-center">During</h3>

                        <div class="mb-3">
                            <label for="during_headings" class="form-label">Headings</label>
                            <input type="text" class="form-control" id="during_headings" name="during_headings" placeholder="Headings for During Guidelines">
                            <span class="text-danger"></span>
                        </div>

                        <div class="mb-3">
                            <label for="during_file" class="form-label">File</label>
                            <input type="file" class="form-control" id="during_file" name="during_file">
                            <span class="text-danger"></span>
                        </div>

                        <div class="mb-3">
                            <label for="during_description" class="form-label">Description</label>
                            <textarea class="form-control" id="during_description" name="during_description" cols="40" rows="5"></textarea>
                            <span class="text-danger"></span>
                        </div>
                    </div>


                    <div class="mb-3">
                        <h3 class="text-center">After</h3>

                        <div class="mb-3">
                            <label for="after_headings" class="form-label">Headings</label>
                            <input type="text" class="form-control" id="after_headings" name="after_headings" placeholder="Headings for After Guidelines">
                            <span class="text-danger"></span>
                        </div>

                        <div class="mb-3">
                            <label for="after_file" class="form-label">File</label>
                            <input type="file" class="form-control" id="after_file" name="after_file">
                            <span class="text-danger"></span>
                        </div>

                        <div class="mb-3">
                            <label for="after_description" class="form-label">Description</label>
                            <textarea class="form-control" id="after_description" name="after_description" cols="40" rows="5"></textarea>
                            <span class="text-danger"></span>
                        </div>
                    </div>


                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>


<div class="modal fade static-modal" id="editGuidelinesModal" tabindex="-1" aria-labelledby="editGuidelinesModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editGuidelinesModalLabel">Edit Guidelines</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editGuidelinesForm" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" class="form-control" id="guidelines_id" name="guidelines_id">
                    <div class="mb-3">
                        <label for="guidelines_title" class="form-label">Guidelines Title</label>
                        <input type="text" class="form-control" id="guidelines_title" name="guidelines_title" placeholder="Write guidelines title">
                        <span class="text-danger" id="edit_guidelines_title"></span>
                    </div>

                    <div class="mb-3">
                        <label for="thumbnail" class="form-label">Thumbnail</label>
                        <input type="file" class="form-control" id="thumbnail" name="thumbnail">
                        <span class="text-danger" id="edit_thumbnail"></span>
                    </div>

                    <div class="mb-3">
                        <label for="disaster_type" class="form-label">Disaster Type</label>
                        <input type="text" class="form-control" id="disaster_type" name="disaster_type" placeholder="Enter disaster type">
                        <span class="text-danger" id="edit_disaster_type"></span>
                    </div>

                    <div class="mb-3">
                        <h3 class="text-center">Before</h3>
                        <div class="mb-3">
                            <label for="before_headings" class="form-label">Headings</label>
                            <input type="text" class="form-control" id="before_headings" name="before_headings" placeholder="Headings for Before Guidelines">
                            <span class="text-danger" id="edit_before_headings"></span>
                        </div>
                        <div class="mb-3">
                            <label for="before_file" class="form-label">File</label>
                            <input type="file" class="form-control" id="before_file" name="before_file">
                        </div>
                        <div class="mb-3">
                            <label for="before_description" class="form-label">Description</label>
                            <textarea class="form-control" id="before_description" name="before_description" cols="40" rows="5"></textarea>
                            <span class="text-danger" id="edit_before_description"></span>
                        </div>
                    </div>

                    <div class="mb-3">
                        <h3 class="text-center">During</h3>
                        <div class="mb-3">
                            <label for="during_headings" class="form-label">Headings</label>
                            <input type="text" class="form-control" id="during_headings" name="during_headings" placeholder="Headings for During Guidelines">
                            <span class="text-danger" id="edit_during_headings"></span>
                        </div>
                        <div class="mb-3">
                            <label for="during_file" class="form-label">File</label>
                            <input type="file" class="form-control" id="during_file" name="during_file">
                        </div>
                        <div class="mb-3">
                            <label for="during_description" class="form-label">Description</label>
                            <textarea class="form-control" id="during_description" name="during_description" cols="40" rows="5"></textarea>
                            <span class="text-danger" id="edit_during_description"></span>
                        </div>
                    </div>

                    <div class="mb-3">
                        <h3 class="text-center">After</h3>
                        <div class="mb-3">
                            <label for="after_headings" class="form-label">Headings</label>
                            <input type="text" class="form-control" id="after_headings" name="after_headings" placeholder="Headings for After Guidelines">
                            <span class="text-danger" id="edit_after_headings"></span>
                        </div>
                        <div class="mb-3">
                            <label for="after_file" class="form-label">File</label>
                            <input type="file" class="form-control" id="after_file" name="after_file">
                        </div>
                        <div class="mb-3">
                            <label for="after_description" class="form-label">Description</label>
                            <textarea class="form-control" id="after_description" name="after_description" cols="40" rows="5"></textarea>
                            <span class="text-danger" id="edit_after_description"></span>
                        </div>
                    </div>

                    <button type="button" id="updateGuidelinesBtn" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        function resetForm(formId) {
            $(formId)[0].reset(); // Reset the form
            $(formId + ' .text-danger').text(''); // Clear error messages
        }

        $('.static-modal').modal({
            backdrop: 'static',
            keyboard: false
        });

        $('#addGuidelinesModal').on('hidden.bs.modal', function() {
            resetForm('#addGuidelinesForm');
        });

        // Reset the editGuidelinesForm on modal close
        $('#editGuidelinesModal').on('hidden.bs.modal', function() {
            resetForm('#editGuidelinesForm');
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('#addGuidelinesForm').submit(function(e) {
            e.preventDefault();

            var formData = new FormData($(this)[0]);

            $.ajax({
                type: 'POST',
                url: '{{ route("guidelines.store") }}',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    toastr.success('Guidelines added successfully');
                    $('#addGuidelinesModal').modal('hide');
                    var guidelinesTable = $('#guidelines-table').dataTable();
                    guidelinesTable.fnDraw(false);
                },
                error: function(error) {
                    var errors = error.responseJSON.errors;
                    $.each(errors, function(key, value) {
                        $('#' + key).next('.text-danger').text(value[0]);
                    });
                }
            });
        });

        $('#updateGuidelinesBtn').on('click', function() {
            var guidelinesId = $("#editGuidelinesModal #guidelines_id").val();
            var updateFormData = new FormData($("#editGuidelinesForm")[0]);

            $.ajax({
                type: 'POST',
                url: "{{ url('admin/guidelines') }}/" + guidelinesId,
                data: updateFormData,
                contentType: false,
                processData: false,
                success: function(response) {
                    toastr.success('Guidelines updated successfully');
                    $('#editGuidelinesModal').modal('hide');
                    var guidelinesTable = $('#guidelines-table').dataTable();
                    guidelinesTable.fnDraw(false);
                },
                error: function(error) {
                    var errors = error.responseJSON.errors;
                    console.log("ERRORS", errors);

                    $.each(errors, function(key, value) {
                        $('#' + "edit_" + key).text(value[0]);
                    });
                }
            });
        });
    });
</script>