<?php
header('Access-Control-Allow-Origin: *');
include "conectar.php";


    $sql = 'SELECT codigo_v , CONCAT_WS("",nombre_v, " " ,ap_v) AS nombre, motivo, fecha_e_v
            FROM  visitantes 
            WHERE DATE(fecha_e_v) = CURDATE();';

    $rows = $conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($rows);


$conn = null;
?>