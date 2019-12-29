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
                        <label for="description">Ingredients</label>
                        <select class="selectpicker  show-tick" data-live-search="true" multiple title="Choose an ingredient...">
                            @foreach ($ingredients as $ingredient)
                            <option>{{$ingredient->name}}</option>
                            @endforeach
                        </select>
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