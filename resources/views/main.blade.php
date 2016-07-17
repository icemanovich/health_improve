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
                <i class="fa"></i>Приём</i>
            </div>
            <div class="h4 col-xs-6">
                <a href="order" role="button" class="btn btn-xs btn-info pull-right">Расписание</a>
            </div>
        </div>
    </div>
    <div class="panel-body">
        <div>В настоящий момент приём осуществляют
            <div>

                {{-- TODO :: Continue ghere --}}
                @foreach($orders as $order)
                    {{ $order }}
                @endforeach

            </div>


        </div>
    </div>

</div>

@endsection
