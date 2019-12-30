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
                <form>
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input class="form-control" id="recipeInputName" name="name" placeholder="Your recipe name" maxlength="35">
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <input class="form-control" id="recipeInputDescription" name="description" rows="3" placeholder="A simple description">
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
                                        <select class="selectpicker show-tick w-100" data-live-search="true" title="Add an ingredient..">
                                            @foreach ($ingredients as $ingredient)
                                            <option value="{{ $ingredient->id }}" >{{ $ingredient->name }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <input type="number" min="0" step="0.01" class="form-control" id="ingredientAmount" name="ingredient_amount">
                                    </td>
                                    <td>
                                        <input class="form-control" id="ingredientUnit" name="ingredient_unit">
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
                            <input type="number" min="0" step="1" class="form-control" id="recipeInputPrepTime" name="prep_time">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="cook_time">Cook time (Minutes)</label>
                            <input type="number" min="0" step="1" class="form-control" id="recipeInputCookTime" name="cook_time">
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
        $('.table').find('tbody:last').append('<tr><td><select class="selectpicker show-tick w-100" data-live-search="true" title="Add an ingredient..">@foreach ($ingredients as $ingredient) <option value="{{ $ingredient->id }}">{{$ingredient->name}}</option>@endforeach </select></td><td><input type="number" min="0" step="0.01" class="form-control" id="ingredientAmount1" name="ingredient_amount_1"></td><td><input class="form-control" id="ingredientUnit" name="ingredient_variable_1"></td><td><button id="btnDeleteIngredient" type="button" class="btn btn-outline-danger"><i class="far fa-trash-alt"></i></button></td></tr>');
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
        // Go thourgh the table and put each cell in a value for JSON
        var rows = ($('.table tr').length);
        rows =- 1;
        var data = $('.table tr:gt(0):lt('+rows+')').map(function() {
            return {
                id: $(this.cells[0]).find("select").val(),
                amount: $(this.cells[1]).find("input[type='number']").val(),
                unit: $(this.cells[2]).find("input").val()
            };
        }).get();

        alert(JSON.stringify(data, null, 4));

        var name = $("input[name=name]").val();
        var description = $("input[name=description]").val();
        var prep_time = $("input[name=prep_time]").val();
        var cook_time = $("input[name=cook_time]").val();
        var ingredients = JSON.stringify(data);

        $.ajax({
            type: 'POST',
            url: "{{ route('recipes.store') }}",
            data: {
                name: name,
                description: description,
                prep_time: prep_time,
                cook_time: cook_time,
                ingredients: ingredients
            },
            success: function(data) {
                alert(data.success);
            }
        });
    });
</script>