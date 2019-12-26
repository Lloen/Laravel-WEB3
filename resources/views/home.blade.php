@extends('layouts.app')

<style>
        .content {
            position: absolute;
            width: 400px;
            height: 400px;
            z-index: 15;
            top: 50%;
            left: 50%;
            margin: -100px 0 0 -150px;
            }

        .title {
            font-size: 60px;
        }
</style>

@section('content')

<div class="content">
    <div class="title">
        Home Page
    </div>
    <p>
        There are {{$recipesCount ?? ''}} total recipes.
    </p>
</div>

@stop
