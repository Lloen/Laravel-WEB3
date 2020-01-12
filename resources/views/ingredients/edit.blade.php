<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">Update your ingredient!</h5>
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
                        <input class="form-control" id="nameInput" name="name" >
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <input class="form-control" id="descriptionInput" name="description" ></input>
                    </div>

                    <div class="form-group">
                        <label for="wikipediaLink">Wikipedia link</label>
                        <input class="form-control" id="wikipediaInput" name="wikipedia_id" >
                    </div>

                    <div class="form-group">
                        <label for="scientificName">Scientific name</label>
                        <input class="form-control" id="scientificInput" name="name_scientific" >
                    </div>

                    <div class="form-group">
                        <label for="group">Group</label>
                        <input class="form-control" id="groupInput" name="group" >
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
    // get ingredient data to display it in input form
    $.ajax({
        url: '/api/ingredients/{{$id}}',
        type: 'GET',
        success: function(data) {
            $("#nameInput").val(data.name);
            $("#descriptionInput").val(data.description);
            $("#wikipediaInput").val(data.wikipedia_id).text();
            $("#scientificInput").val(data.name_scientific);
            $("#groupInput").val(data.group);
        },
    });

    //update ingredient on button sumbmit
    $('#btnSubmit').click(function() {
        var formData = new FormData();
        formData.append('_method', 'POST');
        formData.append('name', $("input[name=name]").val());
        formData.append('description', $("input[name=description]").val());
        formData.append('wikipedia_id', $("input[name=wikipedia_id]").val());
        formData.append('name_scientific', $("input[name=name_scientific]").val());
        formData.append('group', $("input[name=group]").val());

        $.ajax({
            url: '/api/ingredients/{{$id}}',
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

