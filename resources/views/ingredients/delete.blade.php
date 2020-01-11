<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">Delete Recipe</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <p>Are ou sure you want to delete {{$recipe->name}}?</p>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-outline-dark" data-dismiss="modal">Close</button>
        <form action="{{ route('recipes.destroy', $recipe->id) }}" method="post">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger" type="submit">Delete</button>
        </form>
    </div>
</div>