@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-center">
    <div class="card shadow w-100 ml-5 mr-5">
        <div class="card-header">
            <div class="d-flex">
                <div class="row">
                    <div class="col-sm">
                        <img class="rounded float-left" src="/storage/images/recipes/{{ $recipe->picture }}">
                    </div>
                    <div class="d-flex flex-column">
                        <h1 class="card-title">
                            {{ $recipe->name }}
                        </h1>
                        <div class="description">
                            <p>
                                {{ $recipe->description }}
                            </p>
                        </div>
                        <div class="mt-auto">
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
                            <a href="https://en.wikipedia.org/wiki/{{ $ingredient->wikipedia_id }}" target="_blank"> {{ $ingredient->name }}</a>
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
@stop