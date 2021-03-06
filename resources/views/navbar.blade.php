<!-- Static navbar -->
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ route('home') }}">
                <img src="{{ url(elixir('images/logo.png')) }}" style="height: 40px" />
            </a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li>
                    <a href="{{ route('event.index') }}">Events</a>
                </li>

                <!-- Admin options -->
                @if (Gate::check('role-admin') || Gate::check('user-admin') || Gate::check('event-admin') || Gate::check('event-create') || Gate::check('points-admin'))
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            Administration <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            @can('role-admin')
                                <li>
                                    <a href="{{ route('admin.role.index') }}">Role Management</a>
                                </li>
                            @endcan
                            @can('user-admin')
                                <li>
                                    <a href="{{ route('admin.user.index') }}">User Management</a>
                                </li>
                            @endcan
                            @if (Gate::check('event-admin') || Gate::check('event-create'))
                                <li>
                                    <a href="{{ route('admin.event.index') }}">Event Management</a>
                                </li>
                            @endif
                            @can('points-admin')
                                <li>
                                    <a href="{{ route('admin.points-sequence.index') }}">Points Sequences</a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endif
            </ul>

            <!-- User login / management -->
            <ul class="nav navbar-nav navbar-right">
                @if (Auth::check())

                    @if (!Auth::user()->on_server)
                    <li>
                        <p class="navbar-btn">
                            <a href="{{ env('DISCORD_GUILD_INVITE') }}" class="btn btn-social btn-discord btn-default">
                                <span class="fa">
                                    <img src="{{ elixir('images/discord.svg') }}" style="width: 27px; margin-top: 4px" />
                                </span>
                                Join the Discord Server
                            </a>
                        </p>
                    </li>
                    @endif

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            {{ \Auth::user()->name }}
                            @if (\Auth::user()->number)
                                <span class="badge driver-number">
                                    {{ \Auth::user()->number }}
                                </span>
                            @endif
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="{{route('user.logins')}}">Manage Logins</a>
                            </li>
                            <li>
                                <a href="{{route('user.settings')}}">Settings</a>
                            </li>
                            <li>
                                <a href="{{route('auth.logout')}}">Logout</a>
                            </li>
                        </ul>
                    </li>

                @else

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            Login <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">

                            @foreach(\AuthProviders::all() AS $provider)
                            <li>
                                <a href="{{ route('auth', $provider) }}">
                                    @include('login-buttons.'.$provider, ['class' => 'btn-block'])
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </li>

                @endif
            </ul>
        </div><!--/.nav-collapse -->
    </div><!--/.container-fluid -->
</nav>
