@extends("layout")
@section('content')

    <div class="panel panel-default">
        <h4>Список записей на неделю: {{$week[0]}} - {{$week[1]}}</h4>
        <hr>
        @if(isset($orders) && !empty($orders))
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Врач</th>
                    <th>Дата</th>
                    <th>Пациент</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                        <tr>
                            <td>
                                <b>{{$order->doctor->name}}</b><br><i class="small">{{$order->doctor->speciality}}</i>
                            </td>
                            <td>{{$order->date}}:00</td>
                            <td>{{$order->user->name}}</td>
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
