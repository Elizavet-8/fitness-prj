@extends('admin.dashboard.base')

@section('content')

    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-md-8">
                    <div class="nav-tabs-boxed" id="app">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#workout" role="tab" aria-controls="workout">Есть тренировка</a></li>
                            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#weekend" role="tab" aria-controls="weekend">Выходной</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="workout" role="tabpanel">
                                <div class="card">
                                    <div class="card-header"><strong>
                                            Редактирование
                                        </strong></div>
                                    <div class="card-body">
                                        @isset($errors)
                                            @if ($errors->any())
                                                <div class="alert alert-danger">
                                                    <ul>
                                                        @foreach ($errors->all() as $error)
                                                            <li>{{ $error }}</li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            @endif
                                        @endisset
                                        <form class="form-horizontal form" action="{{route('editTrainingDay',['id'=>$training_day->id])}}" method="post">
                                            @csrf
                                            <div class="form-group row">
                                                <label class="col-md-3 col-form-label">Название</label>
                                                <div class="col-md-9">
                                                    <input value="{{ $training_day->name }}" name="name" class="form-control" type="text" placeholder="Название ">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-3 col-form-label">Описание</label>
                                                <div class="col-md-9">
                                                    <input required name="description" class="form-control" type="text" placeholder="Описание " value="{{$training_day->description}}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-3 col-form-label">Номер дня</label>
                                                <div class="col-md-9">
                                                    <input required name="day_number" class="form-control" type="number" placeholder="Номер дня " value="{{$training_day->day_number}}">
                                                </div>
                                            </div>
                                            <input required name="training_id" class="form-control" type="hidden" value="{{$training_day->training_id}}">
                                            <div class="form-group row">
                                                <label class="col-md-3 col-form-label">Место:</label>
                                                <div class="col-md-9">
                                                    <select name="training_location_id" class="form-control">
                                                        @foreach($locations as $location)
                                                            <option value="{{$location->id}}"
                                                                @if($training_day->training_location_id === $location->id)
                                                                    selected
                                                                @endif>
                                                                {{$location->name}}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <Todolistvideo
                                                :videos="{{json_encode($training_day->videos) === null ? [] : json_encode($training_day->videos)}}"
                                            ></Todolistvideo>
                                            <Todolistinfo
                                                :infos="{{json_encode($training_day->info) === null ? [] : json_encode($training_day->info)}}"
                                            ></Todolistinfo>
                                            <div class="card-footer card-footer-edit">
                                                <button class="btn btn-sm btn-primary" type="submit"> Сохранить</button>
                                                <a class="btn btn-sm btn-danger" href="/admin/workout"> Назад</a>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="weekend" role="tabpanel">
                                <div class="card">
                                    <div class="card-header"><strong>Для груди и рук</strong></div>
                                    <div class="card-body">
                                        <form class="form-horizontal form" action="{{route('editTrainingDay',['id'=>$training_day->id])}}" method="post">
                                            @csrf
                                            <Workouttodolist
                                                :infos="{{json_encode($training_day->info)}}"
                                            ></Workouttodolist>
                                            <div class="card-footer card-footer-edit">
                                                <button class="btn btn-sm btn-primary" type="submit"> Сохранить</button>
                                                <a class="btn btn-sm btn-danger" href="/admin/workout"> Назад</a>
                                            </div>
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

@endsection

