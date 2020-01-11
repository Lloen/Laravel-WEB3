@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-center">
    <div class="card shadow w-100 ml-5 mr-5">
        <div class="card-header">
            <div class="container mx-0 px-0">
                <div class="col">
                    <h1 class="card-title" id="ingredientName">

                     </h1>
                </div>
                <div class="row">
                    <div class="col" class="rounded float-left" id="picture" height="400" width="400">
                    </div>
                </div>
            </div>
        </div>
        </div>
        <div class="card-body">
            <div class="d-flex flex-row mb-3">
                <i class="fas fa-list-ul fa-3x p-2"></i>
                <div class="prep_time p-2 ml-2">
                    <p id="scientificName">SCIENTIFIC NAME</br>

                </div>
                <div class="cooking_time p-2">
                    <p id="wikilink">WIKIPEDIA LINK </br>

                </div>
                <div class="cooking_time p-2">
                    <p id="group">GROUP </br>

                </div>
            </div>
            <div class="card-body">
                <div class="description">
                    <p id="ingredientDescription">
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
var id = '{{request()->route("ingredient")}}';

$.ajax({
        url: "/api/ingredients/ " + id,
        success: function(data) {
            $('#ingredientName').append(data.name);
            $('#ingredientDescription').append(data.description);
            $('#group').append(data.group);
            $('#wikilink').append('<a href="http://wikipedia.org/wiki/'+ data.wikipedia_id + '">' + data.name + '</a>');
            $('#scientificName').append(data.name_scientific);
            $('#picture').append('<img src="data:image/png;base64,' + data.picture + '" class="card-img-top">');
        },
    });
</script>
@stop