<!DOCTYPE html>
<html lang="">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta id="token" name="token" value="{{csrf_token()}}">
    <title>Covr</title>
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
  <body id="site" class="page-header-fixed bg-1">


    <div class="modal-shiftfix">
      <!-- Navigation -->
      <div class="navbar navbar-fixed-top scroll-hide">
        <div class="container-fluid top-bar">
          <button class="navbar-toggle"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button><a class="logo" href="index.html">Covr</a>
        </div>
        <div class="container-fluid main-nav clearfix">
          <div class="nav-collapse">
            <ul class="nav">
              <li>
                <a v-link="{path: '/'}">
                   <span aria-hidden="true" class="hightop-home"></span>
                   Home
                 </a>
              </li>
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
    <script src="js/site.js"></script>
  </body>
</html>
