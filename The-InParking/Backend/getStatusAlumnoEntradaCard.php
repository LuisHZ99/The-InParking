<?php
header('Access-Control-Allow-Origin: *');
include "conectar.php";

$sql = "SELECT foto_a, nombre, CONCAT_WS('', ap_a, ' ', am_a) AS apellidos, codigo_nc_ea, carrera, telefono, 
        placa_a, marca, modelo, color, fecha_i_a
        FROM entradaalumnos, alumnos, vehiculos
        WHERE no_control = codigo_nc_ea AND placa = placa_a 
        ORDER BY fecha_i_a DESC LIMIT 1;";

$stmt = $conn->prepare($sql);
$stmt->execute();

$row = $stmt->fetch(PDO::FETCH_ASSOC);

echo json_encode($row);

$conn = null;
?>
