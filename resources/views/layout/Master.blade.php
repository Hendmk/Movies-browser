
    <!doctype html>
    <html lang="{{ app()->getLocale() }}">

    <title> {{ $title }} </title>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Karma">
    <link href="{{ asset ('css/style.css')}}"   rel="stylesheet" type="text/css" />
    <link href="{{ asset ('css/Browse.css')}}"   rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>

    <body>

    <div class="bgimg w3-display-container w3-animate-opacity w3-text-white">
    <div class="w3-display-topleft w3-padding-large w3-xlarge">
      <a href="/start"  style='text-decoration: none;'><h2><strong >M</strong>oview browser<h2></a>
    </div>

    @yield('content')



    </div>

    </body>

    </html>
