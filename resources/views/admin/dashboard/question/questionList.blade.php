@extends('admin.dashboard.base')

@section('content')
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-sm-12 col-md-12">
                    <a  href="/admin/question/add" class="btn btn-primary btn-lg mb-3">Добавить</a>
                </div>
                <div class="col-lg-12">
                    @foreach($topics as $topic)
                    <div class="card">
                        <div class="card-header"><i class="fa fa-align-justify"></i>{{$topic->name}}</div>
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
                            <table class="table table-responsive-sm table-bordered table-striped table-sm">
                                <thead>
                                    <tr>
                                        <th>Заголовок</th>
                                        <th>Текст</th>
                                        <th>Настройки</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($articles as $article)
                                    @if($article->topic_id == $topic->id)
                                    <tr>
                                        <td>{{$article->name}}</td>
                                        <td>{{$article->answer}}</td>
                                        <td class="btns-edit">
                                            <a href="/admin/question/show/{{$article->id}}" class="users-btn btn btn-block btn-success">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                                    width="512px" height="512px" viewBox="0 0 512 512"
                                                    style="enable-background:new 0 0 512 512;" xml:space="preserve">
                                        <g>
                                            <path d="M256,96C144.341,96,47.559,161.021,0,256c47.559,94.979,144.341,160,256,160c111.656,0,208.439-65.021,256-160
                                                C464.441,161.021,367.656,96,256,96z M382.225,180.852c30.082,19.187,55.572,44.887,74.719,75.148
                                                c-19.146,30.261-44.639,55.961-74.719,75.148C344.428,355.257,300.779,368,256,368c-44.78,0-88.428-12.743-126.225-36.852
                                                c-30.08-19.188-55.57-44.888-74.717-75.148c19.146-30.262,44.637-55.962,74.717-75.148c1.959-1.25,3.938-2.461,5.929-3.65
                                                C130.725,190.866,128,205.613,128,221c0,70.691,57.308,128,128,128c70.691,0,128-57.309,128-128
                                                c0-15.387-2.725-30.134-7.703-43.799C378.285,178.39,380.266,179.602,382.225,180.852z M256,205c0,26.51-21.49,48-48,48
                                                s-48-21.49-48-48s21.49-48,48-48S256,178.49,256,205z"/>
                                        </g>
                                        </svg>
                                            </a>
                                            <a href="/admin/question/edit/{{$article->id}}" class="users-btn btn btn-block btn-primary">
                                                <svg id="Layer_1" style="enable-background:new 0 0 128 128;" version="1.1"
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
                                            <form action="{{route('deleteArticle',['id'=>$article->id])}}" method="POST">
                                                @csrf
                                                <button class="users-btn btn btn-block btn-danger" type="submit">
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
                                            </form>
                                        </td>
                                    </tr>
                                    @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

@endsection


@section('javascript')

@endsection
