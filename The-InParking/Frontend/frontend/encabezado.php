<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">

  <!-- siempre debe colocarse pars que sea adaptable-->
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  

  <title>The In-Parking</title>
  <link rel="stylesheet" href="estilos/estilos.css">
  
    <!-- Carga de las bibliotecas de Bootstrap y jQuery -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  
  <link rel="icon" href="/imagenes/logosecundarioicono.png" type="image/x-icon">
</head>

<body style = "background: #CCD1D1;">

  <div class="row">
    <div class="col encabezado">
        <img src="imagenes/logosecundario.png" width="150" height="60" class="imagen-logo-encabezado">
        
      
 <div class="dropdown">
<button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
  <img src="imagenes/usuario_icono.png"  width="40" height="40">
</button>
  <div class="dropdown-menu dropdown-menu-blue" aria-labelledby="dropdownMenuButton">
      
      
<?php
// VALIDACION DE LA SESION ACTIVA DEL USUARIO
if (isset($_SESSION['nombre_usu']) && isset($_SESSION['usuario_usu'])) {
  echo '<a class="dropdown-item" href="#" disabled>';
  echo '<img src="imagenes/nombre_usuario.png" width="40" height="30" style="margin-right:10px;">' . $_SESSION["nombre_usu"] . '</a>';
}
?>
      
    <a class="dropdown-item" href="inicio.php?pp=cerrarsesion">  
    <img src="imagenes/cerrar_sesion.png"  width="40" height="30" style="margin-right:10px;">Cerrar Sesion</a>
  </div>
</div>


<button type="submit" class="btn botones_encabezado_inicio" onclick="window.location.href='inicio.php'">Alumnos</button>
<button type="submit" class="btn botones_encabezado_visitante" onclick="window.location.href='?pp=visitantes'">Visitantes</button>
<button type="submit" class="btn botones_encabezado_proveedores" onclick="window.location.href='?pp=proveedores'">Proveedores</button>

    </div>
    
  </div>
  </body>

</html>