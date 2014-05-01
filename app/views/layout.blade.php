<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $title }}</title>

    {{ HTML::style('http://code.jquery.com/ui/1.10.1/themes/base/jquery-ui.css') }}
    {{ HTML::script('http://code.jquery.com/jquery-2.1.0.min.js') }}
    {{ HTML::script('http://code.jquery.com/ui/1.10.4/jquery-ui.min.js') }}

    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap-theme.min.css">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>

    {{ HTML::style('css/androcles.css') }}
</head>

<body>
<header>
    <nav class="navbar navbar-default" role="navigation">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/">Androcles</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li><a href="/">Home</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Animales <strong class="caret"></strong></a>
                        <ul class="dropdown-menu">
                            <!-- li><a href="{{ action('AnimalsController@read') }}">Todos los animals</a></li -->
                            <li><a href="/animals/up-for-adoption">En adopción</a></li>
                            <li><a href="/animals/lost">Perdidos y encontrados</a></li>
                            <li><a href="/animals/particular">De particulares</a></li>
                            <li><a href="/animals/happy-endings">Finales felices</a></li>
                            <li><a href="/animals/in-our-heart">En nuestro corazón</a></li>
                            <li class="divider"></li>
                            <li><a href="{{ action('AnimalsController@create') }}">Añadir un animal</a></li>
                        </ul>
                    </li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>
</header>

<section class="header section-padding">
    <div class="background">&nbsp;</div>
    <div class="container">
        <div class="header-text">
            <h1>Androcles <small>A CMS for animal shelters</small></h1>
        </div>
    </div>
</section>

@yield('content')

</body>
</html>
