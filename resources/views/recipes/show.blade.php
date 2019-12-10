@extends('layouts.app')

@section('content')
<div class="content">
    <div class="post">
        <div class="image clearfix">
        </div>

        <div class="name">
            <h3>Recipe: {{$recipe->name}}</h3>
        </div>

        <div class="description">
            <P>Description: {{$recipe->description}} </p>
        </div>

        <div class="prep_time">
            <P>Preparation time: {{$recipe->prep_time}} </p>
        </div>

        <div class="cooking_time">
            <P>Cooking time: {{$recipe->cooking_time}} </p>
        </div>

        <div class="votes">
            <P>Votes: {{$recipe->votes}} </p>
        </div>

        <div class="created_by">
            <P>Created by: {{$recipe->create_by}} </p>
        </div>
    </div>
</div>
@stop