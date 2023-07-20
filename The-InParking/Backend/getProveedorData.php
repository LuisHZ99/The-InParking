<?php
header('Access-Control-Allow-Origin: *');
include "conectar.php";


    $sql = 'SELECT codigo_p , CONCAT_WS("",nombre_p, " " ,ap_p) AS nombre, empresa, fecha_e_p
            FROM proveedores 
            WHERE DATE(fecha_e_p) = CURDATE();';

    $rows = $conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($rows);


$conn = null;
?>

