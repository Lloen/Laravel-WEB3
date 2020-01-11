<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">Create an ingredient!</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="flex-center position-ref full-height">
            <div class="content">
                <form>
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input class="form-control" name="name">
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <input class="form-control" name="description">
                    </div>

                    <div class="form-group">
                        <label for="wikipedia_id">Wikipedia link</label>
                        <input class="form-control" name="wikipedia_id">
                    </div>

                    <div class="form-group">
                        <label for="name_scientific">Scientific name</label>
                        <input class="form-control" name="name_scientific">
                    </div>

                    <div class="form-group">
                        <label for="group">Group</label>
                        <input class="form-control" name="group">
                    </div>

                </form>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-outline-dark" data-dismiss="modal">Close</button>
        <button id="btnSubmit" class="btn btn-success">Submit</button>
    </div>
</div>

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#btnSubmit').click(function() {
        var formData = new FormData();
        formData.append('name', $("input[name=name]").val());
        formData.append('description', $("input[name=description]").val());
        formData.append('wikipedia_id', $("input[name=wikipedia_id]").val());
        formData.append('name_scientific', $("input[name=name_scientific]").val());
        formData.append('group', $("input[name=group]").val());
        // if ($('#recipeInputPicture')[0].files[0] != undefined)
        //     formData.append('picture', $('#recipeInputPicture')[0].files[0]);

        $.ajax({
            url: '/api/ingredients/',
            type: 'POST',
            contentType: false,
            processData: false,
            data: formData,
            success: function(result) {
                location.reload();
            }
        });
    });
</script>