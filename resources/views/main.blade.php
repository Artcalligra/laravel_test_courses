<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
          <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">


    </head>
    <body>

            <!-- @yield('content') -->

        
        <button id="loadCourses">Загрузить данные</button>
        <div class = "table-block">     
        </div>

        </div>


                <!-- Scripts -->
        <script src="{{ asset('js/app.js')}}"></script>
    </body>
</html>
