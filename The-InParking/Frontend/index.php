<?php

session_start(); 

$usuario = "";
$contraseña = "";
$datos=array();


if( !empty($_POST['cajatexto_usuario']) && !empty($_POST['cajatexto_contraseña'])){

  	//TOMA LOS VALORES DE LAS CAJAS DE TEXTO
		$usuario    =htmlspecialchars($_POST['cajatexto_usuario']);
		$contraseña =htmlspecialchars($_POST['cajatexto_contraseña']);

     //######### HACE USO DEL SERVICIO WEB QUE ESTA PUBLICADO DE MANERA LOCAL ########		 
     $cliente=new SoapClient(null, array('uri'=>'http://localhost/','location'=>
     'http://nandbless99.shop/theinparking/backend/serviciosweb/servicioweb.php'));

      //SE EJECUTA EL MÉTODO DE ACCESO DEL SERVICIO WEB, PASANDO SUS PARAMETROS
	  $datos = $cliente->usu_acceso($usuario, $contraseña);

    if((int)$datos[0]["BANDA"] != 0){

      echo json_encode($datos);

      $_SESSION["nombre_usu"] = $datos[1]["NOMBRE"];
      $_SESSION["usuario_usu"] = $datos[2]["USUARIO"];
      header("Location: inicio.php");

    } else{
      // MENSAJE DE USUARIO INVALIDO
       echo "<script language='javascript'>alert('Usuario invalido, verificar sus datos');</script>";      
    }
 
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">

  <!-- siempre debe colocarse pars que sea adaptable-->
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">


  <title>The In-Parking</title>
  <link rel="stylesheet" href="estilos/estilos.css">
  <link rel="icon" href="/imagenes/logosecundarioicono.png" type="image/x-icon">
</head>

<body style = "background: #CCD1D1;">

  <div class="row">
    <div class="col encabezado">
         <img src="imagenes/logosecundario.png" width="150" height="60" class="imagen-logo-encabezado">
      <h4>The In-Parking</h4>
    </div>
  </div>

  <br>
  <br>

<div class="container">
    <div class="row">
          <div class="card card-alumno login">
        <h1 class="text-center texto-login">Bienvenido</h1>
        <br>
        <br>
        <form method="POST" class="form-center">
        <input type="text" class="form-control" name="cajatexto_usuario" placeholder="Usuario" autocomplete="off">
        <br>
        <input type="password" class="form-control" name="cajatexto_contraseña" placeholder="Contraseña" autocomplete="off">
        <br>
        <br>
        <button type="submit" class="btn" id="ingresar">Ingresar</button>
        </form>
        </div>
      
      <div class = "col">
        <img src="imagenes/itpachuca_logo.png" width="400" height="300" class="imagen-logo-izquierdo">
        </div>
      
    </div>
      </div>

  <br>

  <div class="row">
    <div class="col encabezadoinferiorlogin">
      <h5>Todos los derechos reservados 2023 © By Zunword </h5>
    </div>
  </div>
 

</body>

</html>