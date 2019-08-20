@extends('master')

@section('title', "Liste des restaurants")

@section('navigation')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ Route('restaurant.list') }}">Liste des restaurants</a></li>
            <!--
              <li class="breadcrumb-item"><a href="#">Library</a></li>
              <li class="breadcrumb-item active" aria-current="page">Data</li>
            -->
        </ol>
    </nav>
@endsection

@section('pageBody')

    <div class="container">



        <div class="row" style="border: 1px solid #74787e; padding: 10px">
            <div class="col-6">sdzf azd</div>
            <div class="col-6" style="color: white">
                <a href="#" class="btn btn-info float-right">Modifier horaires</a>
                <a href="#" class="btn btn-dark float-right" style="margin-right: 10px">voir horaires</a></a>
            </div>
        </div>

        <hr class="my-3">

        <div class="row" style="border: 1px solid #74787e; padding: 10px">
            <div class="col-6">sdzf azd</div>
            <div class="col-6" style="color: white">
                <a href="#" class="btn btn-info float-right">Modifier les horaires</a>
                <a href="#" class="btn btn-dark float-right" style="margin-right: 10px">Voir horaires</a></a>
            </div>
        </div>
    </div>

@endsection