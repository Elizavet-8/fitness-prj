@extends('admin.dashboard.base')

@section('content')

    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="col-md-12">
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
                <form class="form-horizontal form" action="{{route('editMenuDay',['id'=>$menu_day->id])}}" method="post">
                    @csrf
                    <div class="nav-tabs-boxed" id="app">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#menu" role="tab"
                                                    aria-controls="workout">Приёмы пищи</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="menu" role="tabpanel">
                                <div class="card">
                                    <div class="card-header"><strong>
                                            Редактирование
                                        </strong></div>
                                    <div class="card-body">
                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label">Название дня</label>
                                            <div class="col-md-9">
                                                <input required value="{{ $menu_day->name }}" name="name" class="form-control" type="text" placeholder="Название дня">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label">№ дня</label>
                                            <div class="col-md-9">
                                                <input required value="{{ $menu_day->day_number }}" name="day_number" class="form-control" type="number" placeholder="№ дня">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label">Описание дня</label>
                                            <div class="col-md-9">
                                                <input required value="{{ $menu_day->description }}" name="description" class="form-control" type="text" placeholder="Название ">
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="inputState">Тип меню:</label>
                                            <select id="inputState" class="form-control" name="menu_type_id">
                                                @foreach($menuTypes as $type)
                                                    <option value="{{$type->id}}"
                                                        @if($menu_day->menu_type_id === $type->id)
                                                            selected
                                                        @endif>
                                                        {{$type->name}}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-4">
                                                <label class="col-form-label">Белки</label>
                                                <div>
                                                    <input required class="form-control" type="number" value="{{ $menu_day->proteins }}" name="proteins">
                                                </div>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label class="col-form-label">Жиры</label>
                                                <div>
                                                    <input required class="form-control" type="number" value="{{ $menu_day->fat }}" name="fat">
                                                </div>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label class="col-form-label">Углеводы</label>
                                                <div>
                                                    <input required class="form-control" type="number" value="{{ $menu_day->carbs }}" name="carbs">
                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" value="{{$menu_day->menu_id}}" name="menu_id">
                                        <Todolistmenu :data="{{is_string($menu_day->content) ? $menu_day->content : json_encode($menu_day->content)}}"></Todolistmenu>
                                        <Todolistinfo :data="{{is_string($menu_day->info) ? $menu_day->info : json_encode($menu_day->info)}}"></Todolistinfo>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-sm btn-primary" type="submit"> Сохранить</button>
                        <a class="btn btn-sm btn-danger" href="/admin/menu"> Назад</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection


