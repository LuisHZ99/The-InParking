<?php
header('Access-Control-Allow-Origin: *');
include "conectar.php";

if (isset($_GET['codigo_p'])) {
  $codigo_p = $_GET['codigo_p'];

  $sql = " SELECT nombre_p, ap_p, am_p, identificacion_p, empresa, placa_p, modelo_p,
            fecha_e_p FROM proveedores 
            WHERE DATE (fecha_e_p) = CURDATE() AND codigo_p = :codigo_p;";
            
        
            
  
  $stmt = $conn->prepare($sql);
  $stmt->bindParam(':codigo_p', $codigo_p);
  $stmt->execute();
  
  $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
  
  if (count($rows) > 0) {
    echo json_encode($rows);
  } else {
    echo "No se encontraron registros para el número de control proporcionado.";
  }
} else {
  //echo "No se proporcionó el parámetro 'codigo_nc_ea' en la URL.";
}

$conn = null;
?>