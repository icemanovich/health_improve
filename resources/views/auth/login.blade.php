@extends("layout")
@section("content")

<div class="panel panel-default" >
    <div class="panel-heading">
        <div class="row">
            <div class="h4 col-xs-6">
                <i class="fa"></i>Login in
            </div>
        </div>
    </div>
    <div class="panel-body">

        <form class="form" method="POST" action="/login">
            @if($errors->any())
                <div class="alert alert-danger" role="alert">
                    <strong>{{$errors->first()}}</strong>
                </div>
            @endif



            {{--<label for="inputEmail" class="sr-only">Email</label>--}}
            <input name="email" type="email" id="inputEmail" class="form-control" placeholder="Email address" required="" autofocus="" value="{{ old('email') }}">
            {{--<label for="password" class="sr-only">Password</label>--}}
            <input name="password" type="password" id="password" class="form-control" placeholder="Password" required="">
            <button class="btn btn-lg btn-primary btn-block" type="submit">Войти</button>
            {!! csrf_field() !!}
        </form>
    </div>
</div>

@endsection
