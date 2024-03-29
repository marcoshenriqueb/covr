<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta id="token" name="token" value="{{isset($JWTtoken) ? $JWTtoken : ''}}">
    <title>COvr</title>
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
  <body id="app" class="page-header-fixed bg-1">
    <input type="hidden" id="user-set" value="{{isset($user) ? 1 : 0 }}">
    <div class="modal-shiftfix">
      <!-- Navigation -->
      <div class="navbar navbar-fixed-top scroll-hide">
        <div class="container-fluid top-bar">
          @if(isset($user))
          <div class="pull-right">
            <ul class="nav navbar-nav pull-right">
              <li class="notifications hidden-xs">
                <a v-on="click: messagesNotRead = 0" v-link="{path: '/contatos'}">
                  <span aria-hidden="true" class="hightop-flag"></span>
                  <div class="sr-only">
                    Notifications
                  </div>
                  <p v-if="messagesNotRead > 0" class="counter">
                    @{{messagesNotRead}}
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
              <li class="dropdown user hidden-xs">
                <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                  <img width="34"
                       height="34"
                       src="{{(isset($user->profile_pic) ? $user->profile_pic : 'images/int.jpg')}}" />
                  {{$user->getFullName()}}<b class="caret"></b>
                </a>
                <ul class="dropdown-menu">
                  <li><a v-link="{path: '/perfil'}">
                    <i class="fa fa-user"></i>Perfil</a>
                  </li>
                  <li><a href="auth/logout">
                    <i class="fa fa-sign-out"></i>Logout</a>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
          @endif
          <button class="navbar-toggle"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
          <a class="logo" href="painel">COvr</a>
        </div>
        <div class="container-fluid main-nav clearfix">
          <div class="nav-collapse">
            <ul class="nav">
              <li>
                <a v-link="{path: '/painel'}">
                   <span aria-hidden="true" class="hightop-home"></span>
                   Home
                 </a>
              </li>
              @if(isset($user))
              <li>
                <a v-link="{path: '/app'}">
                   <span aria-hidden="true" class="hightop-feed"></span>
                   Painel
                 </a>
              </li>
              <li>
                <a v-link="{path: '/contatos'}">
                  <span aria-hidden="true" class="fa fa-comments-o"></span>
                  Contatos
                </a>
              </li>
              @else
              <li>
                <a v-link="{path: '/login'}">
                  <span aria-hidden="true" class="fa fa-sign-in"></span>
                  Entrar
                </a>
              </li>
              <li>
                <a v-link="{path: '/cadastro'}">
                  <span aria-hidden="true" class="fa fa-pencil-square-o"></span>
                  Cadastro
                </a>
              </li>
              @endif
            </ul>
          </div>
        </div>
      </div>

      <!-- End Navigation -->
      <div class="container-fluid main-content">
        <router-view></router-view>
      </div>

    </div>
    <script src="js/all.js"></script>
    <script src="js/app.js"></script>
    <script async defer
      src="https://maps.googleapis.com/maps/api/js?key={{env('GOOGLE_API_KEY')}}&callback=setMapOk">
    </script>
  </body>
</html>
