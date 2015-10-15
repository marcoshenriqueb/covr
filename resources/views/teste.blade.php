<!DOCTYPE html>
<html lang="">
       <head>
         <meta charset="utf-8">
         <meta http-equiv="X-UA-Compatible" content="IE=edge">
         <meta name="viewport" content="width=device-width, initial-scale=1">
         <title>Title Page</title>

         <!-- Bootstrap CSS -->
         <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet">

         <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
         <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
         <!--[if lt IE 9]>
         <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
         <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
         <![endif]-->
       </head>
       <body id="teste">
        <h1 class="text-center">Hello World</h1>
        <button v-on="click: send" class="btn btn-large btn-block btn-primary">send</button>
        <!-- jQuery -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/0.12.16/vue.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/vue-resource/0.1.16/vue-resource.min.js"></script>
        <!-- Your own javascript -->
        <script type="text/javascript">

        new Vue({
          el: '#teste',

          methods:{
          send: function(){
              this.$http.get('api/currency/latest')
              .success(function(){
                alert('hey');
              });
            }
          }
        })
        </script>
       </body>
</html>
