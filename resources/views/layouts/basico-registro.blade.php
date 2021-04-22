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
          <p class="inicio">Registro {{ $tipo }}</p>

          <form action="{{route('registro.store')}}" method="post" >
            @csrf
                      <p >Nombre</p>
                      <input type="text" placeholder="Nombre Apellido" name="nombre" required>
                      <p >Correo electronico</p>
                      <input type="text" placeholder="nombre@email.com" name="correo" required>
                      <p >Telefono</p>
                      <input type="tel" placeholder="3333333333" name="telefono" pattern="[0-9]{10}" required>
                      <p>Contraseña</p>
                      <input type="password" placeholder="**********" name="contraseña" required>
                      @yield('contenido')
                    </br></br>
                      <input type="submit" value="Registrar">
        </form>
      </div>
      <?php
       if ( $tipo =="administrador" or $tipo =="cliente") {
         echo "<img src='../css/img/$tipo.jpg'class='registro'>";}
         ?>
    </div>
  </body>
</html>
