@extends("layout")
@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="h4 col-xs-6">
                    HELLO
                </div>
                <div class="h4 col-xs-6">
                    <a href="{{URL::to('/order')}}" role="button" class="btn btn-xs btn-default pull-right">Назад</a>
                </div>
            </div>
        </div>
        <div class="panel-body">
            <div>
                1
                2
                3
                4
            </div>
        </div>
    </div>

@endsection
