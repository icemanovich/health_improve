@extends("layout")
@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="h4 col-xs-6">
                    {{ $doctor->name or 'Noname' }}
                    <i class="small">({{$doctor->speciality}})</i>
                    </i>
                </div>
                <div class="h4 col-xs-6">
                    <a href="{{URL::to('/doctor')}}" role="button" class="btn btn-xs btn-default pull-right">Назад</a>
                </div>
            </div>
        </div>
        <div class="panel-body">
            <div>
                @if(isset($doctor))

                    <div class="row">
                        <div class="col-md-4">
                            <img class="thumbnail" src="{{$doctor->photo}}" data-holder-rendered="true" style="width: 200px; height: 200px;"/>
                        </div>
                        <div class="col-md-8">
                            <table class="table">
                                <tbody>
                                <tr>
                                    <td>Email</td>
                                    <td>{{$doctor->email}}</td>
                                </tr>
                                <tr>
                                    <td>Специальность</td>
                                    <td>{{$doctor->speciality}}</td>
                                </tr>
                                <tr>
                                    <td>Место работы</td>
                                    <td>{{$doctor->workplace}}</td>
                                </tr>
                                <tr>
                                    <td>Описание</td>
                                    <td>{{$doctor->description}}</td>
                                </tr>
                                <tr>
                                    <td>Зарегистрирован</td>
                                    <td>{{$doctor->created_at}}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                @else
                    <div class="alert alert-warning" role="alert">
                        <strong>Внимание!</strong>
                        Нет данных по выбранному специалисту
                    </div>
                @endif
            </div>
        </div>
    </div>

@endsection
