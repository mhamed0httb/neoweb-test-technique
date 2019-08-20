@extends('master')

@section('title', "Modifier horaire : " . $restaurant->name )


@section('customStyles')
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/css/tempusdominus-bootstrap-4.min.css"/>


@endsection

@section('navigation')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ Route('restaurant.list') }}">Liste des restaurants</a></li>
            <li class="breadcrumb-item active" aria-current="page">Modifier horaire : {{ $restaurant->name }}</li>
        </ol>
    </nav>
@endsection

@section('pageBody')

    <div class="container">


        <form method="get" action="{{ Route('restaurant.calendar', ['id'=>$restaurant->id]) }}" id="form_choose_day">
            <div class="form-group">
                <label for="choose_day">Choisir le jour</label>
                <select class="form-control" id="choose_day" name="day" onchange="onDayChange()">
                    <option value="none">aucune</option>
                    @foreach (config('enums.week_days') as $day)
                        <option value="{{ $day }}" {{ $chosenDay == $day ? 'selected' : '' }}>{{ $day }}</option>
                    @endforeach
                </select>
            </div>
        </form>

        <h1>{{ $chosenDay }}</h1>


        @if($errors->has('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Erreur!</strong> {{ $errors->first()}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        @if($chosenDay != "Choisir le jour")

            <div class="row" style="margin-left: 10px">
                <form id="form_closing_day" method="post" action="{{ Route('calendar.closing_day') }}">
                    {{ csrf_field() }}
                    <div class="custom-control custom-switch">
                        <input type="checkbox"
                               name="closing_day"
                               class="custom-control-input"
                               {{ $calendar != null && $calendar->type == config('enums.opening_types')['closing'] ? 'checked' : '' }}
                               id="switch_closing_day"
                               onchange="onClosingDayChange()"
                        >
                        <label class="custom-control-label" for="switch_closing_day">Jour de fermeture</label>
                    </div>
                    <input type="hidden" name="id_restaurant" value="{{ $restaurant->id }}"/>
                    <input type="hidden" name="day" value="{{ $chosenDay }}"/>
                </form>

                <form style="margin-left: 50px; {{ $calendar != null && $calendar->type == config('enums.opening_types')['closing'] ? 'display:none' : '' }}"
                      id="form_half_day" method="post" action="{{ Route('calendar.half_day') }}">
                    {{ csrf_field() }}
                    <div class="custom-control custom-switch">
                        <input type="checkbox"
                               name="half_day"
                               class="custom-control-input"
                               {{ $calendar != null && $calendar->type == config('enums.opening_types')['half-time'] ? 'checked' : '' }}
                               id="switch_half_day"
                               onchange="onHalfDayChange()"
                        >
                        <label class="custom-control-label" for="switch_half_day">demi-journée</label>
                    </div>
                    <input type="hidden" name="id_restaurant" value="{{ $restaurant->id }}"/>
                    <input type="hidden" name="day" value="{{ $chosenDay }}"/>
                </form>

            </div>



            <div class="row"
                 style="{{ $calendar != null && $calendar->type == config('enums.opening_types')['closing'] ? 'display:none' : '' }}">
                <div class="col-8">
                    <form method="post" action="{{ Route('restaurant.calendar.update') }}">
                        {{ csrf_field() }}

                        <div class="form-group" style="margin-top: 30px">
                            <label for="close_time">heure d'ouverture</label>
                            <div class="input-group date" id="opentimepicker" data-target-input="nearest">
                                <input type="text" name="open_time" class="form-control datetimepicker-input"
                                       data-target="#opentimepicker" required/>
                                <div class="input-group-append" data-target="#opentimepicker"
                                     data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-clock-o"></i></div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="close_time">heure de fermeture</label>
                            <div class="input-group date" id="closetimepicker" data-target-input="nearest">
                                <input type="text" name="close_time" class="form-control datetimepicker-input"
                                       data-target="#closetimepicker" required/>
                                <div class="input-group-append" data-target="#closetimepicker"
                                     data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-clock-o"></i></div>
                                </div>
                            </div>
                        </div>


                        <input type="hidden" name="id_restaurant" value="{{ $restaurant->id }}"/>
                        <input type="hidden" name="day" value="{{ $chosenDay }}"/>

                        <button type="submit" class="btn btn-primary">Ajouter</button>
                    </form>
                </div>
                <div class="col-4">
                    @if($slots != null)
                        <h3>Les horaires du {{ $chosenDay }}</h3>
                        @foreach ($slots as $slot)
                            <div class="card" style="margin-top: 20px">
                                <div class="card-body">
                                    <h5 class="card-title">Heure d'ouverture</h5>
                                    <h6 class="card-subtitle mb-2 text-muted">{{ Carbon\Carbon::parse($slot->start_time)->format('h:i a') }}</h6>
                                    <h5 class="card-title">Heure de fermeture</h5>
                                    <h6 class="card-subtitle mb-2 text-muted">{{ Carbon\Carbon::parse($slot->close_time)->format('h:i a') }}</h6>
                                    <form method="post" action="{{ Route('slot.delete') }}">
                                        {{ csrf_field() }}
                                        <input type="hidden" value="{{$slot->id}}" name="id_slot"/>
                                        <input type="submit" href="#" class="card-link btn btn-danger"
                                               value="Supprimer"/>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>


        @endif


    </div>

@endsection

@section('customScripts')

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
    <script type="text/javascript"
            src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/js/tempusdominus-bootstrap-4.min.js"></script>


    <script>
        function onDayChange() {
            let day = $('#choose_day').val();
            if (day !== "none") {
                $('#form_choose_day').submit();
            }
        }

        function onClosingDayChange() {
            $('#form_closing_day').submit();
        }

        function onHalfDayChange() {
            $('#form_half_day').submit();
        }
    </script>



    <script type="text/javascript">
        $(function () {
            $('#opentimepicker').datetimepicker({
                format: 'LT'
            });
        });

        $(function () {
            $('#closetimepicker').datetimepicker({
                format: 'LT'
            });
        });
    </script>
@endsection