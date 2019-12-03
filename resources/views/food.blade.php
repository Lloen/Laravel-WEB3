<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <title>Laravel</title>

        <!-- Styles -->
        <style>
            html{
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
            }

            .post{
                width: 800px;
                height: 160px;
                clear: both;
                padding: 20px;
                margin: 20px;
                border: solid;
            }

            .clearfix {
                overflow: auto;
            }

            .name{
                text-align: center;
            }

            button{

                width: 100px;
                height: 50px;
                float: right;
                vertical-align: bottom;
                background-color: #4CAF50; /* Green */
                border: none;
                color: white;
                text-align: center;
                text-decoration: none;
                display: inline-block;
            }
            .image{
                width: 150px;
                height: 150px;
                border-style: solid;
                float: left;

            }

            .title{
                margin:50px;

            }
            
        </style>
    </head>

    <body>
        <div class="title">
            <h> FOODS </h>
        </div>

        <div class="content">
            @foreach($foods as $food)
                <div class="post">
                    <div class="image clearfix">
                    </div>

                        <div class="name">
                            <h3>{{$food->name}}</h3>
                        </div>

                        <div class="description">
                        </div>
                
                    <button type="button" value="button" onclick="window.location.href = '/food/' + {{$food->id}};">  OPEN </button>
                </div>              
            @endforeach
        </div>
    </body>

</html>
