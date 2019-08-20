@extends('master')

@section('title', "Details restaurant : ".$restaurant->name)

@section('navigation')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ Route('restaurant.list') }}">Liste des restaurants</a></li>
            <li class="breadcrumb-item active" aria-current="page">Details restaurant : {{ $restaurant->name }}</li>
        </ol>
    </nav>
@endsection

@section('pageBody')

    <div class="container">
        <div class="row">
            @foreach (config('enums.week_days') as $day)

                <div class="col-4">
                    <h3 style="margin-top: 30px">{{ $day }}</h3>
                    <div class="card">
                        <ul class="list-group list-group-flush">
                            @if(isset($result[$day]))
                                @if($result[$day]['type'] == config('enums.opening_types')['closing'])
                                    Fermé
                                @elseif($result[$day]['type'] == config('enums.opening_types')['half-time'])
                                    Demi-journé
                                @endif

                                @if($result[$day]['type'] != config('enums.opening_types')['closing'])
                                    @foreach($result[$day]['slots'] as $slot)
                                        <li class="list-group-item">
                                            {{ Carbon\Carbon::parse($slot->start_time)->format('H:i') }} -
                                            {{ Carbon\Carbon::parse($slot->close_time)->format('H:i') }}
                                        </li>
                                    @endforeach
                                @endif

                            @endif
                        </ul>
                    </div>
                </div>


            @endforeach
        </div>
    </div>

@endsection