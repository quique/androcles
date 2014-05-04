<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{{ $title }}}</title>

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
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
</head>

<body>
    <header style="margin-bottom: 70px;">
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/">Androcles</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li><a href="#">Animales</a>
                        <ul class="dropdown-menu">
                            <li><a href="#">En adopción</a>
                                <ul class="dropdown-menu">
                                    <li><a href="/animals/up-for-adoption/dogs">Perros</a></li>
                                    <li><a href="/animals/up-for-adoption/cats">Gatos</a></li>
                                    <li><a href="/animals/up-for-adoption/others">Otros</a></li>
                                </ul>
                            </li>
                            <li><a href="/animals/lost">Perdidos y encontrados</a></li>
                            <li><a href="/animals/particular">De particulares</a></li>
                            <li><a href="/animals/happy-endings">Finales felices</a>
                                <ul class="dropdown-menu">
                                    <li><a href="/animals/happy-endings/dogs">Perros</a></li>
                                    <li><a href="/animals/happy-endings/cats">Gatos</a></li>
                                    <li><a href="/animals/happy-endings/others">Otros</a></li>
                                </ul>
                            </li>
                            <li><a href="/animals/in-our-heart">En nuestro corazón</a></li>
                            <li class="divider"></li>
                            <li><a href="{{ action('AnimalsController@create') }}">Añadir un animal</a></li>
                        </ul>
                    </li>
                    <li><a href="{{ action('NewsController@index') }}">Noticias</a></li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>
    </header>


@yield('content')

</body>
</html>
