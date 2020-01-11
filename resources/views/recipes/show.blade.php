@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-center">
    <div class="card shadow w-100 ml-5 mr-5">
        <div class="card-header">
            <div class="container mx-0 px-0">
                <div class="row">
                    <div class="col">
                        <img class="rounded float-left" src="/storage/images/recipes/{{ $recipe->picture }}">
                    </div>
                    <div class="col">
                        <div class="d-flex flex-column justify-content-end">
                            <h1 class="card-title">
                                {{ $recipe->name }}
                            </h1>
                            <div class="description">
                                <p>
                                    {{ $recipe->description }}
                                </p>
                            </div>
                        </div>
                        <div class="d-flex flex-column justify-content-end">
                            <div class="votes">
                                <p>
                                    <i class="far fa-heart mr-2"></i> {{ $recipe->votes }}
                                </p>
                            </div>
                            <div class="created_by">
                                <p>
                                    <i class="fas fa-user mr-2"></i>
                                    <a href="{{ url('/profile/'.$recipe->user->id) }}">{{ $recipe->user->name }}</a>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex flex-column mt-auto">

                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="d-flex flex-row mb-3">
                <i class="far fa-clock fa-3x p-2"></i>
                <div class="prep_time p-2 ml-2">
                    <p>Prep:</br>
                        {{ $recipe->prep_time }}</p>
                </div>
                <div class="cooking_time p-2">
                    <p>Cook: </br>
                        {{ $recipe->cook_time }}</p>
                </div>
            </div>
            <div class="d-flex flex-row mb-3">
                <i class="fas fa-utensils fa-3x p-2"></i>
                <div>
                    <ul>
                        @foreach ($recipe->ingredients as $ingredient)
                        <li>
                            {{ $ingredient->pivot->amount }}
                            {{ $ingredient->pivot->unit }} of
                            <a href="{{ route('ingredients.show', $ingredient->id) }}" > {{ $ingredient->name }}</a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="d-flex flex-row mb-3">
                <i class="fas fa-list-ol fa-3x p-2"></i>
            </div>
        </div>
    </div>
</div>

<a type="button" class="btn btn-success fixedbutton" href="{{ url('/recipes/download/'.$recipe->id) }}">
    <i class="fas fa-arrow-down fa-2x pt-1"></i>
</a>
@stop