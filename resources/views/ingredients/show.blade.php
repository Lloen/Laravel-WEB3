@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-center">
    <div class="card shadow w-100 ml-5 mr-5">
        <div class="card-header">
            <div class="container mx-0 px-0">
                <div class="row">
                    <div class="col">
                        IMAGE
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <h1 class="card-title">
                            INGREDIENT NAME
                        </h1>

                        <div class="d-flex flex-column justify-content-end">
                            <div class="created_by">
                                <p>
                                    <i class="fas fa-user mr-2"></i>
                                        USER
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="d-flex flex-row mb-3">
                <i class="fas fa-list-ul fa-3x p-2"></i>
                <div class="prep_time p-2 ml-2">
                    <p>SCIENTIFIC NAME</br>
                        SCIENTIFIC NAME
                </div>
                <div class="cooking_time p-2">
                    <p>WIKIPEDIA LINK </br>
                        WIKIPEDIA LINK
                </div>
                <div class="cooking_time p-2">
                    <p>GROUP </br>
                        GROUP
                </div>
            </div>
            <div class="card-body">
                <div class="description">
                <p>
                    Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum  Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum  Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum 
                    Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum  Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum  Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum
                    Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum  Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum  Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum 
                </p>
                </div>
            </div>
        </div>
    </div>
</div>

@stop