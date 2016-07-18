@extends("layout")
@section('content')

<div class="panel panel-default">
        <div class="panel-heading">
        <div class="row">
            <div class="h4 col-xs-6">
                <i class="fa"></i>Врачи</i>
            </div>
            <div class="h4 col-xs-6">
                <a href="doctor" role="button" class="btn btn-xs btn-info pull-right">Все</a>
            </div>
        </div>
    </div>
    <div class="panel-body">
        <div class="row">
            @foreach($doctors as $i => $doctor)
                <div class="col-md-6">
                    <div class="row-fluid">
                        <img class="thumbnail pull-left" src="{{$doctor->photo}}" data-holder-rendered="true" style="width: 50px; height: 50px; margin-right:20px;"/>
                        <span class=""><b><a href="/doctor/{{$doctor->email}}" target="_blank">{{$doctor->name}}</a></b></span>
                        <br>
                        <span class="small"><i>{{$doctor->speciality}}</i></span>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="panel-heading">
        <div class="row">
            <div class="h4 col-xs-6">
                Приём сегодня: <i>{{explode(' ', App\Order::getDate())[0]}}</i>
            </div>
            <div class="h4 col-xs-6">
                <a href="order" role="button" class="btn btn-xs btn-info pull-right">Расписание</a>
            </div>
        </div>
    </div>
    <div class="panel-body">
        <div>
            @foreach($orders as $order)
                <div class="col-md-6">
                    <div class="row-fluid">
                        <img class="thumbnail pull-left" src="{{$order->doctor->photo}}" data-holder-rendered="true" style="width: 50px; height: 50px; margin-right:20px;"/>
                        <span class=""><b><a href="/doctor/{{$order->doctor->email}}" target="_blank">{{$order->doctor->name}}</a></b></span>
                        <br>
                        <span class="small"><i>{{$order->doctor->speciality}}</i> <b>(Время: {{explode(' ',$order->date)[1] }})</b></span>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

</div>

@endsection
