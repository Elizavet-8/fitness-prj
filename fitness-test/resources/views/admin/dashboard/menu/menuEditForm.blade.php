@extends('admin.dashboard.base')

@section('content')

    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header"><strong>Меню №1</strong></div>
                        <div class="card-body">
                            <form class="form-horizontal" action="" method="post">
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="hf-email">Название</label>
                                    <div class="col-md-9">
                                        <input class="form-control" id="hf-email" type="email" placeholder="Название " autocomplete="email">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="hf-email">Количесво дней </label>
                                    <div class="col-md-9">
                                        <input class="form-control" id="hf-email" type="email" placeholder="Количесво дней " autocomplete="email">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="hf-email">Калории </label>
                                    <div class="col-md-9">
                                        <input class="form-control" id="hf-email" type="email" placeholder="Калории " autocomplete="email">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="hf-email">Белки </label>
                                    <div class="col-md-9">
                                        <input class="form-control" id="hf-email" type="email" placeholder="Белки " autocomplete="email">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="hf-email">Жиры </label>
                                    <div class="col-md-9">
                                        <input class="form-control" id="hf-email" type="email" placeholder="Жиры " autocomplete="email">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="hf-email">Углеводы </label>
                                    <div class="col-md-9">
                                        <input class="form-control" id="hf-email" type="email" placeholder="Углеводы " autocomplete="email">
                                    </div>
                                </div>
                                <div class="card-footer card-footer-edit">
                                    <button class="btn btn-sm btn-primary" type="submit"> Сохранить</button>
                                    <button class="btn btn-sm btn-danger" type="reset"> Назад</button>
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
