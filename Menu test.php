
    <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="glyphicon glyphicon-user"></span>
          </button>
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-2" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Brand</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <ul class="nav navbar-nav">
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2">
          <ul class="nav navbar-nav">
            <ul class="collapse navbar-collapse nav navbar-nav">
                <li role="presentation"><a href="{{ path('ocnao_homepage') }}">Home</a></li>
                <li role="presentation"><a href="{{ path('ocnao_recherche') }}">Recherche une observation</a></li>
                <li role="presentation"><a href="{{ path('ocnao_addObservation') }}">Ajouter une observation</a></li>
                <li role="presentation"><a href="{{ path('ocnao_contact') }}">Contact</a></li>
                <li role="presentation"><a href="{{ path('ocnao_backoffice') }}">Profil</a></li>
              </ul>
          </ul>
          </div>
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="#">Link</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
              <ul class="dropdown-menu">
                {% if is_granted("IS_AUTHENTICATED_REMEMBERED") %}
                    <li role="presentation"><a href="{{ path('ocnao_backoffice') }}"><span class="glyphicon glyphicon-user"> {{ app.user.username }}</span></a></li>
                    <li><a href="#">Separated link</a></li>
                    <li role="presentation"><a href="{{ path('fos_user_security_logout') }}">Déconnexion</a></li>
                {% else %}
                    <li role="presentation"><a href="{{ path('fos_user_security_login') }}" >Connexion</a></li>
                    <li role="presentation"><a href="{{ path('fos_user_registration_register') }}">Inscription</a></li>
                {% endif %}
              </ul>
            </li>
          </ul>
        </div><!-- /.navbar-collapse -->
        </ul>
      </div><!-- /.container-fluid -->
    </nav>



    .navbar .dropdown-menu::after {
    content: '';
    display: inline-block;
    border-left: 6px solid transparent;
    border-right: 6px solid transparent;
    border-bottom: 6px solid white;
    position: absolute;
    top: -6px;
    left: 10px;
    }
    .navbar .dropdown-menu::before {
    content: '';
    display: inline-block;
    border-left: 7px solid transparent;
    border-right: 7px solid transparent;
    border-bottom: 7px solid #CCC;
    border-bottom-color: rgba(0, 0, 0, 0.2);
    position: absolute;
    top: -7px;
    left: 9px;
    }
