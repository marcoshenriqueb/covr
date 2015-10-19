<!DOCTYPE html>
<html lang="">
       <head>
         <meta charset="utf-8">
         <meta http-equiv="X-UA-Compatible" content="IE=edge">
         <meta name="viewport" content="width=device-width, initial-scale=1">
         <title>Title Page</title>

         <!-- Bootstrap CSS -->
         <link href="css/home.css" rel="stylesheet">

         <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
         <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
         <!--[if lt IE 9]>
         <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
         <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
         <![endif]-->
       </head>
       <body id="teste">
         @for($i = 33; $i < 127; $i++)
            <div data-icon="{{chr($i)}}" class="iconbox_icon"></div>
         @endfor
         @for($i = 97; $i < 122; $i++)
            <div data-icon="&#xe00{{chr($i)}}" class="iconbox_icon"></div>
         @endfor
         @for($i = 0; $i < 10; $i++)
            <div data-icon="&#xe00{{$i}}" class="iconbox_icon"></div>
         @endfor
         @for($i = 97; $i < 122; $i++)
            @for($j = 0; $j < 10; $j++)
              <div data-icon="&#xe0{{$j}}{{chr($i)}}" class="iconbox_icon"></div>
            @endfor
         @endfor
         @for($i = 97; $i < 122; $i++)
           @for($j = 0; $j < 10; $j++)
             @for($k = 0; $k < 10; $k++)
              <div data-icon="&#xe{{$k}}{{$j}}{{chr($i)}}" class="iconbox_icon"></div>
             @endfor
           @endfor
         @endfor

       </body>
</html>
