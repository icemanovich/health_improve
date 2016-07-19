@extends("layout")
@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="h4 col-xs-6">
                    Информация о записи
                </div>
                <div class="h4 col-xs-6">
                    <a href="{{URL::to('/order')}}" role="button" class="btn btn-xs btn-default pull-right">Назад</a>
                </div>
            </div>
        </div>
        <div class="panel-body">
            <div>
                @if(isset($order))
                    <div class="row">
                        <div class="col-md-8">
                            <table class="table">
                                <tbody>
                                <tr><td colspan="2" class="pull-right"><b>Пациент</b></td></tr>
                                <tr>
                                    <td>Имя</td>
                                    <td>{{$order->user->name}}</td>
                                </tr>
                                <tr>
                                    <td>Время</td>
                                    <td>{{$order->date}}</td>
                                </tr>
                                <tr><td colspan="2" class="pull-right"><b>Врач</b></td></tr>
                                <tr>
                                    <td>Врач</td>
                                    <td>{{$order->doctor->name}}</td>
                                </tr>
                                <tr>
                                    <td>Телефон</td>
                                    <td>{{$order->doctor->phone}}</td>
                                </tr>
                                <tr>
                                    <td>Специальность</td>
                                    <td>{{$order->doctor->speciality}}</td>
                                </tr>
                                <tr>
                                    <td>Место приёма</td>
                                    <td>{{$order->doctor->workplace or 'Больница'}}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                @else
                    <div class="alert alert-warning" role="alert">
                        <strong>Внимание!</strong>
                        Нет данных по выбранному заказу
                    </div>
                @endif
            </div>
        </div>
    </div>

@endsection
