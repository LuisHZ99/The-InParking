<?php
header('Access-Control-Allow-Origin: *');
include "conectar.php";

if (isset($_GET['codigo_nc_ea']) && isset($_GET['fecha_i_a'])) {
  $codigo_nc_ea = $_GET['codigo_nc_ea'];
  $fecha_i_a = $_GET['fecha_i_a'];

  $sql = "SELECT nombre, ap_a, am_a, carrera, telefono, placa_a, marca, modelo, color,
    CASE
        WHEN fecha_s_a IS NULL THEN 'Esta Estacionado'
        ELSE fecha_s_a
    END AS fecha_s_a
FROM alumnos 
JOIN entradaalumnos ON no_control = codigo_nc_ea
JOIN vehiculos ON placa_a = placa
LEFT JOIN (
    SELECT identrada_sa, MAX(fecha_s_a) AS fecha_s_a
    FROM salidaalumnos
    GROUP BY identrada_sa
) salidaalumnos ON identrada_a = identrada_sa
WHERE DATE(fecha_i_a) = CURDATE() AND codigo_nc_ea = :codigo_nc_ea AND fecha_i_a = :fecha_i_a;";
  
  $stmt = $conn->prepare($sql);
  $stmt->bindParam(':codigo_nc_ea', $codigo_nc_ea);
  $stmt->bindParam(':fecha_i_a', $fecha_i_a);
  $stmt->execute();
  
  $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
  
  if (count($rows) > 0) {
    echo json_encode($rows);
  } else {
    echo "No se encontraron registros para el número de control y la fecha proporcionados.";
  }
} else {
  echo "No se proporcionaron los parámetros 'codigo_nc_ea' y 'fecha_i_s' en la URL.";
}

$conn = null;
?>

