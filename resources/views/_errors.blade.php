{{--{% with messages = get_flashed_messages() %}--}}
@if($messages)
    @foreach($messages as $message)
    <div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <strong>Ошибка!</strong> {{ $message }}
    </div>
    @endforeach
@endif
{{--{% endwith %}--}}