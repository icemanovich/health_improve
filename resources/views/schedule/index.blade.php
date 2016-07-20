@extends("layout")
@section('content')

    <div class="panel panel-default">
        <h3>Неделя: {{$week[0]}} - {{$week[1]}}</h3>
        <hr>
        @if(isset($doctors))
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>#Врач</th>
                    <th>Понедельник</th>
                    <th>Вторник</th>
                    <th>Среда</th>
                    <th>Четверг</th>
                    <th>Пятница</th>
                </tr>
                </thead>
                <tbody>
                @foreach($doctors as $doctor)
                    <tr>
                        <td>
                            <b>{{$doctor->name}}</b><br><i class="small">{{$doctor->speciality}}</i>
                            <a href="/schedule/{{$doctor->id}}"
                               role="button" class="btn btn-xs btn-primary pull-right"
                                style="margin-top:-15px;">Запись</a>
                        </td>

                        @foreach($doctor->work_date as $day => $hours)
                            <td>{{implode('-', [array_shift($hours), array_pop($hours)])}}</td>
                        @endforeach
                    </tr>
                @endforeach

                </tbody>
            </table>
        @else
            <div class="alert alert-warning" role="alert">
                <strong>Внимание!</strong>
                Записей не найдено
            </div>
        @endif
    </div>

@endsection
