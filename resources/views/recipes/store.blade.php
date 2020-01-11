<!DOCTYPE html>

<html>
    <head>
        <style>
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
            <h> RECIPES </h>
        </div>

        <div class="content">
                <div class="post">
                    <div class="image clearfix">
                    </div>

                        <div class="name">
                            <h3>{{$recipe->name}}</h3>
                        </div>

                        <div class="description">
                            <P>{{$recipe->description}} </p>
                        </div>

                        <div class="prep_time">
                            <P>{{$recipe->prep_time}} </p>
                        </div>

                        <div class="cooking_time">
                            <P>{{$recipe->cooking_time}} </p>
                        </div>

                        <div class="votes">
                            <P>{{$recipe->votes}} </p>
                        </div>

                        <div class="created_by">
                            <P>{{$recipe->create_by}} </p>
                        </div>

                    <button type="button" value="button">  EDIT </button>
                    <button type="button" value="button">  DELETE </button>

                </div>              
        </div>
    </body>

</html>
