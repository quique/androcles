<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!--[if IE]>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <![endif]-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{{ trans($title) }}}</title>

    {{ HTML::style('http://code.jquery.com/ui/1.10.1/themes/base/jquery-ui.css') }}
    {{-- HTML::script('http://code.jquery.com/jquery-2.1.0.min.js') --}}
    {{-- HTML::script('http://code.jquery.com/ui/1.10.4/jquery-ui.min.js') --}}
    {{ HTML::script('js/jquery-2.1.0.min.js') }}
    {{ HTML::script('js/jquery-ui-1.10.4.min.js') }}

    <!-- link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap-theme.min.css">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script -->
    {{ HTML::style('css/bootstrap.min.css') }}
    {{ HTML::style('css/bootstrap-theme.min.css') }}
    {{ HTML::script('js/bootstrap.min.js')}}

    {{ HTML::style('css/androcles.css') }}
    {{ HTML::style('css/jquery.smartmenus.bootstrap.css') }}
    {{ HTML::script('js/jquery.smartmenus.min.js') }}
    {{ HTML::script('js/jquery.smartmenus.bootstrap.min.js') }}

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
    <header style="margin-bottom: 70px;">
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">{{ Lang::get("layout.Toggle") }}</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{ URL::route('home') }}">{{ Config::get('custom.shelter') }}</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li><a href="#">Información</a>
                        <ul class="dropdown-menu">
                            <li><a href="/info/about">Quiénes somos</a></li>
                            <li><a href="/info/get-involved">Cómo ayudar</a></li>
                            <li><a href="/info/a-day">Un día en la prote</a></li>
                            <li><a href="{{ action('VolunteersController@index') }}">{{ Lang::get("layout.Volunteers") }}</a></li>
                            <li><a href="{{ action('NewsController@index') }}">{{ Lang::get("layout.News") }}</a></li>
                            <li><a href="{{ action('LinksController@index') }}">{{ Lang::get("layout.Links") }}</a></li>
                            <li><a href="/info/contact">Contacto</a></li>
                        </ul>
                    </li>

                    <li><a href="#">{{ Lang::get("layout.Up-for-adoption") }}</a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ URL::route('animals.status.species', ['up-for-adoption', 'dogs']) }}">{{ Lang::get("layout.Dogs") }}</a></li>
                            <li><a href="{{ URL::route('animals.status.species', ['up-for-adoption', 'cats']) }}">{{ Lang::get("layout.Cats") }}</a></li>
                            <li><a href="{{ URL::route('animals.status.species', ['up-for-adoption', 'others']) }}">{{ Lang::get("layout.Others") }}</a></li>
                            <li><a href="{{ URL::route('animals.status', ['particular']) }}">{{ Lang::get("layout.Particular") }}</a></li>
                            @if (Sentry::check() and Sentry::getUser()->hasAccess('animals.create'))
                                <li class="divider"></li>
                                <li><a href="{{ action('AnimalsController@create') }}">{{ Lang::get("layout.Add-animal") }}</a></li>
                            @endif
                        </ul>
                    </li>

                    <li><a href="#">{{ Lang::get("layout.More-animals") }}</a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ URL::route('animals.status', ['lost']) }}">{{ Lang::get("layout.Lost-found") }}</a></li>
                            <li><a href="{{ URL::route('animals.status', ['happy-endings']) }}">{{ Lang::get("layout.Happy-endings") }}</a>
                                <ul class="dropdown-menu">
                                    <li><a href="{{ URL::route('animals.status.species', ['happy-endings', 'dogs']) }}">{{ Lang::get("layout.Dogs") }}</a></li>
                                    <li><a href="{{ URL::route('animals.status.species', ['happy-endings', 'cats']) }}">{{ Lang::get("layout.Cats") }}</a></li>
                                    <li><a href="{{ URL::route('animals.status.species', ['happy-endings','others']) }}">{{ Lang::get("layout.Others") }}</a></li>
                                </ul>
                            </li>
                            <li><a href="{{ URL::route('animals.status', ['in-our-heart']) }}">{{ Lang::get("layout.In-our-heart") }}</a></li>
                            @if (Sentry::check() and Sentry::getUser()->hasAccess('animals.create'))
                                <li class="divider"></li>
                                <li><a href="{{ action('AnimalsController@create') }}">{{ Lang::get("layout.Add-animal") }}</a></li>
                            @endif
                        </ul>
                    </li>

                    <li><a href="/info/get-involved">Cómo ayudar</a></li>
                    <li><a href="/info/contact">Contacto</a></li>


                    @if (Sentry::check())
                        <li><a href="#">{{ trans("layout.user") }}</a>
                            <ul class="dropdown-menu">
                                <li><a href="{{ URL::route('volunteers.edit', Sentry::getUser()->id) }}">{{ trans("layout.volunteer-edition") }}</a></li>
                                <li><a href="{{ URL::route('users.password', Sentry::getUser()->id) }}">{{ trans("layout.passwd") }}</a></li>
                                <li><a href="{{ URL::route('logout') }}">{{ Lang::get("layout.logout") }}</a></li>
                                @if (Sentry::getUser()->inGroup(Sentry::getGroupProvider()->findByName('Admin')))
                                    <li class="divider"></li>
                                    <li>{{ HTML::linkRoute('users.index', trans("layout.user-index")) }}</li>
                                    <li>{{ HTML::linkRoute('users.create', trans("layout.create-user")) }}</li>
                                @endif
                            </ul>
                    @else
                        <li>{{ HTML::linkRoute('login', trans("layout.log-in")) }}</li>
                    @endif
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>
    </header>

    <div class="container">
        @if(Session::has('success'))
            <div class="alert alert-success"><p><span class="glyphicon glyphicon-ok-sign"> &nbsp; </span>{{ trans(Session::get('success')) }}</p></div>
        @endif
        @if(Session::has('info'))
            <div class="alert alert-info"><p><span class="glyphicon glyphicon-info-sign"> &nbsp; </span>{{ trans(Session::get('info')) }}</p></div>
        @endif
        @if(Session::has('warning'))
            <div class="alert alert-warning"><p><span class="glyphicon glyphicon-warning-sign"> &nbsp; </span>{{ trans(Session::get('warning')) }}</p></div>
        @endif
        @if(Session::has('danger'))
            <div class="alert alert-danger"><p><span class="glyphicon glyphicon-warning-sign"> &nbsp; </span>{{ trans(Session::get('danger')) }}</p></div>
        @endif
    </div>

@yield('content')

<footer>
    <div class="container" style="text-align: center;">
        <img src="{{ asset('/images/2023-1024.jpg') }}" alt="Subvencionado por el Ministerio de Derechos Sociales y Agenda 2030" width="512" height="auto">
    </div>
</footer>

</body>
</html>
