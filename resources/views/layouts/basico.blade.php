<!DOCTYPE html>
<html lang="es" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content=
        "width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}" />
    <title>Login</title>
  </head>
  <body>
    <div class="login">
      <img src="../css/img/rapadoLogo.png"class="logo" >

        <div class="login-box">
          <p class="inicio">Inicio de seccion {{ $tipo }}</p>
          @yield('contenido')
    </div>
    <div >
      <img src="../css/img/{{ $tipo }}.jpg"class="img-inicio">
    </div>
  </body>
</html>
