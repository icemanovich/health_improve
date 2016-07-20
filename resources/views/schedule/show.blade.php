@extends("layout")
@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="h4 col-xs-8">
                    <i><b>{{$doctor->name}}</b></i> :: Запись на приём
                </div>
                <div class="h4 col-xs-4">
                    <a href="{{URL::to('/schedule')}}" role="button" class="btn btn-xs btn-default pull-right">Назад</a>
                </div>
            </div>
        </div>
        <div class="panel-body">
            <div>
                @if(isset($doctor))
                    <div class="row">
                        <div class="panel-body">
                            <h4>Описание номерков</h4>
                            <div><button class="btn btn-sm btn-primary" type="button" >10:00</button>  Доступный для записи через интернет номерок</div>
                            <br>
                            <div><button class="btn btn-sm btn-default" type="button" >10:00</button>  Заблокированый номерок</div>
                        </div>

                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <td><b>День</b></td>
                                <td><b>Время</b></td>
                            </tr>

                            </thead>
                            <tbody>

                            {{-- Better to make via DB relations !!! --}}
                            @foreach(['Понедельник','Вторник','Среда','Четверг','Пятница', 'Суббота', 'Воскресенье'] as $day => $dayName)
                                <tr>
                                    <td>
                                        <b>{{$week[$day]}}</b> <span class="small">( {{$dayName}} )</span>
                                    </td>
                                    <td>
                                        @if(isset($items[$day+1]))
                                            @foreach($items[$day+1] as $hourItem)
                                                <button

                                                    type="button" style="width:60px;"
                                                    data="{{$week[$day]}} {{$hourItem['hour']}}:{{Auth::user()->id}}:{{$doctor->id}}"
                                                    @if($hourItem['available'])
                                                        class="btn btn-sm btn-primary make_order"
                                                        available="true"
                                                    @else
                                                    class="btn btn-sm btn-default make_order"
                                                        available="false"
                                                    @endif
                                                >{{ $hourItem['hour'] }}:00</button>
                                            @endforeach

                                        @endif
                                        {{--@if(isset($doctor->work_date[$day+1]))--}}
                                            {{--@foreach($doctor->work_date[$day+1] as $hour)--}}


                                                {{--<button--}}
                                                        {{--class="btn btn-sm btn-primary make_order"--}}
                                                        {{--type="button"--}}
                                                        {{--style="width:60px;"--}}
                                                        {{--data="{{$week[$day]}} {{$hour}}:{{Auth::user()->id}}:{{$doctor->id}}"--}}
                                                        {{--available="true"--}}
                                                {{-->{{ $hour }}:00</button>--}}
                                            {{--@endforeach--}}
                                        {{--@endif--}}
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
