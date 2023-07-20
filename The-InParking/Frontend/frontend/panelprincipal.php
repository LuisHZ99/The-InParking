<?php
//VALIDACION DE LA SESION ACTIVA DEL USUARIO
  if (isset($_SESSION['nombre_usu']) == false && isset($_SESSION['usuario_usu']) == false) {
    echo "<script languaje = 'javascript'> alert ('Debe inicar sesion para acceder');</script>";
    
    // REDIRIGE AL USUARIO A LA PAGINA DE INICIO DE SESION SI NO HA INICIADO SESION
    
    header('Location: index.php');
  }

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">

  <!-- siempre debe colocarse pars que sea adaptable-->
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
    <!-- INCLUIR LAS DEPENDECIAS DE BOOTSTRAP (jQuery y Bootstrap CSS) PARA MOSTRAR EL MODEL CUANDO SELECCINO UNA FILA DE LA TABLA -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
         <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="frontend/mainPanelP.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">


  <title>The In-Parking</title>
  <link rel="stylesheet" href="estilos/estilos.css">
</head>

<body style = "background: #CCD1D1;">
    
<div class="container">
    <div class="row">
<div class="card card-titulo">
<h2 class="text-center titulo-panel">Alumnos</h2>
</div>
</div>
</div>



<div class="container">
    <div class="row">
      <div class="card card-alumno">
           <h3 style = "margin-bottom:35px;" class= "text-center">Ingresando</h3>
    <img src="" width="170" height="200" class = "foto_usuario">
    <div class="card-body">
        <ul class="list-group list-group-flush">
    <li class="list-group-item"><span class="fuente-cabecera-card">Nombre: </span><span 
    class="fuente-dato-card" id="lblnombre"> </span></li>
    <li class="list-group-item"><span class="fuente-cabecera-card">Apellidos: </span><span 
    class="fuente-dato-card" id="lblapellidos"> </span></li>
    <li class="list-group-item"><span class="fuente-cabecera-card">No.Control: </span><span 
    class="fuente-dato-card" id="lblnocontrol"> </span></li>
    <li class="list-group-item"><span class="fuente-cabecera-card">Carrera: </span><span 
    class="fuente-dato-card" id="lblcarrera" > </span></li>
    <li class="list-group-item"><span class="fuente-cabecera-card">Telefono: </span><span 
    class="fuente-dato-card" id="lbltelefono"> </span></li>
    <li class="list-group-item"><span class="fuente-cabecera-card">Placas: </span><span 
    class="fuente-dato-card" id="lblplacas" > </span></li>
    <li class="list-group-item"><span class="fuente-cabecera-card">Marca: </span><span 
    class="fuente-dato-card" id="lblmarca" > </span></li>
    <li class="list-group-item"><span class="fuente-cabecera-card">Modelo: </span><span 
    class="fuente-dato-card" id="lblmodelo"> </span></li>
    <li class="list-group-item"><span class="fuente-cabecera-card">Color: </span><span 
    class="fuente-dato-card" id="lblcolor"> </span></li>
    <li class="list-group-item"><span class="fuente-cabecera-card">Fecha de Ingreso: </span><span 
    class="fuente-dato-card" id="lblhrentrada"> </span></li>

 </div>
      </div>
      
      <div class = "col" style = "margin-left: 10px;">
             <h3 class= "text-center tabla-titulo">Ingreso</h3>
             <div class="tabla-contenedor">
      <table class="table tabla-estilo">
        <thead>
          <tr>
            <th scope="col-1">No.Control</th>
            <th scope="col-3">Nombre</th>
            <th scope="col-2">Fecha de Ingreso</th>
          </tr>
        </thead>
        <tbody id="datos_a">
            <tr id="fila_alumno">
              
            </tr>
        </tbody>
      </table>
       </div>
       
       
<div class="modal fade" id="myModalPanelP">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title">Datos del Alumno</h3>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body" id="modalBodyPanelP">
          
        <!-- DATOS DE LA FILA SELECCIONADA DE LA TABLA ALUMNOS -->
      </div>
    </div>
  </div>
</div>

        </div>

        
    </div>
      </div>
      


  <br>
  <br>
  <br>


</body>

</html>