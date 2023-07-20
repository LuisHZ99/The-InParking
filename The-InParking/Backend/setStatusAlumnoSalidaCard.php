<?php
header('Access-Control-Allow-Origin: *');
include "conectar.php";

if (isset($_GET["codigo_nc_sa"])) {
    $codigo_nc_sa = $_GET["codigo_nc_sa"];

    // VERIFICA SI EL NUMERO DE CONTROL EXISTE
    $stmt = $conn->prepare("SELECT COUNT(*) FROM alumnos WHERE no_control = :codigo_nc_sa");
    $stmt->bindParam(':codigo_nc_sa', $codigo_nc_sa);
    $stmt->execute();
    $alumnoExistente = $stmt->fetchColumn();

    if ($alumnoExistente > 0) {
        // OBTIENE EL ULTIMO identrada_a DE entradaalumnos ASIGNADO EN salidaalumnos
        $stmt = $conn->prepare("SELECT identrada_a FROM entradaalumnos WHERE codigo_nc_ea = :codigo_nc_sa AND identrada_a NOT IN (SELECT identrada_sa FROM salidaalumnos) ORDER BY identrada_a DESC LIMIT 1");
        
        $stmt->bindParam(':codigo_nc_sa', $codigo_nc_sa);
        $stmt->execute();
        $ultimaEntrada = $stmt->fetchColumn();

        if ($ultimaEntrada !== false) {
            // INSERTA EL NUMERO DE CONTROL EN salidaalumnos
            $stmt = $conn->prepare("INSERT INTO salidaalumnos (identrada_sa, codigo_nc_sa) VALUES (:identrada_a, :codigo_nc_sa)");
            $stmt->bindParam(':identrada_a', $ultimaEntrada);
            $stmt->bindParam(':codigo_nc_sa', $codigo_nc_sa);
            $stmt->execute();

            echo "true";
        } else {
            //echo "No hay entradas disponibles para asignar en salidaalumnos.";
            echo "false";
        }
    } else {
        //echo "El número de control no existe en la tabla alumnos.";
        echo "false";
    }
} else {
    //echo "No se proporcionó el número de control.";
    echo "false";
}

$conn = null;
?>
