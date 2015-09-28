<!DOCTYPE html>
<html lang="">
       <head>
         <meta charset="utf-8">
         <title>Confirmação de email</title>

         <!-- Bootstrap CSS -->
         <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet">

         <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
         <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
         <!--[if lt IE 9]>
         <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
         <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
         <![endif]-->
       </head>
       <body>
        <h1 class="text-center">Obrigado por se cadastrar!</h1>

        <p class="lead">
          Precisamos apenas que confirme a sua conta clicando <a href="{{url('confirma-email/' . $user->verifiedToken)}}">aqui</a>.
        </p>

      </body>
</html>
