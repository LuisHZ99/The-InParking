<?php

//VALIDACION DE LA SESION ACTIVA DEL USUARIO
if (isset($_SESSION['nombre_usu']) == false && isset($_SESSION['usuario_usu']) == false) {
    echo "<script languaje = 'javascript'> alert ('Debe inicar sesion para acceder');</script>";
    
    // REDIRIGE AL USUARIO A LA PAGINA DE INICIO DE SESION SI NO HA INICIADO SESION
    header('Location: index.php');
  }


  $nombre="";
  $apellido_paterno="";
  $apellido_materno="";
  $identificacion="";
  $motivo="";
  $destino="";
  $placa="";
  $modelo="";

     //######### HACE USO DEL SERVICIO WEB QUE ESTA PUBLICADO DE MANERA LOCAL ########		 
     $cliente=new SoapClient(null, array('uri'=>'http://localhost/','location'=>'http://nandbless99.shop/theinparking/backend/serviciosweb/servicioweb.php'));	

     // INSERCION DEL NUEVO USUARIO
    if(!empty($_POST["nombre_cajatexto"]) && !empty($_POST["apellido_paterno_cajatexto"]) && 
    !empty($_POST["apellido_materno_cajatexto"]) && !empty($_POST["identificacion_cajatexto"])  && !empty($_POST["motivo_cajatexto"]) && 
    !empty($_POST["destino_cajatexto"]) && !empty($_POST["placa_cajatexto"]) &&!empty($_POST["modelo_cajatexto"]))
    {
     $nombre = htmlspecialchars($_POST["nombre_cajatexto"]);
     $apellido_paterno = htmlspecialchars($_POST["apellido_paterno_cajatexto"]);
     $apellido_materno = htmlspecialchars($_POST["apellido_materno_cajatexto"]);
     $identificacion = htmlspecialchars($_POST["identificacion_cajatexto"]);
     $motivo = htmlspecialchars($_POST["motivo_cajatexto"]);
     $destino = htmlspecialchars($_POST["destino_cajatexto"]);
     $placa = htmlspecialchars($_POST["placa_cajatexto"]);   
     $modelo = htmlspecialchars($_POST["modelo_cajatexto"]);


    $cliente->ins_registrov($nombre,$apellido_paterno,$apellido_materno,$identificacion,$motivo,$destino,$placa,$modelo);
    echo '<script language="javascript">alert("Visitante Registrado.")</script>';
     

     $nombre="";
     $apellido_paterno="";
     $apellido_materno="";
     $identificacion="";
     $motivo="";
     $destino="";
     $placa="";
     $modelo="";
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
        <!-- INCLUIR LAS DEPENDECIAS DE BOOTSTRAP (jQuery y Bootstrap CSS) PARA MOSTRAR EL MODEL CUANDO SELECCINO UNA FILA DE LA TABLA -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
         <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    
            <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
            <script src="frontend/mainVisitante.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    
    <title>The In-Parking</title>
    <link rel="stylesheet" href="estilos/estilos2.css">
</head>

<body>
       
       <div class="container">
    <div class="row">
<div class="card card-titulo">
<h2 class="text-center titulo-panel">Visitantes</h2>
</div>
</div>
</div>
  
    <div class="content">

        <div class="contact-wrapper">

            <div class="contact-form">
                

                <form method="POST">
                 
                        <input type="text" class="form-control" name='nombre_cajatexto' placeholder="Nombre" autocomplete="off">
                        <br>
                        <input type="text" class="form-control" name="apellido_paterno_cajatexto" placeholder="Apellido Paterno" autocomplete="off">
                        <br>
                        <input type="text" class="form-control" name="apellido_materno_cajatexto" placeholder="Apellido Materno" autocomplete="off">
                        <br>
                        <input type="text" class="form-control" name="identificacion_cajatexto" placeholder="Identificacion" autocomplete="off">
                        <br>
                        <input type="text" class="form-control" name="motivo_cajatexto" placeholder="Motivo" autocomplete="off">
                        <br>
                        <input type="text" class="form-control" name="destino_cajatexto" placeholder="Destino" autocomplete="off">
                        <br>
                        <input type="text" class="form-control" name="placa_cajatexto" placeholder="Placa" autocomplete="off">
                        <br>
                        <input type="text" class="form-control" name="modelo_cajatexto" placeholder="Modelo" autocomplete="off">
                        <br>
                        <br>
                        <button type="submit" class="btn" id="registrar" >REGISTRAR</button>
                        <br>
                        </form>
            </div>
            <div class="contact-info">
                
                <p class="sub">Ingreso</p>
                <div class="tabla-contenedor">
                <table class="table">
                    <thead>
                    <tr>
                        <th>Codigo</th>
                        <th>Nombre</th>
                        <th>Motivo</th>
                        <th>Fecha de Ingreso</th>
                    </tr>
                    </thead>
                    <tbody id="datos_v">
                    <tr id="fila_visitantes">
                       
                    </tr>
                    </tbody>
                </table>
                </div>
            </div>
            
               
<div class="modal fade" id="myModalVisitante">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title">Datos del Visitante</h3>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body" id="modalBodyVisitante">
        <!-- DATOS DE LA FILA SELECCIONADA DE LA TABLA ALUMNOS -->
      </div>
    </div>
  </div>
</div>

        </div>
    </div>
    
     <br>

  

</body>

</html>