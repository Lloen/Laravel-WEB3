<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">Update your recipe!</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">

        <div class="flex-center position-ref full-height">

            <div class="content">

                <div id="loadingIndicator" class="spinner-border" role="status" style="display:none; width: 3rem; height: 3rem;">
                    <span class="sr-only">Loading...</span>
                </div>

                <form id="fromUpdateRecipe">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input class="form-control" id="recipeInputName" name="name" placeholder="Your recipe name" maxlength="35" value="{{ $recipe->name }}" required>
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <input class="form-control" id="recipeInputDescription" name="description" rows="3" placeholder="A simple description" value="{{ $recipe->description }}" required>
                    </div>

                    <div class="form-group">
                        <label for="avatar">Picture</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="recipeInputPicture">
                            <label class="custom-file-label" for="customFileLang">Select Picture</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="ingredients">Ingredients</label>
                        <table class="table table-borderless border">
                            <thead>
                                <tr>
                                    <th scope="col" style="width: 35%">Ingredient</th>
                                    <th scope="col" style="width: 30%">Amount</th>
                                    <th scope="col" style="width: 30%">Unit</th>
                                    <th scope="col" style="width: 5%"></th>
                                </tr>
                            </thead>
                            <tbody id="ingredientData">
                                @foreach ($recipe->ingredients as $ingredient)
                                <tr>
                                    <td>
                                        <select class="selectpicker" data-width="100%" show-tick data-live-search="true" title="Add an ingredient.." data-style="btn-neutral">
                                            @foreach ($ingredients as $ingredientSelect)
                                            @if ($ingredient->id == $ingredientSelect->id)
                                            <option value="{{ $ingredientSelect->id }}" selected="selected">{{$ingredientSelect->name}}</option>
                                            @else
                                            <option value="{{ $ingredientSelect->id }}" >{{$ingredientSelect->name}}</option>
                                            @endif
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <input type="number" min="0" step="0.01" class="form-control" id="ingredientAmount" name="ingredient_amount" value="{{ $ingredient->amount }}" required>
                                    </td>
                                    <td>
                                        <input class="form-control" id="ingredientUnit" name="ingredient_unit" value="{{ $ingredient->unit }}" required>
                                    </td>
                                    <td>
                                        <button id="btnDeleteIngredient" type="button" class="btn btn-outline-danger">
                                            <i class="far fa-trash-alt"></i>
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <td>
                                    <button id="btnNewIngredient" type="button" class="btn btn-outline-secondary">New Ingredient</button>
                                </td>
                            </tfoot>
                        </table>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="prep_time">Prep time (Minutes)</label>
                            <input type="number" min="0" step="1" class="form-control" id="recipeInputPrepTime" name="prep_time" value="{{ $recipe->prep_time }}" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="cook_time">Cook time (Minutes)</label>
                            <input type="number" min="0" step="1" class="form-control" id="recipeInputCookTime" name="cook_time" value="{{ $recipe->cook_time }}" required>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-outline-dark" data-dismiss="modal">Close</button>
        <button id="btnSubmit" class="btn btn-success">Save</button>
    </div>
</div>

<script>
    //Run script to import input field show file name
    $(document).ready(function() {
        bsCustomFileInput.init()
    })

    // On New Ingredient button click, create a new row of ingredient on table
    $('#btnNewIngredient').on('click', function(e) {
        $('.table').find('tbody:last').append('<tr><td><select class="selectpicker" data-width="100%" show-tick data-live-search="true" title="Add an ingredient.." data-style="btn-neutral">@foreach ($ingredients as $ingredient) <option value="{{ $ingredient->id }}">{{$ingredient->name}}</option>@endforeach </select></td><td><input type="number" min="0" step="0.01" class="form-control" id="ingredientAmount" name="ingredient_amount" required></td><td><input class="form-control" id="ingredientUnit" name="ingredient_unit" required></td><td><button id="btnDeleteIngredient" type="button" class="btn btn-outline-danger"><i class="far fa-trash-alt"></i></button></td></tr>');
        $('select').selectpicker();
    });
    // On Delete Ingredient button remove the row
    $(document).on('click', '#btnDeleteIngredient', function(e) {
        $(this).closest("tr").remove();
    });

    //Update form via AJAX
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $("#btnSubmit").click(function(e) {
        if ($("#fromUpdateRecipe").valid()) {
            // Go thourgh the table and put each cell in a value for JSON
            var rows = ($('.table tr').length);
            rows = -1;
            var dataIngredients = $('.table tr:gt(0):lt(' + rows + ')').map(function() {
                return {
                    id: $(this.cells[0]).find("select").val(),
                    amount: $(this.cells[1]).find("input[type='number']").val(),
                    unit: $(this.cells[2]).find("input").val()
                };
            }).get();

            var formData = new FormData();
            formData.append('_method', 'PATCH');
            formData.append('name', $("input[name=name]").val());
            formData.append('description', $("input[name=description]").val());
            formData.append('prep_time', $("input[name=prep_time]").val());
            formData.append('cook_time', $("input[name=cook_time]").val());
            formData.append('ingredients', JSON.stringify(dataIngredients));
            if ($('#recipeInputPicture')[0].files[0] != undefined)
                formData.append('picture', $('#recipeInputPicture')[0].files[0]);

            $.ajax({
                type: 'POST',
                url: "{{ route('recipes.update', $recipe->id) }}",
                contentType: false,
                processData: false,
                data: formData,
                success: function(response) {
                    window.location.replace(response);
                }
            });
        }
    });

    $(document).ajaxSend(function(e) {
        $('#loadingIndicator').show();
    });

    $(document).ajaxComplete(function(e) {
        $('#loadingIndicator').hide();
    });
</script>