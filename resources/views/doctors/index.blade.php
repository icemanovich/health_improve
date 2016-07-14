@extends("layout")
@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="h4 col-xs-6">
                    {{--<i class="fa"></i> Hello, <i>{{user.email}}!</i>--}}
                    <i class="fa"></i> Hello, {{ $name or 'Noname' }}!</i>
                </div>
            </div>
        </div>
        <div class="panel-body">
            <div>
                @if(isset($doctors))
                    @foreach($doctors as $doctor)
                        <pre>
                            Имя: {{ $doctor->name }}
                            Email: {{ $doctor->email }}
                            Описание: {{ $doctor->description }}
                            Место работы: {{ $doctor->workplace }}
                            Специальность: {{ $doctor->speciality }}
                        </pre>
                    @endforeach
                @else
                    No doctors found
                @endif
            </div>
        </div>
    </div>

@endsection
