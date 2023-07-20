<?php
header('Access-Control-Allow-Origin: *');
include "conectar.php";


    $sql = 'SELECT codigo_nc_ea , CONCAT_WS("",nombre, " " ,ap_a, " ", am_a) AS nombre, fecha_i_a 
            FROM entradaalumnos, alumnos
            WHERE no_control = codigo_nc_ea 
            AND DATE(fecha_i_a) = CURDATE() ORDER BY fecha_i_a DESC;';

    $rows = $conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($rows);


$conn = null;
?>