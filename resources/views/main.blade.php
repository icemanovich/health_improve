@extends("layout")
@section('content')

<div class="panel panel-default">
    <div class="panel-heading">
        <div class="row">
            <div class="h4 col-xs-6">
                {{--<i class="fa"></i> Hello, <i>{{user.email}}!</i>--}}
                <i class="fa"></i> Hello!</i>
            </div>
        </div>
    </div>
    <div class="panel-body">
        <div>
            1
            2
            3
            {{--<p><b>Short user info:</b> {{ user }}</p>--}}
            {{--{% if user.is_admin: %}--}}
                {{--<p><b>User has administrative privileges</b></p>--}}
            {{--{% endif %}--}}
        </div>
    </div>
</div>

@endsection
