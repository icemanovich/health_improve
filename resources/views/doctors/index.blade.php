@extends("layout")
@section('content')

    <div class="panel panel-default">
        @if(isset($doctors))
            @foreach($doctors as $doctor)
                <div class="panel-heading">
                    <div class="row">
                        <div class="h4 col-xs-6">
                            <a href="/doctor/{{$doctor->email}}">
                                <h3 class="panel-title"><b>{{ $doctor->name }}</b></h3>
                            </a>
                        </div>
                        <div class="h4 col-xs-6">
                            <a href="doctor/{{$doctor->email}}" role="button" class="btn btn-xs btn-info pull-right">Инфо</a>
                            <a href="schedule/{{$doctor->id}}" role="button" class="btn btn-xs btn-success pull-right">Запись на приём</a>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="col-md-2">
                        <img class="thumbnail" src="{{$doctor->photo}}" data-holder-rendered="true" style="width: 150px; height: 150px;"/>
                    </div>
                    <div class="col-md-10">
                        Email           : {{ $doctor->email }} <br>
                        Место работы    : {{ $doctor->workplace }} <br>
                        Специальность   : {{ $doctor->speciality }} <br>
                        Описание        : {{ $doctor->description }} <br>
                    </div>
                </div>
            @endforeach
        @else
            <div class="alert alert-warning" role="alert">
                <strong>Внимание!</strong>
                Записей не найдено
            </div>
        @endif
    </div>

@endsection
