@extends('layouts.app')

@section('content')
@if(session()->get('success'))
<div class="alert alert-success">
    {{ session()->get('success') }}
</div><br />
@endif

<div class="row">
    @foreach ($recipes as $recipe)
    <div class="col-sm-3 mb-4">
        <div class="card h-100 shadow">
            @if (Auth::check())
            <img src="storage\images\recipes\{{ $recipe->picture }}" class="card-img-top" alt="...">
            @else
            <img src="storage\images\recipes\{{ $recipe->picture }}" class="card-img-top" style="filter: blur(8px);" alt="...">
            @endif
            <div class="card-body">
                <h5 class="card-title">{{ $recipe->name }}</h5>
                <p class="card-text">{{ $recipe->description }}</p>
            </div>
            <div class="card-footer text-muted">
                <a href="{{ route('recipes.show', $recipe->id) }}" class="btn btn-primary w-100">View Recipe</a>
            </div>
        </div>
    </div>
    @endforeach
</div>
@if (Auth::check())
<a href="{{ route('recipes.create') }}" class="btn btn-success rounded-circle fixedbutton btn-lg shadow " id="btnAddRecipe"><i class="fas fa-plus"></i></a>
@endif

<style>
    .fixedbutton {
        position: absolute;
        bottom: 50px;
        right: 50px;
    }

</style>

<script type="text/javascript">
    $(document).ready(function() {
        $('#btnAddRecipe').on('click', function(e) {
            e.preventDefault();
            var link = this.href;
            $('.modal').modal('toggle');
            $('.modal').load(link, function() {
            $('select').selectpicker();
            })
        });


    });
</script>

@stop