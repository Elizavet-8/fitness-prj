@extends('admin.dashboard.base')

@section('content')

    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="col-md-12">
                <form class="form-horizontal form" action="{{route('addMenuDay')}}" method="post">
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
                                            Добавить
                                        </strong></div>
                                    <div class="card-body">
                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label">Название дня</label>
                                            <div class="col-md-9">
                                                <input required name="name" class="form-control" type="text" placeholder="Название дня">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label">№ дня</label>
                                            <div class="col-md-9">
                                                <input required name="day_number" class="form-control" type="number" placeholder="№ дня">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label">Описание дня</label>
                                            <div class="col-md-9">
                                                <input required name="description" class="form-control" type="text" placeholder="Название ">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-4">
                                                <label class="col-form-label">Белки</label>
                                                <div>
                                                    <input required class="form-control" type="number" name="proteins">
                                                </div>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label class="col-form-label">Жиры</label>
                                                <div>
                                                    <input required class="form-control" type="number" name="fat">
                                                </div>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label class="col-form-label">Углеводы</label>
                                                <div>
                                                    <input required class="form-control" type="number" name="carbs">
                                                </div>
                                            </div>
                                        </div>
                                        <Addtodolistmenu :contents="[]"></Addtodolistmenu>
                                        <Addtodolistinfo></Addtodolistinfo>
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


