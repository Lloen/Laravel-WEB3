@extends('layouts.master')
<head>
    <style>
         .full-height {
                height: 100vh;
            }
            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }
            .position-ref {
                position: relative;
            }
            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }
            .content {
                text-align: center;
            }
            .title {
                font-size: 84px;
            }
            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }
            .m-b-md {
                margin-bottom: 30px;
            }
            .form-input{
                margin-bottom: 20px;
            }
            table{
                width: 100%;
            }
    </style>
</head>

@section('content')
<body>
    <div class="flex-center position-ref full-height">
        <div class="content">
            <h1>Here's a list of recipes</h1>
            <table>
                <thead>
                    <td>Name</td>
                    <td>Prep Time</td>
                    <td>Cooking Time</td>
                    <td>Create By</td>
                </thead>
                <tbody>
                    @foreach ($recipes as $recipe)
                    <tr>
                        <td>{{ $recipe->name }}</td>
                        <td class="inner-table">{{ $recipe->prep_time }}</td>
                        <td class="inner-table">{{ $recipe->cook_time }}</td>
                        <td class="inner-table">{{ $recipe->created_by }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
@stop

</html>
