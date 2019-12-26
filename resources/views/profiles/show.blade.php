@extends('layouts.app')

@section('content')

<div class="accordion" id="accordionExample">
    <div class="card">
        <div class="card-header" id="headingOne" data-toggle="collapse" data-target="#collapseOne">
            <h5 class="mb-0">
                User Information
            </h5>
        </div>

        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
            <div class="card-body">
                <div class="d-flex flex-row">
                    <div class="col-sm">
                        <img class="img-circle" src="data:image/png;base64,{{ chunk_split(base64_encode($user->avatar)) }}">
                    </div>
                    <div class="col-sm">
                        <p>Name: {{ $user->name }}</p>
                        <p>Email: {{ $user->email }}</p>
                        <p>User since: {{ $user->created_at->format('Y-m-d') }}</p>
                    </div>
                    <div class="col-sm mt-auto ml-auto">
                        <a href="/profile/{{ Auth::user()->id }}/edit" class="btn btn-dark btnEditUser">Edit</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header collapsed" id="headingTwo" data-toggle="collapse" data-target="#collapseTwo">
            <h5 class="mb-0">
                Recipes: {{ count($recipes) }}
            </h5>
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
                                <a href="{{ route('recipes.edit', $recipe->id) }}" class="btn btn-dark btnEditRecipe">Edit</a>
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
            $('.modal').modal('toggle');
            $('.modal').load(link);
        });
        $('.btnEditRecipe').on('click', function(e) {
            e.preventDefault();
            var link = this.href;
            $('.modal').modal('toggle');
            $('.modal').load(link);
        });
        $('.btnEditUser').on('click', function(e) {
            e.preventDefault();
            var link = this.href;
            $('.modal').modal('toggle');
            $('.modal').load(link);
        });
    </script>
    @stop