<?php
//PROCESO PARA CERRAR SESION DEL USUARIO
//(DESTRUCCION DE VARIABLES DE SESION)

if(isset($_SESSION["nombre_usu"]) && isset($_SESSION["usuario_usu"])){
    
    //DESTRUCCION DE VARIABLES DE SESION
    session_destroy();
    
    echo "<script lenguaje = 'javascript'> alert ('Sesion cerrada exitosamente');</script>";
    echo "<script lenguaje = 'javascript'> document.location.href='index.php'</script>";
    
}else{
    
    echo "<script lenguaje = 'javascript'> alert ('No hay usuario en sesion');</script>";
    echo "<script lenguaje = 'javascript'> document.location.href='index.php'</script>";
}

?>