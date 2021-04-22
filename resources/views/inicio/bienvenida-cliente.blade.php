@extends('layouts.basico')
@section('contenido')

    <form action="store.php" method="post" >
              <!-- USERNAME INPUT -->
                <p >Correo electronico</p>
                <input type="text" placeholder="nombre@email.com" name="username" required>
                    <!-- PASSWORD INPUT -->
                <p>Contraseña</p>
                <input type="password" placeholder="**********" name="password" required>
              </br></br>
                <input type="submit" value="Entrar">
            </form>
          </div>
            <div class="nueva">
              <b>¿No tienes una cuenta?<b>
              <a href="../registro/{{ $tipo }}">Crea una</a>
            </div>

@endsection
