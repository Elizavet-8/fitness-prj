@extends('admin.dashboard.base')

@section('content')

    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header"><strong>Добавить уведомление</strong></div>
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
                            <form class="form-horizontal" action="{{route('addNotification')}}" method="POST">
                                @csrf
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Название:</label>
                                    <div class="col-md-9">
                                        <input required class="form-control" value="{{ old('name') }}" name="name" type="text">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">День:</label>
                                    <div class="col-md-9">
                                        <input required class="form-control" name="day" type="number">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Описание:</label>
                                    <div class="col-md-9">
                                        <textarea class="form-control" value="{{ old('description') }}" name="description" rows="3"></textarea>
                                    </div>
                                </div>
                                <div class="card-footer card-footer-edit">
                                    <button class="btn btn-sm btn-primary" type="submit"> Добавить</button>
                                    <a class="btn btn-sm btn-danger" href="/admin/notification"> Назад</a>
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
