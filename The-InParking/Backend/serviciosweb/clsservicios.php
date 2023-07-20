<?php
class clsservicios{

//PROCEDIEMINTO ins_registrov
public function ins_registrov($nombre,$apellido_paterno,$apellido_materno,$identificacion,$motivo,$destino,$placa,$modelo){

    if($conn = mysqli_connect("localhost","u174842698_admin","Admin1234$","u174842698_world")){
    //if($conn = mysqli_connect("theinparking.c6cshpwbtmrs.us-east-2.rds.amazonaws.com","admin_tip","Admin1234$","theinparking")){
        //EJECUCION DEL COMANDO SQL Y RECIBIR RESULTADOS (recprdset)
        $renglon = mysqli_query($conn, "call ins_registrov('$nombre','$apellido_paterno','$apellido_materno',
        '$identificacion','$motivo','$destino','$placa','$modelo');");

        //CERRAR CONEXION
        mysqli_close($conn);
    }
}

    //PROCEDIEMINTO ins_registrop
    public function ins_registrop($nombre,$apellido_paterno,$apellido_materno,$identificacion,$empresa,$placa,$modelo){

        if($conn = mysqli_connect("localhost","u174842698_admin","Admin1234$","u174842698_world")){
        //if($conn = mysqli_connect("theinparking.c6cshpwbtmrs.us-east-2.rds.amazonaws.com","admin_tip","Admin1234$","theinparking")){
            //EJECUCION DEL COMANDO SQL Y RECIBIR RESULTADOS (recprdset)
            $renglon = mysqli_query($conn, "call ins_registrop('$nombre','$apellido_paterno','$apellido_materno'
            ,'$identificacion','$empresa','$placa','$modelo');");
    
            //CERRAR CONEXION
            mysqli_close($conn);
        }
    }


      //PROCEDIEMINTO usu_acceso
      public function usu_acceso($usuario,$contraseña){
        $datos=array();

        if($conn = mysqli_connect("localhost","u174842698_admin","Admin1234$","u174842698_world")){
        //if($conn = mysqli_connect("theinparking.c6cshpwbtmrs.us-east-2.rds.amazonaws.com","admin_tip","Admin1234$","theinparking")){
            //EJECUCION DEL COMANDO SQL Y RECIBIR RESULTADOS (recprdset)
            $renglon = mysqli_query($conn, "call usu_acceso('$usuario','$contraseña');");

              //CICLO PARA LECTURA DE REGISTROS
              while($resultado = mysqli_fetch_assoc($renglon)){
                $datos[0]["BANDA"] = $resultado["estatus"];
        
                    //VACIADO DE DATOS EN EL ARREGLO DE SALIDA
                     $datos[1]["NOMBRE"] = $resultado["nombre_completo_u"];
                     $datos[2]["USUARIO"] = $resultado["usuario"];
    
            }
    
            //CERRAR CONEXION
            mysqli_close($conn);
        }
        //RETORNAR EL ARREGLO FORMATEADO Y CON LOS DATOS DE RESULTADO
        return $datos;
    }


}
?>