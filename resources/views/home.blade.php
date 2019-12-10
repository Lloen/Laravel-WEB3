@extends('layouts.master')
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
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
</head>


@section('content')

<div class="content">
    <div class="title">
        Home Page
    </div>
</div>

@stop