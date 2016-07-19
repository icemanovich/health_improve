@extends("layout")
@section('content')

    <div class="panel panel-default">
        <h4>Список заказов на неделю: {{$week[0]}} - {{$week[1]}}</h4>
        <hr>
        @if(isset($orders))
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
                    @foreach($orders as $order)
                        <tr>
                            <td><b>{{$order->doctor->name}}</b><br><i class="small">{{$order->doctor->speciality}}</i></td>
{{--                            @foreach($doctor->work_date as $day => $hours)--}}
{{--                                <td>{{implode('-', [array_shift($hours), array_pop($hours)])}}</td>--}}
                            {{--@endforeach--}}
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
