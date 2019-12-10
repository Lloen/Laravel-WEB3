<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">Update your recipe!</h5>
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
                <form method="POST" action="{{ route('recipes.update', $recipe->id) }}">
                    @method('PATCH')
                    @csrf
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input class="form-control" id="recipeInputName" name="name" value="{{ $recipe->name }}">
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <input class="form-control" id="recipeInputDescription" name="description" rows="3" value="{{ $recipe->description }}">
                    </div>

                    <div class="form-group">
                        <label for="prep_time">Prep time</label>
                        <input class="form-control" id="recipeInputPrepTime" name="prep_time" value="{{ $recipe->prep_time }}">
                    </div>

                    <div class="form-group">
                        <label for="cook_time">Cook time</label>
                        <input class="form-control" id="recipeInputCookTime" name="cook_time" value="{{ $recipe->cook_time }}">
                    </div>

                    <button type="submit" class="btn btn-success">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>