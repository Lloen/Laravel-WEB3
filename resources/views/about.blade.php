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
        About Us
    </div>
    <p>
        A WEB3 project about a page to upload recipes.</br>
        <i class="fab fa-laravel"></i> <i class="fab fa-bootstrap"></i>
    </p>
</div>

@stop