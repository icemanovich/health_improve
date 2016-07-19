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
                @if(isset($doctor))
                    <div class="row">

                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <td><b>День</b></td>
                                    <td><b>Время</b></td>
                                </tr>

                                </thead>
                                <tbody>
                                @foreach(['Понедельник','Вторник','Среда','Четверг','Пятница'] as $day => $dayName)
                                    <tr>
                                        <td>$dayName</td>
                                        <td>
                                            @foreach($doctor->work_date[$day+1] as $hour)
                                                {{--<button class="btn btn-sm btn-default" type="button">Default</button>--}}
                                                <button class="btn btn-sm btn-primary" type="button">{{ $hour }}</button>

                                            @endforeach
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
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
