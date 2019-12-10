@extends('layouts.app')

@section('content')

<div class="accordion" id="accordionExample">
    <div class="card">
        <div class="card-header" id="headingOne">
            <h2 class="mb-0">
                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    User Information
                </button>
            </h2>
        </div>

        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
            <div class="card-body">
                Name: {{ $user->name }}
                Email: {{ $user->email }}
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header" id="headingTwo">
            <h2 class="mb-0">
                <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    Recipes
                </button>
            </h2>
        </div>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
            <div class="card-body">
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
                                <a href="{{ route('recipes.show', $recipe->id) }}" class="btn btn-primary">View</a>
                                @if ($recipe->created_by == Auth::user()->id)
                                <a href="{{ route('recipes.edit', $recipe->id) }}" class="btn btn-warning btnEditRecipe">Edit</a>
                                <a href="{{ route('recipes.delete', $recipe->id) }}" class="btn btn-danger btnDeleteRecipe">Delete</a>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>


    <script>
        $('.btnDeleteRecipe').on('click', function(e) {
            e.preventDefault();
            var link = this.href;
            $('.modal').load(link, function() {
                $('.modal').modal('toggle')
            })
        });
        $('.btnEditRecipe').on('click', function(e) {
            e.preventDefault();
            var link = this.href;
            $('.modal').load(link, function() {
                $('.modal').modal('toggle')
            })
        });
    </script>
    @stop