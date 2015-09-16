<!DOCTYPE html>
<html lang="">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta id="token" name="token" value="{{csrf_token()}}">
    <title>AppCambio</title>
    <!-- Bootstrap CSS -->
    <link href="http://fonts.googleapis.com/css?family=Lato:100,300,400,700" media="all" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="/css/all.css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="page-header-fixed bg-1">
    <div id="{{(isset($user)) ? 'app' : 'site'}}" class="modal-shiftfix">
      <!-- Navigation -->
      <div class="navbar navbar-fixed-top scroll-hide">
        <div class="container-fluid top-bar">
          @if(isset($user))
          <div class="pull-right">
            <ul class="nav navbar-nav pull-right">
              <li class="dropdown notifications hidden-xs">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#"><span aria-hidden="true" class="hightop-flag"></span>
                  <div class="sr-only">
                    Notifications
                  </div>
                  <p class="counter">
                    8
                  </p>
                </a>
                <ul class="dropdown-menu">
                  <li><a href="#">
                    <div class="notifications label label-info">
                      New
                    </div>
                    <p>
                      New user added: Jane Smith
                    </p></a>

                  </li>
                  <li><a href="#">
                    <div class="notifications label label-info">
                      New
                    </div>
                    <p>
                      Sales targets available
                    </p></a>

                  </li>
                  <li><a href="#">
                    <div class="notifications label label-info">
                      New
                    </div>
                    <p>
                      New performance metric added
                    </p></a>

                  </li>
                  <li><a href="#">
                    <div class="notifications label label-info">
                      New
                    </div>
                    <p>
                      New growth data available
                    </p></a>

                  </li>
                </ul>
              </li>
              <li class="dropdown messages hidden-xs">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#"><span aria-hidden="true" class="hightop-envelope"></span>
                  <div class="sr-only">
                    Messages
                  </div>
                  <p class="counter">
                    3
                  </p>
                </a>
                <ul class="dropdown-menu">
                  <li><a href="#">
                    <img width="34" height="34" src="images/foto_perfil.jpg" />Could we meet today? I wanted...</a>
                  </li>
                  <li><a href="#">
                    <img width="34" height="34" src="images/foto_perfil.jpg" />Important data needs your analysis...</a>
                  </li>
                </ul>
              </li>
              <li class="dropdown user hidden-xs"><a data-toggle="dropdown" class="dropdown-toggle" href="#">
                <img width="34" height="34" src="images/foto_perfil.jpg" />John Smith<b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li><a href="#">
                    <i class="fa fa-user"></i>My Account</a>
                  </li>
                  <li><a href="#">
                    <i class="fa fa-gear"></i>Account Settings</a>
                  </li>
                  <li><a href="logout">
                    <i class="fa fa-sign-out"></i>Logout</a>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
          @else
          <ul class="nav navbar-nav pull-right">
            <li><a v-link="{path: '/login'}">Login</a></li>
            <li><a v-link="{path: '/cadastro'}">Cadastre-se</a></li>
          </ul>
          @endif
          <button class="navbar-toggle"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button><a class="logo" href="index.html">AppCambio</a>
        </div>
        <div class="container-fluid main-nav clearfix">
          <div class="nav-collapse">
            <ul class="nav">
              <li>
                <a v-class="current: activePage == '/'"
                   v-on="click: changeActivePage"
                   v-link="{path: '/'}">
                   <span aria-hidden="true" class="hightop-home"></span>
                   Home
                 </a>
              </li>
              <li>
                <a href="social.html"
                   v-on="click: changeActivePage"
                   v-class="current: activePage == '/blog'">
                  <span aria-hidden="true" class="fa fa-file-text-o"></span>
                  Blog
                </a>
              </li>
              @if(isset($user))
              <li>
                <a href="social.html">
                  <span aria-hidden="true" class="fa fa-money"></span>
                  Câmbio
                </a>
              </li>
              <li>
                <a href="social.html">
                  <span aria-hidden="true" class="fa fa-comments-o"></span>
                  Mensagens
                </a>
              </li>
              <li class="dropdown">
                <a data-toggle="dropdown" href="#">
                  <span aria-hidden="true" class="fa fa-line-chart"></span>
                  Ferramentas<b class="caret"></b>
                </a>
                <ul class="dropdown-menu">
                  <li>
                    <a href="buttons.html">Conversor</a>
                  </li>
                  <li>
                    <a href="fontawesome.html">Acompanhamento de taxas</a>
                  </li>
                  <li>
                    <a href="glyphicons.html">Previsões</a>
                  </li>
                </ul>
              </li>
              @else
              <li>
                <a v-link="{path: '/cadastro'}"
                   v-on="click: changeActivePage"
                   v-class="current: activePage == '/cadastro'">
                  <span aria-hidden="true" class="fa fa-sign-in"></span>
                  Cadastre-se
                </a>
              </li>
              @endif
            </ul>
          </div>
        </div>
      </div>

      <!-- End Navigation -->
      <div class="container-fluid main-content">
        <router-view ></router-view>

      </div>
    </div>

        <script src="js/all.js"></script>
        <script src="js/{{(isset($user)) ? 'app' : 'site'}}.js"></script>
       </body>
</html>
