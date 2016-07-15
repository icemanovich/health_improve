<!-- Static navbar -->
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">Make an appointment to the doctor</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            {{--@if(isset($current_user) and $current_user->is_admin)--}}
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="/doctor">Врачи</a></li>
                    <li><a href="/order">Расписание</a></li>
                    <li><a href="/logout">Выйти</a></li>
                </ul>
            {{--@endif--}}
        </div><!--/.nav-collapse -->
    </div><!--/.container-fluid -->
</nav>