<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">Create a recipe!</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div><br />
        @endif

        <div class="flex-center position-ref full-height">

            <div class="content">
                <form id="fromCreateRecipe">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input class="form-control" id="recipeInputName" name="name" placeholder="Your recipe name" maxlength="35" required>
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <input class="form-control" id="recipeInputDescription" name="description" rows="3" placeholder="A simple description" required>
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
                                <tr>
                                    <td>
                                        <select class="selectpicker show-tick" data-width="100%" data-live-search="true" title="Add an ingredient.." required>
                                            @foreach ($ingredients as $ingredient)
                                            <option value="{{ $ingredient->id }}">{{ $ingredient->name }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <input type="number" min="0" step="0.01" class="form-control" id="ingredientAmount" name="ingredient_amount" required>
                                    </td>
                                    <td>
                                        <input class="form-control" id="ingredientUnit" name="ingredient_unit" required>
                                    </td>
                                </tr>
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
                            <input type="number" min="0" step="1" class="form-control" id="recipeInputPrepTime" name="prep_time" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="cook_time">Cook time (Minutes)</label>
                            <input type="number" min="0" step="1" class="form-control" id="recipeInputCookTime" name="cook_time" required>
                        </div>
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
    $('#btnNewIngredient').on('click', function(e) {
        $('.table').find('tbody:last').append('<tr><td><select class="selectpicker" data-width="100%" show-tick data-live-search="true" title="Add an ingredient..">@foreach ($ingredients as $ingredient) <option value="{{ $ingredient->id }}">{{$ingredient->name}}</option>@endforeach </select></td><td><input type="number" min="0" step="0.01" class="form-control" id="ingredientAmount1" name="ingredient_amount_1"></td><td><input class="form-control" id="ingredientUnit" name="ingredient_variable_1"></td><td><button id="btnDeleteIngredient" type="button" class="btn btn-outline-danger"><i class="far fa-trash-alt"></i></button></td></tr>');
        $('select').selectpicker();
    });

    $(document).on('click', '#btnDeleteIngredient', function(e) {
        $(this).closest("tr").remove();
    });


    //Post form via AJAX
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $("#btnSubmit").click(function(e) {
        if ($("#fromCreateRecipe").valid()) {
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
            formData.append('name', $("input[name=name]").val());
            formData.append('description', $("input[name=description]").val());
            formData.append('prep_time', $("input[name=prep_time]").val());
            formData.append('cook_time', $("input[name=cook_time]").val());
            formData.append('ingredients', JSON.stringify(dataIngredients));
            console.log($('#recipeInputPicture')[0].files[0]);
            if($('#recipeInputPicture')[0].files[0] != undefined )
                formData.append('picture', $('#recipeInputPicture')[0].files[0]);
                
            $.ajax({
                type: 'POST',
                url: "{{ route('recipes.store') }}",
                contentType: false,
                processData: false,
                data: formData,
                success: function(response) {
                    window.location.replace(response);
                }
            });
        }
    });
</script>