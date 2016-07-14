@extends("layout")
@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="h4 col-xs-6">
                    <i class="fa"></i> Hello, {{ $name or 'Noname' }}!</i>
                </div>
            </div>
        </div>
        <div class="panel-body">
            <div>
                @if(isset($doctor))
                    <pre>
                        <?php (print_r($doctor->toArray())); ?>
                    </pre>
                @else
                    Нет данных по выбранному специалисту
                @endif
            </div>
        </div>
    </div>

@endsection
