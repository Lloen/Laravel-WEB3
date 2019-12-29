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
                <form method="POST" action="{{ route('recipes.store') }}">
                    @csrf
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input class="form-control" id="recipeInputName" name="name" placeholder="Your recipe name">
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
                                    <th scope="col">Ingredient</th>
                                    <th scope="col">Amount</th>
                                    <th scope="col">Of</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <select class="selectpicker show-tick w-100" data-live-search="true" title="Add an ingredient..">
                                            @foreach ($ingredients as $ingredient)
                                            <option>{{$ingredient->name}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <input type="number" min="0" step="1" class="form-control" id="ingredientAmount1" name="ingredient_amount_1">
                                    </td>
                                    <td>
                                        <input type="number" min="0" step="1" class="form-control" id="ingredientVatriable1" name="ingredient_variable_1">
                                    </td>
                                </tr>
                            </tbody>
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

                    <button type="submit" class="btn btn-success">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $('.selectpicker').on('changed.bs.select', function(e, clickedIndex, isSelected, previousValue) {
        $('.table').find('tbody:last').append('<tr></tr>');
    });
</script>