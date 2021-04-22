@extends('layouts.basico-registro')
@section('contenido')
<?php
 if ( $tipo =="administrador") {

      echo "<p >Codigo</p>";
      echo "<input type='text' placeholder='123456789' name='codigo' required>";

}
 if( $tipo =="peluqueria")
{
  echo "<div class='registro'>";
      echo "<p >Nombre peluqueria</p>";
      echo "<input type='text' placeholder='Peluqueria' name='peluqueria' required>";
      echo "<p >Direccion</p>";
      echo "<input type='text' placeholder='Av.Ejemplo #111' name='direccion' required>";
  echo "</div>";
  }
  ?>
@endsection
