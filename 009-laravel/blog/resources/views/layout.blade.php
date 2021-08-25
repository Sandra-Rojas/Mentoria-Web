<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Segic Blog</title>
    <!-- <link rel="stylesheet" href="app.css"> -->
    <!-- para que tome hoja de estilo -->
    <link rel="stylesheet" href="/app.css">
</head>
<body>
    <!-- Esta es la platilla padre -->
    <!-- con yield(PRODUCIR) indica que va a producir contenido -->
    <header>
        @yield('banner')    
    </header>

    @yield('content')
</body>
</html>
