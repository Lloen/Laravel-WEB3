@extends('layouts.app')

@section('content')
@if(session()->get('success'))
<div class="alert alert-success">
    {{ session()->get('success') }}
</div><br />
@endif

<div class="row">
    @foreach ($recipes as $recipe)
    <div class="col-sm-3">
        <div class="card h-100">
            <img src="https://www.cimec.co.za/wp-content/uploads/2018/07/4-Unique-Placeholder-Image-Services-for-Designers.png" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">{{ $recipe->name }}</h5>
                <p class="card-text">{{ $recipe->description }}</p>
            </div>
            <div class="card-footer text-muted">
                <a href="{{ route('recipes.show', $recipe->id) }}" class="btn btn-primary">View Recipe</a>
            </div>
        </div>
    </div>
    @endforeach
</div>

<a href="{{ route('recipes.create') }}" class="btn btn-success fixedbutton btn-lg shadow " id="btnAddRecipe">Add</a>

<style>
    .fixedbutton {
        position: absolute;
        bottom: 50px;
        right: 50px;
    }
</style>

@section('scripts')
<script type="text/javascript">
    $(document).ready(function() {
        $('#btnAddRecipe').on('click', function(e) {
            e.preventDefault();
            var link = this.href;
            $('.modal').load(link, function() {
                $('.modal').modal('toggle')
            })
        });
    });
</script>
@endsection

@stop