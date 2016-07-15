<!-- Static navbar -->
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">Запись на приём</a>
            @if (Auth::check())
                <a class="navbar-brand small" href="/doctor/{{Auth::user()->email}}">{{Auth::user()->name}}</a>
            @endif
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            @if(Auth::check())
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="/doctor">Врачи</a></li>
                    <li><a href="/order">Расписание</a></li>
                    <li><a href="/logout">Выйти</a></li>
                </ul>
            @endif
        </div><!--/.nav-collapse -->
    </div><!--/.container-fluid -->
</nav>