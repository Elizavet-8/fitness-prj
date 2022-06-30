@extends('admin.dashboard.base')

@section('content')

    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header"><strong>{{$program->name}}</strong></div>
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
                            <form class="form-horizontal" action="/admin/program/edit/{{$program->id}}" method="post">
                                @csrf
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Окончание акции:</label>
                                    <div class="col-md-9">
                                        <input required class="form-control" name="finish_date" type="datetime-local" value="{{ date('Y-m-d\TH:i', $program->finish_date) }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Цена без скидки:</label>
                                    <div class="col-md-9">
                                        <input required class="form-control" name="price" type="number" value="{{$program->price}}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Цена со скидкой:</label>
                                    <div class="col-md-9">
                                        <input required class="form-control" name="discount_price" type="number" value="{{$program->discount_price}}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="form-group col-md-6">
                                        <label for="inputState">Меню:</label>
                                        <select id="inputState" class="form-control" name="menu_id">
                                            @foreach($menus as $menu)
                                                <option value="{{$menu->id}}"
                                                        @if($program->menu_id === $menu->id)
                                                        selected
                                                    @endif>
                                                    {{$menu->menu_content}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputState">Тренировка:</label>
                                        <select id="inputState" class="form-control" name="training_id">
                                            @foreach($trainings as $training)
                                                <option value="{{$training->id}}"
                                                    @if($program->training_id === $training->id)
                                                        selected
                                                        @endif>
                                                    {{$training->name}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Дополнительно о тренировках:</label>
                                    <div class="col-md-9">
                                        <input class="form-control" name="about_trainings" type="text" value="{{$program->about_trainings}}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Дополнительно о рационе:</label>
                                    <div class="col-md-9">
                                        <input class="form-control" name="about_ration" type="text" value="{{$program->about_ration}}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Дополнительно о процедурах:</label>
                                    <div class="col-md-9">
                                        <input class="form-control" name="about_procedures" type="text" value="{{$program->about_procedures}}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Дополнительно о поддержке:</label>
                                    <div class="col-md-9">
                                        <input class="form-control" name="about_support" type="text" value="{{$program->about_support}}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Дополнительно о мотивации:</label>
                                    <div class="col-md-9">
                                        <input class="form-control" name="about_motivation" type="text" value="{{$program->about_motivation}}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Id услуги в Stripe:</label>
                                    <div class="col-md-9">
                                        <input class="form-control" name="stripe_id" type="text" value="{{$program->stripe_id}}">
                                    </div>
                                </div>
                                <div class="card-footer card-footer-edit">
                                    <button class="btn btn-sm btn-primary" type="submit"> Сохранить</button>
                                    <a class="btn btn-sm btn-danger" href="/admin/program"> Назад</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection

@section('javascript')

@endsection
