@extends('layouts.app')

@section('content')

@if ($errors->any())
<div class="alert alert-danger alert-block">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div><br />
@endif

@if ($message = Session::get('success'))
<div class="alert alert-success alert-block">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <strong>{{ $message }}</strong>
</div>
@endif

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
                    <div>
                        <img class="rounded float-left" src="/storage/images/users/{{ $user->avatar }}">
                    </div>
                    <div class="col-sm">
                        <p>Name: {{ $user->name }}</p>
                        @if (Auth::user()->id == $user->id)
                        <p>Email: {{ $user->email }}</p>
                        @endif
                        <p>User since: {{ $user->created_at->format('Y-m-d') }}</p>
                    </div>
                    <div class="col-sm mt-auto ml-auto">
                        @if (Auth::user()->id == $user->id)
                        <a href="/profile/{{ Auth::user()->id }}/edit" class="btn btn-dark btnEditUser">Edit</a>
                        @endif
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
                            <img src="storage\images\recipes\{{ $recipe->picture }}" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">{{ $recipe->name }}</h5>
                                <p class="card-text">{{ $recipe->description }}</p>
                            </div>
                            <div class="card-footer text-muted">
                                <div class="d-flex justify-content-around">
                                    <a href="{{ route('recipes.show', $recipe->id) }}" class="btn btn-primary w-100">View</a>
                                    @if (Auth::user()->id == $recipe->created_by)
                                    <a href="{{ route('recipes.edit', $recipe->id) }}" class="btn btn-dark btnEditRecipe w-100">Edit</a>
                                    <a href="{{ route('recipes.delete', $recipe->id) }}" class="btn btn-danger btnDeleteRecipe w-100">Delete</a>
                                    @endif
                                </div>
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
            $('.modal').load(link, function() {
                $('select').selectpicker();
            })
        });
        $('.btnEditUser').on('click', function(e) {
            e.preventDefault();
            var link = this.href;
            $('.modal').modal('toggle');
            $('.modal').load(link);
        });
    </script>
    @stop