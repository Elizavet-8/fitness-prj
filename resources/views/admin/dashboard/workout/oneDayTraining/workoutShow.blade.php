@extends('admin.dashboard.base')

@section('content')
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-sm-12 col-md-12">
                    <a href="/admin/workout/days/add/{{$id}}" class="btn btn-primary btn-lg mb-3">Добавить</a>
                </div>
                <div class="col-lg-12">
                    @foreach($trainings->days as $trainings_day)
                        <div class="card">
                            <div class="card-header"><i class="fa fa-align-justify"></i>День {{$trainings_day->day_number}}</div>
                            <div class="card-body">
                                <table class="table table-responsive-sm table-bordered table-striped table-sm">
                                    <thead>
                                    <tr>
                                        <th>
                                            @if(!is_null($trainings_day->videos))
                                                Название тренировки
                                            @else
                                                -
                                            @endif
                                        </th>
                                        <th>
                                            @if(!is_null($trainings_day->videos))
                                                Видео
                                            @else
                                                Описание
                                            @endif
                                        </th>
                                        <th>Дополнительно</th>
                                        @if(!is_null($trainings_day->videos))
                                            <th>Зал/Дом</th>
                                        @else

                                        @endif
                                        <th>Настройки</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>
                                            @if(!is_null($trainings_day->videos))
                                                {{ $trainings_day->name }}
                                            @else
                                                Выходной
                                            @endif
                                        </td>
                                        <td>
                                            @if(!is_null($trainings_day->videos))
                                                @foreach($trainings_day->videos as $video)
                                                    @if(is_string($video))
                                                        <a href="{{json_decode($video)->link}}">{{json_decode($video)->title}}</a>
                                                        @isset(json_decode($video)->preview_path)
                                                            /
                                                            <a href="{{json_decode($video)->preview_path}}">Превью</a>
                                                        @endisset
                                                    @else
                                                        <a href="{{$video["link"]}}">{{$video["title"]}}</a>
                                                        @isset($video["preview_path"])
                                                            /
                                                            <a href="{{$video["preview_path"]}}">Превью</a>
                                                        @endisset
                                                    @endif
                                                @endforeach
                                            @else
                                                {{ $trainings_day->description }}
                                            @endif
                                        </td>
                                        <td>
                                            @isset($trainings_day->info)
                                                @foreach($trainings_day->info as $item)
                                                    <p>{{$item}}</p>
                                                @endforeach
                                            @endisset
                                        </td>
                                        @if(!is_null($trainings_day->videos))
                                            <td>
                                                {{$trainings_day->trainingLocation->name}}
                                            </td>
                                        @else

                                        @endif
                                        <td class="btns-edit">
                                            <a href="/admin/workout/days/edit/{{$trainings_day->id}}"
                                               class="users-btn btn btn-block btn-primary">
                                                <svg id="Layer_1" style="enable-background:new 0 0 128 128;"
                                                     version="1.1"
                                                     viewBox="0 0 128 128" xml:space="preserve"
                                                     xmlns="http://www.w3.org/2000/svg"
                                                     xmlns:xlink="http://www.w3.org/1999/xlink"><g>
                                                        <path
                                                            d="M91.4,63.5L64.5,36.6L1,100.1V127h26.9L91.4,63.5z M9,119v-15.6l55.5-55.5l15.6,15.6L24.6,119H9z"/>
                                                        <rect height="8" width="44" x="55" y="119"/>
                                                        <rect height="8" width="8" x="109" y="119"/>
                                                        <path
                                                            d="M71.6,29.6l26.9,26.9L116.8,38L90,11.2L71.6,29.6z M98.4,45.1L82.9,29.6l7.1-7.1L105.5,38L98.4,45.1z"/>
                                                    </g></svg>
                                            </a>
                                            <button type="submit"  class="users-btn btn btn-block btn-danger" onclick="deleteDay({{$trainings_day->id}})">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                     xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                                     viewBox="0 0 791.908 791.908"
                                                     style="enable-background:new 0 0 791.908 791.908;"
                                                     xml:space="preserve">
                                                    <g>
                                                        <path d="M648.587,99.881H509.156C500.276,43.486,452.761,0,394.444,0S287.696,43.486,279.731,99.881H142.315
                                                            c-26.733,0-48.43,21.789-48.43,48.43v49.437c0,24.719,17.761,44.493,41.564,47.423V727.64c0,35.613,28.655,64.268,64.268,64.268
                                                            h392.475c35.613,0,64.268-28.655,64.268-64.268V246.087c23.711-3.937,41.564-23.711,41.564-47.423v-49.437
                                                            C697.017,121.67,675.228,99.881,648.587,99.881z M394.444,36.62c38.543,0,70.219,26.733,77.085,63.261H316.351
                                                            C324.225,64.268,355.901,36.62,394.444,36.62z M618.924,728.739c0,14.831-11.901,27.648-27.648,27.648H198.71
                                                            c-14.831,0-27.648-11.901-27.648-27.648V247.185h446.948v481.554H618.924z M660.397,197.748c0,6.958-4.944,11.902-11.902,11.902
                                                            H142.223c-6.958,0-11.902-4.944-11.902-11.902v-49.437c0-6.958,4.944-11.902,11.902-11.902h505.265
                                                            c6.958,0,11.901,4.944,11.901,11.902v49.437H660.397z M253.09,661.45V349.081c0-9.887,7.873-17.761,17.761-17.761
                                                            s17.761,7.873,17.761,17.761V661.45c0,9.887-7.873,17.761-17.761,17.761C260.964,680.309,253.09,671.337,253.09,661.45z
                                                             M378.606,661.45V349.081c0-9.887,7.873-17.761,17.761-17.761c9.887,0,17.761,7.873,17.761,17.761V661.45
                                                            c0,9.887-7.873,17.761-17.761,17.761C386.57,680.309,378.606,671.337,378.606,661.45z M504.212,661.45V349.081
                                                            c0-9.887,7.873-17.761,17.761-17.761s17.761,7.873,17.761,17.761V661.45c0,9.887-7.873,17.761-17.761,17.761
                                                            C513.093,680.309,504.212,671.337,504.212,661.45z"/>
                                                    </g>
                                                    </svg>
                                            </button>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <script>
        function deleteDay(id) {
            axios.delete('/admin/workout/days/remove/' + id)
                .then(() => {
                    location.reload();
                })
                .catch(() => {
                    location.reload();
                })
        }
    </script>
@endsection


@section('javascript')

@endsection
