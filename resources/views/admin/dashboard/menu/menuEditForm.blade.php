@extends('admin.dashboard.base')

@section('content')

    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header"><strong>{{ $menu->menu_content }}</strong></div>
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
                        <div class="card-body">
                            <form class="form-horizontal" action="{{route('editMenu',['id'=>$menu->id])}}" method="post">
                                @csrf
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Название</label>
                                    <div class="col-md-9">
                                        <input required value="{{ $menu->menu_content }}" name="menu_content" class="form-control" type="text" placeholder="Название ">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Цена</label>
                                    <div class="col-md-9">
                                        <input required name="menu_price" class="form-control" type="number" placeholder="Цена" value="{{$menu->menu_price}}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Тип</label>
                                    <div class="col-md-9">
                                        <select name="menu_type_id" class="form-control">
                                            @foreach($types as $type)
                                                <option value="{{$type->id}}"
                                                        @if($menu->menu_type_id === $type->id)
                                                        selected
                                                    @endif>{{$type->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Калории</label>
                                    <div class="col-md-9">
                                        <select name="menu_calories_id" class="form-control">
                                            @foreach($calories as $calorie)
                                                <option value="{{$calorie->id}}"
                                                    @if($menu->menu_calories_id === $calorie->id)
                                                        selected
                                                    @endif>{{$calorie->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Белки </label>
                                    <div class="col-md-9">
                                        <input required value="{{ $menu->proteins }}" name="proteins" class="form-control" type="text" placeholder="Белки ">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Жиры </label>
                                    <div class="col-md-9">
                                        <input required value="{{ $menu->fat }}" name="fat" class="form-control" type="text" placeholder="Жиры ">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Углеводы </label>
                                    <div class="col-md-9">
                                        <input required value="{{ $menu->carbs }}" name="carbs" class="form-control" placeholder="Углеводы " type="text">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Id в Stripe</label>
                                    <div class="col-md-9">
                                        <input required value="{{$menu->stripe_id}}" name="stripe_id" class="form-control" placeholder="Id в Stripe " type="text">
                                    </div>
                                </div>
                                <div class="card-footer card-footer-edit">
                                    <button class="btn btn-sm btn-primary" type="submit"> Сохранить</button>
                                    <a class="btn btn-sm btn-danger" href="/admin/menu"> Назад</a>
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
