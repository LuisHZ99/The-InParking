<?php
header('Access-Control-Allow-Origin: *');
include "conectar.php";

if (isset($_GET["codigo_nc_ea"])) {
    $codigo_nc_ea = $_GET["codigo_nc_ea"];

    //VERIFICA SI EL NUMERO DE CONTROL EXISTE
    $stmt = $conn->prepare("SELECT COUNT(*) FROM alumnos WHERE no_control = :codigo_nc_ea");
    $stmt->bindParam(':codigo_nc_ea', $codigo_nc_ea);
    $stmt->execute();
    $alumnoExistente = $stmt->fetchColumn();

    if ($alumnoExistente > 0) {
        //VERIFICA SI EL ALUMNO TIENE UN REGISTRO EN ENTRADA ALUMNOS SIN UNA SALIDA CORRESPONDIENTE
        $stmt = $conn->prepare("SELECT COUNT(*) FROM entradaalumnos WHERE codigo_nc_ea = :codigo_nc_ea AND identrada_a NOT IN (SELECT identrada_sa FROM salidaalumnos)");
        $stmt->bindParam(':codigo_nc_ea', $codigo_nc_ea);
        $stmt->execute();
        $entradaPendiente = $stmt->fetchColumn();

        if ($entradaPendiente > 0) {
            //echo "El alumno con número de control $codigo_nc_ea ya tiene un registro de entrada sin salida correspondiente. Sigue estacionado.";
            echo "false";
            
        } else {
            //INSERTA EL NUMERO DE CONTROL EN ENTRADA ALUMNOS
            $stmt = $conn->prepare("INSERT INTO entradaalumnos (codigo_nc_ea) VALUES (:codigo_nc_ea)");
            $stmt->bindParam(':codigo_nc_ea', $codigo_nc_ea);
            $stmt->execute();

            echo "true";
        }
    } else {
        echo "false";
    }
}else {
    //echo "No se proporcionó el número de control.";
    echo "false";
}

$conn = null;
?>