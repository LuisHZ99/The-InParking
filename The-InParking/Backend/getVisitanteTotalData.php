<?php
header('Access-Control-Allow-Origin: *');
include "conectar.php";

if (isset($_GET['codigo_v'])) {
  $codigo_v = $_GET['codigo_v'];

  $sql = " SELECT nombre_v, ap_v, am_v, identificacion_v, motivo, destino_v, placa_v, modelo_v,
            fecha_e_v FROM visitantes 
            WHERE DATE (fecha_e_v) = CURDATE() AND codigo_v = :codigo_v;";
  
  $stmt = $conn->prepare($sql);
  $stmt->bindParam(':codigo_v', $codigo_v);
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