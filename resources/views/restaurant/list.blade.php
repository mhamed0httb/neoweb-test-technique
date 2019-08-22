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
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal_add_restaurant">
        Ajouter restaurant
    </button>
@endsection

@section('pageBody')

    <div class="container">

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Succès!</strong> {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        @foreach ($restaurants as $restaurant)
            <div class="row" style="border: 1px solid #74787e; padding: 10px">
                <div class="col-6">{{ $restaurant->name }}</div>
                <div class="col-6" style="color: white">
                    <a href="{{ Route('restaurant.calendar', ['id'=>$restaurant->id]) }}" class="btn btn-info float-right">Modifier horaires</a>
                    <a href="{{ Route('restaurant.details', ['id'=>$restaurant->id]) }}" class="btn btn-dark float-right" style="margin-right: 10px">voir horaires</a></a>
                </div>
            </div>

            <hr class="my-3">
        @endforeach

    </div>

    <!-- Modal add restaurant -->
    <div class="modal fade" id="modal_add_restaurant" tabindex="-1" role="dialog" aria-labelledby="add_restaurant_label" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="add_restaurant_label">Ajouter un nouveau restaurant</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="{{ Route('restaurant.create') }}">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="input_restaurant_name">Nom du restaurant</label>
                            <input type="text"
                                   class="form-control"
                                   id="input_restaurant_name"
                                   name="restaurant_name"
                                   required
                                   placeholder="Entrer le nom du restaurant">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection