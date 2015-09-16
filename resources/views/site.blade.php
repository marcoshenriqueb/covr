<!DOCTYPE html>
<html lang="pt-br">
  <head>
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta id="token" name="token" value="{{csrf_token()}}">
   <title>Vue app</title>
   <!-- Bootstrap CSS -->
   <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet">
   <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
   <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
   <!--[if lt IE 9]>
   <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
   <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
   <![endif]-->
   <link href="/css/all.css" rel="stylesheet">
 </head>
 <body class="container">
   <div class="site-wrapper" id="site">
     <div class="site-wrapper-inner">
       <div class="cover-container">
         <div class="masthead clearfix">
           <div class="inner">
             <h3 class="masthead-brand">AppCambio</h3>
             <nav>
               <ul class="nav masthead-nav">
                 <li v-on="click: changeActivePage" v-class="active: activePage == '/'"><a v-link="{path: '/'}">Home</a></li>
                 <li v-on="click: changeActivePage" v-class="active: activePage == '/login'"><a v-link="{path: '/login'}">Login</a></li>
                 <li v-on="click: changeActivePage" v-class="active: activePage == '/cadastro'"><a v-link="{path: '/cadastro'}">Cadastre-se</a></li>
               </ul>
             </nav>
           </div>
         </div>

         <router-view></router-view>

         <div class='painel-cotacoes'>
           <div class="inner col-md-3"
                v-class="animated: animate, fadeIn: animate">
            <span class="cotacao" v-class="USDcolor"> @{{cotacao.USD}} </span>
           </div>
           <div class="inner col-md-3"
                v-class="animated: animate, fadeIn: animate">
            <span class="cotacao" v-class="CADcolor"> @{{cotacao.CAD}} </span>
           </div>
           <div class="inner col-md-3"
                v-class="animated: animate, fadeIn: animate">
            <span class="cotacao" v-class="AUDcolor"> @{{cotacao.AUD}} </span>
           </div>
           <div class="inner col-md-3"
                v-class="animated: animate, fadeIn: animate">
            <span class="cotacao" v-class="EURcolor"> @{{cotacao.EUR}} </span>
           </div>
           <div class="inner col-md-3"
                v-class="animated: animate, fadeIn: animate">
            <span class="cotacao" v-class="GBPcolor"> @{{cotacao.GBP}} </span>
           </div>
           <div class="inner col-md-3"
                v-class="animated: animate, fadeIn: animate">
            <span class="cotacao" v-class="CLPcolor"> @{{cotacao.CLP}} </span>
           </div>
           <div class="inner col-md-3"
                v-class="animated: animate, fadeIn: animate">
            <span class="cotacao" v-class="ARScolor"> @{{cotacao.ARS}} </span>
           </div>
           <div class="inner col-md-3"
                v-class="animated: animate, fadeIn: animate">
            <span class="cotacao" v-class="MXNcolor"> @{{cotacao.MXN}} </span>
           </div>
         </div>
       </div>
     </div>
   </div>

   <script src="/js/app.js"></script>

  </body>
</html>
