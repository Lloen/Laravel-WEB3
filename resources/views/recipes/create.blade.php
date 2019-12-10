<html lang="{{ app()->getLocale() }}">
    <head>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }
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
        </style>
    </head>

@section('content')   
    <body>
        <div class="flex-center position-ref full-height">

            <div class="content">
                <form method="POST" action="{{ config('app.url')}}/recipes">
                    @csrf
                    <h1> Enter Details to create a recipe</h1>

                    <div class="form-input">
                        <label>Name</label>
                        <input type="text" name="name">
                    </div>

                    <div class="form-input">
                        <label>Description</label>
                        <input type="text" name="description">
                    </div>

                    <div class="form-input">
                        <label>Prep Time</label>
                        <input type="number" name="prep_time">
                    </div>

                    <div class="form-input">
                        <label>Cooking Time</label>
                        <input type="number" name="cook_time">
                    </div>

                    <button type="submit">Submit</button>
                </form>
            </div>
        </div>
    </body>
@stop
</html>